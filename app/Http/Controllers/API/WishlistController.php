<?php

namespace App\Http\Controllers\API;

use App\FunctionModel;
use App\HomeModel;
use App\Http\Controllers\APIRes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\WishlistModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller{


    public function addToWishlist(Request $request){
        $post = $request->all();

        $validator = Validator::make($post, [
            'prod_type' => ['required','in:1,2'],
            'product_id' => ['required','integer'],
            'flag' => ['required','in:0,1'],
            'psize_id' => ['required','integer']
        ]);

        if ($validator->fails()) {
            return APIRes::validation_res($validator);
        }

        $prod_id = $post['product_id'];
        $prod_type = $post['prod_type'];
        $psize_id = $post['psize_id'];
        $flag = $post['flag'];  // 0 = remove , 1 = add
        $user_id = $request->user()->id;

        if($prod_type == 1 && $psize_id == 0){
            return APIRes::normal_validation_res("Invalid Product Size !!");
        }

        if($flag == 0){
            WishlistModel::where('user_id',$user_id)
                        ->where('prod_id',$prod_id)
                        ->delete();
        }else{
            WishlistModel::updateOrCreate([
                'user_id'   =>  $user_id,
                'prod_id'   =>  $prod_id,
                'prod_type' =>  $prod_type,
                'psize_id'  =>  $psize_id
            ],[
                'user_id'   =>  $user_id,
                'prod_id'   =>  $prod_id,
                'prod_type' =>  $prod_type,
                'psize_id'  =>  $psize_id
            ]);
        }

        return APIRes::success_res("Success");

    }

    public function viewWishlist(Request $request){
        $user_id = $request->user()->id;

        $prod_m = WishlistModel::where('user_id',$user_id)->where('prod_type',1)
                    ->select('prod_id','psize_id')->get()->KeyBy('prod_id')->toArray();

        $prod_id = array_pluck($prod_m,'prod_id');

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

            $psize_id = $prod_m[$row['id']]['psize_id'];

            $price_m = FunctionModel::getData('tbl_product_price', array('is_active'=> '1', 'product_id'=> $row['id'],'id' =>  $psize_id), 'first', array('id'=>'desc'));

            $row['size'] = @$price_m->size;
            $row['price'] = @$price_m->price;
            $row['selling_price'] = @$price_m->selling_price;
            $row['psize_id'] = $psize_id;

            $row['wishlist'] = 1;
            $row['prod_type'] = 1;

            array_push($product,$row);
        }

        // healthbox
        $healthbox_id = WishlistModel::where('user_id',$user_id)->where('prod_type',2)
                    ->pluck('prod_id')->toArray();
        $healthbox = DB::table('tbl_healthbox')
                    ->where('tbl_healthbox.is_active','1')
                    ->whereIn('tbl_healthbox.id',$healthbox_id)
                    ->get()->toArray();
        foreach($healthbox as $k => $row){
            if(is_object($row)) {
                $row = (array) $row;
            }
            unset($row['product_properties']);
            unset($row['interesting_facts']);
            unset($row['storage_instructions']);
            unset($row['health_benefits']);

            $row['size'] = "";
            $row['psize_id'] = 0;

            $row['wishlist'] = 1;
            $row['prod_type'] = 2;

            array_push($product,$row);
        }

        return APIRes::success_res("",$product);

    }

}
