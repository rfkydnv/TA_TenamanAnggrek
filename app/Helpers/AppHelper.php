<?php

namespace App\Helpers;

use App\Menu;
use App\Models\TrxOrderHistory;
use AppCoreHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

/**
 * 
 */
class AppHelper
{
    protected static $menuActive = [];
    protected static $currentUrl = [];
    protected static $setSubMenuStatus = false;

	public static function granted($roleId)
	{
		$role = [];
        $role['data'] = [];
        $getRoleDetail = DB::table('role')
            ->join('role_detail','role_id','=','roledetail_role_id')
            ->join('menu','roledetail_menu_id','=','menu_id')
            ->select('role_name','role_desc','roledetail_link','roledetail_segment','roledetail_access','roledetail_view','menu_id','menu_parentid')
            ->where('role_id',$roleId)
            ->get();

        $menuAcess = [];
        if (count($getRoleDetail) > 0) {
            foreach ($getRoleDetail as $key => $value) {
                array_push($role['data'], array(
                    'menu'    => $value->menu_id,
                    'type'    => $value->menu_parentid != "" ? 'child' : 'parent',
                    'link'    => $value->roledetail_link,
                    'segment' => $value->roledetail_segment,
                    'view'    => $value->roledetail_view,
                    'access'  => $value->roledetail_access,
                ));

                if (!is_array($value->roledetail_link)) {
	                $menuAcess[$value->roledetail_link] = [
	                    'view' => $value->roledetail_view,
	                    'access' => $value->roledetail_access
	                ];
	            }
            }

            $role['name'] = $value->role_name;
            $role['desc'] = $value->role_desc;
        }

        $data['role'] = $role;
        
        $roleMenu = AppCoreHelper::app_menu_granted($role);
        $data['menu'] = AppCoreHelper::app_menu_db($roleMenu);
        $data['menu_access'] = $menuAcess;
		return $data;
	}

	private static function app_menu_granted(  $role = null ) {		
		$menu 	= [];		

		foreach ( (array) @$role['data'] as $value) {
			if ( $value['type'] == 'child' ) {
				$_parent 	= AppCoreHelper::app_menu_parent($value['menu']);
				$menu[] 	= $value['menu'];
				foreach ((array) $_parent as $val) {
					$menu[] = $val;
				}
			} else {
				$menu[] = $value['menu'];
			}
		}

		$menu 	= array_unique($menu);
		return $menu;
	}

	private static function app_menu_parent( $id = "" )
	{
		
		$hasil 	= [];
		$sql 	= "
			SELECT  @id :=
                    (
                    SELECT  menu_parentid
                    FROM    menu
                    WHERE   menu_id = @id
                    ) AS id
            FROM    (
                    SELECT  @id := $id
                    ) vars
            STRAIGHT_JOIN
                    menu
            WHERE   @id IS NOT NULL
		";
		$result = DB::select(DB::raw($sql));

		foreach ($result as $rows) {
			if ( $rows->id != "" ) {
				$hasil[] = $rows->id;
			}
		}

		return $hasil;
	}

	private static function app_menu_db( $menu_granted = null )
	{
		
		$menu 	= [];

		$menu_granted = count($menu_granted) == 0 ? [''] : $menu_granted;
		$getData = DB::table('menu')
			->whereNull('menu_parentid')
			->whereNull('menu_deleted_at');

		if (!is_null($menu_granted) AND count($menu_granted) > 0) {
			$getData->whereIn('menu_id',$menu_granted);
		}
		$getData = $getData->get();
		
		$i = 0;
		foreach ($getData as $rows) {
			$menu[$i]['name']       = $rows->menu_name;
			$menu[$i]['icon']       = $rows->menu_icon;
			$menu[$i]['segment']    = $rows->menu_segment;
			$menu[$i]['controller'] = $rows->menu_controller;

			if ( $rows->menu_link == NULL ) {
				$menu[$i]['link'] = AppCoreHelper::app_menu_db_get($rows->menu_id, $menu_granted); 				
			} else {
				$menu[$i]['link'] = $rows->menu_link;
			}

			$i++;
		}

		return $menu;
	}

	public static function app_menu_db_get($parent, $menu_granted = null)
	{
		$menu 	= [];

		$getData = DB::table('menu')
			->where('menu_parentid',$parent)
            ->whereNull('menu_deleted_at');

		if (!is_null($menu_granted) AND count($menu_granted) > 0) {
			$getData->whereIn('menu_id',$menu_granted);
		}
		$getData = $getData->get();

		$i = 0;
		foreach ($getData as $rows) {
			$menu[$i]['name']       = $rows->menu_name;
			$menu[$i]['icon']       = $rows->menu_icon;
			$menu[$i]['segment']    = $rows->menu_segment;
			$menu[$i]['controller'] = $rows->menu_controller;

			if ( $rows->menu_link == NULL ) {
				$menu[$i]['link'] = AppCoreHelper::app_menu_db_get($rows->menu_id); 				
			} else {
				$menu[$i]['link'] = $rows->menu_link;
			}

			$i++;
		}

		return $menu;
	}

	public static function app_submenu($link, $title)
	{
		if (is_array($link)) {
			echo '<div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>';
				echo '<ul class="kt-menu__subnav">';
					echo '<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">'.$title.'</span></span></li>';
					foreach ($link as $rows) {
						$isHaveSubMenu = is_array($rows['link']) ? TRUE : FALSE;
						$link = !is_array($rows['link']) ? $rows['link'] : "javascript:;";
                        $menu_active = AppHelper::menuActive($rows['name']);
                        echo '<li class="kt-menu__item '. ($isHaveSubMenu ? 'kt-menu__item--submenu ' : '').'  ' . $menu_active . ' " aria-haspopup="true" '.($isHaveSubMenu ? 'data-ktmenu-submenu-toggle="hover"' : '').'><a href="'.url($link).'" class="kt-menu__link '.($isHaveSubMenu ? 'kt-menu__toggle' : 'core-pjax').'">';
							echo '<i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>';
							echo '<span class="kt-menu__link-text">'.$rows['name'].'</span>';
							if ($isHaveSubMenu) {
								echo '<i class="kt-menu__ver-arrow la la-angle-right"></i>';
							}
							echo '</a>';
							if ($isHaveSubMenu) {
								AppCoreHelper::app_submenu($rows['link'], $rows['name']);
							}
						echo '</li>';
					}
				echo '</ul>';
			echo '</div>';
		}
	}

	public static function setUrl()
    {
        $segment = []; $url = "";
        $current_url = Request()->getRequestUri();
        $arr_url = explode("/", $current_url);
        $length_url = sizeof($arr_url);

        foreach ($arr_url as $k_url => $v_url){
            if (!empty($v_url)) {
                $url .= "/".$v_url;
                if ($k_url == 1) $url = "/".$v_url;
                $segment["segment_".$k_url] = $url;
            }
        }

        AppHelper::$currentUrl = [
            'url_segment' => $segment,
            'length'      => $length_url
        ];


    }

	public static function setMenuActive()
    {
        AppHelper::setUrl();
        $menu = session("menu");
        $find = false;
        foreach ($menu as $k_menu => $v_menu)
        {            
            if (is_array($v_menu['link']))
            {
                foreach ($v_menu['link'] as $k2_menu => $v2_menu)
                {
                    if (is_array($v2_menu['link']))
                    {
                        AppHelper::$menuActive = [
                            $v_menu['name'] => "kt-menu__item--open kt-menu__item--here", // parent
                            $v2_menu['name'] => "kt-menu__item--open kt-menu__item--here" // sub
                        ];

                        if (!AppHelper::$setSubMenuStatus) AppHelper::setSubMenu($v2_menu);
                        if (AppHelper::$setSubMenuStatus){
                            $find = true;
                            break;
                        }
                    }elseif  (in_array("/".$v2_menu['link'], AppHelper::$currentUrl['url_segment'])){
                        
                        AppHelper::$menuActive = [
                            $v_menu['name'] => "kt-menu__item--open kt-menu__item--here", // parent
                            $v2_menu['name'] => "kt-menu__item--active" // sub
                        ];

                        $find = true;
                        break;
                    }
                }
                if ($find) break;
            }elseif (in_array("/".$v_menu['link'], AppHelper::$currentUrl['url_segment'])){

                AppHelper::$menuActive = [
                    $v_menu['name'] => "kt-menu__item--open kt-menu__item--here"
                ];

                break;
            }
        }


    }

    public static function setSubMenu($sub_menu)
    {
        if (is_array($sub_menu))
        {
            if (is_array(@$sub_menu['link'])){
                AppHelper::setSubMenu($sub_menu['link']);
            }else{
                foreach ($sub_menu as $k_submenu => $v_submenu)
                {
                    if (is_array($v_submenu['link'])){
                        AppHelper::setSubMenu($v_submenu['link']);
                    }else if (in_array("/".$v_submenu['link'], AppHelper::$currentUrl['url_segment'])){
                        AppHelper::$menuActive[$v_submenu['name']] = "kt-menu__item--active";
                        AppHelper::$setSubMenuStatus = true;
                        break;
                    }
                }
            }
        }

    }

    public static function menuActive($menu_name)
    {
        $menu_name = strtoupper($menu_name);
        AppHelper::$menuActive = array_change_key_case(AppHelper::$menuActive, CASE_UPPER);
        if (array_key_exists($menu_name, AppHelper::$menuActive)){
            return AppHelper::$menuActive[$menu_name];
        } 
        return "";
    }

    public static function setprefixTable($data, $prefix = null, $except = null)
    {
        $tempArr = [];
        if (!empty($prefix)){
            foreach ($data as $k_data => $v_data){
               if (in_array($k_data, $except)){
                    $tempArr[$k_data] = $v_data;
                } else {
                    $tempArr[$prefix."_".$k_data] = $v_data;
                }
            }
        }
        if (sizeof($tempArr) > 0) return $tempArr;
        return $data;
    }

    public static function deleted($table, $prefix, $id)
    {
	    $data = DB::table($table);
	    $data->where($prefix.'_id', $id);
	    $data->whereNotNull($prefix.'_deleted_at');
	    $data->where($prefix.'_is_delete', 1);
	    $tmp = $data->first();
	    if (!empty($tmp)) return true;
        return false;
    }

    public static function insertHistory($order_id = null, $kategori, $catatan)
    {
        if (is_array($order_id)) {
            $order_history = [];
            foreach ($order_id as $koid => $void){
                $order_history[] = [
                    'orderhistory_orderid' => $void,
                    'orderhistory_karyawanid' => user_id(),
                    'orderhistory_tgl' => date("Y-m-d H:i:s"),
                    'orderhistory_kategori' => $kategori,
                    'orderhistory_catatan' => $catatan,
                ];
            }

            TrxOrderHistory::insert($order_history);
        }else if (!is_array($order_id) && !empty($order_id)){

            $order_history = [
                'orderhistory_orderid' => $order_id,
                'orderhistory_karyawanid' => user_id(),
                'orderhistory_tgl' => date("Y-m-d H:i:s"),
                'orderhistory_kategori' => $kategori,
                'orderhistory_catatan' => $catatan,
            ];

            TrxOrderHistory::create($order_history);
        }
    }

}