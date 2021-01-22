<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use AppCoreHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $roleDetail = DB::table('role_detail')
            ->where('roledetail_role_id', Auth::user()->user_role_id)
            ->get();
            
        // dd(AppCoreHelper::granted(Auth::User()->user_role_id));

        $data['module_title'] = "Dashboard";
        $data['breadcrumb'] = [
            ['title' => 'Dashboard','url' => ''],
        ];
        return view('home',$data);
    }
}
