<?php

namespace Modules\Artikel\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\AppGranted;
use App\Helpers\AppResponse;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

// use App\Models\Model;

class ArtikelController extends Controller
{
    protected $except = [];

    protected $moduleParent = "Master Data";
    protected $moduleTitle = "Artikel";
    protected $moduleUrl = "artikel";

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

        return view("artikel::artikel", $data);
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

        $data['action'] = route('artikel.store');
        $data['action_type'] = "add";
        $data['redirect'] = route("artikel.index");
        $data['data'] = json_encode(['karyawan_nik' => app_generate_nik()]);
        return view("artikel::artikel_form", $data);
    }

    public function get(Request $request)
    {
      $getData = DB::table('artikel')
      ->whereNull('artikel_deleted_at');
      $getData->offset($request->start)->limit($request->length);
      
      // filter
      if ($request->filled("judul")) {
          $getData->where("artikel_judul", "like", "%{$request->judul}%");
      }
      // if ($request->filled("sampul")) {
      //     $getData->where("kantor_tipe", "like", "%{$request->tipe}%");
      // }
      if ($request->filled("kategori")) {
          $getData->where("artikel_kategori", "like", "%{$request->kategori}%");
      }

      $getData->orderBy("artikel_id", $request->order[0]["dir"]);
      $totalData =  $getData->count();
      $getData = $getData->get();

      $iDisplayLength = intval($_REQUEST['length']);
      $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;

      // list data
      $data = [];
      $i = 1;
      foreach ($getData as $key => $value) {
          $action = [];
          $refId = $value->artikel_id;
          $isDelete = true;
          $isEdit = true;
          
          $action['view'] = route('artikel.show', ['id' => $refId]);
          if ($isEdit) {
              $action['edit'] = route('artikel.edit', ['id' => $refId]);
          }
          if ($isDelete) {
              $action['delete'] = "mydata-url='" . route("artikel.delete", ['id' => $refId]) . "' mydata-isdelete='1' mydata-name='" . $value->artikel_judul . "' mydata-id='" . $refId . "'";
          }
          
          $foto = "<img src='$value->artikel_foto' height='30px' width='30px' />" ;
          array_push($data, array(
              $i++,
              $foto,
              $value->artikel_judul,
              $value->artikel_kategori,
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
  			'artikel_judul' => 'required',
  			'artikel_kategori' => 'required',
  		]);
        // dd($request->all());
        DB::beginTransaction();
        $input = $request->all();
        $input['artikel_created_by'] = Auth::user()->karyawan_id;
        if ($request->has('file')) {
            $file = $request->file('file');
            $path = '/uploads/artikel/';
            $exe = $file->getClientOriginalExtension();
            /* upload to direktori*/
            Image::make($file)->save(public_path($path . 'artikel_foto.' . $exe), 70);

            /*set value untuk nyimpan ke database*/
            $input['artikel_foto'] = $path . 'artikel_foto.' . $exe;
        }
      // dd($input);
      try {
        Artikel::create($input);
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
            ['title' => $this->moduleTitle,'url' => "artikel"],
            ['title' => '','url' => $this->moduleUrl."/show/".$id]
        ];

        $data['action_type'] = "lihat";
        $data['getdata'] = route('artikel.single_data', $id);
        $data['action'] = route('artikel.show', $id);

        return view("artikel::show",$data);
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
          ['title' => $this->moduleTitle,'url' => "artikel"],
          ['title' => '','url' => $this->moduleUrl."/edit/".$id]
      ];

      $data['action_type'] = "edit";
      $data['getdata'] = route('artikel.single_data', $id);
      $data['action'] = route('artikel.update', $id);
      $data['redirect'] = route("artikel.index");
      $data['data'] = json_encode(['karyawan_nik' => app_generate_nik()]);

      return view("artikel::artikel_form", $data);
    }

    public function get_single_data($id)
    {
      $_data=Artikel::find($id)->toArray();
      $data = (object) $_data;
      AppResponse::set('success', 'get data');
      return response()->json(AppResponse::response($data, 'artikel_foto'), AppResponse::getCode());
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
          'artikel_judul' => 'required',
          'artikel_kategori' => 'required',
        ]);
      
        $input = $request->all();
        $input['artikel_created_by'] = Auth::user()->karyawan_id;
        if ($request->has('file')) {
            $file = $request->file('file');
            $path = '/uploads/artikel/';
            $exe = $file->getClientOriginalExtension();
            /* upload to direktori*/
            Image::make($file)->save(public_path($path . 'artikel_foto.' . $exe), 70);
  
            /*set value untuk nyimpan ke database*/
            $input['artikel_foto'] = $path . 'artikel_foto.' . $exe;
        }

        $find = Artikel::findOrFail($id);
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
      $find = Artikel::findOrFail($id);
      
        if ($find->delete()) {
            AppResponse::set('success', 'Berhasil Menghapus Data'); // ['success','error','failed']
        } else {
            AppResponse::set('error', ' Tidak Berhasil Menghapus Data'); // ['success','error','failed']
        }
        return response()->json(AppResponse::response(), AppResponse::getCode());
    }
}
