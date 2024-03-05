<?php

namespace App\Http\Controllers\API;

use App\CartModel;
use App\FunctionModel;
use App\HomeModel;
use App\Http\Controllers\APIRes;
use App\Http\Controllers\Controller;
use App\PayStatusCheckLogModel;
use App\ShopModel;
use Illuminate\Http\Request;
use App\WishlistModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;

class OrderController extends Controller{

    public function viewWishlist(Request $request){
        $user_id = $request->user()->id;

        $prod_id = WishlistModel::where('user_id',$user_id)->pluck('prod_id')->toArray();

        $prod = DB::table('tbl_product')
                    ->where('tbl_product.is_active','1')
                    ->whereIn('tbl_product.id',$prod_id)
                    ->get()->toArray();

        $product = [];
        foreach($prod as $k => $row){
            if(is_object($row)) {
                $row = (array) $row;
            }
            unset($row['product_properties']);
            unset($row['interesting_facts']);
            unset($row['storage_instructions']);
            unset($row['health_benefits']);

            $row['price'] = FunctionModel::getData('tbl_product_price', array('is_active'=> '1', 'product_id'=> $row['id']), 'first', array('id'=>'desc'));

            $wl = WishlistModel::where('prod_id',$row['id'])->where('user_id',$user_id)->exists();
            $row['wishlist'] = ($wl)?1:0;

            array_push($product,$row);
        }

        return APIRes::success_res("",$product);

    }

    public function makeOrder(Request $request){

        $post = $request->all();
        $validator = Validator::make($post, [
            'address_id' => ['required','integer']
        ]);

        if ($validator->fails()) {
            return APIRes::validation_res($validator);
        }

        $user = $request->user();

        $cartController = new CartController();
        $cart = $cartController->getCartData($user->id)['details'];
        if(count($cart) > 0){
            $order_id = $this->generate_order($cart, $post['address_id'],$user);
        }else{
            return APIRes::normal_validation_res("Cart Value are Empty");
        }

        $order = (array) ShopModel::getData('tbl_order', array('payment_status'=> 'Not Connect', 'order_id' => $order_id), 'first');

        $order['details'] = ShopModel::getData('tbl_order_item', array('order_id'=> $order_id, 'status'=>'card'), 'get')->toArray();

        return APIRes::success_res("Successfully Order Generated",[compact('order','user')]);

    }

    public function generate_order($shopping, $customer_address_id,$user){

        DB::beginTransaction();
        $model = new ShopModel();

        $chk_order = DB::table('tbl_order')->where('client_id',$user->id)
                        ->orderBy('id','desc')->first();

        if(isset($chk_order->payment_status) && $chk_order->payment_status == 'Not Connect'){
            $chk_order = (array) $chk_order;

            $orderId = $chk_order['order_id'];

        }else{
            $chk_order = [];

            $Oid = $model->getLastId('tbl_order', 'id' );
            if($Oid == ""){
                $tempId = 0;
            }else{
                $tempId = $Oid->id;
            }
            $orderId = 'SOP'.date('Y', time()).($tempId+1);
        }
        $total = 0;
        $total_tax = 0;

        //echo $shopping->options->type; exit;
        $ins_upd_in_item = [];
        foreach ($shopping as $key => $row) {
            //echo $row->options->size; exit;
            $order = array();
            if($row['prod_type'] == 1){
                $products = $model->getData('tbl_product', array('id' => $row['product_id']), 'first');
            }elseif($row['prod_type'] == 2){
                $products = $model->getData('tbl_healthbox', array('id' => $row['product_id']), 'first');
            }

            $amount = $row['price'];
            $total = $total + $amount;
            $tax = ($amount * 18) / 118;
            $total_tax = round($total_tax + $tax,2);
            $order['order_id'] = $orderId;
            $order['product_id'] = $row['product_id'];
            $order['sku_number'] = $products->sku_number;
            $order['product_name'] = $row['name'];

            $order['qty'] = $row['qty'];
            $order['size'] = ($row['prod_type'] == 1)?$row['size']:"";
            $order['price'] = $row['prod_price'];
            $order['total_price'] = $row['price'];
            $order['product_image'] = $products->product_image;
            $order['tax_rate'] = 18;
            $order['tax_amount'] = $tax;
            $order['is_active'] = '0';
            $order['date_time'] = date('Y-m-d', time());
            $order['type'] = $row['prod_type'];

            if(isset($chk_order['order_id'])){
                $item_chk = DB::table('tbl_order_item')->where('product_id',$row['product_id'])
                ->where('type',$row['prod_type'])
                ->where('size',$row['size'])
                ->where('is_active','0')
                ->where('order_id',$chk_order['order_id'])
                ->first();
            }else{
                $item_chk = (object) [];
            }

            if(isset($item_chk->id)){
                array_push($ins_upd_in_item,$item_chk->id);

                DB::table('tbl_order_item')->where('id',$item_chk->id)
                        ->update($order);
            }else{
                $ord_id = DB::table('tbl_order_item')->insertGetId($order);

                array_push($ins_upd_in_item,$ord_id);
            }
        }
        // delete if cart updated
        DB::table('tbl_order_item')->whereNotIn('id',$ins_upd_in_item)
                            ->where('order_id',$orderId)
                            ->delete();
        // end
        $client_address = FunctionModel::getData('tbl_client_address', array('is_active'=>'1', 'id'=>$customer_address_id), 'first', array('id'=>'desc'));

        $data = array(
            'order_id'      => $orderId,
            'delivery_fee'  => 0,
            'gst'           => $total_tax,
            'sub_total'     => $total-$total_tax,
            'total_amount'  => $total+0,
            'client_id'     => $user->id,
            'first_name'    => $user->first_name,
            'last_name'     => $user->last_name,
            'email'         => $user->email,
            'mobile'        => $user->mobile,
            'status'        => 'card',
            'payment_status'=> 'Not Connect',
            'is_active'     => '1',
            'date_time'     => date('Y-m-d', time()),
        );

        $data['shipping_post_code'] = $client_address->zip;
        $data['shipping_locality']  = $client_address->locality;
        $data['shipping_city']      = $client_address->city;
        $data['shipping_state']     = $client_address->state;
        $data['shipping_address']   = $client_address->address;
        $data['shipping_country']   = $client_address->country;

        if(isset($chk_order['order_id'])){
            DB::table('tbl_order')->where("id",$chk_order['id'])
                ->update($data);
        }else{
            DB::table('tbl_order')->insert($data);
        }
        DB::commit();
        return $orderId;

    }

    public function final_payment(Request $request){

        $user = $request->user();

        $post = $request->all();
        $validator = Validator::make($post, [
            'payment_method' => ['required','in:online,cod'],
            'razorpay_order_id' =>  ['required_if:payment_method,online'],
            'razorpay_payment_id' =>  ['required_if:payment_method,online'],
            'order_id'  =>  ['required'],
            'total_amount'  =>  ['required'],
            'coupon_amount' =>  [],
            'coupon_code'   =>  []
        ]);

        if ($validator->fails()) {
            return APIRes::validation_res($validator);
        }

        // now Cart value should be blank
            CartModel::where('user_id',$user->id)->delete();
        // end

        $chk_order = DB::table('tbl_order')->where('order_id',$post['order_id'])
                        ->where('client_id',$user->id)
                        ->first();
        if(!isset($chk_order->id)){
            return APIRes::normal_validation_res("Invalid Order Number");
        }
        if($chk_order->payment_status == "Done" ){
            return APIRes::success_res("Success",[$chk_order]);
        }
        if($chk_order->payment_status == "COD" ){
            return APIRes::success_res("Success",[$chk_order]);
        }
        // makeing a log
        $log_id = DB::table('final_pay_response_log')->insertGetId([
            'user_id'   =>  $user->id,
            'json_data' =>  json_encode($post,1)
        ]);
        // end

        $data = array();
        if($post['payment_method'] == "online"){

            $chk_rp_id = DB::table('tbl_order')->where('razorpay_payment_id',$post['razorpay_payment_id'])
                            ->where('order_id','!=',$post['order_id'])
                            ->select('id')
                            ->first();
            // return (array) $chk_rp_id;
            if(isset($chk_rp_id->id)){
                return APIRes::normal_validation_res("Invalid Razorpay Payment Id");
            }

            if(@$post['razorpay_order_id'] == "" || @$post['razorpay_payment_id'] ==""){

                return APIRes::normal_validation_res("Payment transaction on pending please try again later");

            }else{
                $data['razorpay_order_id'] = $post['razorpay_order_id'];
                $data['razorpay_payment_id'] = $post['razorpay_payment_id'];

                $rp_status = $this->verify_payment($data['razorpay_payment_id']);

                if(isset($rp_status['pay_status'])){
                    $data['payment_status'] = $rp_status['pay_status'];
                }else{
                    $data['payment_status'] = "Pending";
                }
            }
        }elseif($post['payment_method'] == "cod"){
            $data['payment_status'] = "COD";
        }else{
            return APIRes::normal_validation_res("Getting error try again later");
        }

        if(@$post['coupon_amount'] != ""){
            $data['coupon_amount']= $post['coupon_amount'];
            $data['coupon_code']= $post['coupon_code'];
        }
        $data['invoice_id'] = "SOP".time();
        $data['total_amount'] = $post['total_amount'];
        $data['payment_method'] = $post['payment_method'];
        $data['status'] = 'new';

        DB::beginTransaction();
        $update = DB::table('tbl_order')
                    ->where('order_id',$post['order_id'])
                    ->update($data);

        $update_item = DB::table('tbl_order_item')
                        ->where('order_id',$post['order_id'])
                        ->update([
                            'is_active' =>  '1',
                            'status'    =>  'new'
                        ]);

        DB::commit();

        // update log flag
        DB::table('final_pay_response_log')->where('id',$log_id)
        ->update([
            'mflag' =>  1
        ]);
        //

        $order = (array) ShopModel::getData('tbl_order', array('order_id' => $post['order_id']), 'first');

        // $order['details'] = ShopModel::getData('tbl_order_item', array('order_id'=> $post['order_id']), 'get')->toArray();
        return APIRes::success_res("Success",[$order]);
    }

    public function verify_payment($rp_id)
    {
        // return [config('app.RAZORPAY_KEY'),config('app.RAZORPAY_SECRET')];
        $api = new Api(config('app.RAZORPAY_KEY'),config('app.RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($rp_id);

        $res = $payment->toArray();
        PayStatusCheckLogModel::insert([
            'rp_id' =>  $rp_id,
            'json_data' =>  json_encode($res,1)
        ]);

        // return json_encode($payment->toArray());
        try {
            $response = $api->payment->fetch($rp_id)->capture(array('amount'=>$res['amount']));
            $res['pay_status'] = 'Done';
            return $res;
        } catch (Exception $e) {

            $status = $res['status'];
            switch ($status) {
                case 'authorized':
                    # code...
                    $res['pay_status'] = 'InProcess';
                    break;
                case 'captured':
                    # code...
                    $res['pay_status'] = 'Done';
                    break;
                case 'refunded':
                    # code...
                    $res['pay_status'] = 'Refunded';
                    break;
                case 'failed':
                    # code...
                    $res['pay_status'] = 'Failed';
                    break;
                default:
                    # code...
                    $res['pay_status'] = 'Pending';
                    break;
            }

            return $res;
        }
    }

    public function ReCheck_payment(Request $request){
        return 'testing';
        return $this->verify_payment($request->input('razorpay_payment_id'));

        $user = $request->user();

        $post = $request->all();
        $validator = Validator::make($post, [
            'razorpay_payment_id' =>  ['required']
        ]);

        if ($validator->fails()) {
            return APIRes::validation_res($validator);
        }

        $chk_order = DB::table('tbl_order')->where('order_id',$post['order_id'])
                        ->where('client_id',$user->id)
                        ->first();
        if(!isset($chk_order->id)){
            return APIRes::normal_validation_res("Invalid Order Number");
        }
        if($chk_order->payment_status == "Done" ){
            return APIRes::success_res("Success",[$chk_order]);
        }
        if($chk_order->payment_status == "COD" ){
            return APIRes::success_res("Success",[$chk_order]);
        }

        $rp_status = $this->verify_payment($post['razorpay_payment_id']);

        if(isset($rp_status['pay_status'])){
            $data['payment_status'] = $rp_status['pay_status'];
        }else{
            $data['payment_status'] = "Pending";
        }


        DB::beginTransaction();
        $update = DB::table('tbl_order')
                    ->where('order_id',$post['order_id'])
                    ->update($data);

        $update_item = DB::table('tbl_order_item')
                        ->where('order_id',$post['order_id'])
                        ->update([
                            'is_active' =>  '1',
                            'status'    =>  'new'
                        ]);

        DB::commit();

        $order = (array) ShopModel::getData('tbl_order', array('order_id' => $post['order_id']), 'first');

        // $order['details'] = ShopModel::getData('tbl_order_item', array('order_id'=> $post['order_id']), 'get')->toArray();
        return APIRes::success_res("Success",[$order]);
    }

}
