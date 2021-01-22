<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    use SoftDeletes;

    protected $table      = 'artikel';
    protected $primaryKey = 'artikel_id';
    protected $fillable = ['artikel_id',
    'artikel_judul',
    'artikel_isi',
    'artikel_kategori',
    'artikel_foto'
    ];


    protected $dates = [
        'artikel_created_at',
        'artikel_updated_at',
        'artikel_deleted_at'
    ];

    const CREATED_AT = 'artikel_created_at';
    const UPDATED_AT = 'artikel_updated_at';
    const DELETED_AT = 'artikel_deleted_at';
}
