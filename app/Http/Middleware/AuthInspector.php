<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class AuthInspector{
    public function handle($request, Closure $next){
        if(Auth::guest()){
            return redirect()->action('HomeController@index');
        }else{
            if(Auth::user()->permission_id!=30){
                return redirect()->action('HomeController@index');
            }
        }
        return $next($request);
    }
}