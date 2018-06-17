<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;
class InfoUserUpdated extends Model{
	public $timestamps = false;
	public $table = "info_users_updated";
	protected $fillable = [
		'user_id','updated_at'
	];
	public function dataUser() {
		return $this->belongsTo('App\User','user_id');
	}
}