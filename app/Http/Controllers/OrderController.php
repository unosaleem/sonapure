<?php
namespace App\Http\Controllers;
use App\HomeModel;
use App\FunctionModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\ShopModel;
use Cart;
use Image;
use Mail;
use Session;

class OrderController extends ShiprocketController{

    public function sendSms($mobile, $message, $templateid){
        //---------------------------------
        $username="sonapure";
        $password="19Bvc@Du0pW8b";
        $sender="SOPURE";
        //---------------------------------
        $mobile=$mobile;
        $message=$message;
        $templateid=$templateid;
        $username=urlencode($username);
        $password=urlencode($password);
        $sender=urlencode($sender);
        $message=urlencode($message);
        $templateid=urlencode($templateid);
        $parameters="username=".$username."&password=".$password."&mobile=".$mobile."&sendername=".$sender."&message=".$message."&templateid=".$templateid;
        $url="http://sms.margsoft.org/sms_api/sendsms.php?";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
        $return_val = curl_exec($ch);
        if($return_val=="")
            return array('code' => 319, 'msg'=> 'please check msg');
        else
            return array('code' => 200, 'msg'=> 'msg send');
    }

    public static function cURLget($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
        //echo $curl_scraped_page;
        return $curl_scraped_page;
    }

    public function new_orders(){
        $url = url()->current();
        if(Session::has('admin')){
            $model = new ShopModel();
            $data['title'] = "Sona PureOrders";
            $data['nav']   = "new-orders";
            if(isset($_GET['submit'])){
                $data['filter'] = array(
                    'date_validate' => trim($_GET['date_validate']),
                    'date_range'    => $_GET['date_range'],
                    'customer'      => $_GET['customer'],
                    'paid_status'   => $_GET['paid_status'],
                    'submit'        => $_GET['submit'],
                );
                $where = array('tbl_order.is_active'=> '1','tbl_order.status'=> 'new');
                if($_GET['customer'] !=""){
                    $where['tbl_client.mobile'] = $data['filter']['customer'];
                }
                if($_GET['paid_status'] !=""){
                    $where['tbl_order.payment_method'] = $data['filter']['paid_status'];
                }

                if($_GET['submit'] == "view"){
                    $data['data'] = ShopModel::orders($where, 'paginate', array('tbl_order.id'=> 'desc'), '', ($data['filter']['date_validate'] == "y" ? $data['filter']['date_range'] : ""));
                    return view('admin.orders.new-orders', $data);
                }
            }else{
                $data['data'] = $model->orders(array('tbl_order.is_active'=>'1', 'tbl_order.status'=> 'new'), 'paginate');
                return view('admin.orders.new-orders', $data);
            }

        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function all_orders(){
        $url = url()->current();
        if(Session::has('admin')){
            $model = new ShopModel();
            $data['title'] = "Sona Pure All Orders";
            $data['nav']   = "all-orders";
            if(isset($_GET['submit'])){
                $data['filter'] = array(
                    'date_validate' => trim($_GET['date_validate']),
                    'date_range'    => $_GET['date_range'],
                    'customer'      => $_GET['customer'],
                    'paid_status'   => $_GET['paid_status'],
                    'order_status'  => $_GET['order_status'],
                    'submit'        => $_GET['submit'],
                );

                $where = array('tbl_order.is_active'=> '1');
                if($_GET['customer'] !=""){
                    $where['tbl_client.mobile'] = $data['filter']['customer'];
                }
                if($_GET['paid_status'] !=""){
                    $where['tbl_order.payment_method'] = $data['filter']['paid_status'];
                }
                if($_GET['order_status'] !=""){
                    $where['tbl_order.status'] = $data['filter']['order_status'];
                }
                if($_GET['submit'] == "view"){
                    $data['data'] = ShopModel::orders($where, 'paginate', array('tbl_order.id'=> 'desc'), array('tbl_order.status'=>'card', 'tbl_order.status'=>'aborted'), ($data['filter']['date_validate'] == "y" ? $data['filter']['date_range'] : ""));
                   // echo '<pre>';print_r($data);exit;
                    return view('admin.orders.all-orders', $data);
                }
            }else{
                $data['data'] = $model->orders(array('tbl_order.is_active'=>'1'), 'paginate', array('tbl_order.id'=>'DESC'), array('tbl_order.status'=>'card','tbl_order.status'=>'aborted'));
                return view('admin.orders.all-orders', $data);
            }

        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function process_orders(){
        $url = url()->current();
        if(Session::has('admin')){
            $model = new ShopModel();
            $data['title'] = "Sona Pure Orders";
            $data['nav']   = "process-orders";
            $data['data'] = $model->orders(array('tbl_order.is_active'=>'1', 'tbl_order.status'=> 'process'), 'paginate');
            return view('admin.orders.process-orders', $data);
        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function order_shipment($order_id){
        $url = url()->current();
        if(Session::has('admin')){
            $model = new ShopModel();
            $data['title'] = "Orders Deliver";
            $data['nav']   = "process-orders";
            $data['order'] = $model->orders(array('tbl_order.is_active'=>'1','tbl_order.order_id'=>base64_decode($order_id), 'tbl_order.status'=> 'process'), 'first');
            $data['order_item'] = $model->getData('tbl_order_item', array('is_active'=>'1','order_id'=>base64_decode($order_id)), 'get');
            return view('admin.orders.order-shipment', $data);
        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function shipment_orders(){
        $url = url()->current();
        if(Session::has('admin')){
            $model = new ShopModel();
            $data['title'] = "Shipment Orders";
            $data['nav']   = "shipment-orders";
            $data['data'] = $model->orders(array('tbl_order.is_active'=>'1', 'tbl_order.status'=> 'shipments'), 'paginate');

            return view('admin.orders.shipment-orders', $data);
        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function shipping_orders(){
        $url = url()->current();
        if(Session::has('admin')){
            $model = new ShopModel();
            $data['title'] = "Shiprocket Orders";
            $data['nav']   = "shipping-orders";
            $data['data'] = json_decode($this->shiprocketOrders(array('short'=> 'DESC')), true);
            //echo '<pre>'; print_r($data); exit;

            return view('admin.orders.shipping-orders', $data);
        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function customers(){
        $url = url()->current();
        if(Session::has('admin')){
            $model = new ShopModel();
            $data['title'] = "Sona PureOrders";
            $data['nav']   = "customers";
            $data['data'] = $model->getData('tbl_client', '', 'paginate');
            return view('orders.customers', $data);
        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function post_order_shipment(Request $request){
        if(Session::has('admin')){
            $model = new ShopModel();
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;

            $sql= $this->genearteOrderToCourier($post);
            if($sql['code'] == 200){
                $data = array(
                    'shipment_order_id' => $sql['data']['order_id'],
                    'shipment_id'       => $sql['data']['shipment_id'],
                    'shipment_status'   => $sql['data']['status'],
                    'shipment_status_code'=> $sql['data']['status_code'],
                    'onboarding_completed_now'=> $sql['data']['onboarding_completed_now'],
                    'awb_code'            => $sql['data']['awb_code'],
                    'status'        => ($sql['data']['status'] == "CANCELED" ? "cancel" : "shipments"),
                );
                $sqlOrder = $model->update_data('tbl_order', array('order_id'=> $post['order_id']), $data);
                if($sqlOrder['code'] == 200){
                    $model->update_data('tbl_order_item', array('order_id'=> $post['order_id']), array('status'=> ($sql['data']['status'] == "CANCELED" ? "cancel" : "shipments")));
                    $user = $model->getData('tbl_order', array('order_id' => $post['order_id']), 'first');
                    $profile = $model->getData('tbl_client', array('id' => $user->client_id), 'first');
                    $msg = "Your order with SONA Pure Essentials has been safely packed & shipped. Track shipping " .$post['order_id']. " --- SPE";
                    $tempId = 1607100000000229940;
                    //echo $msg; exit;
                    $this->sendSms($profile->mobile, $msg, $tempId);
                    Session::flash('success', 'Your order is submitted to shipment');
                    return redirect('admin/order/shipment-orders');
                }else{
                    Session::flash('warning', $sql['msg']);
                    return redirect($_SERVER['HTTP_REFERER']);
                }
            }else{
                Session::flash('warning', $sql['msg']);
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            return redirect('/dash?url='.$_SERVER['HTTP_REFERER']);
        }

    }

    /*public function shipment_order_details($order_id){
        $url = url()->current();
        if(Session::has('admin')){
            $model          = new ShopModel();
            $order_id       = base64_decode($order_id);
            $data['title']  = "Shipment Orders Details";
            $data['nav']    = "shipment-orders";
            $data['order']  = $model->orders(array('tbl_order.is_active'=>'1', 'tbl_order.order_id'=> $order_id), 'first');
            $data['order_item'] = $model->getData('tbl_order_item', array('is_active'=>'1','order_id'=>$order_id), 'get');
            $data['data']   = json_decode($this->getSlipdata($order_id), true);
           //echo '<pre>'; print_r($data); exit;
            return view('orders.shipment-order-details', $data);
        }else{
            return redirect('/dash?url='.$url);
        }
    }*/

    public function cancel_shipment_order(Request $request){
        $post = $request->all();
        $model = new ShopModel();
        $order_id = base64_decode($post['order_id']);
        $sql_query = json_encode($this->cancel_order($order_id), true);
        $model->update_data('tbl_order', array('order_id'=>$order_id), array('status'=> 'cancel', 'is_active'=>'2'));
        $model->update_data('tbl_order_item', array('order_id'=>$order_id), array('status'=> 'cancel', 'is_active'=>'2'));
        return jsone_encode(array('code'=>200, 'msg'=> 'Order canceled successful..'));
    }

    public function shipping_order_track($awbNo){
        $url = url()->current();
        if(Session::has('admin')){
            //$awbNo          = base64_decode($awbNo);
            $data['title']  = "Shipment Orders Details";
            $data['nav']    = "shipment-orders";

            $data['data']   = json_decode($this->trackOrder($awbNo), true);
           //echo '<pre>'; print_r($data); exit;
            return view('admin.orders.shipping-order-track', $data);
        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function shipping_order_detail($shipping_id){
        $url = url()->current();
        if(Session::has('admin')){
            //$awbNo          = base64_decode($awbNo);
            $data['title']  = "Shipment Orders Details";
            $data['nav']    = "shipment-orders";

            $data['data']   = json_decode($this->shiprocketOrderDetails($shipping_id), true);
           //echo '<pre>'; print_r($data['data']); exit;
           if ($data['data']['status_code'] != '404'){
               return view('admin.orders.shipping-order-detail', $data);
           }else{
               echo 'Data not found url expiry';
           }


        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function order_details_ajax(Request $request){
        $url = url()->previous();
        if(Session::has('admin')){
            $post = $request->all();
            $data = FunctionModel::getData('tbl_order_item', $post['where'], 'get');
            $div = '';
            if(count($data)!=0){
                foreach ($data as $key=>$row){
                    $div .='<tr>
                                <td>'.($key+1).'</td>
                                <td><img src="'.asset($row->product_image).'" style="height: 50px"></td>
                                <td>
                                    <p>'.$row->product_name.'</p>
                                    <p>'.$row->size.'</p>

                                </td>
                                <td>'.$row->qty.'</td>
                                <td>'.$row->price.'</td>
                                <td>
                                    '.$row->total_price.'
                                </td>
                            </tr>';
                }
                return json_encode(array('code'=> 200, 'div'=> $div));

            }else{
                return json_encode(array('code'=> 400, 'div'=> $div));
            }
            //echo '<pre>'; print_r($data);
        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function convert_number($number){

        if (($number < 0) || ($number > 999999999)) {
            throw new Exception("Number is out of range");
        }
        $giga = floor($number / 1000000);
        // Millions (giga)
        $number -= $giga * 1000000;
        $kilo = floor($number / 1000);
        // Thousands (kilo)
        $number -= $kilo * 1000;
        $hecto = floor($number / 100);
        // Hundreds (hecto)
        $number -= $hecto * 100;
        $deca = floor($number / 10);
        // Tens (deca)
        $n = $number % 10;
        // Ones
        $result = "";
        if ($giga)
        {
            $result .= $this->convert_number($giga) .  "Million";
        }
        if ($kilo)
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($kilo) . " Thousand";
        }
        if ($hecto)
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($hecto) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($deca || $n) {
            if (!empty($result))
            {
                $result .= " and ";
            }
            if ($deca < 2)
            {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n)
                {
                    $result .= "-" . $ones[$n];
                }
            }
        }
        if (empty($result))
        {
            $result = "zero";
        }
        return $result;
    }

    public function order_invoice($order_id){
        $url = url()->current();
        if(Session::has('admin')){
            $model = new HomeModel();
            $data['order'] = $model->orders(array('tbl_order.id'=>base64_decode($order_id)), 'first');
            $data['profile'] = $model->getData('tbl_client', array('id' => $data['order']->client_id), 'first');
            $data['order_item'] = $model->getData('tbl_order_item', array('order_id' => $data['order']->order_id), 'get');
            $data['word'] = $this->convert_number($data['order']->total_amount);
            //echo '<pre>'; print_r($data); exit;
            return view('admin.invoice.order_invoice', $data);
        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function order_convert_process(Request $request){
        $url = url()->current();
        if(Session::has('admin')) {
            $model = new ShopModel();
            $post = $request->all();
            $check_order = FunctionModel::update_data('tbl_order', $post['where'], $post['input']);
            if($check_order['code'] == 200){
                FunctionModel::update_data('tbl_order_item', $post['where'], $post['input']);
                return json_encode(array('code'=> 200, 'msg'=> 'order status updated.'));
            }else{
                return json_encode(array('code'=> 209, 'msg'=> 'order status not update try again later.'));
            }
            //echo '<pre>'; print_r($post);
        }else{
            return redirect('/dash?url='.$url);
        }
    }





    /************* Shiplite Function ******************************************/

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



    public function getSlipdata ($order_id) {
        $timestamp = time();
        $appID = 5442;
        $key = 'EhpboEifcc8=';
        $secret = 'p+z3U1a8AgQuI1IYNWGevgc7z0c19Jz45wZ5uLfXou3zb3lJ7iyKoyKG7djIwcBfiKvFJsMzdHBcjHnOwho95A==';

        $sign = "key:". $key ."id:". $appID. ":timestamp:". $timestamp;
        $dashtoken = rawurlencode(base64_encode(hash_hmac('sha256', $sign, $secret, true)));
        $ch = curl_init();

        $header = array(
            "x-appid: $appID",
            "x-timestamp: $timestamp",
            "x-sellerid:49203",
            "x-version:3", // for dash version 3.0 only
            "dashorization: $dashtoken"
        );

        curl_setopt($ch, CURLOPT_URL, 'https://api.shyplite.com/getSlip?orderID='.urlencode($order_id));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        return $server_output;
    }

    public function cancel_order($order_id) {
        $timestamp = time();
        $appID = 5442;
        $key = 'EhpboEifcc8=';
        $secret = 'p+z3U1a8AgQuI1IYNWGevgc7z0c19Jz45wZ5uLfXou3zb3lJ7iyKoyKG7djIwcBfiKvFJsMzdHBcjHnOwho95A==';

        $sign = "key:". $key ."id:". $appID. ":timestamp:". $timestamp;
        $dashtoken = rawurlencode(base64_encode(hash_hmac('sha256', $sign, $secret, true)));
        $ch = curl_init();

        $data = array(
            "orders"=> [$order_id]
        );

        $data_json = json_encode($data);

        $header = array(
            "x-appid: $appID",
            "x-sellerid:49203",
            "x-timestamp: $timestamp",
            "x-version:3", // for dash version 3.0 only
            "dashorization: $dashtoken",
            "Content-Type: application/json",
            "Content-Length: ".strlen($data_json)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.shyplite.com/ordercancel');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        return $response;

    }

    public function track($awbNo) {
        $timestamp = time();
        $appID = 5442;
        $key = 'EhpboEifcc8=';
        $secret = 'p+z3U1a8AgQuI1IYNWGevgc7z0c19Jz45wZ5uLfXou3zb3lJ7iyKoyKG7djIwcBfiKvFJsMzdHBcjHnOwho95A==';

        $sign = "key:". $key ."id:". $appID. ":timestamp:". $timestamp;
        $dashtoken = rawurlencode(base64_encode(hash_hmac('sha256', $sign, $secret, true)));
        $ch = curl_init();

        $header = array(
            "x-appid: $appID",
            "x-timestamp: $timestamp",
            "x-sellerid:49203",
            "x-version:3", // for dash version 3.0 only
            "dashorization: $dashtoken"
        );

        curl_setopt($ch, CURLOPT_URL, 'https://api.shyplite.com/track/'.$awbNo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        return $server_output;
    }



}
