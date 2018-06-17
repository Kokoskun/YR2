<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;
class SocialAuth extends Model{
	public $timestamps = false;
	public $table = "social_auth";
	protected $fillable = [
		'user_id','facebook_id','google_id'
	];
	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}
}