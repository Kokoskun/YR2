<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Groups extends Model{
	public $table = "groups";
	protected $fillable = [
		'name','remark','created_at','updated_at'
	];
}