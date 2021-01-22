<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    //
    use SoftDeletes;

	protected $table      = 'role';
	protected $fillable = ['role_id','role_name','role_desc'];
	protected $primaryKey = 'role_id';
	
	protected $dates = [
		'role_created_at',
		'role_updated_at',
		'role_deleted_at'
	];

	const CREATED_AT      = 'role_created_at';
	const UPDATED_AT      = 'role_updated_at';
	const DELETED_AT      = 'role_deleted_at';
}
