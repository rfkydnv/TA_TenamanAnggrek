<?php

namespace Modules\Karyawan\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\AppGranted;
use App\Helpers\AppResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\KaryawanKantor;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['module_title'] = "Karyawan";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => 'master/karyawan/#'],
            ['title' => "Karyawan",'url' => 'master/karyawan']
        ];
        $combo = [
            'TETAP' => [
                'label' => 'TETAP'
            ],
            'LEPAS' => [
                'label' => 'LEPAS'
            ],
        ];
        $data['select2'] = json_encode($combo);

        return view("karyawan::karyawan", $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
     	AppGranted::grantedAccess('add', true);
        $data['module_title'] = 'Karyawan';
        $data['form_title'] = 'Form Tambah Karyawan';
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => 'master/karyawan/#'],
            ['title' => "Karyawan",'url' => "master/karyawan"],
            ['title' => "Tambah",'url' => "master/karyawan/create"]
        ];  
        $data['action'] = route('karyawan.store');
        $data['action_type'] = "add";
        $data['redirect'] = route("karyawan");
        $data['data'] = json_encode(['karyawan_nik' => app_generate_nik()]);
        return view("karyawan::karyawan_form",$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
		$this->validate($request,[
			'karyawan_nik' => 'required',
			'karyawan_fullname' => 'required',
			'karyawan_username' => 'required',
			'karyawan_jenis_kelamin' => 'required',
			'karyawan_no_identitas' => 'required',
			'karyawan_tempat_lahir' => 'required',
			'karyawan_tgl_lahir' => 'required|date_format:d-m-Y',
			'karyawan_tgl_masuk' => 'required|date_format:d-m-Y',
			'karyawan_tgl_keluar' => 'required|date_format:d-m-Y',
			'karyawan_email' => 'required',
			'karyawan_telp' => 'required',
			'karyawan_password' => 'required',
			'karyawan_role_id' => 'required',
			'karyawan_jabatan_id' => 'required',
			'karyawan_kantor_id' => 'required',
			'karyawan_npwp' => 'required',
			'karyawan_agama' => 'required',
            'karyawan_is_active' => 'required',
        ]);
        
        $input = $request->all();
        $input['karyawan_nik'] = app_generate_nik($request->karyawan_tipe);
        $input['karyawan_created_by'] = Auth::user()->karyawan_id;
        $input['karyawan_password'] = Hash::make($request->karyawan_password);
        $input['karyawan_tgl_lahir'] = date("Y-m-d",strtotime($request->karyawan_tgl_lahir));
        $input['karyawan_tgl_masuk'] = date("Y-m-d",strtotime($request->karyawan_tgl_masuk));
        $input['karyawan_tgl_keluar'] = date("Y-m-d",strtotime($request->karyawan_tgl_keluar));
        if ($request->has('file')) {
            $file = $request->file('file');
            $path = '/uploads/karyawan/';
            $exe = $file->getClientOriginalExtension();
            /* upload to direktori*/
            Image::make($file)->save(public_path($path . 'karyawan_foto.' . $exe), 70);

            /*set value untuk nyimpan ke database*/
            $input['karyawan_foto'] = $path . 'karyawan_foto.' . $exe;
        }
        
        DB::beginTransaction();
        try {
            Karyawan::create($input);
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        
        try {
            $kelola = [];
            $kelola=  $request->karyawan_kantor_kelola;
            $kantor = [];
            foreach ($kelola as $key => $value) {
                $kantor[$key]['karyawankantor_karyawan_id'] = DB::getPdo()->lastInsertId();
                $kantor[$key]['karyawankantor_kantor_id'] = $value;
                $kantor[$key]['karyawankantor_created_by_fullname'] = Auth::user()->user_fullname;
            }
            KaryawanKantor::insert($kantor);
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        DB::commit();
        AppResponse::set('success','Berhasil Menambah data'); // ['success','error','failed']
		return response()->json(AppResponse::response(), AppResponse::getCode());
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $data['module_title'] = 'Karyawan';
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => 'master/karyawan/#'],
            ['title' => "Karyawan",'url' => "master/karyawan"],
            ['title' => '','url' => "master/karyawan/show/".$id]
        ];
        $getData = DB::table('master_karyawan')
            ->leftjoin('master_jabatan', 'karyawan_jabatan_id', '=', 'jabatan_id')
            ->leftjoin('master_role', 'karyawan_role_id', '=', 'role_id')
            ->leftjoin('master_kantor', 'karyawan_kantor_id', '=', 'kantor_id')
            ->select("master_kantor.*", "master_karyawan.*", "master_jabatan.*", "master_role.*")
            ->where('karyawan_id', '=', $id)
            ->first();
        $data_kantor = Karyawan::with("karyawankantor", "karyawankantor.kantor")->find($id); 
        $data['karyawan_id'] = $getData->karyawan_id;
        $data['jabatan'] = ['id' => $getData->jabatan_id, 'text' => $getData->jabatan_nama];
        $data['role'] = ['id' => $getData->role_id, 'text' => $getData->role_name];
        $data['kantor'] = ['id' => $getData->kantor_id, 'text' => $getData->kantor_nama];
        $kantor = [];
        foreach ($data_kantor->karyawankantor as $key => $value) {
            $kantor[] = ['id' => $value->karyawankantor_kantor_id, 'text' => $value->kantor->kantor_nama];
        }
        $data['kantorkelola'] = $kantor;
        $data['data'] = json_encode(['karyawan_nik' => $getData->karyawan_nik, 'karyawan_tgl_keluar' => date("Y-m-d", strtotime($getData->karyawan_tgl_keluar)), 'karyawan_tgl_masuk' => date("Y-m-d", strtotime($getData->karyawan_tgl_masuk)),'karyawan_password'=>'password']);
        $data['action_type'] = "lihat";
        $data['getdata'] = route('karyawan.single_data', $id);

        return view("karyawan::karyawan_lihat",$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        AppGranted::grantedAccess('edit', true);
        $data['module_title'] = 'Karyawan';
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => 'master/karyawan/#'],
            ['title' => "Karyawan",'url' => "master/karyawan"],
            ['title' => 'Edit','url' => "master/karyawan/edit/".$id]
        ];
        
        $getData = DB::table('master_karyawan')
        ->leftjoin('master_jabatan', 'karyawan_jabatan_id', '=', 'jabatan_id')
        ->leftjoin('master_role', 'karyawan_role_id', '=', 'role_id')
        ->leftjoin('master_kantor', 'karyawan_kantor_id', '=', 'kantor_id')
        ->select("master_kantor.*", "master_karyawan.*", "master_jabatan.*", "master_role.*")
        ->where('karyawan_id', '=', $id)
        ->first();

        $data_kantor = Karyawan::with("karyawankantor","karyawankantor.kantor")->find($id); 
        
        $data['karyawan_id'] = $getData->karyawan_id;
        $data['jabatan'] = ['id' => $getData->jabatan_id, 'text' => $getData->jabatan_nama];
        $data['role'] = ['id' => $getData->role_id, 'text' => $getData->role_name];
        $data['kantor'] = ['id' => $getData->kantor_id, 'text' => $getData->kantor_nama];
        $kantor = [];
        foreach ($data_kantor->karyawankantor as $key => $value) {
            $kantor[] = ['id' => $value->karyawankantor_kantor_id ,'text' => $value->kantor->kantor_nama];
        }
        $data['kantorkelola'] = $kantor;
        $data['karyawan_tgl_keluar'] = date('d-m-Y',strtotime($getData->karyawan_tgl_keluar));
        $data['karyawan_tgl_masuk'] = date("Y-m-d", strtotime($getData->karyawan_tgl_masuk));
        $data['karyawan_tgl_lahir'] = date("Y-m-d", strtotime($getData->karyawan_tgl_lahir));
        // dd($data);
        $data['data'] = json_encode(['karyawan_nik' => $getData->karyawan_nik,'karyawan_password' => ';.,.,;']);
        $data['action_type'] = "edit";
        $data['getdata'] = route('karyawan.single_data', $id);
        $data['action'] = route('karyawan.update', $id);
        return view("karyawan::karyawan_form",$data);
    }
    
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'karyawan_nik' => 'required',
            'karyawan_fullname' => 'required',
            'karyawan_username' => 'required',
            'karyawan_jenis_kelamin' => 'required',
            'karyawan_no_identitas' => 'required',
            'karyawan_tempat_lahir' => 'required',
            'karyawan_tgl_lahir' => 'required',
            'karyawan_tgl_masuk' => 'required',
            'karyawan_tgl_keluar' => 'required',
            'karyawan_email' => 'required',
            'karyawan_telp' => 'required',
            'karyawan_password' => 'required',
            'karyawan_role_id' => 'required',
            'karyawan_jabatan_id' => 'required',
            'karyawan_kantor_id' => 'required',
            'karyawan_npwp' => 'required',
            'karyawan_agama' => 'required',
            'karyawan_is_active' => 'required',
        ]);
        $input = $request->all();
        $input['karyawan_created_by'] = Auth::user()->karyawan_id;
        $input['karyawan_password'] = Hash::make($request->karyawan_password);
        $input['karyawan_tgl_lahir'] = date("Y-m-d", strtotime($request->karyawan_tgl_lahir));
        $input['karyawan_tgl_masuk'] = date("Y-m-d", strtotime($request->karyawan_tgl_masuk));
        $input['karyawan_tgl_keluar'] = date("Y-m-d", strtotime($request->karyawan_tgl_keluar));
        
        if ($request->karyawan_password == ';.,.,;') {
            unset($input['karyawan_password']);
        }else {
            $input['karyawan_password'] = Hash::make($request->karyawan_password);
        }
        
        if ($request->has('file')) 
        {
            $file = $request->file('file');
       
            $path = '/uploads/karyawan/';
            $exe = $file->getClientOriginalExtension();
            /* upload to direktori*/
            Image::make($file)->save(public_path($path . 'karyawan_foto.' . $exe), 70);
            
            /*set value untuk nyimpan ke database*/
            $input['karyawan_foto'] = $path . 'karyawan_foto.' . $exe;
        }
        
        $find = Karyawan::findOrFail($id);
        DB::beginTransaction();
        try {
            $find->update($input);
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        
        try {
            $kelola = [];
            $kelola =  $request->karyawan_kantor_kelola;
            $kantor = [];
            foreach ($kelola as $key => $value) {
                $kantor[$key]['karyawankantor_karyawan_id'] = $id;
                $kantor[$key]['karyawankantor_kantor_id'] = $value;
                $kantor[$key]['karyawankantor_created_by_fullname'] = Auth::user()->user_fullname;
            }
            KaryawanKantor::where('karyawankantor_karyawan_id','=',$id)->delete();
            KaryawanKantor::insert($kantor);
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        DB::commit();
        AppResponse::set('success','Berhasil Mengubah Data'); // ['success','error','failed']
       	return response()->json(AppResponse::response(), AppResponse::getCode());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        $find = Karyawan::findOrFail($id);
        $data_update['karyawan_deleted_by'] = Auth::user()->karyawan_id;
        $data_update['karyawan_is_delete'] = "1";
        $find->update($data_update);

        if ($find->delete()) {
            AppResponse::set('success', 'Berhasil Menghapus Data'); // ['success','error','failed']
        } else {
            AppResponse::set('error', ' Tidak Berhasil Menghapus Data'); // ['success','error','failed']
        }
        return response()->json(AppResponse::response(), AppResponse::getCode());
    }

    public function getdata(Request $request)
    {
        if (!$request->ajax()) {
            dd("why you haven't sleep yet");
        }

        $getData = DB::table('karyawan')
        ->leftjoin('jabatan', 'karyawan_jabatan_id', '=', 'jabatan_id')
        ->leftjoin('role', 'karyawan_role_id', '=', 'role_id')
        ->select("*")
        ->whereNull('karyawan_deleted_at');
        
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;
        
        $filter = [
            "like" => [
                "karyawan_nik",
                "karyawan_fullname",
                "karyawan_email",
                "karyawan_agama",
                "jabatan_nama",
                "role_name",
                "karyawan_tipe",
                ]
            ];
            
            foreach ($filter as $key => $value) {
                foreach ($value as $item) {
                    if ($request->filled($item)) {
                        if ($key == "like") {
                            $getData->where($item, "like", "%{$request->$item}%");
                        } else if ($key == "=") {
                            $getData->where($item, "=", "{$request->$item}");
                        }
                    }
                }
            }
            // filter
            $totalData =  $getData->count();
            // dd($totalData);

            $getData->offset($request->start)
            ->limit($request->length);
            
            $col_order = $request->order[0]['column'];
            
            $col = [
                'karyawan_id',
                'karyawan_nik',
                'karyawan_fullname',
                'karyawan_email',
                'karyawan_agama',
                'jabatan_nama',
                'role_name',
                'karyawan_tipe'
            ];
            // dd($request->all());
            
            $getData->orderBy($col[$col_order], $request->order[0]["dir"]);  
            $getData = $getData->get();
            
            $start = (int) $request->start;
            $length = $request->length;
            // list data
            $data = [];
            foreach ($getData as $key => $value) {
                $action = [];
                $refId = $value->karyawan_id;
                $isDelete = true;
                $isEdit = true;
                
                $action['view'] = route('karyawan.view', ['id' => $refId]);
                if ($isEdit) {
                    $action['edit'] = route('karyawan.edit', ['id' => $refId]);
                }
                if ($isDelete) {
                    $action['delete'] = "mydata-url='" . route("karyawan.delete", ['id' => $refId]) . "' mydata-isdelete='1' mydata-name='" . $value->karyawan_fullname . "' mydata-id='" . $refId . "'";
                }
                
            array_push($data, array(
                ($key + ($start + 1)),
                $value->karyawan_nik,
                $value->karyawan_fullname,
                $value->karyawan_email,
                $value->karyawan_agama,
                $value->jabatan_nama,
                $value->role_name,
                $value->karyawan_tipe,
                $action
            ));
        }
        // list data
        $secho = 0;
        if (isset($request->sEcho)) {
            $secho = intval($request->sEcho);
        }

        $result = [
            'iTotalRecords'        => $totalData,
            'iTotalDisplayRecords' => $totalData,
            'sEcho'                => $secho,
            'sColumns'             => '',
            'aaData'               => $data,
        ];
        return response()->json($result);
    }

    public function getselect2(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('karyawan')
                ->select('karyawan_id as id', 'karyawan_fullname as text')
                ->where('karyawan_nik', 'LIKE', '%' . $cari . '%') 
                ->where('karyawan_fullname', 'LIKE', '%' . $cari . '%', 'or')
                ->where('karyawan_username', 'LIKE', '%' . $cari . '%', 'or')
                ->whereNull('karyawan_deleted_at')->get();

                return response()->json($data);

        }
    }

    public function getselectrole(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $tes = DB::table('role')
                ->select('role_id as id', 'role_name as text')
                ->where('role_name', 'LIKE', '%' . $cari . '%')->whereNull('role_deleted_at')
                ->get();
            return response()->json($tes);
        }
    }

    public function getselectjabatan(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $tes = DB::table('jabatan')
                ->select('jabatan_id as id', 'jabatan_nama as text')
                ->where('jabatan_nama', 'LIKE', '%' . $cari . '%')->whereNull('jabatan_deleted_at')
                ->get();
            return response()->json($tes);
        }
    }

    public function getselectkantor(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $tes = DB::table('kantor')
                ->select('kantor_id as id', 'kantor_nama as text')
                ->where('kantor_nama', 'LIKE', '%' . $cari . '%')->whereNull('kantor_deleted_at')
                ->get();
            return response()->json(["data"=>$tes]);
        }
    }

    public function get_single_data($id)
    {
        $_data=Karyawan::find($id)->toArray();
        $data = (object) $_data;
        AppResponse::set('success', 'get data');
        return response()->json(AppResponse::response($data, 'karyawan_foto'), AppResponse::getCode());
    }

    public function getselectkantorsingle(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $tes = DB::table('kantor')
                ->select('kantor_id as id', 'kantor_nama as text')
                ->where('kantor_nama', 'LIKE', '%' . $cari . '%')->whereNull('kantor_deleted_at')
                ->get();


            return response()->json($tes);
        }
    }
}
