<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table      = 'master_menu';
    protected $primaryKey = 'menu_id';
    protected $fillable = [
        'menu_id',
        'menu_parentid',
        'menu_name',
        'menu_link',
        'menu_icon'
    ];

    protected $dates = [
        'menu_deleted_at'
    ];

    const CREATED_AT      = 'menu_created_at';
    const UPDATED_AT      = 'menu_updated_at';
    const DELETED_AT      = 'menu_deleted_at';
}
