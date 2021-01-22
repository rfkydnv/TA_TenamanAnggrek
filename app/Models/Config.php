<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    // use SoftDeletes;

    public $timestamps    = false;
    protected $table        = 'master_config';
    protected $primaryKey   = 'config_id';
    protected $fillable     = [
        "config_tipe",
        "config_finance_tipe",
        "config_finance_title",
        "config_code",
        "config_value",
        "config_tipe_input",
        "config_updated_by",
        "config_updated_date",
    ];

    public function scopeFinance($query)
    {
        $get = $query
                ->where("config_tipe", "FINANCE")
                ->pluck("config_value", "config_code");
        
        $array = $get->toArray();

        return $array;
    }
    
}
