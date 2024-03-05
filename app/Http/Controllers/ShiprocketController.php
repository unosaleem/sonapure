<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeModel;
use App\FunctionModel;
use App\ShopModel;
use Session;

class ShiprocketController extends Controller
{
    public $address_id="";
    // Shiprocket auth
    public function loginAuth(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "email": "support@sonapureessentials.com",
                "password": "Include!23"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    // Shiprocket Courier List With Counts
    public function courierList(){
        $auth = $this->loginAuth();
        $auth = json_decode($auth, true);
        //echo '<pre>'; print_r($auth); exit;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/courierListWithCounts',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$auth['token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo '<pre>'; print_r($response); exit;
    }

    // Shiprocket Generate Order
    public function genearteOrderToCourier($data){
        $auth = $this->loginAuth();
        $auth = json_decode($auth, true);
        //echo '<pre>'; print_r($auth); exit;
        $order = FunctionModel::getData('tbl_order', array('order_id'=> $data['order_id'], 'status'=>'process'), 'first');
        $order_items = FunctionModel::getData('tbl_order_item', array('order_id'=> $data['order_id'], 'status'=>'process'), 'get');
        $data_order = array(
            "order_id"          => $order->order_id,
            "order_date"        => date('Y-m-d', strtotime($order->date_time)),
            "pickup_location"   => "Margsoft Office",
            "channel_id"        => "",
            "comment"           => "",
            "billing_customer_name" => $order->first_name,
            "billing_last_name" => $order->last_name,
            "billing_address"   => $order->shipping_locality,
            "billing_address_2" => $order->shipping_address,
            "billing_city"      => $order->shipping_city,
            "billing_pincode"   => $order->shipping_post_code,
            "billing_state"     => $order->shipping_state,
            "billing_country"   => $order->shipping_country,
            "billing_email"     => $order->email,
            "billing_phone"     => $order->mobile,
            "shipping_is_billing"=> true,
            "shipping_customer_name"=> $order->first_name,
            "shipping_last_name" => $order->last_name,
            "shipping_address" => $order->shipping_locality,
            "shipping_address_2" => $order->shipping_address,
            "shipping_city" => $order->shipping_city,
            "shipping_pincode" => $order->shipping_post_code,
            "shipping_country" => $order->shipping_country,
            "shipping_state" => $order->shipping_state,
            "shipping_email" => $order->email,
            "shipping_phone" => $order->mobile,
            "payment_method" => ($order->payment_status == "COD" ? "COD" : "Prepaid" ),
            "shipping_charges"=> 0,
            "giftwrap_charges"=> 0,
            "transaction_charges"=> 0,
            "total_discount"=> 0,
            "sub_total"=> $order->total_amount,
            "length" => $data['length'],
            "breadth"=> $data['breadth'],
            "height"=> $data['height'],
            "weight"=> $data['weight']
        );
        if(count($order_items) !=0){
            foreach ($order_items as $key=>$skuList){
                $data_order['order_items'][$key] = array(
                    "name" => $skuList->product_name,
                    "sku" => $skuList->sku_number,
                    "units" => $skuList->qty,
                    "selling_price" => $skuList->price,
                    "discount" => "",
                    "tax" => "",
                    "hsn" => "",
                );
            }
        }
        $data_json = json_encode($data_order);
        //echo '<pre>'; print_r($data_json); exit;
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$auth['token']
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $response  = curl_exec($ch);
        $result = json_decode($response, true);
        //echo '<pre>'; print_r($result); exit;
        if(isset($result['order_id']) && $result['order_id'] !=""){
            return array('code'=> 200, 'msg'=> 'success order generated', 'data'=> $result);
        }else{
            return array('code'=> 400, 'msg'=> $result['message']);
        }

    }

    // Shiprocket Orders
    public function shiprocketOrders($post){
        $auth = $this->loginAuth();
        $auth = json_decode($auth, true);
        $curl = curl_init();
        $url = 'https://apiv2.shiprocket.in/v1/external/orders';
        $data = http_build_query($post);
        $getUrl = $url."?".$data;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $getUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$auth['token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    // Shiprocket Track Order
    public function trackOrder($shipping_id){
        $auth = $this->loginAuth();
        $auth = json_decode($auth, true);
        $curl = curl_init();
        $url = 'https://apiv2.shiprocket.in/v1/external/courier/track/awb';
        $getUrl = $url."/".$shipping_id;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $getUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$auth['token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function shiprocketOrderInvoice($shipping_id){
        $auth = $this->loginAuth();
        $auth = json_decode($auth, true);
        $curl = curl_init();
        //$url = 'https://apiv2.shiprocket.in/v1/external/orders/print/invoice';
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/print/invoice',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "ids": ['.$shipping_id.']
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$auth['token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function shiprocketOrderDetails($shipping_id){
        $auth = $this->loginAuth();
        $auth = json_decode($auth, true);
        $curl = curl_init();
        $url = 'https://apiv2.shiprocket.in/v1/external/orders/show/';
        $getUrl = $url.'/'.$shipping_id;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $getUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$auth['token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }


}
