<?php

namespace Modules\Konfig\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\AppGranted;
use App\Helpers\AppResponse;
use App\Konfig;
use DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class KonfigController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        AppGranted::grantedAccess('edit', true);
        $data['module_title'] = "Config";
        $data['breadcrumb'] = [
            ['title' => 'Master Data', 'url' => 'master/konfig'],
            ['title' => "Konfig", 'url' => "master/konfig"]
        ];
        $data['action_type'] = "edit";
        $data['action'] = route('konfig.action_edit');
        $company_data = $this->get_company(["tipe" => ["COMPANY", "APP", "PROFILE"]], "OR");
        return view("konfig::index", $data, compact('company_data'));
    }

    public function getConfig()
    {
        $company_data = $this->get_company(["tipe" => ["COMPANY", "APP", "PROFILE"]], "OR");
        return response()->json($company_data);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get_company($params = [], $tipe_search = null)
    {
        $operator  = "AND";
        $response  = [];
        $tempVal = [];
        $where  = "";
        $kolom = [
            'id'            => "config_id",
            'tipe'          => "config_tipe",
            'code'          => "config_code",
            'value'         => "config_value",
            'finance_tipe'  => "config_finance_tipe",
            'finance_title' => "config_finance_title",
            'tipe_input'    => "config_tipe_input"
        ];

        if (!empty(@$tipe_search)) @$operator = @$tipe_search;

        if (count(@$params) > 0) {
            $where = "WHERE 1=1 ";
            if (is_array(@$params)) {
                foreach ($params as $key => $value) {
                    if (array_key_exists($key, $kolom)) {
                        if (is_array(@$value)) {
                            foreach ($value as $v) {
                                $tempVal[] = $v;
                                $where .= " " . @$operator . " " . @$kolom[$key] . " = '" . strtoupper(@$v) . "'";
                            }
                        } else {
                            $tempVal[] = $value;
                            $where .= " AND " . @$kolom[$key] . " = '" . strtoupper(@$value) . "'";
                        }
                    }
                }
            }
        }
        // $whereExplode = explode(' ', $where);
        $getData = DB::select("select * from master_config " . $where);

        if (count($tempVal) > 0) {
            foreach ($tempVal as $kt) {
                $i = 0;
                foreach ($getData as $kl => $vl) {
                    if ($kt == $vl->config_tipe) {
                        if (!empty($vl->config_finance_title)) {
                            $response[$kt][$i] = $vl;
                        }
                    }
                    $i++;
                }
            }
        }
        return $response;
    }



    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        AppGranted::grantedAccess('add', true);
        $data['module_title'] = Konfig;
        $data['breadcrumb'] = [
            ['title' => 'Master Data', 'url' => '#'],
            ['title' => "Konfig", 'url' => "konfig/create"]
        ];

        return view("konfig::create");
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
        $data['module_title'] = Konfig;
        $data['breadcrumb'] = [
            ['title' => 'Master Data', 'url' => '#'],
            ['title' => "Konfig", 'url' => "konfig"],
            ['title' => '', 'url' => "konfig/show/" . $id]
        ];

        return view("konfig::show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        AppGranted::grantedAccess('edit', true);
        $data['module_title'] = Konfig;
        $data['breadcrumb'] = [
            ['title' => 'Master Data', 'url' => '#'],
            ['title' => "Konfig", 'url' => "konfig"],
            ['title' => '', 'url' => "konfig/edit/" . $id]
        ];
        $data['action_type'] = "edit";
        $data['action'] = route('konfig.action_edit');
        return view("konfig::edit", $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $update = [['column' => 'value'], ['column' => 'value']];
        DB::table('my_table')->whereIn('page_id', [1, 2, 3])->update($update);

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
        AppResponse::set('success', 'Berhasil Menghapus Data'); // ['success','error','failed']
        return response()->json(AppResponse::response(), AppResponse::getCode());
    }


    public function action_edit(Request $request)
    {
        // dd($request->APP);
        $data = null;
        foreach ($request->COMPANY as $key => $value) {
            $updateKonfig = Konfig::find($value["config_id"]);
            if (!is_null($updateKonfig)) {
                $updateKonfig->config_value = $value["config_value"];
                $simpanCompany = $updateKonfig->save();
            }
        }

        if ($simpanCompany) {
            $this->status = true;
            $this->message = "Berhasil Merubah data";
            $this->statusCode = 200;
        }


        foreach ($request->APP as $k => $v) {
            $updateKonfigApp = Konfig::find($v["config_id"]);
            if (!is_null($updateKonfigApp)) {
                $updateKonfigApp->config_value = $v["config_value"];
                $simpanApp = $updateKonfigApp->save();
            }
        }



        // for ($i = 0; $i < count($request->config_id); $i++) {
        //     if (isset($request->config_value[$i])) $data["config_value"] = $request->config_value[$i];
        //     $updateKonfig = Konfig::find($request->config_id[$i]);
        //     $updateKonfig->config_value = $data["config_value"];
        //     $simpan = $updateKonfig->save();
        // }

        if ($simpanApp) {
            $this->status = true;
            $this->message = "Berhasil Merubah data";
            $this->statusCode = 200;
        }
        return response()->json(['status' => $this->status, 'message' => $this->message], $this->statusCode);
    }
}
