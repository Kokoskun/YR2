<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Status extends Model{
	public $timestamps = false;
	public $table = "status";
	protected $fillable = [
		'name','remark'
	];
}