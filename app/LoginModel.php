<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class LoginModel extends FunctionModel
{
    public static function loginAuth($where="", $type="get"){
        //echo '<pre>'; print_r($where); exit;
        $sql = DB::table('tbl_login')->select('tbl_login.id','tbl_login.user_name','tbl_login.email','tbl_login.role_id','tbl_login.contact_number', 'tbl_role.title as role_title', 'tbl_role.permission')
               ->join('tbl_role', function($join){
                   $join->on('tbl_role.id', '=', 'tbl_login.role_id');
                   $join->where('tbl_role.is_active', '=', '1');
               });
        if($where !=""){
            $sql->where($where);
        }
        switch($type){
            case 'first':
                $result = $sql->first();
                break;
            case 'get':
                $result = $sql->get();
                break;
            case 'paginate':
                $result = $sql->paginate(20);
                break;
        }
        return $result;
    }
}
