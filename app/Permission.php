<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Permission extends Model{
	public $timestamps = false;
    public $table = "permissions";
	protected $fillable = [
		'name','remark'
	];
}