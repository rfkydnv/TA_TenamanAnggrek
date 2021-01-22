<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Auth;
/**
* 
*/
class ApprovalService
{
	public function get_approve_on($moduleCode, $nominal = 0)
    {
    	$approval = DB::select("
    		SELECT 
			b.`approvaldetail_no_urut`,
			b.`approvaldetail_kondisi`,
			b.`approvaldetail_nominal`,
			b.`approvaldetail_jabatan_id` AS jabatan_id,
			c.`jabatan_nama`
			FROM master_approval a
			JOIN master_approval_detail b ON a.approval_id = b.`approvaldetail_approval_id`
			JOIN master_jabatan c ON b.`approvaldetail_jabatan_id` = c.jabatan_id
			WHERE a.approval_kode = '".$moduleCode."' AND approval_deleted_at is null and approvaldetail_deleted_at is null
			ORDER BY b.`approvaldetail_no_urut` ASC
    	");
    	
    	$approveOn = 1;
    	$approveOnJabatan = "";
    	$approveOnJabatanId = "";
    	$isFindApproveOn = false;
    	$maxApproveWithoutCondition = 0;
    	$maxApproveWithoutConditionJabatan = "";

    	foreach ($approval as $key => $value) {
    		if ($nominal > 0) {
    			if ($value->approvaldetail_kondisi != "" AND $value->approvaldetail_nominal != "") {
    				$isMeetConditions = false;
    				switch ($value->approvaldetail_kondisi) {
    					case '>=':
    							$isMeetConditions = ($nominal >= $value->approvaldetail_nominal) ? true : false;
    						break;
    					case '<=':
    							$isMeetConditions = ($nominal <= $value->approvaldetail_nominal) ? true : false;
    						break;
    					case '>':
    							$isMeetConditions = ($nominal > $value->approvaldetail_nominal) ? true : false;
    						break;
    					default:
    						# code...
    						break;
    				}
    				if ($isMeetConditions) {
    					$isFindApproveOn = true;
    					$approveOn = $value->approvaldetail_no_urut;
    					$approveOnJabatan = $value->jabatan_nama;
    					$approveOnJabatanId = $value->jabatan_id;
    				}else{
    					if ($value->approvaldetail_no_urut == 1) {
    						$maxApproveWithoutCondition = $value->approvaldetail_no_urut;
    						$maxApproveWithoutConditionJabatan = $value->jabatan_nama;
    						$maxApproveWithoutConditionJabatanId = $value->jabatan_id;
    					}else{
							$maxApproveWithoutCondition = $value->approvaldetail_no_urut - 1;
							$maxApproveWithoutConditionJabatan = $approval[$maxApproveWithoutCondition]['jabatan_nama'];
							$maxApproveWithoutConditionJabatanId = $approval[$maxApproveWithoutCondition]['jabatan_id'];
    					}
    				}
    			}else{
    				if ($isFindApproveOn == false) {
    					if ($maxApproveWithoutCondition > 0) {
    						$approveOn = $maxApproveWithoutCondition;
    						$approveOnJabatan = $maxApproveWithoutConditionJabatan;
    					}else{
							$approveOn = $value->approvaldetail_no_urut;
							$approveOnJabatan = $value->jabatan_nama;
							$approveOnJabatanId = $value->jabatan_id;
    					}
    				}
    			}
    		}else{
    			$approveOn = $value->approvaldetail_no_urut;
    			$approveOnJabatan = $value->jabatan_nama;
    			$approveOnJabatanId = $value->jabatan_id;
    		}
    	}
    	
    	return [
    		'no_urut' => $approveOn,
    		'jabatan' => $approveOnJabatan,
    		'jabatan_id' => $approveOnJabatanId,
    	];
    }

    public function get_history_old($params)
   	{
   		$strFilter = "a.`".$params['field_primary']."`='".$params['ref_id']."'";
   		if (@$params['ref_parent_id'] != "" && is_int((int)@$params['ref_parent_id'])) {
   			$strFilter = "(a.`".$params['field_primary']."`='".$params['ref_id']."' OR a.`".$params['field_primary']."`='".$params['ref_parent_id']."')";
   		}
   		$strFieldKaryawan = @$params['field_karyawan'] == "" ? "a.`".$params['field_prefix']."karyawanid`" : @$params['field_karyawan'];
   		$strFieldDate = @$params['field_date'] == "" ? "a.`".$params['field_prefix']."created_at`" : @$params['field_date'];
   		$data = DB::select("
   			SELECT 
			b.`karyawan_id`,
			b.`karyawan_fullname`,
			c.jabatan_nama,
			b.`karyawan_foto`,
			a.`".$params['field_prefix']."status`,
			".$strFieldDate." AS approvalhistory_date,
			a.`".$params['field_prefix']."catatan`,
			a.`".$params['field_prefix']."is_delegasi`
			FROM ".$params['table']." a
			LEFT JOIN master_karyawan b ON ".$strFieldKaryawan." = b.`karyawan_id`
			LEFT JOIN master_jabatan c ON b.karyawan_jabatan_id = c.jabatan_id
			WHERE ".$strFilter."
   		");
   		
   		return $data;
   	}

   	public function is_admin()
    {
        $user   = Auth::user();
        if (in_array(@$user->karyawan_role_id, ['1'])) {
            return true;
        }

        if (in_array(@$user->role_name, ['ADMINISTRATOR SATELIT'])) {
            return true;
        }

        return false;
    }

   	public function can_approve($param)
   	{
		$approval = $this->get_approval_new($param['module_code'], $param);

   		$response['status'] = FALSE;
		if ($this->is_admin() OR ($approval['karyawan_id'] == get_current_user_id() OR @$approval['karyawan_id_delegasi'] == get_current_user_id())) {
			if ($approval['current_no_urut'] <= $param['approve_on']) {
				$response['current_no_urut'] = $approval['current_no_urut'];
				$response['approve_on'] = $approval['current_no_urut'];
				$response['status'] = TRUE;
			}
		}
   		
   		return $response;
   	}

   	public function get_approval_new($kode, $params, $nextKaryawan = false)
   	{
   		$approval = DB::select("
			SELECT 
			b.`approvaldetail_jabatan_id`,
			b.`approvaldetail_no_urut`
			FROM `master_approval` a
			LEFT JOIN master_approval_detail b ON a.`approval_id` = b.`approvaldetail_approval_id`
			WHERE a.`approval_kode`='".$kode."'
			AND approval_deleted_at is null
			and approvaldetail_deleted_at is null
			ORDER BY b.`approvaldetail_no_urut`
		");
		$approvalPivot = [];
		foreach ($approval as $key => $value) {
			$approvalPivot[$value->approvaldetail_no_urut] = $value->approvaldetail_jabatan_id;
		}

		// Mengecek sudah ada berapa approval di tabel
		// $cekUrutan = DB::select("
		// 	SELECT COUNT(*) AS total FROM master_approval_history
		// 	WHERE approvalhistory_ref_id = '".$params['ref_id']."' AND approvalhistory_modul_kode = '".$kode."'
		// ");
		$cekUrutan = collect(\DB::select("SELECT COUNT(*) AS total FROM master_approval_history
			WHERE approvalhistory_ref_id = '".$params['ref_id']."' AND approvalhistory_modul_kode = '".$kode."'"))->first();

		$noUrut = ($cekUrutan->total + 1);
		// Detail Karyawan Current
		if(@$approvalPivot[$noUrut] == null){
			return false;
		}
		$karyawan = $this->get_karyawan_by_jabatan_kantor(@$approvalPivot[$noUrut], $params['kantor_id']);
		
		// dd($karyawan);
		// Jika ada delegasi gunakan delegasi
		$karyawan = $this->get_karyawan_delegasi($karyawan);
		$karyawan['current_no_urut'] = $noUrut;
		if ($noUrut != @$params['approve_on']) {
			
			$karyawan['next_no_urut'] = $noUrut + 1;
			$karyawan['next_jabatan'] = $approvalPivot[$karyawan['next_no_urut']];

			$jabatan = (array)collect(\DB::select("
				SELECT a.`jabatan_nama` FROM master_jabatan a WHERE jabatan_deleted_at is null and a.`jabatan_id`='".$karyawan['next_jabatan']."'
			"))->first();
			if ($nextKaryawan) {
				$_karyawan = $this->get_karyawan_by_jabatan_kantor($karyawan['next_jabatan'], $params['kantor_id']);
				$karyawan['next_karyawan_id']    = $_karyawan['karyawan_id'];
				$karyawan['next_karyawan_nama']  = $_karyawan['karyawan_fullname'];
				$karyawan['next_karyawan_email'] = $_karyawan['karyawan_email'];
			}
			$karyawan['next_jabatan_nama'] = $jabatan['jabatan_nama'];
		}
		return $karyawan;
   	}

   	public function get_karyawan_delegasi($params)
    {
    	// DB::enableQueryLog();
    	// dd($params);
    	$karyawan = (array) collect(\DB::select("
    		SELECT b.`karyawan_id`,b.`karyawan_fullname`,b.`karyawan_role_id`,b.`karyawan_email` FROM master_delegasi_approval a
			LEFT JOIN master_karyawan b ON a.`delegasiapproval_pengganti_karyawan_id` = b.`karyawan_id`
			WHERE a.`delegasiapproval_karyawan_id` = '".$params['karyawan_id']."' AND '".date("Y-m-d H:i:s")."' BETWEEN a.`delegasiapproval_tanggal_mulai` AND a.`delegasiapproval_tanggal_selesai`
			AND delegasiapproval_is_delete is null
		"))->first();
		// dd(DB::getQueryLog());
    	if (count($karyawan) > 0) {
			$params['karyawan_id_delegasi'] = $params['karyawan_id'];
			$params['karyawan_id']    = $karyawan['karyawan_id'];
			$params['karyawan_fullname']  = $karyawan['karyawan_fullname'];
			$params['karyawan_role_id']  = $karyawan['karyawan_role_id'];
			$params['karyawan_email'] = $karyawan['karyawan_email'];
			$params['is_delegasi']    = TRUE;
    	}

    	return $params;
    }

   	public function get_karyawan_by_jabatan_kantor($jabatanId,$kantorId)
    {
    	$karyawan = (array)collect(\DB::select("
			SELECT a.`karyawan_id`,a.`karyawan_fullname`,a.`karyawan_role_id`,a.`karyawan_email`,a.`karyawan_jabatan_id` AS current_jabatan_id, c.`jabatan_nama` AS current_jabatan FROM master_karyawan a
			INNER JOIN master_karyawan_kantor b ON a.`karyawan_id` = b.`karyawankantor_karyawan_id`
			LEFT JOIN master_jabatan c ON a.`karyawan_jabatan_id` = c.`jabatan_id`
			WHERE a.`karyawan_jabatan_id` = '".$jabatanId."' 
			AND karyawan_deleted_at is null
			AND b.`karyawankantor_kantor_id` IN (".$kantorId.")
		"))->first();
    	if ($this->is_admin()) {
    		$karyawan['current_jabatan'] = "Admin Sistem";
    	}
    	return $karyawan;
    }

	public function get_approval($kode, $params, $nextKaryawan = false)
	{
		$approval = DB::select("SELECT 
			b.`approvaldetail_jabatan_id`,
			b.`approvaldetail_no_urut`
			FROM `master_approval` a
			LEFT JOIN master_approval_detail b ON a.`approval_id` = b.`approvaldetail_approval_id`
			WHERE a.`approval_kode`='".$kode."'
			AND approval_deleted_at is null
			ORDER BY b.`approvaldetail_no_urut`");
		$approvalPivot = [];
		foreach ($approval as $key => $value) {
			$approvalPivot[$value->approvaldetail_no_urut] = $value->approvaldetail_jabatan_id;
		}
		// dd($approvalPivot);

		$cekUrutan = collect(\DB::select("
			SELECT COUNT(*) AS total FROM ".$params['tabel']."
			WHERE ".$params['foreign']." = '".$params['ref_id']."'
		"))->first();

		// $cekUrutan = $this->db->query("
		// 	SELECT COUNT(*) AS total FROM ".$params['tabel']."
		// 	WHERE ".$params['foreign']." = '".$params['ref_id']."'
		// ")->row();

		$noUrut = ($cekUrutan->total + 1);
		// Detail Karyawan Current
		$karyawan = $this->get_karyawan_by_jabatan_kantor(@$approvalPivot[$noUrut], $params['kantor_id']);
		$karyawan['current_no_urut'] = $noUrut;
		
		// Cek Apakah punya delegasi
		$karyawan = $this->get_karyawan_delegasi($karyawan);
		if ($noUrut != $params['approve_on']) {
			
			$karyawan['next_no_urut'] = $noUrut + 1;
			$karyawan['next_jabatan'] = $approvalPivot[$karyawan['next_no_urut']];
			$jabatan = (array) collect(\DB::select("
				SELECT a.`jabatan_nama` FROM master_jabatan a WHERE jabatan_deleted_at is null and a.`jabatan_id`='".$karyawan['next_jabatan']."'
			"))->first();
			if ($nextKaryawan) {
				$_karyawan = $this->get_karyawan_by_jabatan_kantor($karyawan['next_jabatan'], $params['kantor_id']);
				$karyawan['next_karyawan_id']    = $_karyawan['karyawan_id'];
				$karyawan['next_karyawan_nama']  = $_karyawan['karyawan_fullname'];
				$karyawan['next_karyawan_email'] = $_karyawan['karyawan_email'];
			}
			$karyawan['next_jabatan_nama'] = $jabatan['jabatan_nama'];
		}

		$karyawan['kantor_id'] = $params['kantor_id'];

		return $karyawan;
	}
}
