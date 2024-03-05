<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ShopModel extends Model
{
     public static function getData($table, $where="", $type="get", $orderby="", $orwhere ="", $date="", $whereLike=""){
        $sql = DB::table($table);
        if($where !=""){
            $sql->where($where);
        }
        if($orwhere !=""){
            $sql->orWhere($orwhere);
        }
        if($orderby !=""){
            foreach ($orderby as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($whereLike !=""){
            foreach ($whereLike as $key=>$row){
                $sql->where($key, 'LIKE', '%'.$row.'%');
            }
        }
        if($date !=""){
//            $temp_date = explode('to', $date);
//            $sql->whereBetween('date_time', [$temp_date[0], $temp_date[1]]);

            $temp_date = explode(' to ', $date);
            if (count($temp_date) == 1) {
                // If you have a single date, retrieve records for that date
                $sql->whereDate('date_time', '=', $temp_date[0]);
            } else {
                // If you have a date range, retrieve records between the two dates
                $sql->whereBetween('date_time', [$temp_date[0], $temp_date[1]]);
            }
        }
        switch($type){
            case 'first':
                $result = $sql->first();
                break;
            case 'get':
                $result = $sql->get();
                break;
            case 'count':
                $result = $sql->count();
                break;
            case 'paginate':
                $result = $sql->paginate(20);
                break;
        }
        return $result;
    }

    function insert_data($table, $insert){
        $sql = DB::table($table)->insertGetId($insert);
        if($sql!=""){
            return array('code'=> 200, 'msg'=> 'Data Insert Successful.', 'last_id'=> $sql);

        }else{
            return array('code'=> 404, 'msg'=> 'Data Not insert');
        }
    }

    function update_data($table, $where, $data){
        $sql = DB::table($table)->where($where)->update($data);
        if($sql){
            return array('code'=> 200, 'msg'=> 'Data update success.');

        }else{
            return array('code'=> 404, 'msg'=> 'Data Not update');
        }


    }
    //
    function getLastId($table, $col, $where=""){
        $sql = DB::table($table)->select($col);
        if($where !=""){
            $sql->where($where);
        }
        return $sql->orderBy('id', 'Desc')->first();

    }

    public static function getSum($table, $where, $col="", $date=""){
        $balance = DB::table($table)->where($where);
        if($date !=""){
//            $temp_date = explode(' to ', $date);
//            $balance->whereBetween('date_time', [$temp_date[0], $temp_date[1]]);

            $temp_date = explode(' to ', $date);
            if (count($temp_date) == 1) {
                // If you have a single date, retrieve records for that date
                $balance->whereDate('date_time', '=', $temp_date[0]);
            } else {
                // If you have a date range, retrieve records between the two dates
                $balance->whereBetween('date_time', [$temp_date[0], $temp_date[1]]);
            }
        }
        return $balance->count();
    }

    function getDataCount($table, $where=""){
        $sql = DB::table($table);
        if($where!=""){
            $sql->where($where);
        }

        $result = $sql->count();
        return $result;
    }

    function getValidOffers($type, $where=""){
        $sql = DB::table('tbl_offer')->where('end_date', '>', date('Y-m-d', time()));
        if($where!=""){
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

    function getAllProducts($type, $where="", $like="", $limit="", $orderBy=""){
        $sql = DB::table('tbl_product')
            ->select('tbl_product.*', 'tbl_shop_categories.category_title','tbl_brand.brand_title')
            ->leftJoin('tbl_shop_categories', 'tbl_shop_categories.id', '=', 'tbl_product.category_id')
            ->leftJoin('tbl_brand', 'tbl_brand.id', '=', 'tbl_product.brand_id');
        if($where != ""){
            $sql->where($where);
        }
        if($like !=""){
            foreach ($like as $key=>$row){
                if($row !=""){
                    $sql->where($key, 'LIKE', '%'.$row.'%');
                }
            }
        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){
            $result = $sql->first();
        }else if($type == "get"){
            if($limit !=""){
                $sql->limit($limit);
            }
            $result = $sql->get();
        }else if($type == 'paginate'){
            $result = $sql->paginate(20);
        }
        return $result;
    }

    function getSearchData($keywaord){
        $sql = DB::table('tbl_product')
            ->select('product_title', 'product_url', 'product_image')
            ->where('product_title', 'Like', '%'.$keywaord.'%')
            ->where('is_active', '1')
            ->orderBy('id', 'DESC')->get();
        return $sql;
    }

    function searchProduct($keyword, $category){
        $category = "";
        $keyword = explode(' ', $keyword);
        $sql = DB::table('tbl_product')
            ->select('tbl_product.*', 'tbl_shop_categories.category_title', 'tbl_brand.brand_title')
            ->leftJoin('tbl_shop_categories', 'tbl_shop_categories.id', '=', 'tbl_product.category_id')
            ->leftJoin('tbl_brand', 'tbl_brand.id', '=', 'tbl_product.brand_id');
        if($category != ""){
            $sql->where('tbl_product.category_id', $category);
        }
        $sql->where(array('tbl_product.is_active'=>'1'));
        $sql->where(function($query) use ($keyword){
            foreach($keyword as $term){
                $query->where('tbl_product.product_title', 'LIKE', '%'.$term.'%');
            }
        });
        $sql->orderBy('tbl_product.product_title', 'Desc');
        return $sql->paginate(25);
    }

    public static function orders($where="", $type="get", $orderBy="", $wherenot="", $date="",  $orwhere="", $whereLike=""){
        $sql = DB::table('tbl_order')
            ->select('tbl_order.*', 'tbl_client.first_name as first_name', 'tbl_client.last_name as last_name', 'tbl_client.mobile as mobile', 'tbl_client.email as email')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_order.client_id');
        if($where!=""){
            $sql->where($where);
        }
        if($wherenot!=""){
            foreach ($wherenot as $key=>$row){
                $sql->where($key,'!=',$row);
            }
        }
        if($whereLike !=""){

            $sql->where('tbl_client.first_name', 'LIKE', '%'.$whereLike.'%');
            $sql->orWhere('tbl_client.last_name', 'LIKE', '%'.$whereLike.'%');
            $sql->orWhere('tbl_client.email', 'LIKE', '%'.$whereLike.'%');

            //echo '<pre>';print_r($whereLike);exit;
        }

        if($orwhere !=""){
            $sql->orWhere($orwhere);
        }
        if($date !=""){
            //echo $date; exit;
            /*$temp_date = explode(' to ', $date);
            $sql->whereBetween('tbl_order.date_time', [date('Y-m-d', strtotime($temp_date[0])), date('Y-m-d', strtotime($temp_date[1]))]);*/

            $temp_date = explode(' to ', $date);
            if (count($temp_date) == 1) {
                // If you have a single date, retrieve records for that date
                $sql->whereDate('tbl_order.date_time', '=', date('Y-m-d', strtotime($temp_date[0])));
            } else {
                // If you have a date range, retrieve records between the two dates
                $sql->whereBetween('tbl_order.date_time', [date('Y-m-d', strtotime($temp_date[0])), date('Y-m-d', strtotime($temp_date[1]))]);
            }
        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){

            $result = $sql->first();

        }else if($type == "get"){

            $result = $sql->get();
           // echo '<pre>';print_r($result);exit;
        }else if($type == 'paginate'){

            $result = $sql->paginate(20);
//            echo '<pre>';print_r($result);exit;
        }else if($type == "count"){
            $result = $sql->count();
        }
        return $result;

    }

    public static function order_items($where="", $type="", $order="", $wherenot=""){
        $sql = DB::table('tbl_order_item')
            ->select('tbl_order_item.*', 'tbl_product.product_hindi_title','tbl_product.product_title', 'tbl_product.product_url')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_order_item.product_id');
        if($where!=""){
            $sql->where($where);
        }
        if($wherenot!=""){
            foreach ($wherenot as $key=>$row){
                $sql->where($key,'!=',$row);
            }
        }
        if($order !=""){
            foreach ($order as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){
            $result = $sql->first();
        }else if($type == "get"){
            $result = $sql->get();
        }else if($type == 'paginate'){
            $result = $sql->paginate(20);
        }
        return $result;
    }

    public static function recent_order($where ="", $type="get", $orderBy=""){
        $date = date('Y-m-d', time());
        $data = DB::table('tbl_order_item')
                ->select('tbl_order_item.*', 'tbl_order.first_name', 'tbl_order.last_name','tbl_order.mobile','tbl_order.shipping_address','tbl_order.shipping_post_code','tbl_order.shipping_city','tbl_order.payment_status')
                ->join('tbl_order', 'tbl_order_item.order_id', '=', 'tbl_order.order_id')->where('tbl_order_item.status', '!=', 'card')->where('tbl_order_item.date_time', $date);
        if($where !=""){
            $data->where($where);
        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $data->orderBy($key, $row);
            }
        }
        if($type == 'first'){
            $result = $data->first();
        }else if($type == "get"){
            $result = $data->get();
        }else if($type == 'paginate'){
            $result = $data->paginate(20);
        }
        return $result;

    }
    public static function CustomerDetails($where="", $type="get", $orderBy="", $groupBy="n", $date=""){
        $sql = DB::table('tbl_client')
            ->select('tbl_client.*', DB::raw('count(tbl_order.id) as count_orders'))
            ->leftJoin('tbl_order', 'tbl_client.id', '=', 'tbl_order.client_id');
        if($where!=""){
            $sql->where($where);
        }
        if($groupBy =="y"){
            $sql->groupBy('tbl_client.id');
        }
        if($date !=""){
            $temp_date = explode(' to ', $date);
            if (count($temp_date) == 1) {
                // If you have a single date, retrieve records for that date
                $sql->whereDate('tbl_client.date_time', '=', date('Y-m-d', strtotime($temp_date[0])));
            } else {
                // If you have a date range, retrieve records between the two dates
                $sql->whereBetween('tbl_client.date_time', [date('Y-m-d', strtotime($temp_date[0])), date('Y-m-d', strtotime($temp_date[1]))]);
            }
            //echo $date; exit;
//            $temp_date = explode(' to ', $date);
//            $sql->whereBetween('tbl_client.date_time', [date('Y-m-d', strtotime($temp_date[0])), date('Y-m-d', strtotime($temp_date[1]))]);
        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){

            $result = $sql->first();

        }else if($type == "get"){

            $result = $sql->get();

        }else if($type == 'paginate'){

            $result = $sql->paginate(20);
        }else if($type == "count"){
            $result = $sql->count();
        }
        return $result;

    }

}
