<?php

namespace Modules\Komentar\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\AppGranted;
use App\Helpers\AppResponse;
use App\Models\Komentar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
// use App\Models\Model;

class KomentarController extends Controller
{
    protected $except = [];

    protected $moduleParent = "Master Data";
    protected $moduleTitle = "Komentar";
    protected $moduleUrl = "komentar";

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

        return view("komentar::komentar", $data);
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

        $data['action'] = route('komentar.store');
        $data['action_type'] = "add";
        $data['redirect'] = route("komentar.index");

        return view("komentar::create", $data);
    }

    public function get(Request $request)
    {
      $getData = DB::table('komentar')
      ->whereNull('komentar_deleted_at');
      $getData->offset($request->start)->limit($request->length);
      
      // filter
      if ($request->filled("email")) {
          $getData->where("komentar_email", "like", "%{$request->email}%");
      }

      if ($request->filled("isi")) {
        $getData->where("komentar_isi", "like", "%{$request->isi}%");
    }

      $getData->orderBy("komentar_id", $request->order[0]["dir"]);
      $totalData =  $getData->count();
      $getData = $getData->get();

      $iDisplayLength = intval($_REQUEST['length']);
      $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;

      // list data
      $data = [];
      $i = 1;
      foreach ($getData as $key => $value) {
          $action = [];
          $refId = $value->komentar_id;
          $isDelete = true;
          $isEdit = true;
          
          if ($isDelete) {
              $action['delete'] = "mydata-url='" . route("komentar.delete", ['id' => $refId]) . "' mydata-isdelete='1' mydata-name='" . $value->komentar_email . "' mydata-id='" . $refId . "'";
          }
          
          array_push($data, array(
              $i++,
              $value->komentar_email,
              $value->komentar_isi,
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
  			'name_input' => 'required',
  		]);

      DB::beginTransaction();

      try {
        // $data->save();
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
            ['title' => $this->moduleTitle,'url' => "komentar"],
            ['title' => '','url' => $this->moduleUrl."/show/".$id]
        ];

        $data['action_type'] = "lihat";
        $data['getdata'] = route('komentar.single_data', $id);
        $data['action'] = route('komentar.show', $id);

        return view("komentar::show",$data);
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
          ['title' => $this->moduleTitle,'url' => "komentar"],
          ['title' => '','url' => $this->moduleUrl."/edit/".$id]
      ];

      $data['action_type'] = "edit";
      $data['getdata'] = route('komentar.single_data', $id);
      $data['action'] = route('komentar.update', $id);

      return view("komentar::edit", $data);
    }

    public function get_single_data($id)
    {
        $data = DB::table('table')->where('column_id', $id)->first();
        // $data = Model::find($id);

        return response()->json($data, 200);
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
          'name_input' => 'required',
        ]);
      
        $data = DB::table('table')->where('column_id', $id)->first();
        // $data = Model::find($id);
        
        DB::beginTransaction();

        try {
          // $data->save();
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
      $find = Komentar::findOrFail($id);
      
      if ($find->delete()) {
          AppResponse::set('success', 'Berhasil Menghapus Data'); // ['success','error','failed']
      } else {
          AppResponse::set('error', ' Tidak Berhasil Menghapus Data'); // ['success','error','failed']
      }
      return response()->json(AppResponse::response(), AppResponse::getCode());
    }
}
