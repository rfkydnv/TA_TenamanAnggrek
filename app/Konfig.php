<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konfig extends Model
{

    protected $table      = 'master_config';
    protected $primaryKey = 'config_id';
    protected $fillable = ['config_id', 'config_tipe', 'config_finance_tipe', 'config_finance_title', 'config_code', 'config_value', 'config_tipe_input', 'config_updated_by', 'config_updated_date'];
    protected $dates = [
        'config_updated_date'
    ];

    const UPDATED_AT      = 'config_updated_date';
}
