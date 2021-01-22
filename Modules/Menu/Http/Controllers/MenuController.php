<?php

namespace Modules\Menu\Http\Controllers;

use App\Helpers\AppGranted;
use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    protected $message = "Gagal menambah data";
    protected $status = false;
    protected $statusCode = 402;

    public function index($aksi='tambah', $id = null)
    {
        $data['module_title'] = "Menu";
        $data['form_title'] = "Daftar Menu";
        $data['action'] = route('menu.store');
        $data['action_type'] = "add";

        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Menu','url' => 'mahasiswa']
        ];

        $data['redirect'] = route("menu.index");
        if ($aksi=='tambah')
        {
            $data['form_judul'] ='Tambah';
            $data['form_id']    ='';
            $data['form_nama']  ='';
            $data['form_link']  ='';
            $data['form_icon']  ='';
            $data['form_tombol']='Tambah';
        }

        return view('menu::menu', $data);
    }


    public function edit($id)
    {
        AppGranted::grantedAccess("edit",true);

        $data['module_title'] = "Menu";
        $data['form_title'] = "Daftar Menu";
        $data['action'] = route('menu.update', $id);
        $data['action_type'] = "edit";

        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Menu','url' => 'menu']
        ];

        $data['redirect'] = route("menu.index");
        $data['getdata'] = route('menu.get_single_data', $id);

        # mapping select2 value
        $menu = Menu::findOrFail($id);
        if (!empty($menu->menu_parentid))
        {
            $menu_parent = DB::table("master_menu")->where("menu_id", $menu->menu_parentid)->first();
            $data['menu'] = ['id'=> $menu_parent->menu_id, 'text'=> $menu_parent->menu_name];
        }

        return view('menu::menu', $data);
    }

    public function get_single_data($id)
    {
        # fix response
        $data = DB::table('master_menu')->where('menu_id',$id)->first();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'menu_name' => 'required',
            'menu_link' => 'required',
        ]);

        $save = Menu::create($request->all());

        if ($save)
        {
            $this->status = true;
            $this->message = "Berhasil Menambah data";
            $this->statusCode = 200;
        }

        return response()->json(['status'=> $this->status, 'message' => $this->message], $this->statusCode);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function select2(Request $request)
    {
        $cari = $request->q;
        $tes = DB::table('master_menu')
            ->select('menu_id as id', 'menu_name as text')
            ->where('menu_name', 'LIKE', '%'.$cari.'%')->whereNull('menu_deleted_at')->limit(5)
            ->get();
        return response()->json($tes);
    }


    public function selecticon(Request $request)
    {
        $cari = $request->q;
        $tes = font_awesome();
        $new = [];
        foreach ($tes as $k => $v){
            $new[] = ["id"=> 1, "name"=>$v];
        }
        return response()->json(['data'=>$new]);

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $old_data = Menu::findOrFail($id);
        $update = $old_data->update($input);

        if ($update)
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
    public function delete($id)
    {
        $find = Menu::findOrFail($id);
        if ($find->delete())
        {
            $this->status = true;
            $this->message = "Berhasil Menghapus data";
            $this->statusCode = 200;
        }

        return response()->json(['status'=> $this->status, 'message' => $this->message], $this->statusCode);
    }

    public function bulkDelete($id)
    {
        $find = Menu::findOrFail($id);
        if ($find->delete())
        {
            DB::table("master_menu")->where("menu_parentid" ,'=',$find->menu_parentid)->delete();
            $this->status = true;
            $this->message = "Berhasil Menghapus data";
            $this->statusCode = 200;
        }

        return response()->json(['status'=> $this->status, 'message' => $this->message], $this->statusCode);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function getIcon(Request $request)
    {
        $icon = flat();
        $newIcon=[];
        $newIcon1=[];$ambilIndex=0;

        foreach ($icon as $k => $v)
        {
            $newIcon[]=$v;

            $ambilIndex++;
            if ($ambilIndex == 4)
            {
                $newIcon1[] = $newIcon;
                $newIcon = []; $ambilIndex = 0;
            }
        }
        return response()->json(['status'=> $this->status, 'message' => $this->message, 'data' => $newIcon1],200);
    }

}
