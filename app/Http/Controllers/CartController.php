<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\ShopModel;


class CartController extends Controller{

    /*public function index(Request $request){
        $post = $request->all();
        //echo '<pre>'; print_r($post);exit;
        $model = new ShopModel();
        $product = $model->getData('tbl_product', array('id'=> $post['product_id']), 'first');
        $cartItem = Cart::instance('shopping')->add($post['product_id'], $product->product_title, $post['qty'], $post['price'],0,array($post['size']));
        if($cartItem){
            $shopping=count(Cart::instance('shopping')->content());
            return json_encode(array('msg'=> 'Product added to card..', 'code'=> 200, 'count'=>$shopping));
        }else{
            return json_encode(array('msg'=> 'Product added to card getting error..', 'code'=> 400, 'count'=> count(Cart::instance('shopping')->content())));
        }
    }*/


    public function add_cart(Request $request){
        $post = $request->all();
        //echo '<pre>'; print_r($post);exit;
        $model = new ShopModel();
        $product = $model->getData('tbl_product', array('id'=> $post['product_id']), 'first');
        $cartItem = Cart::instance('shopping')->add($post['product_id'], $product->product_title, $post['qty'], $post['price'],0,array('type'=>'1', 'size'=>$post['size'], 'image'=>$product->product_image));
        if($cartItem){
            $shopping=count(Cart::instance('shopping')->content());
            return json_encode(array('msg'=> 'Product added to card..', 'code'=> 200, 'count'=>$shopping));
        }else{
            return json_encode(array('msg'=> 'Product added to card getting error..', 'code'=> 400, 'count'=> count(Cart::instance('shopping')->content())));
        }
    }

    public function add_heathbox(Request $request){
        $post = $request->all();
        //echo '<pre>'; print_r($post);exit;
        $model = new ShopModel();
        $healthbox = $model->getData('tbl_healthbox', array('id'=> $post['product_id']), 'first');
        $cartItem = Cart::instance('shopping')->add($post['product_id'], $healthbox->product_title, $post['qty'], $post['price'],0,array('type'=>'2', 'size'=>$post['size'], 'image'=>$healthbox->product_image));
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

    public function addWishlist(Request $request){
        $post = $request->all();
        //echo '<pre>'; print_r($post);exit;
        $model = new ShopModel();
        $product = $model->getData('tbl_product', array('id'=> $post['product_id']), 'first');
        $cartItem = Cart::instance('wishlist')->add($post['product_id'], $product->product_title, $post['qty'], $post['price'],0,array('type'=>'1', 'size'=>$post['size'], 'image'=>$product->product_image));
        if($cartItem){
            $wishlist=count(Cart::instance('wishlist')->content());
            return json_encode(array('msg'=> 'Product added to Wishlist..', 'code'=> 200, 'count'=>$wishlist));
        }else{
            return json_encode(array('msg'=> 'Product added to Wishlist getting error..', 'code'=> 400, 'count'=> count(Cart::instance('wishlist')->content())));
        }
    }
    public function removeWishlist(){
        $rowId = $_GET['id'];
        Cart::instance('wishlist')->remove($rowId);
        return 200;

    }
    public function updateWishlist(Request $request){
        //dd($request->all());
        Cart::instance('wishlist')->update($request->id , $request->qty);
        return 200;

    }

}
