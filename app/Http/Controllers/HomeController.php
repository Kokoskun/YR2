<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Defect;
use App\VerifyPermissionDefect;
use App\VerifyPermissionGroups;
use App\ImageDefect;
use App\Permission;
use App\Status;
class HomeController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    protected function index(){
		$layoutLocat = 'home';
		$layoutLocatMobile = 'home-mobile';
		if(Auth::user()->permission_id==30){
			$userID=Auth::user()->id;
			$listImageDefect=ImageDefect::all();
			$dataGroups=VerifyPermissionGroups::where('user_id',$userID)->orderBy('id','desc')->get();
			$dataPermission=Permission::all();
			$listStatus=Status::all();
			$dataImageDefect=[];
			$checkDefectID=[];
			$dataDefect=[];
			$countDefectID=0;
			$dataInvolved=[];
			$dataStatus=[];
			for($item=0;$item<count($liteDefect);$item++){
				$groupID=$liteDefect[$item]->dataDefect->group_id;
				$permissionID=$liteDefect[$item]->permission_id;
				$statusID=$liteDefect[$item]->dataDefect->status_id;
				if(empty($dataStatus[$groupID])){
					$dataStatus[$groupID]=[];
				}
				if(empty($dataStatus[$groupID][$statusID])){
					$dataStatus[$groupID][$statusID]=1;
				}else{
					$dataStatus[$groupID][$statusID]+=1;
				}
				if(empty($dataInvolved[$groupID])){
					$dataInvolved[$groupID]=[];
				}
				if(empty($dataInvolved[$groupID][$permissionID])){
					$dataInvolved[$groupID][$permissionID]=1;
				}else{
					$dataInvolved[$groupID][$permissionID]+=1;
				}
			}
			for($item=0;$item<count($listImageDefect);$item++){
				$defectID=$listImageDefect[$item]->defect_id;
				if(isset($checkDefectID[$defectID])){
					$dataImageDefect[$countDefectID]=[];
					$dataImageDefect[$countDefectID][0]=$defectID;
					$dataImageDefect[$countDefectID][1]=$listImageDefect[$item]->image_name;
					$countDefectID+=1;
				}
			}
			return view('home.inspector',['layoutLocat'=>$layoutLocat,'layoutLocatMobile'=>$layoutLocatMobile,'dataDefect'=>$dataDefect,'dataGroups'=>$dataGroups,'dataImageDefect'=>$dataImageDefect,'dataInvolved'=>$dataInvolved,'dataPermission'=>$dataPermission,'dataStatus'=>$dataStatus,'listStatus'=>$listStatus]);
		}else{
			return view('home',['layoutLocat'=>$layoutLocat,'layoutLocatMobile'=>$layoutLocatMobile]);
		}
    }
}