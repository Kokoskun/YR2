<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Groups;
use App\ImageFloor;
use App\User;
use App\SocialAuth;
use App\VerifyPermissionGroups;
use Image;
use File;
class ManageGroupAdminController extends Controller{
	protected function index(){
        $layoutLocat = 'manage-group';
        $dataGroups = Groups::orderBy('id','desc')->get();
        $dataUser = User::orderBy('permission_id','desc')->get();
        $countGroup = count($dataGroups);
        $listVPG=VerifyPermissionGroups::all();
        $listSocialAuth=SocialAuth::all();
        $dataSocialAuth = [];
        $dataVPG=[];
        $dataCountVPG=[];
        for ($item=0;$item<count($listSocialAuth);$item++){
            $dataSocialAuth[$listSocialAuth[$item]->user_id]=[];
            $dataSocialAuth[$listSocialAuth[$item]->user_id]['facebook_id']=$listSocialAuth[$item]->facebook_id;
            $dataSocialAuth[$listSocialAuth[$item]->user_id]['google_id']=$listSocialAuth[$item]->google_id;
        }
        for($item=0;$item<count($listVPG);$item++){
        	$groupID=$listVPG[$item]->group_id;
        	$permissionID=$listVPG[$item]->dataUser->permission_id;
			if(isset($dataVPG[$groupID])){
				$countList=count($dataVPG[$groupID]);
			}else{
				$countList=0;
			}
        	if(isset($dataCountVPG[$groupID])){
        		$dataCountVPG[$groupID]++;
        	}else{
        		$dataCountVPG[$groupID]=1;
        	}
        	if($permissionID==70||$permissionID==80){
	        	$dataVPG[$groupID][$countList]['image_name']=$listVPG[$item]->dataUser->image_name;
        	}
        }
        return view('manage.groups.index', ['layoutLocat'=>$layoutLocat,'dataGroups'=>$dataGroups,'countGroup'=>$countGroup,'dataUser'=>$dataUser,'dataVPG'=>$dataVPG,'dataCountVPG'=>$dataCountVPG,'listVPG'=>$listVPG,'dataSocialAuth'=>$dataSocialAuth]);

	}
	protected function create(Request $request){
		$valueName=$request->createNameGroup;
		$valueRemark=$request->createRemarkGroup;
		$statusRemark=true;
		$statusName=true;
		if(isset($valueName)){
			if(preg_match('/[\041\042\043\044\046\073\133\135\173\175\176\177]/',$valueName)){
				$statusName=false;
			}
		}else{
			$statusName=null;
		}		
		if(isset($valueRemark)){
			if(preg_match('/[\041\042\043\044\046\048\049\073\133\135\173\175\176\177]/',$valueRemark)){
				$statusRemark=false;
			}
		}else{
			$statusRemark=null;
			$valueRemark=null;
		}
		if($statusName!=true||($statusRemark==false&&$statusRemark!=null)){
			$response = array(
				'idGroup'=>null,
				'valueName'=>$valueName,
				'valueRemark'=>$valueRemark,
				'statusName'=>$statusName,
				'statusRemark'=>$statusRemark
			);
		}else{
			$groupID=Groups::create([
				'name'=>$valueName,
				'remark'=>$valueRemark
			])->id;
			$response = array(
				'idGroup'=>$groupID,
				'valueName'=>$valueName,
				'valueRemark'=>$valueRemark,
				'statusName'=>$statusName,
				'statusRemark'=>$statusRemark
			);
		}
		return response()->json($response);
	}
    protected function destroyGroup(Request $request){
        $valueID = $request->messageID;
        $valueGroup = Groups::where('id', $valueID)->first();
        if(isset($valueGroup)){
            Groups::where('id',$valueID)->delete();
            VerifyPermissionGroups::where('group_id',$valueID)->delete();
            $dataImageFloor=ImageFloor::where('group_id',$valueID)->get();
            for($item=0;$item<count($dataImageFloor);$item++){
            	File::delete(public_path().'/image/floor/'.$dataImageFloor[$item]->image_name);
            }
			$dataDefect=Defect::where('group_id',$valueID)->get();
            for($item=0;$item<count($dataDefect);$item++){
	            $verifyDefect = VerifyPermissionDefect::where('defect_id',$dataDefect[$item]->id)->first();
	      		$dataFloorDefect = FloorDefect::where('defect_id',$dataDefect[$item]->id)->get();
	            $dataImageDefect = ImageDefect::where('defect_id',$dataDefect[$item]->id)->get();
	            Defect::where('id',$dataDefect[$item]->id)->delete();
	            for($itemImage=0;$itemImage<count($dataImageDefect);$itemImage++){
	            	File::delete(public_path().'/image/defects50/'.$dataImageDefect[$itemImage]->image_name);
	                File::delete(public_path().'/image/defects/'.$dataImageDefect[$itemImage]->image_name);
	            }
	            if(isset($verifyDefect)){
	            	VerifyPermissionDefect::where('defect_id',$dataDefect[$item]->id)->delete();
	            }
	            if(isset($dataFloorDefect)){
	            	FloorDefect::where('defect_id',$dataDefect[$item]->id)->delete();
	            }
	            if(isset($dataImageDefect)){
	            	ImageDefect::where('defect_id',$dataDefect[$item]->id)->delete();
	            }
            }
        }else{
	        $response = array(
	          'valueID'=>null
	        );
        }
        $response = array(
          'valueID'=>$valueID
        );
        return response()->json($response);
    }
    protected function updateGroup(Request $request){
		$valueName=$request->editGroupName;
		$valueRemark=$request->editRemark;
		$valueGroupID=$request->groupID;
		$valueGroupID=number_format($valueGroupID);
        $valueGroup = Groups::where('id', $valueGroupID)->first();       
		$statusRemark=true;
		$statusName=true;
		$statusID=true;
		if(isset($valueName)){
			if(preg_match('/[\041\042\043\044\046\073\133\135\173\175\176\177]/',$valueName)){
				$statusName=false;
			}
		}else{
			$statusName=null;
		}		
		if(isset($valueRemark)){
			if(preg_match('/[\041\042\043\044\046\048\049\073\133\135\173\175\176\177]/',$valueRemark)){
				$statusRemark=false;
			}
		}else{
			$statusRemark=null;
			$valueRemark='';
		}

		if(isset($valueGroup)){
			if($statusRemark==true||$statusRemark==null){
				Groups::where('id',$valueGroupID)->update(['remark'=>$valueRemark]);
			}
			if($statusName==true){
				Groups::where('id',$valueGroupID)->update(['name'=>$valueName]);
			}
		}
		$response = array(
			'idGroup'=>$valueGroupID,
			'countGroup'=>count($valueGroup),
			'valueName'=>$valueName,
			'valueRemark'=>$valueRemark,
			'statusName'=>$statusName,
			'statusRemark'=>$statusRemark
		);
		return response()->json($response);
    }
    protected function viewMangeFloor($id){
        $layoutLocat = 'manage-group';
        $dataGroup=Groups::where('id',$id)->first();
        $dataImageFloor=ImageFloor::where('group_id',$id)->orderBy('number_class','asc')->get();
        $countFloor=count($dataImageFloor);
        return view('manage.groups.floor',['layoutLocat'=>$layoutLocat,'countFloor'=>$countFloor,'id'=>$id,'dataGroup'=>$dataGroup,'dataImageFloor'=>$dataImageFloor]);
    }
	protected function createFloor(Request $request,$id){
		$textRemark=$request->remark;
		$numberClass=$request->numberClass;
		$statusImage=true;
		if(is_numeric($numberClass)){
			if($numberClass>=0&&$numberClass<=150){
				$statusNumber=true;
			}else{
				$statusNumber=false;
			}
		}else{
			$statusNumber=null;
		}
		if($request->hasFile('fileUploadFloor')){
			$fileMimeType=$request->file('fileUploadFloor')->getMimeType();
			if($fileMimeType!=image_type_to_mime_type(IMAGETYPE_JPEG)&&$fileMimeType!=image_type_to_mime_type(IMAGETYPE_PNG)){
				$statusImage= false;
			}
		}else{
			$statusImage= null;
		}
		if(empty($statusImage)||empty($statusNumber)){
			$numberClass=null;
			$imageFloorID=null;
			$textRemark=null;
			$newfilename=null;
		}else{
			$newfilename=$this->createImageFloor($id,$request,'fileUploadFloor');
			$imageFloorID = ImageFloor::create(array(
				'group_id'=>$id,
				'number_class'=>$numberClass,
				'image_name'=>$newfilename,
				'remark'=>$textRemark,
			))->id;
		}
		$response = array(
			'groupID'=>$id,
			'statusImage'=>$statusImage,
			'statusNumber'=>$statusNumber,
			'numberClass'=>$numberClass,
			'imageFloorID'=>$imageFloorID,
			'textRemark'=>$textRemark,
			'newfilename'=>$newfilename
		);
		return response()->json($response);
	}
	protected function createImageFloor($groupID,Request $request,$nameFile){
		$time = date('Y-m-d:H:i:s');
		$sizeImage=File::size($request->file($nameFile));
		$newfilename=str_random(10).md5($time).'.'.
		$request->file($nameFile)->getClientOriginalExtension();
		$request->file($nameFile)->move(public_path().'/image/',$newfilename);
		$dataImage=getimagesize(public_path().'/image/'.$newfilename);
		$widthImage= $dataImage[0];
		$heightImage= $dataImage[1];
		$heightNewImage=($heightImage/$widthImage)*1280;
		Image::make(public_path().'/image/'.$newfilename)->resize(1280,$heightNewImage)->save(public_path().'/image/floor/'.$newfilename);
		File::delete(public_path().'/image/'.$newfilename);
		return $newfilename;
	}
    protected function viewManagePerson($id){
        $layoutLocat = 'manage-group';
        $dataSocialAuth = [];
        $dataUser = User::orderBy('permission_id','desc')->get();
    	$arrayVPG=[];
    	$dataVPG=VerifyPermissionGroups::where('group_id',$id)->get();
		$countUser=count($dataVPG);
        $listSocialAuth=SocialAuth::all();
        $dataGroup=Groups::where('id',$id)->first();
        for ($item=0;$item<count($listSocialAuth);$item++){
            $dataSocialAuth[$listSocialAuth[$item]->user_id]=[];
            $dataSocialAuth[$listSocialAuth[$item]->user_id]['facebook_id']=$listSocialAuth[$item]->facebook_id;
            $dataSocialAuth[$listSocialAuth[$item]->user_id]['google_id']=$listSocialAuth[$item]->google_id;
        }
        return view('manage.groups.user',['layoutLocat'=>$layoutLocat,'countUser'=>$countUser,'dataUser'=>$dataUser,'dataSocialAuth'=>$dataSocialAuth,'id'=>$id,'dataVPG'=>$dataVPG,'dataGroup'=>$dataGroup]);
    }
    protected function confirmPerson(Request $request,$id){
    	$valueUser=$request->userGroup;
    	$groupID=$request->groupID;
    	$listGroup=Groups::where('id',$groupID)->first();
    	$countGroup=count($listGroup);
    	$valueCount=count($valueUser);
    	if($valueCount!=0&&$countGroup!=0){
	    	for($item=0;$item<$valueCount;$item++){
	    		$dataUser = User::where('id', $valueUser[$item])->first();
	    		$dataVPG = VerifyPermissionGroups::where([['group_id','=',$groupID],['user_id','=',$valueUser[$item]]])->first();
	    		if(isset($dataUser)&&isset($dataVPG)){
					$idVPG=VerifyPermissionGroups::create([
						'group_id'=>$groupID,
						'user_id'=>$valueUser[$item]
					])->id;
	    		}
	    	}
    	}else if($countGroup==0){
    		return view('errors.404');
    	}
		return redirect()->action(
			'ManageGroupAdminController@viewManagePerson',['id' =>$groupID]
		);
    }
    protected function dismissPerson(Request $request,$id){
        $valueID = $request->messageID;
        $valueGroupID = $request->groupID;
        $dataVPG = VerifyPermissionGroups::where([['group_id','=',$valueGroupID],['user_id','=',$valueID]])->first();          
        if(isset($dataVPG)){
            VerifyPermissionGroups::where([['group_id','=',$valueGroupID],['user_id','=',$valueID]])->delete();
        }else{
	        $response = array(
	          'valueID'=>null
	        );
        }
        $response = array(
          'valueID'=>$valueID
        );
        return response()->json($response);
    }
    protected function dismissFloor(Request $request,$id){
        $valueID = $request->messageID;
        $valueGroupID = $request->groupID;
        $dataImageFloor=ImageFloor::where([['group_id','=',$valueGroupID],['id','=',$valueID]])->first();          
        if(isset($dataImageFloor)){
            ImageFloor::where([['group_id','=',$valueGroupID],['id','=',$valueID]])->delete();
	        File::delete(public_path().'/image/floor/'.$dataImageFloor->image_name);
        }else{
	        $response = array(
	          'valueID'=>null
	        );
        }
        $response = array(
          'valueID'=>$valueID
        );
        return response()->json($response);
    }
    protected function viewMangeStatusDefect(Request $request,$id){
    	return $id;
    }
}