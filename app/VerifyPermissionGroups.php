<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Groups;
class VerifyPermissionGroups extends Model{
	public $table = "verify_permission_groups";
	protected $fillable = [
		'group_id','user_id'
	];
	public function dataGroup() {
		return $this->belongsTo('App\Groups','group_id');
	}
	public function dataUser() {
		return $this->belongsTo('App\User','user_id');
	}
}