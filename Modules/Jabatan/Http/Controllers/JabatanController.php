<?php

namespace Modules\Jabatan\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\AppGranted;
use App\Helpers\AppResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jabatan;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['module_title'] = "Jabatan";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => 'master/jabatan/#'],
            ['title' => "Jabatan",'url' => "master/jabatan"]
        ];

        return view("jabatan::jabatan", $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
     	AppGranted::grantedAccess('add', true);
        $data['module_title'] = "Jabatan";
        $data['form_title'] = 'Form Tambah Jabatan';
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => 'master/jabatan/#'],
            ['title' => "Jabatan",'url' => "master/jabatan"],
            ['title' => "Tambah",'url' => "master/jabatan/create"]
          ];
          $data['action'] = route('jabatan.store');
          $data['action_type'] = "add";
          $data['redirect'] = route("jabatan.index");
          
          return view("jabatan::jabatan_form", $data);
        }
        
        public function get(Request $request)
        {
          if(!$request->ajax()) {
            dd("why you haven't sleep yet");
          }
          
          $table = 'master_jabatan';
          
          $getData = DB::table($table)
          ->select("*")
          ->whereNull('jabatan_deleted_at');
          
          $iDisplayLength = intval($_REQUEST['length']);
          $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;
          
          $filter = [
            "like" => [
              "jabatan_nama",
              ]
            ];
            foreach ($filter as $key => $value) {
              foreach ($value as $item) {
                if($request->filled($item)) {
                  if($key == "like") {
                    $getData->where($item, "like", "%{$request->$item}%");
                  } else if($key == "=") {
                    $getData->where($item, "=", "{$request->$item}");
                  }
                }
              }
            }
            
        $totalData = $getData->count();
        $getData->offset($request->start)
        ->limit($request->length);
        
      $col_order = $request->order[0]['column'];

      $col = [
        'jabatan_id',
        'jabatan_nama',
        'jabatan_keterangan'
      ];
    // dd($request->all());
    
    $getData->orderBy($col[$col_order], $request->order[0]["dir"]);        

    $getData = $getData->get();


    $start = (int) $request->start;
    $length = $request->length;
    
    $data = [];
    
        $isDelete = AppGranted::grantedAccess("delete");
        $isEdit = AppGranted::grantedAccess("edit");

        foreach ($getData as $key => $value) {
            $action = [];
            $refId = @$value->jabatan_id;

            // $action['view'] = route('jabatan.show',['id'=>$refId]);

            if($isEdit){
                $action['edit'] = route('jabatan.edit',['id'=>$refId]);
              }

            if ($isDelete) {
                $action ['delete'] = "mydata-url='". route("jabatan.delete",['id'=>$refId]) ."' mydata-isdelete='1' mydata-name='".@$value->jabatan_nama."' mydata-id='". $refId."'";
            }

            array_push($data, array(
              ($key + ($start + 1)),
              $value->jabatan_nama,
              $value->jabatan_keterangan,
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
			'jabatan_nama' => 'required',
			'jabatan_keterangan' => 'required',
    ]);
    $input = $request->all();
    $input['jabatan_created_by'] = Auth::user()->user_id;

    $save = Jabatan::create($input);
    if ($save) {
      # code...
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
        $data['module_title'] = "Jabatan";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => 'master/jabatan/#'],
            ['title' => "Jabatan",'url' => "master/jabatan"],
            ['title' => '','url' => "master/jabatan/show/".$id]
        ];

        return view("jabatan::show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
		AppGranted::grantedAccess('edit', true);
        $data['module_title'] = "Jabatan";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => 'master/jabatan/#'],
            ['title' => "Jabatan",'url' => "master/jabatan"],
            ['title' => 'Edit','url' => "master/jabatan/edit/".$id]
        ];

        $data['action_type'] = "edit";
        $data['getdata'] = route('jabatan.single_data', $id);
        $data['action'] = route('jabatan.update', $id);
        return view("jabatan::jabatan_form",$data);
    }

    public function get_single_data($id)
    {
        $data = DB::table('master_jabatan')->where('jabatan_id', $id)->first();
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
        $this->validate($request, [
          'jabatan_nama' => 'required',
          'jabatan_keterangan' => 'required',
        ]);
        $input = $request->all();
        $input['jabatan_updated_by'] = Auth::user()->user_id;

        $find = Jabatan::findOrFail($id);

        $update = $find->update($input);
        if ($update) {
          # code...
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
        $jabatan = Jabatan::find($id);
        if ($jabatan->delete()) {
          AppResponse::set('success', 'Berhasil Menghapus Data'); // ['success','error','failed']
        } else {
          AppResponse::set('error', ' Tidak Berhasil Menghapus Data'); // ['success','error','failed']
        }
         return response()->json(AppResponse::response(), AppResponse::getCode());
    }
    
}
