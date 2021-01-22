<?php

namespace App\Models;

use App\Kantor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KaryawanKantor extends Model
{
    // use SoftDeletes;

    protected $table      = 'master_karyawan_kantor';
    protected $primaryKey = 'karyawankantor_id';
    protected $fillable = [
        'karyawankantor_id','karyawankantor_karyawan_id', 'karyawankantor_kantor_id', 'karyawankantor_created_by_fullname', 'karyawankantor_created_at'
    ];

    protected $dates = [
        'karyawankantor_created_at'
    ];

    public function kantor()
    {
        return $this->belongsTo(Kantor::class, "karyawankantor_kantor_id", "kantor_id");
    }

    const CREATED_AT = 'karyawankantor_created_at';
    const UPDATED_AT = 'karyawankantor_updated_at';
    const DELETED_AT = 'karyawankantor_deleted_at';
}
