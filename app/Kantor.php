<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kantor extends Model
{
    use SoftDeletes;

	protected $table      = 'master_kantor';
	protected $primaryKey = 'kantor_id';
	protected $fillable = ['kantor_id','kantor_nama','kantor_tipe','kantor_keterangan','kantor_lokasi_id','kantor_created_by','kantor_updated_by','kantor_deleted_by'];
	protected $dates = [
		'kantor_created_at',
		'kantor_updated_at',
		'kantor_deleted_at'
	];

	const CREATED_AT      = 'kantor_created_at';
	const UPDATED_AT      = 'kantor_updated_at';
	const DELETED_AT      = 'kantor_deleted_at';
}
