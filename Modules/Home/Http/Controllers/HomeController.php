<?php

namespace Modules\Home\Http\Controllers;

use App\Helpers\AppResponse;
use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Komentar;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
// use App\Models\Model;

class HomeController extends Controller
{
    protected $except = [];

    protected $moduleParent = "Master Data";
    protected $moduleTitle = "Home";
    protected $moduleUrl = "home";

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $data['module_title'] = $this->moduleTitle;
        $data['breadcrumb'] = [
            ['title' => $this->moduleParent,'url' => '#'],
            ['title' => $this->moduleTitle,'url' => $this->moduleUrl]
        ];

        if($request->mode != "galery"){
          $getData = DB::table('artikel')
          ->whereNull('artikel_deleted_at');

          $data['artikel'] = "active";
        } else {
          $getData = DB::table('anggrek')
          ->select('anggrek_id as artikel_id','anggrek_foto as artikel_foto', 'anggrek_nama as artikel_judul')
          ->whereNull('anggrek_deleted_at');
          $data['anggrek'] = "active";
        }
        $totalData =  $getData->count();
        $getData = $getData->paginate(6);
        
        $data['data'] = $getData;

        return view("home::home", $data);
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

        $data['action'] = route('home.store');
        $data['action_type'] = "add";
        $data['redirect'] = route("home.index");

        return view("home::create", $data);
    }

    public function get(Request $request)
    {
        if(!$request->ajax()) {
            dd("why you haven't sleep yet");
        }

        $table = 'table';
        $column = 'column';

        $query = DB::table($table)->whereNull($column."_deleted_at");

        $totalData =  $query->count();

        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;

        $getData = $query;
        
        $getData = $getData->offset($request->start)
        ->limit($request->length);

        $filter = [
          "like" => [
            $column."_1",
          ],
          "=" => [
            $column."_2",
          ]
        ];

        foreach ($filter as $key => $value) {
          foreach ($value as $item) {
            if($request->filled($item)) {
              if($key == "like") {
                $getData = $getData->where($item, "like", "%{$request->$item}%");
              } else if($key == "=") {
                $getData = $getData->where($item, "=", "{$request->$item}");
              }
            }
          }
        }

    // dd($request->all());

        $getData = $getData->orderBy($column."_id", $request->order[0]["dir"]);        

        $getData = $getData->get();
            
        $data = [];

        $isDelete = AppGranted::grantedAccess("delete");
        $isEdit = AppGranted::grantedAccess("edit");

        $start = (int) $request->start;
        $length = $request->length;

        foreach ($getData as $key => $value) {
            $action = [];
            $refId = @$value->{$column."_id"};

            $action['view'] = route('home.show',['id'=>$refId]);

            if($isEdit){
                $action['edit'] = route('home.edit',['id'=>$refId]);
            }

            if ($isDelete) {
                $action ['delete'] = "mydata-url='". route("home.delete",['id'=>$refId]) ."' mydata-isdelete='1' mydata-name='".@$value->{$column."_nama"}."' mydata-id='". $refId."'";
            }

            array_push($data, array(
              ($key + ($start + 1)),
              $action
            ));
        }

        $secho = 0;
        if ( isset($request->sEcho) ) {
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
  			// 'name_input' => 'required',
  		]);
      $input = $request->all();
      DB::beginTransaction();

      try {
        Komentar::create($input);
      } catch (\Exception $e) {
        DB::rollback();
        dd($e);
      }

      DB::commit();

      return redirect(route('home.edit', $input['komentar_artikelid']));
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
            ['title' => $this->moduleTitle,'url' => "home"],
            ['title' => '','url' => $this->moduleUrl."/show/".$id]
        ];

        $data['action_type'] = "lihat";
        $data['getdata'] = route('home.single_data', $id);
        $data['action'] = route('home.show', $id);

        return view("home::show",$data);
    }


    public function about()
    {
        $data['module_title'] = $this->moduleTitle;
        $data['breadcrumb'] = [
            ['title' => $this->moduleParent,'url' => '#'],
            ['title' => $this->moduleTitle,'url' => "about"],
        ];

        $data['action_type'] = "lihat";

        return view("home::about",$data);
    }

    public function contact()
    {
        $data['module_title'] = $this->moduleTitle;
        $data['breadcrumb'] = [
            ['title' => $this->moduleParent,'url' => '#'],
            ['title' => $this->moduleTitle,'url' => "contact"],
        ];

        $data['action_type'] = "lihat";

        return view("home::contact",$data);
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

      $data['module_title'] = $this->moduleTitle;
      $data['breadcrumb'] = [
          ['title' => $this->moduleParent,'url' => '#'],
          ['title' => $this->moduleTitle,'url' => "home"],
          ['title' => '','url' => $this->moduleUrl."/edit/".$id]
      ];

      $artikel = DB::table('artikel')->where('artikel_id', $id)->first();
      $komentar = DB::table('komentar')->where('komentar_artikelid', $id)->get();

      $data['action_type'] = "add";
      $data['data'] = $artikel;
      $data['komentar'] = $komentar;
      $data['action'] = route('home.store');
      // dd($data);
      return view("home::artikel_form", $data);
    }

    public function get_single_data($id)
    {
        $data = DB::table('artikel')->where('artikel_id', $id)->first();
        // $data = Model::find($id);
        // $_data=Artikel::find($id)->toArray();
        // $data = (object) $_data;
        // AppResponse::set('success', 'get data');
        // return response()->json(AppResponse::response($data, 'karyawan_foto'), AppResponse::getCode());
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
      $data = DB::table('table')->where('column_id', $id)->first();
        // $data = Model::find($id);
        // 
      DB::beginTransaction();

      try {
        // $data->save();
      } catch (\Exception $e) {
        DB::rollback();
        dd($e);
      }

      DB::commit();

      AppResponse::set('success','Berhasil Menghapus Data'); // ['success','error','failed']
      return response()->json(AppResponse::response(), AppResponse::getCode());
    }
}
