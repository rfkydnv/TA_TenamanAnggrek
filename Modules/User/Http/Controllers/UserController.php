<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use BITStudio\BITDataTable\BITDataTable;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    
    public function index()
    {
        $data['module_title'] = "User";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'User','url' => 'User']
        ];

        return view('user::index',$data);
    }

    // public function get(Request $request)
    // {

    //     $dtb = new BITDataTable();
    //     $dtb->setRequest($request);
        
    //     $data = DB::table('master_user');
    //     $data->select([
    //         'user_id',
    //         'user_fullname',
    //         'user_username',
    //         'user_email',
    //     ]);

    //     $dtb->from($data);
    //     $dtb->addCol(function ($row){
    //         $col = "";
    //         if(true) {
    //             $col = " <a target='_blank' href='/' class='btn btn-danger'>Hapus</a>";
    //         }
    //         $row->action = "<a target='_blank' href='#' class='btn btn-primary'>Lihat</a>{$col}";
    //         // $row->action_1 = "<a target='_blank' href='#' class='btn btn-danger'>x</a>";
          
    //         return $row;
    //       });
          
    //       return $dtb->generate();

    // }

    public function get(Request $request)
    {
        $totalData =  DB::table('master_user')->count();
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;

        $getData = DB::table('master_user')
        ->select("*")->whereNull('user_deleted_at');
        $getData->offset($request->start)->limit($request->length);
        
        // filter
        if ($request->filled("nama")) {
            $getData->where("user_fullname", "like", "%{$request->nama}%");
        }
        if ($request->filled("email")) {
            $getData->where("user_email", "like", "%{$request->email}%");
        }
        // filter
        $getData->orderBy("user_id", $request->order[0]["dir"]);  
        $getData = $getData->get();

        // list data
        $data = [];
        foreach ($getData as $key => $value) {
            $action = [];
            $refId = $value->user_id;
            $isDelete = true;
            $isEdit = true;
            
            $action['view'] = route('user.view', ['id' => $refId]);
            if ($isEdit) {
                $action['edit'] = route('user.edit', ['id' => $refId]);
            }
            if ($isDelete) {
                $action['delete'] = "mydata-url='" . route("user.delete", ['id' => $refId]) . "' mydata-isdelete='1' mydata-name='" . $value->user_fullname . "' mydata-id='" . $refId . "'";
            }

            array_push($data, array(
                $value->user_id,
                $value->user_fullname,
                $value->user_email,
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
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'User','url' => 'mahasiswa'],
            ['title' => 'Tambah','url' => 'form']
        ];
        $data['module_title'] = "Form tambah user";
        $data['action'] = route('user.store');
        $data['action_type'] = "add";
        $data['redirect'] = route("user.index");
        return view('user::form',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_fullname' => 'required',
            'user_username' => 'required',
            'user_email' => 'required',
            'user_password' => 'required',
            'user_role_id' => 'required',
            ]);

        $user_is_active ='0';
        if ($request->user_is_active != null) {
            if ($request->user_is_active == 1) {
                $user_is_active='1';
            }
        }  

        $data = [
            'user_fullname' => $request->user_fullname,
            'user_username' => $request->user_username,
            'user_email' => $request->user_email,
            'user_password' => Hash::make($request->user_password),
            'user_is_active' => $user_is_active,
            'user_role_id'  => $request->user_role_id
        ];
        $save = User::create($data);
        if ($save) {
            $this->status = true;
            $this->message = "Berhasil Menambah data user";
            $this->statusCode = 200;
        }

        return response()->json(['status' => $this->status, 'message' => $this->message], $this->statusCode);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data['module_title'] = "Role";
        $data['breadcrumb'] = [
            ['title' => 'Master Data', 'url' => '#'],
            ['title' => 'User', 'url' => 'user.index'],
            ['title' => 'Edit', 'url' => 'edit']
        ];

        $data['action_type'] = "edit";
        $data['getdata'] = route('user.getedit', $id);
        $data['action'] = route('user.update', $id);
        return view('user::form', $data);
    }

    public function getedit($id)
    {
        $data = DB::table('master_user')
        ->join('master_role','master_user.user_role_id','=','master_role.role_id')
        ->where('user_id', $id);
        return response()->json($data->first(), 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        $delete=$user->delete();
        if ($delete) {
            $this->status = true;
            $this->message = "Berhasil Hapus data " . $request->user_username;
            $this->statusCode = 200;
        } else {
            $this->status = true;
            $this->message = "Gagal Hapus data " . $request->user_username;
            $this->statusCode = 200;
        }

        // return redirect('/master/mahasiswa/');
        return response()->json(['status' => $this->status, 'message' => $this->message], $this->statusCode);
    }
}
