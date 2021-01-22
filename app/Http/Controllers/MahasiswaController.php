<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
	private $jenis_kelamin;

	public function __construct()
	{
		//Do your magic here
		$this->jenis_kelamin = ['L' => 'Laki-laki','P' => 'Perempuan'];
	}

    //
    public function index()
    {
        $data['module_title'] = "Mahasiswa";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Mahasiswa','url' => 'mahasiswa']
        ];

    	$getMahasiswa = Mahasiswa::All();
    	$data['mahasiswa'] = $getMahasiswa;
    	return view('mahasiswa.mahasiswa_index',$data);
    }

    public function show($id)
    {
    	$getMahasiswa = Mahasiswa::find($id);

        $data['module_title'] = "Mahasiswa";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Mahasiswa','url' => 'mahasiswa'],
            ['title' => $getMahasiswa->mahasiswa_nama,'url' => 'mahasiswa/'.$getMahasiswa->mahasiswa_id]
        ];

    	$data['detail'] = $getMahasiswa;

    	return view('mahasiswa.mahasiswa_lihat',$data);	
    }

    public function add()
    {
		$data['jenis_kelamin'] = $this->jenis_kelamin;
    	
    	return view('mahasiswa.mahasiswa_form',$data);	
    }

    public function edit($id)
    {
    	$getMahasiswa = Mahasiswa::find($id);
    	$data['jenis_kelamin'] = $this->jenis_kelamin;
    	$data['detail'] = $getMahasiswa;
    	
    	return view('mahasiswa.mahasiswa_form',$data);	
    }

    public function action_proses(Request $input)
    {
    	if (@$input->mahasiswa_id != "") {
    		// Update 
    		$getMahasiswa = Mahasiswa::find($input->mahasiswa_id);
			$getMahasiswa->mahasiswa_nama = $input->mahasiswa_nama;
			$getMahasiswa->mahasiswa_jenis_kelamin  = $input->mahasiswa_jenis_kelamin;

			try {
				$getMahasiswa->save();
				return redirect('/mahasiswa');
			} catch (\Exception $e) {
				dd("Gagal")	;
			}

    	}else{
    		// Add
    		$mahasiswa = new Mahasiswa;
			$mahasiswa->mahasiswa_nama = $input->mahasiswa_nama;
			$mahasiswa->mahasiswa_jenis_kelamin  = $input->mahasiswa_jenis_kelamin;    
			
			try {
				$mahasiswa->save();
				return redirect('/mahasiswa');
			} catch (\Exception $e) {
				dd("Gagal")	;
			}		
    	}
    }


    public function action_delete(Request $input)
    {
    	if (@$input->mahasiswa_id != "") {
    		$getMahasiswa = Mahasiswa::find($input->mahasiswa_id);
    		$getMahasiswa->delete();
    		return redirect('/mahasiswa');
    	}
    }
}
