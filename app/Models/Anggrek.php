<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggrek extends Model
{
    use SoftDeletes;

    protected $table      = 'anggrek';
    protected $primaryKey = 'anggrek_id';
    protected $fillable = ['anggrek_id',
    'anggrek_nama',
    'anggrek_foto',
    'anggrek_jenis',
    'anggrek_keterangan'
    ];


    protected $dates = [
        'anggrek_created_at',
        'anggrek_updated_at',
        'anggrek_deleted_at'
    ];

    const CREATED_AT = 'anggrek_created_at';
    const UPDATED_AT = 'anggrek_updated_at';
    const DELETED_AT = 'anggrek_deleted_at';
}
