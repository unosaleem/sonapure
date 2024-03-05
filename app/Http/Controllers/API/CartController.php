<?php

namespace App\Http\Controllers\API;

use App\CartModel;
use App\FunctionModel;
use App\HomeModel;
use App\Http\Controllers\APIRes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\ShopModel;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller{


    public function addToCart(Request $request){
        $post = $request->all();

        $validator = Validator::make($post, [
            'prod_type' => ['required','in:1,2'],
            'product_id' => ['required','integer'],
            'qty' => ['required','integer'],
            'psize_id' => ['required','integer']
        ]);

        if ($validator->fails()) {
            return APIRes::validation_res($validator);
        }
        if($post['prod_type'] == 1 && $post['psize_id'] <= 0 ){
            return APIRes::normal_validation_res("Invalid Product Size !!");
        }
        $ins_arr = [
            'user_id'   =>  $request->user()->id,
            'product_id'    =>  $post['product_id'],
            'qty'   =>  $post['qty'],
            'psize_id'  =>  $post['psize_id'],
            'prod_type'  =>  isset($post['prod_type'])?$post['prod_type']:1
        ];
        $where = [
            'user_id'   =>  $ins_arr['user_id'],
            'product_id'    =>  $post['product_id'],
            'psize_id'  =>  $post['psize_id'],
            'prod_type' =>  $ins_arr['prod_type']
        ];

        if($ins_arr['qty'] == 0){
            CartModel::where($where)->delete();
        }else{
            $ins = CartModel::updateOrCreate($where,$ins_arr);
        }

        return APIRes::success_res("Success");

    }

    public function viewCart(Request $request){

        $user = $request->user();

        $data = $this->getCartData($user->id);

        return APIRes::success_res("Cart Data",[$data]);
    }
    public function getCartData($user_id){
        $cart = CartModel::where('user_id',$user_id)
                ->select(
                    'user_id','product_id','qty','psize_id','prod_type'
                )
                ->get()->toArray();

        $gt_amount = 0;
        foreach($cart as $k => $v){
            if($v['prod_type'] == 1){

                $prod = HomeModel::product_details(array('tbl_product.id'=> $v['product_id'], 'tbl_product_price.id'    =>  $v['psize_id'] , 'tbl_product.is_active'=> '1'), 'first');

                $cart[$k]['name']   = $prod->product_title;
                $cart[$k]['prod_tag']   = $prod->product_tag;
                $cart[$k]['prod_url']   = $prod->product_url;
                $cart[$k]['image']  =   $prod->product_image;
                $cart[$k]['prod_price']  =   $prod->selling_price;
                $cart[$k]['price']  =   $prod->selling_price*$v['qty'];
                $cart[$k]['size'] = $prod->size;

            }else{

                $prod = ShopModel::getData('tbl_healthbox', array('id'=> $v['product_id'], 'is_active'=> '1'), 'first');

                $cart[$k]['name']   = $prod->product_title;
                $cart[$k]['prod_tag']   = $prod->product_tag;
                $cart[$k]['prod_url']   = $prod->product_url;
                $cart[$k]['image']  =   $prod->product_image;
                $cart[$k]['prod_price']  =   $prod->selling_price;
                $cart[$k]['price']  =   $prod->selling_price*$v['qty'];
                $cart[$k]['size'] = "HealthBox";
            }
            $gt_amount += $cart[$k]['price'];
        }
        $data = [];
        $data['details'] = $cart;
        $data['gt_amount'] = $gt_amount;
        $data['no_of_prod'] = count($cart);
        $data['total_qty'] = array_sum(array_pluck($cart,'qty'));
        $data['assets_url'] = asset('');

        return $data;
    }

    public function add_heathbox(Request $request){
        $post = $request->all();
        //echo '<pre>'; print_r($post);exit;
        $model = new ShopModel();
        $healthbox = $model->getData('tbl_healthbox', array('id'=> $post['product_id']), 'first');
        $cartItem = Cart::instance('shopping')->add($post['product_id'], $healthbox->product_title, $post['qty'], $post['price'],0,array('type'=>'2',  'size'=>$post['size'], 'image'=>$healthbox->product_image));
        if($cartItem){
            $shopping=count(Cart::instance('shopping')->content());
            return json_encode(array('msg'=> 'Product added to card..', 'code'=> 200, 'count'=>$shopping));
        }else{
            return json_encode(array('msg'=> 'Product added to card getting error..', 'code'=> 400, 'count'=> count(Cart::instance('shopping')->content())));
        }
    }

    public function updateCart(Request $request){
        //dd($request->all());
        Cart::instance('shopping')->update($request->id , $request->qty);
        return 200;

    }

    public function removeCart(){
        $rowId = $_GET['id'];
        Cart::instance('shopping')->remove($rowId);
        return 200;

    }

}
