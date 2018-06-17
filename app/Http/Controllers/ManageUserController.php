<?php
namespace App\Http\Controllers;
use App\User;
use App\SocialAuth;
use App\Permission;
use Image;
use File;
use Illuminate\Http\Request;
class ManageUserController extends Controller{
    protected function index(){
        $layoutLocat = 'manage-user';
        $dataSocialAuth = [];
        $dataPermission = Permission::all();
        $dataUsers = User::orderBy('permission_id','desc')->get();
        $listSocialAuth = SocialAuth::all();
        for ($item=0; $item < count($listSocialAuth); $item++){
            $dataSocialAuth[$listSocialAuth[$item]->user_id] =[];
            $dataSocialAuth[$listSocialAuth[$item]->user_id]['facebook_id'] =  $listSocialAuth[$item]->facebook_id;
            $dataSocialAuth[$listSocialAuth[$item]->user_id]['google_id'] =  $listSocialAuth[$item]->google_id;
        }
        $countUser = count($dataUsers);
        return view('manage.users.index', ['layoutLocat'=>$layoutLocat,'dataUsers'=>$dataUsers,'countUser'=>$countUser,'dataSocialAuth'=>$dataSocialAuth,'dataPermission'=>$dataPermission]);
    }
    protected function updatePermission(Request $request){
        $valueUpdate = $request->messageUpdate;
        $value = $request->message;
        $valueID = $request->messageID;
        $valuePermission = Permission::where('id', $valueUpdate)->first();
        $valueUser = User::where('id', $valueID)->first();          
        if(count($valuePermission) !=0 && count($valueUser)!=0){
            User::where('id',$valueID)->update(['permission_id' => $valueUpdate]);
        }
        $response = array(
          'valueUpdate'=>$valueUpdate,'value'=>$value,'valueID'=>$valueID
        );
        return response()->json($response);
    }
    protected function updateUser(Request $request,$id){
        $valueEmail = $request->editEmail;
        $valueFirstName=$request->editFirstName;
        $valueLastName=$request->editLastName;
        $valueImage =null;
        $statusEmail = true;
        $statusFirstName=true;
        $statusLastName=true;
        $statusImage=true;
        $statusID=true;
        $valueUser = User::where('id', $id)->first();
        if (isset($valueEmail)){
            if (!filter_var($valueEmail, FILTER_VALIDATE_EMAIL)||preg_match('/[\032\041\042\043\044\046\047\050\051\052\053\054\055\057\072\073\074\075\076\077\133\134\135\136\140\173\174\175\176\177]/',$valueEmail)){
                $statusEmail=false;
            }
        }else{
            $statusEmail=null;
        }
        if (isset($valueFirstName)){
            if (preg_match('/[\041\042\043\044\045\046\047\050\051\052\053\054\055\057\072\073\074\075\076\077\100\133\134\135\136\137\140\173\174\175\176\177]/',$valueFirstName)){
                $statusFirstName=false;
            }
        }else{
            $statusFirstName=null;
        }
        if (isset($valueLastName)){
            if (preg_match('/[\041\042\043\044\045\046\0471\050\051\052\053\054\055\057\072\073\074\075\076\077\100\133\134\135\136\137\140\173\174\175\176\177]/',$valueLastName)){
                $statusLastName=false;
            }
        }else{
            $statusLastName=null;
        }
        if ($request->hasFile('fileUpload')&&count($valueUser)!=0){
            $fileMimeType = $request->file('fileUpload')->getMimeType();
            if ($fileMimeType == image_type_to_mime_type(IMAGETYPE_JPEG)||$fileMimeType == image_type_to_mime_type(IMAGETYPE_PNG)){
                $time = date('Y-m-d:H:i:s');
                $newfilename = str_random(10).md5($time).'.'.
                    $request->file('fileUpload')->getClientOriginalExtension();
                    $request->file('fileUpload')->move(public_path().'/image/', $newfilename);
                Image::make(public_path().'/image/'.$newfilename)->resize(50,50)->save(public_path().'/image/profile50/'.$newfilename);
                $dataImage=getimagesize(public_path().'/image/'.$newfilename);
                $widthImage= $dataImage[0];
                $heightImage= $dataImage[1];
                $heightNewImage=($heightImage/$widthImage)*256;
                Image::make(public_path().'/image/'.$newfilename)->resize(256,$heightNewImage)->save(public_path().'/image/profile256/'.$newfilename);
                File::delete(public_path().'/image/'.$newfilename);
                if (isset($valueUser->image_name)) {
                    File::delete(public_path().'/image/profile50/'.$valueUser->image_name);
                    File::delete(public_path().'/image/profile256/'.$valueUser->image_name);
                }
                $valueImage = $newfilename;
            }else{
                $statusImage = false;
            }
        }else{
            $statusImage = null;
        }
        if(count($valueUser)!=0){
            if ($statusEmail==true){
                $isCheckEmail = User::where('email', $valueEmail)->first();
                if (count($isCheckEmail)==0) {
                    User::where('id',$id)->update(['email'=>$valueEmail]);
                }else{
                    $statusEmail = false;
                }
            }
            if ($statusFirstName==true){
                User::where('id',$id)->update(['first_name'=>$valueFirstName]);
            }
            if ($statusLastName==true){
                User::where('id',$id)->update(['last_name'=>$valueLastName]);
            }
            if ($statusImage==true){
                User::where('id',$id)->update(['image_name'=>$newfilename]);
            }
        }else{
            $statusID=false;
        }
        $response = array(
          'valueID'=>$id,
          'valueEmail'=>$valueEmail,
          'valueFirstName'=>$valueFirstName,
          'valueLastName'=>$valueLastName,
          'valueImage'=>$valueImage,
          'statusEmail'=>$statusEmail,
          'statusFirstName'=>$statusFirstName,
          'statusLastName'=>$statusLastName,
          'statusImage'=>$statusImage,
          'statusID'=>$statusID
        );
        return response()->json($response);
    }
    protected function destroyUser(Request $request){
        $valueID = $request->messageID;
        $valueUser = User::where('id', $valueID)->first();          
        if(count($valueUser)!=0){
            User::where('id',$valueID)->delete();
            if (isset($valueUser->image_name)) {
                File::delete(public_path().'/image/profile50/'.$valueUser->image_name);
                File::delete(public_path().'/image/profile256/'.$valueUser->image_name);
            }
        }else{
            return view('errors.404');
        }
        $response = array(
          'valueID'=>$valueID
        );
        return response()->json($response);
    }
}