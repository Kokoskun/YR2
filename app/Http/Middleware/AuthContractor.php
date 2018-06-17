<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class AuthContractor{
    public function handle($request, Closure $next){
        if(Auth::guest()){
            return redirect()->action('HomeController@index');
        }else{
            if(Auth::user()->permission_id!=21&&Auth::user()->permission_id!=22&&Auth::user()->permission_id!=23){
                return redirect()->action('HomeController@index');
            }
        }
        return $next($request);
    }
}