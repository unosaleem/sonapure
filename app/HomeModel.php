<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class HomeModel extends ShopModel{

    public static function product_details($where="", $type="get", $order_by=""){
        $sql = DB::table('tbl_product')
            ->select('tbl_product.*', 'tbl_product_price.size', 'tbl_product_price.price','tbl_product_price.selling_price');
        $sql->join('tbl_product_price', function($join){
            $join->on('tbl_product_price.product_id', '=', 'tbl_product.id');
        });
        if($where !=""){
            $sql->where($where);
        }
        if($order_by !=""){
            foreach ($order_by as $key=>$row){
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
