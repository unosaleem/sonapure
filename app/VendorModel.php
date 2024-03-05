<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class VendorModel extends Model
{
    public static function getVendors($where="", $type='get', $orderBy=""){
        $sql = DB::table('tbl_vendor')->select('tbl_vendor.*', 'tbl_service.service_title');
        $sql->join('tbl_service', function ($join){
            $join->on('tbl_vendor.service','=', 'tbl_service.id');
            $join->where('tbl_service.is_active','1');
        });
        if($where !=""){
            $sql->where($where);
        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
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
