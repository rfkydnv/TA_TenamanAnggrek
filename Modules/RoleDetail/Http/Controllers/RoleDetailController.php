<?php

namespace Modules\RoleDetail\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\RoleDetail;

class RoleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['module_title'] = "RoleDetail";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'RoleDetail','url' => 'roledetail']
        ];
        
        return view('roledetail::index', $data);
    }

    public function get_data(Request $request)
    {
      $totalData =  DB::table('master_role_detail')->count();
      $iDisplayLength = intval($_REQUEST['length']);
      $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;
        
      $getData = DB::table('master_role_detail')
      ->join('master_role', 'role_id', '=', 'roledetail_role_id')
      ->join('master_menu', 'menu_id', '=', 'roledetail_menu_id')
      ->select("master_role_detail.*","menu_name","role_name")
      ->where('role_id','=',$request->role_id)
      ->whereNull('roledetail_deleted_at');
        $getData->offset($request->start)
        ->limit($request->length);
        
        if($request->filled("link")){
            $getData->where("roledetail_link","like","%{$request->link}%");
        }
        if($request->filled("segment")){
            $getData->where("roledetail_segment","like","%{$request->segment}%");
        }
        
        $getData->orderBy("roledetail_id", $request->order[0]["dir"]);        
        
        $getData = $getData->get();
        
      $data = [];
      foreach ($getData as $key => $value) {
        $action = [];
        
        $refId = $value->roledetail_id;
        $isDelete = true;
        $isEdit = true;
        $isView = false;
        if($isView){
            $action['view'] = route('roledetail.lihat',['id'=>$refId]);
        }
        if($isEdit){
            $action['edit'] = route('roledetail.editdetail',['id'=>$refId]);
        }
        if ($isDelete) {
            $action ['delete'] = "mydata-url='". route("roledetail.delete",['id'=>$refId]) ."' mydata-isdelete='1' mydata-name='".$value->roledetail_link."' mydata-id='". $refId."'";
        }

        array_push($data, array(
          $value->roledetail_id,
          $value->menu_name,
          $value->roledetail_link,
          $value->roledetail_segment,
          $value->roledetail_view,
          $value->roledetail_access,
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
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data['module_title'] = "$STUDLY_NAME";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => '$STUDLY_NAME','url' => '$LOWER_NAME']
        ];
        return view('roledetail::create');
    }

    public function getselect2 (Request $request){
        if ($request->has('q'))
        {
            $cari = $request->q;
            $tes = DB::table('master_menu')
            ->select('menu_id as id', 'menu_name as text')
            ->where('menu_name', 'LIKE', '%'.$cari.'%')->whereNull('menu_deleted_at')
            ->get();
            // return response()->json($tes);
            return response()->json($tes);
        }
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {   
        $this->validate($request,[
            'role_name' => 'required',
            ]);

        $access = implode(",",$request->isChecked);
        
        $getData = DB::table('master_menu')
        ->where('menu_id','=',$request->menu)
        ->first();

        $getsegment = explode('/',$getData->menu_link);
        $segments = '1-'.count($getsegment);

        $link = $getData->menu_link;
        $segment = $segments;

        $data = [
            'roledetail_role_id' => $request->role_id,
            'roledetail_menu_id' => $request->menu,
            'roledetail_link' => $link,
            'roledetail_segment' => $segment,
            'roledetail_view' => $request->roledetail_view,
            'roledetail_access' => $access,
        ];   

        $save = RoleDetail::create($data);

        if ($save)
        {
            $this->status = true;
            $this->message = "Berhasil Menambah data";
            $this->statusCode = 200;
        }
 
    	return response()->json(['status'=> $this->status, 'message' => $this->message], $this->statusCode);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */

    public function get_single_data($id)
    {
        $data = DB::table('master_role')->where('role_id',$id)->first();
        return response()->json($data, 200);
    }

    public function get_single_data_detail($id)
    {
        $data = DB::table('master_role_detail')
        ->join('master_role', 'role_id', '=', 'roledetail_role_id')
        ->join('master_menu', 'menu_id', '=', 'roledetail_menu_id')
        ->select("master_role_detail.*","menu_name","menu_id","role_name","role_id")
        ->where('roledetail_id','=',$id)
        ->first();

        $data->tes = explode(",",$data->roledetail_access);
        return response()->json($data, 200);
    }

    public function show($id)
    {   
        $data['module_title'] = "Role Detail";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Role Detail','url' => 'role_detail'],
            ['title' => '','url' => 'lihat']
        ];

        // $data['role'] = ['id'=>1,'text'=>'lorem ipsum'];
        $data['role_id'] = $id;
        $data['action_type'] = "edit";
        $data['getdata'] = route('roledetail.single_data', $id);
        $data['action'] = route('roledetail.store', $id);
        return view('roledetail::index',$data);
    }
    
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data['module_title'] = "Role Detail";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Role Detail','url' => 'role_detail'],
            ['title' => '','url' => 'lihat']
        ];

        $getData = DB::table('master_role_detail')
        ->join('master_role', 'role_id', '=', 'roledetail_role_id')
        ->join('master_menu', 'menu_id', '=', 'roledetail_menu_id')
        ->select("master_role_detail.*","menu_name","menu_id","role_name","role_id")
        ->where('roledetail_id','=',$id)
        ->first();


        $data['role_id'] = $getData->role_id;
        $data['action_type'] = "edit";
        $data['role'] = ['id'=>$getData->menu_id,'text'=>$getData->menu_name];
        $data['getdata'] = route('roledetail.single_data_detail', $id);
        $data['action'] = route('roledetail.update', $id);
        return view('roledetail::index',$data);
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
            'role_name' => 'required',
        ]);

        $access = implode(",",$request->tes);
        
        $getData = DB::table('master_menu')
        ->where('menu_id','=',$request->menu)
        ->first();

        $getsegment = explode('/',$getData->menu_link);
        $segments = '1-'.count($getsegment);

        $link = $getData->menu_link;
        $segment = $segments;

        $roleDetail = RoleDetail::find($id);
        $roleDetail->roledetail_role_id = $request->roledetail_role_id;
        $roleDetail->roledetail_menu_id = $request->roledetail_menu_id;
        $roleDetail->roledetail_link = $link;
        $roleDetail->roledetail_segment = $segment;
        $roleDetail->roledetail_view = $request->roledetail_view;
        $roleDetail->roledetail_access = $access;
        $save = $roleDetail->save();

        if ($save)
        {
            $this->status = true;
            $this->message = "Berhasil Merubah data";
            $this->statusCode = 200;
        }

        return response()->json(['status'=> $this->status, 'message' => $this->message], $this->statusCode);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $roledetail = RoleDetail::find($id);
        // $roledetail->delete();

        if ($roledetail->delete())
        {
            $this->status = true;
            $this->message = "Berhasil Merubah data";
            $this->statusCode = 200;
        }

        return response()->json(['status'=> $this->status, 'message' => $this->message], $this->statusCode);
    }
}
