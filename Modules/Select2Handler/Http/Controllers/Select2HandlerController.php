<?php

namespace Modules\Select2Handler\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\AppGranted;
use App\Helpers\AppResponse;
use DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class Select2HandlerController extends Controller
{
    public function get($table, $prefix, $key, $value, Request $request)
    {
        $_value = "";

        if (strpos($value, '_') !== false) {
            $_value = $value;
        } else {
            $_value = $prefix."_".$value;
        }

        $select = [
            $prefix."_".$key . " as id",
            $_value . " as text",
        ];

        
        if($request->filled("image")) {
            $select[] = $request->image . " as image";
        }
        
        $query = DB::table($table);
        
        if($request->filled("left_join")) {
            foreach ($request->left_join as $key => $value) {
                $tmp = explode(",", $value);

                $query->leftJoin($tmp[0], $tmp[1], $tmp[2], $tmp[3]);
            }
        }

        if ($request->filled("custom")){
            foreach ($request->custom as $key => $value) {
                if($key == "is"){
                    $query->where(function($q) use ($value) {
                        foreach ($value as $k => $v) {
                            if($v == "null"){
                                $q->whereNull($k);
                            }else{
                                $q->where($k,$v);
                            }
                        }
                    });
                }
            }
        }

        if ($request->filled("soft_delete")) {
            if ($request->soft_delete == 1) {
                $query->whereNull($prefix."_deleted_at");
            }
        }

        if($request->filled("q") && $request->filled("desc")) {
            $q = $request->q;
            // $query->where($_value, "like", "%".$q."%");
            $query->where(function($qw) use($_value, $q, $request) {
                $qw->where($_value, "like", "%".$q."%");
                $qw->orWhere($request->desc, "like", "%".$request->q."%");
            });
        } else {
            $q = $request->q;

            $query->where($_value, "like", "%".$q."%");
        }

        // if($request->filled("desc")) {
        //     $select[] = $request->desc . " as desc";
        //     $query = $query->orWhere($request->desc, "like", "%".$request->q."%");
        // }

        $query = $query
        ->select($select);

        $query->limit(20);
        // dd(getSql($query));
        $data = $query->get();

        return $data;
    }

    public function getSales($table, $prefix, $key, $value, Request $request)
    {
        $q = $request->q;
        $query = DB::table($table)
            ->select($prefix."_".$key . " as ".$key , $prefix."_fullname". " as text")
            ->leftjoin("master_jabatan","jabatan_id","=","karyawan_jabatan_id");

        if ($value == "kepalagudang") $query->where("jabatan_nama", "=", "Kepala Gudang");
        if ($value == "sales") $query->where("jabatan_nama", "=", "Sales");


        if($request->filled("q")) {
            $query->where($prefix."_fullname", "like", "%".$q."%");
        }

        if ($request->filled("soft_delete")) {
            if ($request->soft_delete == 1) {
                $query->whereNull($prefix."_deleted_at");
            }
        }


        $query->limit(20);
        return $query->get();
    }

    public function getProduk($table, $prefix, $key, $value, Request $request)
    {

        $query = DB::table("master_harga");
        $query->select(
                        "produk_id as id" ,"produk_nama as text", "harga_id",
                        "harga_refill", "harga_baru", "produk_nama", "produk_id"
                      );
        $query->leftjoin("master_produk","produk_id","=","harga_produk_id");
        $query->leftjoin("master_zona","zona_id","=","harga_zona_id");
        $query->leftjoin("master_zona_detail","zonadetail_zona_id","=","zona_id");
        $query->where("zonadetail_kecamatan_id", $request->lokasi_id);
        $query->where("zonadetail_is_delete", '0');
        $query->whereNull("zona_deleted_at");

        if($request->filled("q"))
        {
            $q = $request->q;
            $query->where($prefix."_".$value, "like", "%".$q."%");
        }

        $query->limit(20);
        return $query->get();
    }

    public function getKasBank(Request $request)
    {

        $kasbank = DB::table("master_config")
            ->select("config_value")
            ->where("config_code", 'kas_bank')->first();

        $query = DB::table("finance_kode_rekening");
        $query->selectRaw("koderekening_nama as text, koderekening_kode as id");
        $query->where("koderekening_is_rekening_jurnal",'1');
        $query->where("koderekening_kode","like", "%". @$kasbank->config_value ."%");

        if($request->filled("q"))
        {
            $q = $request->q;
            $query->where("koderekening_nama", "like", "%".$q."%");
        }

        $query->limit(20);

        return $query->get();
    }

    public function getZona(Request $request)
    {
        $query = DB::select("SELECT
            zona_id as id,
            concat('<b>',zona_nama,'</b>') as text,
            ifnull((SELECT GROUP_CONCAT(kecamatan_nama SEPARATOR ', ') FROM master_zona_detail
            LEFT JOIN master_kecamatan ON zonadetail_kecamatan_id = kecamatan_id
            where zonadetail_zona_id = zona_id), '') as `desc`
        FROM
            master_zona
            LEFT JOIN master_zona_detail ON zona_id = zonadetail_zona_id
            LEFT JOIN master_kecamatan ON zonadetail_kecamatan_id = kecamatan_id
        WHERE
            kecamatan_nama LIKE '%{$request->q}%' or zona_nama LIKE '%{$request->q}%'
        GROUP BY
            zona_id
        limit 5");

        return $query;
    }

    public function getFinanceConfigRek(Request $request)
    {
        $q = "SELECT
            koderekening_kode as id,
            concat(koderekening_kode, ' / ', koderekening_nama) as text
        FROM
            finance_kode_rekening
        WHERE
            koderekening_kode LIKE '%{$request->q}%' or koderekening_nama LIKE '%{$request->q}%'
        limit 20";

        // dd($q);
        $query = DB::select($q);

        return $query;
    }
}
