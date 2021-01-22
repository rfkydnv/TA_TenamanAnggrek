<?php
    namespace App\Helpers;

    use Illuminate\Support\Facades\Request;

    class AppGranted
    {
        protected static $btnEdit = false;
        protected static $btnUpdate = false;
        protected static $btnCreate = false;
        protected static $btnAdd = false;
        protected static  $btnDelete = false;
        protected static $btnView = "";
        protected static $access = [];

        public static function setRolePermission()
        {
            $basePath = Request::route()->action['prefix'];
            $uriPrefix = substr($basePath, 1);
            $menu_access = @session("menu_access")[$uriPrefix];
            AppGranted::btnPrivilege($menu_access);
        }

        public static function btnPrivilege($btn)
        {
            $btn_record = explode(",", $btn['access']);
            AppGranted::$btnView = $btn['view'];

            foreach ($btn_record as $key => $value)
            {
                $value = strtolower($value);
                if ($value == "delete") AppGranted::$btnDelete = true;
                if ($value == "edit" || $value == "update") AppGranted::$btnEdit = true;
                if ($value == "update" || $value == "edit") AppGranted::$btnUpdate = true;
                if ($value == "add" || $value == "create") AppGranted::$btnAdd = true;
                if ($value == "create" || $value == "add") AppGranted::$btnCreate = true;
            }

            AppGranted::$access = array(
                'delete'=>AppGranted::$btnDelete,
                'edit'=>AppGranted::$btnEdit,
                'create'=>AppGranted::$btnCreate,
                'view'=>AppGranted::$btnView,
                'update'=>AppGranted::$btnUpdate,
                'add'=>AppGranted::$btnAdd,
            );
        }

        public static function grantedAccess($role_ = "", $deniedPage_ = false)
        {
            AppGranted::setRolePermission();

            if (!empty($role_)){
                if ($deniedPage_ && !AppGranted::$access[$role_]) return AppGranted::deniedpage();
                return AppGranted::$access[$role_];
            }

            return AppGranted::$access;
        }

        public static function deniedpage()
        {
            return abort(401,"maaf, anda tidak diizinkan mengakses halaman ini");
        }
    }