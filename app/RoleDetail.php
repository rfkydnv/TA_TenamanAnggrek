<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleDetail extends Model
{
    //
    use SoftDeletes;

	protected $table      = 'role_detail';
	protected $fillable = ['roledetail_id','roledetail_role_id','roledetail_menu_id','roledetail_link','roledetail_segment','roledetail_view','roledetail_access'];
	protected $primaryKey = 'roledetail_id';
	
	protected $dates = [
		'roledetail_created_at',
		'roledetail_updated_at',
		'roledetail_deleted_at'
	];

	const CREATED_AT      = 'roledetail_created_at';
	const UPDATED_AT      = 'roledetail_updated_at';
	const DELETED_AT      = 'roledetail_deleted_at';
}
