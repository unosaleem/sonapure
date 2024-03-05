<?php

namespace App\Http\Controllers;

class APIRes{

    const SUCCESS = 200;
    const MAIL_RESEND = 205;
    const UNAUTHORIZED = 201;
    const FIELD_ERROR = 203;
    const INTERNAL_ERROR = 204;

    public static function res($status_code, $status, $msg, $data=[]){
        return response()->json([
            'status_code'   =>  $status_code,
            'status'    =>  $status,
            'msg'   =>  $msg,
            'data'  =>  $data
        ]);
    }

    public static function validation_res($validator){
        return self::res(self::FIELD_ERROR,'field-error',array_flatten($validator->errors()->toArray())[0],[]);
        // return self::res(self::FIELD_ERROR,'field-error',array_flatten($validator->errors()->toArray())[0],[$validator->errors()]);
    }
    public static function normal_validation_res($msg){
        return self::res(self::FIELD_ERROR,'error',$msg,[]);
        // return self::res(self::FIELD_ERROR,'field-error',array_flatten($validator->errors()->toArray())[0],[$validator->errors()]);
    }
    public static function success_res($msg,$data=[]){
        return self::res(self::SUCCESS,'success',$msg,$data);
    }
    public static function error_res($msg,$data=[]){
        return self::res(self::INTERNAL_ERROR,'error',$msg,$data);
    }
    public static function unauth($msg,$data=[]){
        return self::res(self::UNAUTHORIZED,'unauthorized',$msg,$data);
    }
    public static function mailresend_res($msg,$data=[]){
        return self::res(self::MAIL_RESEND,'mail-resend',$msg,$data);
    }
}