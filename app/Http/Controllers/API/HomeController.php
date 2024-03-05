<?php

namespace App\Http\Controllers\API;

use App\CartModel;
use App\FunctionModel;
use App\HomeModel;
use App\Http\Controllers\APIRes;
use App\Http\Controllers\Controller;
use App\ShopModel;
use App\User;
use App\WishlistModel;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{

        public function index(Request $req){
        // return md5('sonapureessentials');
        $api_token = $req->header('api-token');
        if($api_token != "c7870b514796c9a7137bfc8d22ed9407"){
            return APIRes::error_res("Api Token Mismatch");
        }
        $user = auth()->guard('api')->user();

        $slider = FunctionModel::getData('tbl_slider', array('is_active'=>'1'), 'get')->toArray();
        $product = FunctionModel::getData('tbl_product', array('is_front'=> '1', 'is_active'=>'1'), 'get')->toArray();
        $healthbox = FunctionModel::getData('tbl_healthbox', array('is_front'=> '1', 'is_active'=>'1'), 'get')->toArray();
        $testimonials = FunctionModel::getData('tbl_testimonials', array('is_active'=>'1'), 'get')->toArray();

        $data = compact('slider','product','healthbox','testimonials');
        $data['asset_url'] = asset('/');

        // return $data['product'][0]->id;
        $prod = [];
        foreach($data['product'] as $k => $row){
            if(is_object($row)) {
                $row = (array) $row;
            }
            $row['price'] = FunctionModel::getData('tbl_product_price', array('is_active'=> '1', 'product_id'=> $row['id']), 'first', array('id'=>'desc'));
            $row['size_temp'] = FunctionModel::getData('tbl_product_price', array('is_active'=> '1', 'product_id'=> $row['id']), 'get', array('id'=>'desc'));
            $row['gallery'] = FunctionModel::getData('tbl_product_gallery', array('is_active'=> '1', 'product_id'=> $row['id']), 'first');

            $row['product_properties'] = null;
            $row['interesting_facts'] = null;
            $row['storage_instructions'] = null;
            $row['health_benefits'] = null;

            $row['prod_type'] = 1;

            if(isset($user->id)){
                $wl = WishlistModel::where('prod_id',$row['id'])
                    ->where('prod_type',$row['prod_type'])
                    ->where('psize_id',$row['price']->id)
                    ->where('user_id',$user->id)->exists();
                $row['wishlist'] = ($wl)?1:0;

            }else{
                $row['wishlist'] = 0;
            }

            array_push($prod,$row);
        }
        // return $prod;
        $data['product'] = $prod;
        // return json_encode($data,1);

        $hgallery = [];
        foreach($data['healthbox'] as $key=>$hrow){
            if(is_object($hrow)) {
                $hrow = (array) $hrow;
            }
            $hrow['gallery'] = FunctionModel::getData('tbl_healthbox_banner', array('is_active'=> '1', 'product_id'=> $hrow['id']), 'get')->toArray();

            $hrow['prod_type'] = 2;

            if(isset($user->id)){
                $wl = WishlistModel::where('prod_id',$hrow['id'])
                    ->where('prod_type',$hrow['prod_type'])
                    ->where('psize_id',0)
                    ->where('user_id',$user->id)->exists();
                $row['wishlist'] = ($wl)?1:0;

            }else{
                $row['wishlist'] = 0;
            }

            array_push($hgallery,$hrow);
        }
        $data['healthbox'] = $hgallery;
        // return $data['product'];
        if(isset($user->id)){

            $data['wishlist_value'] = WishlistModel::where('user_id',$user->id)->count();

            $data['cart_value'] = CartModel::where('user_id',$user->id)
                            ->sum('qty');

        }else{
            $data['cart_value'] = 0;
            $data['wishlist_value'] = 0;
        }

        $data['video'] = 'assets/Video/sona-video.mp4';
        $data['methods']    =   [
            [
                'title' =>  'Bee Keeping Farms',
                'gallery'   =>  [
                    'assets/images/m1.jpg',
                    'assets/images/m11.jpg',
                    'assets/images/m111.jpg',
                    'assets/images/m1111.jpg',
                ]
            ],
            [
                'title' =>  'Natural Rock Salt',
                'gallery'   =>  [
                    'assets/images/m2.jpg',
                    'assets/images/m22.jpg'
                ]
            ],
            [
                'title' =>  'Cool PresseD Method for Mustard Oil',
                'gallery'   =>  [
                    'assets/images/m3.jpg',
                    'assets/images/m32.jpg'
                ]
            ],
            [
                'title' =>  'Ghee making from Bilona method',
                'gallery'   =>  [
                    'assets/images/m4.jpg',
                    'assets/images/m42.jpg'
                ]
            ],
            [
                'title' =>  'GIR COWS FARM',
                'gallery'   =>  [
                    'assets/images/m5.jpg',
                    'assets/images/m52.jpg',
                    'assets/images/m53.jpg',
                    'assets/images/m54.jpg'
                ]
            ]
        ];
        $data['certificates'] = [
            'assets/images/Client1.png',
            'assets/images/Client2.png',
            'assets/images/Client3.png',
            'assets/images/Client4.png',
            'assets/images/Client5.png',
            'assets/images/Client6.png',
            'assets/images/Client7.png',
        ];

        // $data['ingradient_url'] = 'healthbox/ingradient';

        return APIRes::success_res("",$data);

    }

    public function product_details(Request $req){

        $post = $req->input();
        $validator = Validator::make($post, [
            'prod_type' => ['required','in:1,2'],
            'product_url' => ['required','string'],
            'psize_id' => ['required','integer']
        ]);

        if ($validator->fails()) {
            return APIRes::validation_res($validator);
        }
        $product_url = $req->input('product_url');
        $psize_id = $req->input('psize_id');
        $prod_type = $req->input('prod_type');

        $user = auth()->guard('api')->user();

        $data = [];
        $data['product_banners'] = [];
        $data['product_price'] = [];

        if($prod_type == 2){
            $data['product'] = ShopModel::getData('tbl_healthbox', array('product_url'=> $product_url, 'is_active'=> '1'), 'first');

            if(empty($data['product'])){
                return APIRes::error_res("Invalid Product");
            }
            $data['product']->prod_type = 2;
            $data['product']->psize_id =  $psize_id;

            $data['product_gallery'] = FunctionModel::getData('tbl_healthbox_gallery', array('product_id'=> $data['product']->id, 'is_active'=> '1'), 'get');

        }else{

            // $data['product'] = HomeModel::product_details(array('tbl_product.product_url'=> $product_url, 'tbl_product.is_active'=> '1'), 'first');
            $data['product'] = DB::table('tbl_product')->where('product_url',$product_url)
                                ->where('is_active','1')
                                ->first();
            if(empty($data['product'])){
                return APIRes::error_res("Invalid Product");
            }
            $data['product']->prod_type = 1;

            $data['product_gallery'] = FunctionModel::getData('tbl_product_gallery', array('product_id'=> $data['product']->id, 'is_active'=> '1'), 'get');
            $data['product_banners'] = FunctionModel::getData('tbl_product_banners', array('product_id'=> $data['product']->id, 'is_active'=> '1'), 'get');
            $data['product_price'] = FunctionModel::getData('tbl_product_price', array('product_id'=> $data['product']->id, 'is_active'=> '1'), 'get');

            $mprice = $data['product_price']->KeyBy('id')->toArray();

            $data['product']->price =  @$mprice[$psize_id]->price;
            $data['product']->selling_price =  @$mprice[$psize_id]->selling_price;
            $data['product']->size =  @$mprice[$psize_id]->size;
            $data['product']->psize_id =  $psize_id;
        }

        $cart = CartModel::where('product_id',$data['product']->id)
                    ->where('prod_type',$data['product']->prod_type)
                    ->get()->toArray();
        // if(isset($cart[0])){
        $data['cart']   =   $cart;
        // }
        if(isset($user->id)){
            $wl = WishlistModel::where('prod_id',$data['product']->id)->where('user_id',$user->id)->exists();
            $data['product']->wishlist = ($wl)?1:0;
        }else{
            $data['product']->wishlist = 0;
        }

        return APIRes::success_res("",$data);

    }

    public function register(Request $request)
    {
    	//Validate data
        $data = $request->only('name', 'email','mobile', 'password');

        $validator = $this->validator($data);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            // return response()->json(['error' => $validator->messages()], 200);
            return APIRes::validation_res($validator);
        }

        //Request is valid, create new user
        try
        {
            DB::beginTransaction();
            event(new Registered($user = $this->create($data)));
            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
            return APIRes::error_res('Mail Not Working Now',[$e->getMessage()]);
        }

        //User created, return success response
        return APIRes::success_res('User created successfully',[$user]);
    }

    public function healthboxIngradient(Request $request){
        $data = [
            'banner'    =>  'assets/images/the-healthbox.png',
            'product_url'   =>  'health-box',
            'base_url'  =>  asset(''),
            'ingradient'    =>  [
                [
                    'title' =>  'Turmeric',
                    'title-hi'  =>  'हरिद्रा/हल्दी',
                    'points'   =>   [
                        'Anti-Inflammatory',
                        'Antioxidant',
                        'Anti-bacterial property which prevents infection',
                        'Helps in Digestion'
                    ],
                    'image' =>  'assets/images/card-1.png'
                ],
                [
                    'title' =>  'Jaggery',
                    'title-hi'  =>  'गुड़/शर्करा',
                    'points'   =>   [
                        'Works as a sweetener',
                        'Prevents Constipation',
                        'Aids in Digestion',
                        'Cures Anaemia'
                    ],
                    'image' =>  'assets/images/card-2.png'
                ],
                [
                    'title' =>  'Pink Salt',
                    'title-hi'  =>  'सेंधा नमक/सैधव लवण',
                    'points'   =>   [
                        'Maintains fluid balance in the body',
                        'Prevention of Allergy Symptoms',
                        'Healthy Sleep Patterns',
                        'Improved Energy & Mood',
                        'Supports Respiratory & Immune system'
                    ],
                    'image' =>  'assets/images/card-3.png'
                ],
                [
                    'title' =>  'Honey',
                    'title-hi'  =>  'शहद/शुद्ध मधु',
                    'points'   =>   [
                        'Rich source of Antioxidants',
                        'Avoids development of chronic diseases like cancer',
                        'Treats cold and soothes sore throat',
                        'Heals and protects wounds from infections'
                    ],
                    'image' =>  'assets/images/card-4.png'
                ],
                [
                    'title' =>  'Immunity Mix',
                    'title-hi'  =>  'रोग-प्रतिरोधात्मक शक्ति',
                    'points'   =>   [
                        'Anti-Inflammatory',
                        'Aids Digestion',
                        'Antioxidant',
                        'Antibacterial',
                        'Supports Immunity'
                    ],
                    'image' =>  'assets/images/card-5.png'
                ],
                [
                    'title' =>  'Desi Ghee',
                    'title-hi'  =>  'देशी घी/घ्रत',
                    'points'   =>   [
                        'Healthy growth in children',
                        'Enhances our immunity',
                        'Reduces Bad Cholesterol',
                        'Improves blood circulation',
                        'Increases Bone density'
                    ],
                    'image' =>  'assets/images/card-6.png'
                ],
                [
                    'title' =>  'Mustard Oil',
                    'title-hi'  =>  'सरसों का तेल/सर्षप',
                    'points'   =>   [
                        'Possesses antimicrobial properties',
                        'Inhibits growth of harmful bacteria',
                        'Optimizes Hair and Skin health',
                        'Reduces body pain'
                    ],
                    'image' =>  'assets/images/card-7.png'
                ]
            ]
        ];
        return APIRes::success_res("success",[$data]);
    }
}
