<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    //
    use SoftDeletes;

	protected $table      = 'master_mahasiswa';
	protected $primaryKey = 'mahasiswa_id';
	protected $fillable = ['mahasiswa_id','mahasiswa_nama','mahasiswa_jenis_kelamin'];
	protected $dates = [
		// 'mahasiswa_created_at',
		// 'mahasiswa_updated_at',
		'mahasiswa_deleted_at'
	];

	const CREATED_AT      = 'mahasiswa_created_at';
	const UPDATED_AT      = 'mahasiswa_updated_at';
	const DELETED_AT      = 'mahasiswa_deleted_at';
}
