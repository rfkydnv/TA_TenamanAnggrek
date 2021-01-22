<?php

namespace Modules\Anggrek\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\AppGranted;
use App\Helpers\AppResponse;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Anggrek;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
// use App\Models\Model;

class AnggrekController extends Controller
{
    protected $except = [];

    protected $moduleParent = "Master Data";
    protected $moduleTitle = "Anggrek";
    protected $moduleUrl = "anggrek";

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['module_title'] = $this->moduleTitle;
        $data['breadcrumb'] = [
            ['title' => $this->moduleParent,'url' => '#'],
            ['title' => $this->moduleTitle,'url' => $this->moduleUrl]
        ];

        return view("anggrek::anggrek", $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
     	AppGranted::grantedAccess('add', true);
        $data['module_title'] = $this->moduleTitle;
        $data['breadcrumb'] = [
            ['title' => $this->moduleParent,'url' => '#'],
            ['title' => $this->moduleTitle,'url' => $this->moduleUrl."/create"]
        ];

        $data['action'] = route('anggrek.store');
        $data['action_type'] = "add";
        $data['redirect'] = route("anggrek.index");
        $data['data'] = json_encode(['karyawan_nik' => app_generate_nik()]);

        return view("anggrek::anggrek_form", $data);
    }

    public function get(Request $request)
    {
      $getData = DB::table('anggrek')
      ->whereNull('anggrek_deleted_at');
      $getData->offset($request->start)->limit($request->length);
      
      // filter
      if ($request->filled("nama")) {
          $getData->where("anggrek_nama", "like", "%{$request->nama}%");
      }

      $getData->orderBy("anggrek_id", $request->order[0]["dir"]);
      $totalData =  $getData->count();
      $getData = $getData->get();

      $iDisplayLength = intval($_REQUEST['length']);
      $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;

      // list data
      $data = [];
      $i = 1;
      foreach ($getData as $key => $value) {
          $action = [];
          $refId = $value->anggrek_id;
          $isDelete = true;
          $isEdit = true;
          
          $action['view'] = route('anggrek.show', ['id' => $refId]);
          if ($isEdit) {
              $action['edit'] = route('anggrek.edit', ['id' => $refId]);
          }
          if ($isDelete) {
              $action['delete'] = "mydata-url='" . route("anggrek.delete", ['id' => $refId]) . "' mydata-isdelete='1' mydata-name='" . $value->anggrek_nama . "' mydata-id='" . $refId . "'";
          }
          
          $foto = "<img src='$value->anggrek_foto' height='50px' width='50px' />" ;
          array_push($data, array(
              $i++,
              $foto,
              $value->anggrek_nama,
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

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
  		$this->validate($request,[
  			'anggrek_nama' => 'required',
  		]);
        // dd($request->all());
        DB::beginTransaction();
        $input = $request->all();
        $input['anggrek_created_by'] = Auth::user()->karyawan_id;
        if ($request->has('file')) {
            $file = $request->file('file');
            $path = '/uploads/anggrek/';
            $exe = $file->getClientOriginalExtension();
            /* upload to direktori*/
            Image::make($file)->save(public_path($path . 'anggrek_foto.' . $exe), 70);

            /*set value untuk nyimpan ke database*/
            $input['anggrek_foto'] = $path . 'anggrek_foto.' . $exe;
        }

      try {
        Anggrek::create($input);
      } catch (\Exception $e) {
        DB::rollback();
        dd($e);
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
        $data['module_title'] = $this->moduleTitle;
        $data['breadcrumb'] = [
            ['title' => $this->moduleParent,'url' => '#'],
            ['title' => $this->moduleTitle,'url' => "anggrek"],
            ['title' => '','url' => $this->moduleUrl."/show/".$id]
        ];

        $data['action_type'] = "lihat";
        $data['getdata'] = route('anggrek.single_data', $id);
        $data['action'] = route('anggrek.show', $id);

        return view("anggrek::show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
		  AppGranted::grantedAccess('edit', true);

      $data['module_title'] = $this->moduleTitle;
      $data['breadcrumb'] = [
          ['title' => $this->moduleParent,'url' => '#'],
          ['title' => $this->moduleTitle,'url' => "anggrek"],
          ['title' => '','url' => $this->moduleUrl."/edit/".$id]
      ];

      $data['action_type'] = "edit";
      $data['getdata'] = route('anggrek.single_data', $id);
      $data['action'] = route('anggrek.update', $id);
      $data['redirect'] = route("anggrek.index");
      $data['data'] = json_encode(['karyawan_nik' => app_generate_nik()]);

      return view("anggrek::anggrek_form", $data);
    }

    public function get_single_data($id)
    { 
      $_data = Anggrek::find($id)->toArray();
      $data  = (object) $_data;
      AppResponse::set('success', 'get data');
      return response()->json(AppResponse::response($data, 'anggrek_foto'), AppResponse::getCode());
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
          'anggrek_nama' => 'required',
        ]);
      
        $input = $request->all();
        if ($request->has('file')) {
            $file = $request->file('file');
            $path = '/uploads/anggrek/';
            $exe = $file->getClientOriginalExtension();
            /* upload to direktori*/
            Image::make($file)->save(public_path($path . 'anggrek_foto.' . $exe), 70);
  
            /*set value untuk nyimpan ke database*/
            $input['anggrek_foto'] = $path . 'anggrek_foto.' . $exe;
        }

        $find = Anggrek::findOrFail($id);
        DB::beginTransaction();
        try {
          $find->update($input);
        } catch (\Exception $e) {
          DB::rollback();
          dd($e);
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
      $find = Anggrek::findOrFail($id);
      
        if ($find->delete()) {
            AppResponse::set('success', 'Berhasil Menghapus Data'); // ['success','error','failed']
        } else {
            AppResponse::set('error', ' Tidak Berhasil Menghapus Data'); // ['success','error','failed']
        }
        return response()->json(AppResponse::response(), AppResponse::getCode());
    }
}
