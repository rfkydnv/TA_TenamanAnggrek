<?php

namespace Modules\Mahasiswa\Http\Controllers;

use App\Helpers\AppGranted;
use App\Helpers\AppResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Yajra\Datatables\Datatables;
use BITStudio\BITDataTable\BITDataTable;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    protected $message = "Gagal menambah data";
    protected $status = false;
    protected $statusCode = 402;

    public function index()
    {
        $data['module_title'] = "Mahasiswa";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Mahasiswa','url' => 'mahasiswa']
        ];

        $combo = [
            'L'=>[
                'label'=>'Laki - laki', 
                'desc'=>'manusia yg punya otong'
            ],
            'P'=>[
                'label'=>'Perempuan', 
                'desc'=>'manusia yg punya apam'
            ],
        ];
        $data['select2'] = json_encode($combo);
        return view('mahasiswa::index2', $data);
    }

    public function get(Request $request)
    {
        $dtb = new BITDataTable();
        $dtb->setRequest($request);
        $data = DB::table('master_mahasiswa')
        ->select("*",
        DB::raw("date_format(mahasiswa_created_at,'%d-%m-%Y') as tanggal_buat")
        )
        ->whereNull('mahasiswa_deleted_at');
        // dd($data->toSql());
        // $data->select([
        //     'mahasiswa_id',
        //     'mahasiswa_nama',
        //     'mahasiswa_jenis_kelamin',
        //     'mahasiswa_created_at',
        // ]);
        
        if($request->filled("nama")){
            $data->where("mahasiswa_nama","like","%{$request->nama}%");
        }

        if($request->filled("tanggal")){
            $reqtanggal = $request->tanggal;
            $exploadtanggal = explode(" - ",$reqtanggal);
            $tgl_awal = date('Y-m-d', strtotime($exploadtanggal[0]));
            $tgl_akhir = date('Y-m-d', strtotime($exploadtanggal[1]));

           $data->where(function($query) use ($tgl_awal,$tgl_akhir){
                $query->whereRaw("date_format( mahasiswa_created_at, '%Y-%m-%d' ) >= '{$tgl_awal}'");
                $query->whereRaw("date_format( mahasiswa_created_at, '%Y-%m-%d' ) <= '{$tgl_akhir}'");
           });
        }
        
        $dtb->from($data);
        $dtb->addCol(function ($row){
            $id = $row->mahasiswa_id;
            $col = "";
            if(true) {
                $col = " <a class='btn btn-danger la la-trash' id='hapus' onClick=tes(".$id.") style=color:white;></a>";
            }
            $row->action = "<a class='btn btn-success la la-desktop' href='master/mahasiswa/lihat/".$id."'></a> <a class='btn btn-primary la la-pencil-square' href='master/mahasiswa/edit/".$id."'></a>{$col} ";
          
            return $row;
          });
          
          return $dtb->generate();

    }

    public function get_data(Request $request)
    {
      $totalData =  DB::table('master_mahasiswa')->count();
      $iDisplayLength = intval($_REQUEST['length']);
      $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;
        
      $getData = DB::table('master_mahasiswa')
      ->select("*",
      DB::raw("date_format(mahasiswa_created_at,'%d-%m-%Y') as tanggal_buat")
      )
      ->whereNull('mahasiswa_deleted_at');
        $getData->offset($request->start)
        ->limit($request->length);
        
        if($request->filled("nama")){
            $getData->where("mahasiswa_nama","like","%{$request->nama}%");
        }
        if($request->filled("id")){
            $getData->where("mahasiswa_id","like","%{$request->id}%");
        }
        if($request->filled("jk")){
            $getData->where("mahasiswa_jenis_kelamin","like","%{$request->jk}%");
        }
        if($request->filled("tanggal")){
            $tanggal = date('Y-m-d', strtotime($request->tanggal));
            $getData->whereRaw("date_format( mahasiswa_created_at, '%Y-%m-%d') = '{$tanggal}'");
        }
        if($request->filled("awal") && $request->filled("akhir")){  
            $tgl_awal = date('Y-m-d', strtotime($request->awal));
            $tgl_akhir = date('Y-m-d', strtotime($request->akhir));

           $getData->where(function($query) use ($tgl_awal,$tgl_akhir){
                $query->whereRaw("date_format( mahasiswa_created_at, '%Y-%m-%d' ) >= '{$tgl_awal}'");
                $query->whereRaw("date_format( mahasiswa_created_at, '%Y-%m-%d' ) <= '{$tgl_akhir}'");
           });
        }
        $getData->orderBy("mahasiswa_id", $request->order[0]["dir"]);        
        
        $getData = $getData->get();

        $data = [];
        $isDelete = AppGranted::grantedAccess('delete');
        $isEdit = AppGranted::grantedAccess('edit');

      foreach ($getData as $key => $value) {
        $action = [];
        
        $refId = $value->mahasiswa_id;
        $action['view'] = route('mahasiswa.lihat',['id'=>$refId]);

        if($isEdit){
            $action['edit'] = route('mahasiswa.lihat',['id'=>$refId]);
        }
        if ($isDelete) {
            $action ['delete'] = "mydata-url='". route("mahasiswa.delete",['id'=>$refId]) ."' mydata-isdelete='1' mydata-name='".$value->mahasiswa_nama."' mydata-id='". $refId."'";
        }
        
        array_push($data, array(
          $value->mahasiswa_id,
          $value->mahasiswa_nama,
          $value->mahasiswa_jenis_kelamin,
          $value->tanggal_buat,
          $value->tanggal_buat,
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
    public function getselect2 (Request $request){
        // if ($request->has('q')) { 
            $cari = $request->q;
            $tes = DB::table('master_mahasiswa')
            ->select('mahasiswa_id as id', 'mahasiswa_nama as text')
            ->where('mahasiswa_nama', 'LIKE', '%'.$cari.'%')->whereNull('mahasiswa_deleted_at')->limit(5)
            ->get();
            return response()->json($tes);
        // }
    }

    public function create()
    { 
        $data['module_title'] = "Mahasiswa";
        $data['action'] = route('mahasiswa.store');
        $data['action_type'] = "add";

        $data['breadcrumb'] = [ 

            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Mahasiswa','url' => 'mahasiswa'],
            ['title' => 'form','url' => 'form']
        ];

        $data['redirect'] = route("mahasiswa.index");
        
        return view('mahasiswa::mahasiswa_form',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $response = [];
        $this->validate($request,[
            'mahasiswa_nama' => 'required',
            'mahasiswa_jenis_kelamin' => 'required',
        ]);
        
        $data = [
            'mahasiswa_nama' => $request->mahasiswa_nama,
            'mahasiswa_jenis_kelamin' => $request->mahasiswa_jenis_kelamin
        ];

        $save = Mahasiswa::create($data);

        # other case, misal aku ndak maok ngesave kalau ad data yg salah, contoh kalau gaz yg di inputkan sudah di deposit orang lain.


        if ($save)
        {
           AppResponse::set('success','Berhasil Menambah data');
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
        return view('mahasiswa::lihat');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function get_single_data($id)
    {
        $data['module_title'] = "Mahasiswa";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Mahasiswa','url' => 'mahasiswa'],
            ['title' => 'edit','url' => 'edit']
        ];

        $data['mahasiswa'] = DB::table('master_mahasiswa')->where('mahasiswa_id',$id)->get();
        // dd($data['mahasiswa']);
        return view('mahasiswa::mahasiswa_form',$data);
    }

    public function fileUpload(Request $request)
    {
        $input = [];

        dd($request->all());
        if ($request->has('file')) {
            $file = $request->file('file');
            dd($file);
            $path = 'uploads/gudang/';
            $exe = $file->getClientOriginalExtension();

            /* upload to direktori*/
            Image::make($file)->save(public_path($path . '-gudang_foto.' . $exe) , 70);

            /*set value untuk nyimpan ke database*/
            $input['gudang_foto'] = '-gudang_foto.' . $exe;
            AppResponse::set('success','Berhasil Upload Data');
        }

        return response()->json(AppResponse::response($input), AppResponse::getCode());
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->mahasiswa_nama = $request->mahasiswa_nama;
        $mahasiswa->save();
        return redirect('master/mahasiswa/');
    }

    public function lihat($id)
    {
        $data['module_title'] = "Mahasiswa";
        $data['breadcrumb'] = [
            ['title' => 'Master Data','url' => '#'],
            ['title' => 'Mahasiswa','url' => 'mahasiswa'],
            ['title' => 'lihat','url' => 'lihat']
        ];

        $data['action_type'] = "edit";
        $data['getdata'] = route('mahasiswa.single_data', $id);
        $data['action'] = route('mahasiswa.update', $id);

        return view('mahasiswa::mahasiswa_form',$data);
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
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->mahasiswa_is_delete = $request->isdelete;
        $delete = $mahasiswa->save();
        if ($delete) {
            $this->status = true;
            $this->message = "Berhasil Hapus data ".$request->name;
            $this->statusCode = 200;
        }else{
            $this->status = false;
            $this->message = "Gagal Hapus data ".$request->name;
            $this->statusCode = 402;
        }

        // return redirect('/master/mahasiswa/');
        return response()->json(['status' => $this->status, 'message' => $this->message], $this->statusCode);
    }
    public function form()
    {
        $data['module_title'] = "Mahasiswa";
        $data['breadcrumb'] = [
            ['title' => 'Master Data', 'url' => '#'],
            ['title' => 'Mahasiswa', 'url' => 'mahasiswa'],
            ['title' => 'form', 'url' => 'form']
        ];
        $data['redirect'] = route("mahasiswa.index");
        $data['action'] = 'oke';

        return view('mahasiswa::form', $data);
    }

    public function testValidate()
    {
        $data['module_title'] = "Test Validate";
        $data['breadcrumb'] = [
            ['title' => 'Master Data', 'url' => '#'],
            ['title' => 'Mahasiswa', 'url' => 'mahasiswa'],
            ['title' => 'form', 'url' => 'form']
        ];

        $data['redirect'] = route("mahasiswa.index");
        $data['action'] = 'oke';

        return view('mahasiswa::test_validate_form', $data);
    }
}
