<?php
namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
class RegisterController extends Controller{
    use RegistersUsers;
    protected $redirectTo = '/home';
    public function __construct(){
        $this->middleware('guest');
    }
    protected function validator(array $data){
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    protected function create(array $data){
        return User::create([
            'permission_id' => 10,  
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'password' => bcrypt($data['password']),
        ]);
    }
}