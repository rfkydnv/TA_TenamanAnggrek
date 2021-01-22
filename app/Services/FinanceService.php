<?php
namespace App\Services;

use App\Models\FinanceJurnalDetail;
use App\Models\FinanceKoderekening;
use App\Models\FinanceJurnal;
use DB;

class FinanceService {

    //POSTING JURNAL DAN JURNAL DETAIL MENGGUNAKAN ARRAY
    public function posting($jurnal = [], $detail_jurnal = [])
    {
        $jurnal_no = $this->generateNo("JN01");
        $jurnal["jurnal_no"] = $jurnal_no;
        $jurnal["jurnal_created_date"] = Ymdhis();
        $jurnal["jurnal_created_at"] = Ymdhis();
        $jurnal["jurnal_created_by"] = auth()->user()->karyawan_id;
        $save_jurnal = null;
        try {
            FinanceJurnal::unguard();
            $save_jurnal = FinanceJurnal::create($jurnal);
            FinanceJurnal::reguard();

            FinanceJurnalDetail::unguard();
            $jurnal_detail = array_map(function ($row) use ($jurnal, $save_jurnal){
                $row["jurnaldetail_jurnal_id"] = $save_jurnal->jurnal_id;
                $row["jurnaldetail_jurnal_no"] = $jurnal["jurnal_no"];
                if(!array_key_exists("jurnaldetail_jumlah_kredit",$row)){
                    $row["jurnaldetail_jumlah_kredit"] = 0;
                }
                if(!array_key_exists("jurnaldetail_jumlah_debit",$row)){
                    $row["jurnaldetail_jumlah_debit"] = 0;
                }
                return $row;
            }, $detail_jurnal);

            $save_jurnal_detail = FinanceJurnalDetail::insert($jurnal_detail);
            FinanceJurnalDetail::reguard();
        } catch (\Exception $e) {
          dd($e);
        }

        return $save_jurnal;
    }

    public function generateNo($tipe)
    {
        $custom = [
            'custom' => "day(jurnal_created_at) = day(sysdate()) AND month(jurnal_created_at) = month(sysdate()) 
            AND year(jurnal_created_at) = year(sysdate())"
        ];

        $seq = date('ym') . substr("0" . date('d'), -2);

        $generate_no = app_generate_unik_no(
              'finance_jurnal',
              'jurnal_no',
              $tipe, 
              $seq,
              $custom,
              3);

        return $generate_no;
    }

    public function getBySumber($no)
    {
        $data = FinanceJurnal::where("jurnal_sumber", "=", $no)
                        ->first();
                        
        return $data;
    }

    public function cekPeriode($periode) // 4-2019
    {
        $query_periode = DB::table("finance_tutup_periode")
                        ->where("tutupperiode_periode", "=", $periode)
                        ->count();

        return $query_periode > 0 ? true : false;
    }

    public function hapusJurnalBySumber($no) // 4-2019
    {
        $data = $this->getBySumber($no);

        $data->jurnal_isdelete = "1";
        $data->jurnal_deleted_at = date("Y-m-d h:i:s");
        $data->jurnal_deleted_by = auth()->user()->karyawan_id;

        try {
          $delete_detail = FinanceJurnalDetail::where("jurnaldetail_jurnal_id", "=", $data->jurnal_id)
                        ->delete();
        } catch (\Exception $e) {

        }

        try {
          $data->save();
        } catch (\Exception $e) {

        }

        return true;
    }

    public function getKodeRekening($kode_rek)
    {
        $data = FinanceKodeRekening::where("koderekening_kode", "=", $kode_rek)->first();
        return [
            'kode' => $data->koderekening_kode,
            'nama' => $data->koderekening_nama
        ];
    }
}
