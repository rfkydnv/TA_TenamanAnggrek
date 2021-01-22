<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ekspedisi extends Model
{
    use SoftDeletes;

    protected $table      = 'master_ekspedisi';
    protected $primaryKey = 'ekspedisi_id';
    protected $fillable = [
    ];

    protected $dates = [
        'ekspedisi_created_at',
        'ekspedisi_updated_at',
        'ekspedisi_deleted_at'
    ];

    const CREATED_AT      = 'ekspedisi_created_at';
    const UPDATED_AT      = 'ekspedisi_updated_at';
    const DELETED_AT      = 'ekspedisi_deleted_at';
}
