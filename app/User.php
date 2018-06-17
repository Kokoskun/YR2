<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permission;
class User extends Authenticatable{
	use Notifiable;
	public $table = "users";
	protected $fillable = [
		'permission_id','email','first_name','last_name', 'password','image_name'
	];
	protected $hidden = [
		'password', 'remember_token',
	];
	public function dataPermission() {
		return $this->belongsTo('App\Permission', 'permission_id');
	}
}