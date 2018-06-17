<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use App\SocialAuth;
use Auth;
class SocialAuthController extends Controller{
	public function facebookRedirectToProvider(){
		return Socialite::driver('facebook')->fields(['email'])->redirect();
	}
	public function googleRedirectToProvider(){
		return Socialite::driver('google')->redirect();
	}
	public function googleHandleProviderCallback(){   
		try {
			$userGoogle = Socialite::driver('google')->user();
			$googleId=$userGoogle->getId();
			$googleEmail=$userGoogle->getEmail();
			$users = User::where('email','=',$googleEmail)->first();
			if (isset($users)) {
				$user = User::find($users->id);
				$userSocialAuth = SocialAuth::where('user_id','=',$users->id)->first();
				if (empty($userSocialAuth)) {
                    $socialAuth = new SocialAuth();
                    $socialAuth->user_id = $users->id;
                    $socialAuth->google_id = $googleId;
                    $socialAuth->save();
				}else{
            		SocialAuth::where('user_id',$users->id)->update(['google_id' => $googleId]);
				}
				Auth::login($user);
				return redirect()->action('HomeController@index');
			}else{
				return view('auth.register');
			}
		} catch (Exception $e) {
			return view('errors.404');
		}
	}
    public function facebookHandleProviderCallback()
    {   
        try {
            $userFacebook = Socialite::driver('facebook')->fields(['email'])->user();
            $facebookId = $userFacebook->getId();
            $facebookEmail = $userFacebook->getEmail();
            $users = User::where('email','=',$facebookEmail)->first();
			if (isset($users)) {
				$user = User::find($users->id);
				$userSocialAuth = SocialAuth::where('user_id','=',$users->id)->first();
				if (empty($userSocialAuth)) {
                    $socialAuth = new SocialAuth();
                    $socialAuth->user_id = $users->id;
                    $socialAuth->facebook_id = $facebookId;
                    $socialAuth->save();
				}else{
            		SocialAuth::where('user_id',$users->id)->update(['facebook_id' => $facebookId]);
				}
				Auth::login($user);
				return redirect()->action('HomeController@index');
			}else{
				return view('auth.register');
			}
        } catch (Exception $e) {
            return view('errors.404');
        }
    }
}