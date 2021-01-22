<?php

namespace Modules\Role\Http\Controllers;

use App\Helpers\AppGranted;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['module_title'] = "Role";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Role','url' => 'role']
        ];

        return view('role::index', $data);
    }

    public function getselect2(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $tes = DB::table('master_role')
                ->select('role_id as id', 'role_name as text')
                ->where('role_name', 'LIKE', '%' . $cari . '%')->whereNull('role_deleted_at')
                ->get();
            return response()->json($tes);
        }
    }

    public function get_data(Request $request)
    {
      $totalData =  DB::table('master_role')->count();
      $iDisplayLength = intval($_REQUEST['length']);
      $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;
        
      $getData = DB::table('master_role')
      ->select("*")
      ->whereNull('role_deleted_at');
        $getData->offset($request->start)
        ->limit($request->length);
        
        if($request->filled("nama")){
            $getData->where("role_name","like","%{$request->nama}%");
        }
        if($request->filled("deskripsi")){
            $getData->where("role_desc","like","%{$request->deskripsi}%");
        }
        
        $getData->orderBy("role_id", $request->order[0]["dir"]);        
        
        $getData = $getData->get();
        
      $data = [];
      $isDelete = AppGranted::grantedAccess("delete");
      $isEdit = AppGranted::grantedAccess("edit");

      foreach ($getData as $key => $value) {
        $action = [];
        $refId = $value->role_id;
        $action['view'] = route('role.lihat',['id'=>$refId]);

        if($isEdit){
            $action['edit'] = route('role.edit',['id'=>$refId]);
        }

        if ($isDelete) {
            $action ['delete'] = "mydata-url='". route("role.delete",['id'=>$refId]) ."' mydata-isdelete='1' mydata-name='".$value->role_name."' mydata-id='". $refId."'";
        }

        array_push($data, array(
          $value->role_id,
          $value->role_name,
          $value->role_desc,
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
        $data['module_title'] = "Role";
        $data['action'] = route('role.store');
        $data['action_type'] = "add";

        $data['breadcrumb'] = [ 
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Role','url' => 'role'],
            ['title' => 'form','url' => 'form']
        ];

        $data['redirect'] = route("role.index");
        
        return view('role::form',$data);
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
       
        $save = Role::create($request->all());
        

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
    public function show($id)
    {
        return view('roledetail::index');
    }

    
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function get_single_data($id)
    {
        $data = DB::table('master_role')->where('role_id',$id)->first();
        return response()->json($data, 200);
    }
    
    public function edit($id)
    {
        $data['module_title'] = "Role";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Role','url' => 'role'],
            ['title' => 'edit','url' => 'edit']
        ];

        $data['action_type'] = "edit";
        $data['getdata'] = route('role.single_data', $id);
        $data['action'] = route('role.update', $id);

        return view('role::form',$data);
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

        $role = Role::find($id);
        $role->role_name = $request->role_name;
        $save = $role->save();

        if ($save)
        {
            $this->status = true;
            $this->message = "Berhasil Merubah data";
            $this->statusCode = 200;
        }

        return response()->json(['status'=> $this->status, 'message' => $this->message], $this->statusCode);
    }

    public function lihat($id)
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

    public function editDetail($id){
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
        $data['role'] = ['id'=>$getData->menu_id,'text'=>$getData->menu_name];
        $data['action_type'] = "edit";
        $data['getdata'] = route('roledetail.single_data_detail', $id);
        $data['action'] = route('roledetail.update', $id);
        return view('roledetail::index',$data);
    }
    
    public function lihatDetail($id){
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
        $role = Role::find($id);
        $role->delete();
        return redirect('/master/role/');
    }
}
