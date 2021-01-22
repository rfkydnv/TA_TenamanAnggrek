<?php
    namespace App\Helpers;

    class AppResponse
    {
        protected static $status = false;
        protected static $messages = "";
        protected static $messagesBulk = [];
        protected static $statusMessage = "error";
        protected static $statusCode = 400;
        protected static $data = [];
        protected static $response = [];
        protected static $bypass = ['warning','error'];

        public static function getCode(){
            if (sizeof(AppResponse::$response) == 0) AppResponse::setResponse();
            return AppResponse::$statusCode;
        }

        public static function response($compactData = null, $fieldFile = null)
        {
            AppResponse::$data = $compactData;
            if (!empty($compactData)) {
                AppResponse::setNameField($compactData, $fieldFile);
                AppResponse::$response['record'] = AppResponse::$data;
            }
            if (sizeof(AppResponse::$response) == 0) AppResponse::setResponse();
            return AppResponse::$response;
        }

        public static function setNameField($compactData, $field)
        {
            foreach ($compactData as $name_field => $val_field){
                if ($name_field == $field) AppResponse::$data->file = $val_field;
            }
        }

        public static function setResponse()
        {
            AppResponse::setStatusCode();
            if (AppResponse::$statusMessage == "warning")
            {
                $result = [];
                foreach (AppResponse::$messagesBulk as $k_mb => $v_mb) $result[]= [$v_mb];
                AppResponse::$response = [
                    "errors"    => (object) $result,
                    "message"   => "The given data was invalid.",
                    "code"      => AppResponse::$statusCode
                ];
            }else{
                AppResponse::$response = [
                    "status"    => AppResponse::$status,
                    "message"   => AppResponse::$messages,
                    "code"      => AppResponse::$statusCode,
                ];
            }
        }

        public static function setStatusCode()
        {
            switch (AppResponse::$statusMessage){
                case "error":
                    AppResponse::$statusCode = 400;
                    AppResponse::$messages = !empty(AppResponse::$messages) ? AppResponse::$messages : "error";
                    AppResponse::$status = false;
                    break;
                case "success":
                    AppResponse::$statusCode = 200;
                    AppResponse::$messages = !empty(AppResponse::$messages) ? AppResponse::$messages : "success";
                    AppResponse::$status = true;
                    break;
                case "failed":
                    AppResponse::$statusCode = 404;
                    AppResponse::$messages =  !empty(AppResponse::$messages) ? AppResponse::$messages : "failed";
                    AppResponse::$status = false;
                    break;
                case "warning":
                    AppResponse::$statusCode = 422;
                    AppResponse::$messagesBulk = !empty(AppResponse::$messagesBulk) ? AppResponse::$messagesBulk : "warning";
                    AppResponse::$status = false;
                    break;
                default:
                    AppResponse::$statusCode = 408;
                    AppResponse::$messages = !empty(AppResponse::$messages) ? AppResponse::$messages : "no internet connection";
                    AppResponse::$status = false;
                    break;
            }

        }

        public static function set($status = "", $message = null, $get = "")
        {
            AppResponse::$statusMessage = $status;
            if (is_array($message)) AppResponse::$messagesBulk = $message;
            if (!is_array($message)) AppResponse::$messages = $message;
            AppResponse::setResponse();

            if (!empty($get)) return AppResponse::setReturn($get);
            if (in_array(strtolower(AppResponse::$statusMessage), AppResponse::$bypass))
            {
                return response()->json(AppResponse::response(), AppResponse::getCode());
            }
            return [
                'data'      => AppResponse::$response,
                'code'      => AppResponse::$statusCode
            ];
        }

        public static function setReturn($get)
        {
            if ($get == "data") return AppResponse::$response;
            if ($get == "code") return AppResponse::$statusCode;
        }


    }