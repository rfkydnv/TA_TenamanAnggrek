<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Komentar extends Model
{
    use SoftDeletes;

	protected $table      = 'komentar';
	protected $primaryKey = 'komentar_id';
	protected $fillable = ['komentar_id','komentar_artikelid','komentar_email','komentar_isi'];


	const CREATED_AT      = 'komentar_created_at';
	const UPDATED_AT      = 'komentar_updated_at';
	const DELETED_AT      = 'komentar_deleted_at';
}
