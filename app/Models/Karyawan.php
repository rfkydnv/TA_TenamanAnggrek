<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;

class Karyawan extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table      = 'karyawan';
    protected $primaryKey = 'karyawan_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'karyawan_nik','karyawan_role_id','karyawan_jenis_kelamin','karyawan_fullname', 'karyawan_username', 'karyawan_password', 'karyawan_email', 'karyawan_no_identitas', 'karyawan_tempat_lahir', 'karyawan_tgl_lahir', 'karyawan_telp', 'karyawan_jabatan_id' , 'karyawan_kantor_id', 'karyawan_npwp', 'karyawan_agama', 'karyawan_tgl_masuk', 'karyawan_tgl_keluar', 'karyawan_alamat', 'karyawan_tipe', 'karyawan_foto', 'karyawan_npwp_alamat', 'karyawan_is_active'
    ];

    // protected $unguard = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'karyawan_remember_token',
    ];

    protected $appends = [
        'karyawan_kantor_kelola',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'karyawan_email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->karyawan_password;
    }

    public function karyawankantor()
    {
        return $this->hasMany(KaryawanKantor::class, "karyawankantor_karyawan_id", "karyawan_id");
    }
    public function kantor()
    {
        return $this->hasOne(Kantor::class, "kantor_id", "karyawan_kantor_id");
    }
    public function jabatan()
    {
        return $this->hasOne(Jabatan::class, "jabatan_id", "karyawan_jabatan_id");
    }
    public function role()
    {
        return $this->hasOne(Role::class, "role_id", "karyawan_role_id");
    }
    //accessor
    public function getKaryawanKantorKelolaAttribute($value)
    {
        $data = $this->karyawankantor;
        $temp = [];
        foreach ($data as $key => $value) {
            $temp[]=(string)$value->karyawankantor_kantor_id;
        }
        return $temp;
    }
    public function getKaryawanTglLahirAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }
    public function getKaryawanTglMasukAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }
    public function getKaryawanTglKeluarAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }
    // public function getKaryawanPasswordAttribute($value)
    // {
    //     return ';.,.,;';
    // }
    //mutator

    const CREATED_AT      = 'karyawan_created_at';
    const UPDATED_AT      = 'karyawan_updated_at';
    const DELETED_AT      = 'karyawan_deleted_at';
}
