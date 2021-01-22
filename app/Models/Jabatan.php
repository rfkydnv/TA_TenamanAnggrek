<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    use SoftDeletes;

    protected $table      = 'master_jabatan';
    protected $primaryKey = 'jabatan_id';
    protected $fillable = [
        'jabatan_id',
        'jabatan_nama',
    ];

    public $timestamps = false;
    
    protected $casts = [
        "jabatan_is_delete" => "boolean",
    ];

    protected $dates = [
        'jabatan_created_at',
        'jabatan_updated_at',
        'jabatan_deleted_at'
    ];

    const CREATED_AT = 'jabatan_created_at';
    const UPDATED_AT = 'jabatan_updated_at';
    const DELETED_AT = 'jabatan_deleted_at';
}
