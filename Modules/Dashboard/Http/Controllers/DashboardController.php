<?php

namespace Modules\Dashboard\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\AppGranted;
use App\Helpers\AppResponse;
use App\Models\Artikel;
use App\Models\Karyawan;
use App\Models\Produk;
use App\Models\TrxOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
// use App\Models\Model;

class DashboardController extends Controller
{
  protected $except = [];

  protected $moduleParent = "Master Data";
  protected $moduleTitle = "Dashboard";
  protected $moduleUrl = "dashboard";

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index()
  {
    $data['module_title'] = $this->moduleTitle;
    $data['breadcrumb'] = [
      ['title' => $this->moduleParent, 'url' => '#'],
      ['title' => $this->moduleTitle, 'url' => $this->moduleUrl]
    ];

    $data['dateAwal'] = date("d-m-Y");
    $data['dateAkhir'] = date("d-m-Y");

    return view("dashboard::dashboard_index", $data);
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
      ['title' => $this->moduleParent, 'url' => '#'],
      ['title' => $this->moduleTitle, 'url' => $this->moduleUrl . "/create"]
    ];

    $data['action'] = route('dashboard.store');
    $data['action_type'] = "add";
    $data['redirect'] = route("dashboard.index");
    return view("dashboard::create", $data);
  }

  public function getartikel(Request $request)
  {
    $getDataSales =
      DB::table("artikel")
      ->whereNull("artikel_deleted_at");

      $getDataAnggrek =
      DB::table("anggrek")
      ->whereNull("anggrek_deleted_at");

    $totalData['totalDataSales'] = $getDataSales->count();
    $totalData['totalDataAnggrek'] = $getDataAnggrek->count();

    return response()->json($totalData);
  }

  public function get_sales(Request $request)
  {
    $getDataSales =
      Karyawan::where('karyawan_jabatan_id', 6)
      ->leftjoin('master_jabatan', 'master_karyawan.karyawan_jabatan_id', '=', 'master_jabatan.jabatan_id');
    $totalDataSales = $getDataSales->count();
    return response()->json($totalDataSales);
  }

  public function getorder(Request $request)
  {
    $getDataSales =
      DB::table("trx_order")
      ->leftjoin('master_karyawan', 'trx_order.order_sales_id', '=', 'master_karyawan.karyawan_id')
      ->where("master_karyawan.karyawan_jabatan_id", "=", 6);
    if (empty($request->all())) {
      $getDataSales
        ->where("trx_order.order_tanggal", ">=", date("Y-m-d"))
        ->where("trx_order.order_tanggal", "<=", date("Y-m-d"));
    } else {
      $getDataSales
        ->where("trx_order.order_tanggal", ">=", date("Y-m-d", strtotime($request->tglawal)))
        ->where("trx_order.order_tanggal", "<=", date("Y-m-d", strtotime($request->tglakhir)));
    }

    $getOrderTotalStatus = DB::table("trx_order")
      ->where("order_is_delete", '=', '0');
    if (empty($request->all())) {
      $getOrderTotalStatus
        ->where("trx_order.order_tanggal", ">=", date("Y-m-d"))
        ->where("trx_order.order_tanggal", "<=", date("Y-m-d"));
    } else {
      $getOrderTotalStatus
        ->where("trx_order.order_tanggal", ">=", date("Y-m-d", strtotime($request->tglawal)))
        ->where("trx_order.order_tanggal", "<=", date("Y-m-d", strtotime($request->tglakhir)));
    }

    $status = [
      "ORDER",
      "PROSES",
      "MUAT",
      "TERKIRIM",
      "SELESAI",
      "DITUNDA",
    ];
    $getOrderStatus = null;
    $i = 0;
    foreach ($status as $key) {
      if ($i == 0) {
        $getOrderStatus = DB::table("trx_order")
          ->select(DB::raw('"' . $key . '" AS order_status'), DB::raw("count(*) as order_qty"), "order_tanggal")
          ->where("order_status", $key)
          ->where("order_is_delete", '=', '0');
        if (empty($request->all())) {
          $getOrderStatus
            ->where("trx_order.order_tanggal", ">=", date("Y-m-d"))
            ->where("trx_order.order_tanggal", "<=", date("Y-m-d"));
        } else {
          $getOrderStatus
            ->where("trx_order.order_tanggal", ">=", date("Y-m-d", strtotime($request->tglawal)))
            ->where("trx_order.order_tanggal", "<=", date("Y-m-d", strtotime($request->tglakhir)));
        }
        // dd($getOrderStatus->toSql());
      } else {
        $tmp = DB::table("trx_order")
          ->select(DB::raw('"' . $key . '" AS order_status'), DB::raw("count(*) as order_qty"), "order_tanggal")
          ->where("order_status", $key)
          ->where("order_is_delete", '=', '0');
        if (empty($request->all())) {
          $tmp
            ->where("trx_order.order_tanggal", ">=", date("Y-m-d"))
            ->where("trx_order.order_tanggal", "<=", date("Y-m-d"));
        } else {
          $tmp
            ->where("trx_order.order_tanggal", ">=", date("Y-m-d", strtotime($request->tglawal)))
            ->where("trx_order.order_tanggal", "<=", date("Y-m-d", strtotime($request->tglakhir)));
        }

        $getOrderStatus->union($tmp);
      }

      $i++;
    }


    $select = ["produk_id", "produk_nama", DB::raw("ifnull(SUM( orderdetail_qty ), 0)  AS qty")];

    $getProdukAll =
      DB::table("master_produk")
      ->select($select)
      ->leftjoin("trx_order_detail", "trx_order_detail.orderdetail_produk_id", "=", "master_produk.produk_id")
      ->leftjoin("trx_order", "trx_order.order_id", "=", "trx_order_detail.orderdetail_order_id");


    if (empty($request->all())) {
      $getProdukAll
        ->where("trx_order.order_tanggal", ">=", date("Y-m-d"))
        ->where("trx_order.order_tanggal", "<=", date("Y-m-d"))
        ->orWhere("trx_order.order_tanggal");
    } else {
      $getProdukAll
        ->where("trx_order.order_tanggal", ">=", date("Y-m-d", strtotime($request->tglawal)))
        ->where("trx_order.order_tanggal", "<=", date("Y-m-d", strtotime($request->tglakhir)))
        ->orWhere("trx_order.order_tanggal");
    }
    $getProdukAll->groupBy("master_produk.produk_id");

    $totalData['totalDataSales'] = $getDataSales->count();
    $totalData['totalDataOrderStatus'] = $getOrderStatus->get();
    $totalData['totalDataTotalOrderStatus'] = $getOrderTotalStatus->count();
    $totalData['totalDataProdukAll'] = $getProdukAll->get();

    return response()->json($totalData);
  }

  public function get(Request $request)
  {
    if (!$request->ajax()) {
      dd("why you haven't sleep yet");
    }

    $table = 'table';
    $column = 'column';

    $query = DB::table($table)->whereNull($column . "_deleted_at");

    $totalData =  $query->count();

    $iDisplayLength = intval($_REQUEST['length']);
    $iDisplayLength = $iDisplayLength < 0 ? $totalData : $iDisplayLength;

    $getData = $query;

    $getData = $getData->offset($request->start)
      ->limit($request->length);

    $filter = [
      "like" => [
        $column . "_1",
      ],
      "=" => [
        $column . "_2",
      ]
    ];

    foreach ($filter as $key => $value) {
      foreach ($value as $item) {
        if ($request->filled($item)) {
          if ($key == "like") {
            $getData = $getData->where($item, "like", "%{$request->$item}%");
          } else if ($key == "=") {
            $getData = $getData->where($item, "=", "{$request->$item}");
          }
        }
      }
    }

    // dd($request->all());

    $getData = $getData->orderBy($column . "_id", $request->order[0]["dir"]);

    $getData = $getData->get();

    $data = [];

    $isDelete = AppGranted::grantedAccess("delete");
    $isEdit = AppGranted::grantedAccess("edit");

    $start = (int) $request->start;
    $length = $request->length;

    foreach ($getData as $key => $value) {
      $action = [];
      $refId = @$value->{$column . "_id"};

      $action['view'] = route('dashboard.show', ['id' => $refId]);

      if ($isEdit) {
        $action['edit'] = route('dashboard.edit', ['id' => $refId]);
      }

      if ($isDelete) {
        $action['delete'] = "mydata-url='" . route("dashboard.delete", ['id' => $refId]) . "' mydata-isdelete='1' mydata-name='" . @$value->{$column . "_nama"} . "' mydata-id='" . $refId . "'";
      }

      array_push($data, array(
        ($key + ($start + 1)),
        $action
      ));
    }

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

    $this->validate($request, [
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

    AppResponse::set('success', 'Berhasil Menambah data'); // ['success','error','failed']
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
      ['title' => $this->moduleParent, 'url' => '#'],
      ['title' => $this->moduleTitle, 'url' => "dashboard"],
      ['title' => '', 'url' => $this->moduleUrl . "/show/" . $id]
    ];

    $data['action_type'] = "lihat";
    $data['getdata'] = route('dashboard.single_data', $id);
    $data['action'] = route('dashboard.show', $id);

    return view("dashboard::show", $data);
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
      ['title' => $this->moduleParent, 'url' => '#'],
      ['title' => $this->moduleTitle, 'url' => "dashboard"],
      ['title' => '', 'url' => $this->moduleUrl . "/edit/" . $id]
    ];

    $data['action_type'] = "edit";
    $data['getdata'] = route('dashboard.single_data', $id);
    $data['action'] = route('dashboard.update', $id);

    return view("dashboard::edit", $data);
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
    $this->validate($request, [
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

    AppResponse::set('success', 'Berhasil Mengubah Data'); // ['success','error','failed']
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

    AppResponse::set('success', 'Berhasil Menghapus Data'); // ['success','error','failed']
    return response()->json(AppResponse::response(), AppResponse::getCode());
  }
}
