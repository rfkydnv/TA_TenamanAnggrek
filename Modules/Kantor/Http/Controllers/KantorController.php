<?php

namespace Modules\Kantor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\AppGranted;
use App\Helpers\AppResponse;
use Illuminate\Support\Facades\Auth;
use App\Kantor;

class KantorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['module_title'] = "Master Kantor";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => 'home'],
            ['title' => 'Kantor','url' => 'master/kantor']
        ];

        return view('kantor::kantor', $data);
    }

    public function get(Request $request)
    {
        $getData = DB::table('master_kantor')
        ->leftjoin('master_kecamatan', 'kecamatan_id', '=', 'kantor_lokasi_id')
        ->select("*","kecamatan_nama")->whereNull('kantor_deleted_at');
        $getData->offset($request->start)->limit($request->length);
        
        // filter
        if ($request->filled("nama")) {
            $getData->where("kantor_nama", "like", "%{$request->nama}%");
        }
        if ($request->filled("tipe")) {
            $getData->where("kantor_tipe", "like", "%{$request->tipe}%");
        }
        if ($request->filled("lokasi")) {
            $getData->where("kecamatan_nama", "like", "%{$request->lokasi}%");
        }

        $getData->orderBy("kantor_id", $request->order[0]["dir"]);
        $totalData =  $getData->count();
        $getData = $getData->get();

        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;

        // list data
        $data = [];
        $i = 1;
        foreach ($getData as $key => $value) {
            $action = [];
            $refId = $value->kantor_id;
            $isDelete = true;
            $isEdit = true;
            
            $action['view'] = route('kantor.view', ['id' => $refId]);
            if ($isEdit) {
                $action['edit'] = route('kantor.edit', ['id' => $refId]);
            }
            if ($isDelete) {
                $action['delete'] = "mydata-url='" . route("kantor.delete", ['id' => $refId]) . "' mydata-isdelete='1' mydata-name='" . $value->kantor_nama . "' mydata-id='" . $refId . "'";
            }

            array_push($data, array(
                $i++,
                $value->kantor_nama,
                $value->kantor_tipe,
                $value->kecamatan_nama,
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
            $tes = DB::table('master_lokasi')
                ->select('lokasi_id as id', 'lokasi_nama as text')
                ->where('lokasi_nama', 'LIKE', '%' . $cari . '%')->whereNull('lokasi_deleted_at')
                ->get();
                return response()->json(['data'=>$tes]);
        }
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
     	AppGranted::grantedAccess('add', true);
        $data['module_title'] = "Role";
        $data['action'] = route('kantor.store');
        $data['action_type'] = "add";

        $data['breadcrumb'] = [ 
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Kantor','url' => 'kantor'],
            ['title' => 'form','url' => 'form']
        ];

        $data['redirect'] = route("kantor.create");
        
        return view('kantor::kantor_form',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
		$this->validate($request,[
			'kantor_nama' => 'required',
			'kantor_tipe' => 'required',
            ]);
        
        
        $input = $request->all();
        // $input['kantor_lokasi_id'] = ;
        $input['kantor_created_by'] = Auth::user()->user_id;

        $save = Kantor::create($input);
        
        if ($save)
        {
            AppResponse::set('success','Berhasil Menambah data'); // ['success','error','failed']
        }

		return response()->json(AppResponse::response(), AppResponse::getCode());
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $data['module_title'] = "Kantor";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => 'home'],
            ['title' => 'Kantor','url' => 'master/kantor'],
            ['title' => 'lihat','url' => 'master/kantor/show/'.$id]
        ];

        $getData = DB::table('master_kantor')
        ->leftjoin('master_kecamatan', 'kecamatan_id', '=', 'kantor_lokasi_id')
        ->select("master_kantor.*","master_kecamatan.*")
        ->where('kantor_id','=',$id)
        ->first();

        $data['kantor_id'] = $getData->kantor_id;
        $data['lokasi'] = ['id'=>$getData->kecamatan_id,'text'=>$getData->kecamatan_nama];
        
        $data['action_type'] = "lihat";
        $data['getdata'] = route('kantor.single_data_lihat', $id);
        $data['action'] = route('kantor.update', $id);

        return view('kantor::kantor_lihat',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function get_single_data_lihat($id)
    {
        $data = DB::table('master_kantor')
        ->leftjoin('master_kecamatan', 'kecamatan_id', '=', 'kantor_lokasi_id')
        ->select("master_kantor.*","master_kecamatan.*")
        ->where('kantor_id','=',$id)
        ->first();
        
        return response()->json($data, 200);
    }

    public function get_single_data($id)
    {
        $data = DB::table('master_kantor')->where('kantor_id',$id)->first();
        return response()->json($data, 200);
    }
    
    public function edit($id)
    {
		AppGranted::grantedAccess('edit', true);
        $data['module_title'] = "Kantor";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => 'home'],
            ['title' => 'Kantor','url' => 'master/kantor'],
            ['title' => 'edit','url' => 'master/kantor/edit/'.$id]
        ];

        $getData = DB::table('master_kantor')
        ->leftjoin('master_kecamatan', 'kecamatan_id', '=', 'kantor_lokasi_id')
        ->select("master_kantor.*","master_kecamatan.*")
        ->where('kantor_id','=',$id)
        ->first();
        
        $data['kantor_id'] = $getData->kantor_id;
        $data['lokasi'] = ['id'=>$getData->kecamatan_id,'text'=>$getData->kecamatan_nama];

        $data['action_type'] = "edit";
        $data['getdata'] = route('kantor.single_data', $id);
        $data['action'] = route('kantor.update', $id);

        return view('kantor::kantor_form',$data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
			'kantor_nama' => 'required',
			'kantor_tipe' => 'required',
            ]);
            
        $input = $request->all();
        $input['kantor_updated_by'] = Auth::user()->user_id;

        $find = Kantor::findOrFail($id);

        $update = $find->update($input);

        if ($update)
        {
            AppResponse::set('success','Berhasil Mengubah Data'); // ['success','error','failed']
        }
       	return response()->json(AppResponse::response(), AppResponse::getCode());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        $kantor = Kantor::find($id);
        if ($kantor->delete()) {
            AppResponse::set('success','Berhasil Menghapus Data'); // ['success','error','failed']
        }else{
            AppResponse::set('error',' Tidak Berhasil Menghapus Data'); // ['success','error','failed']
        }
        return response()->json(AppResponse::response(), AppResponse::getCode());
    }
}
