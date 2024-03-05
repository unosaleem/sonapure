<?php
namespace App\Http\Controllers;
use App\AdminModel;
use Illuminate\Http\Request;
use App\HomeModel;
use App\FunctionModel;
use Cart;
use Image;
use Mail;
use Session;
use PDF;

class UserProfile extends OrderController{

    public function my_profile(){
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = '/';
        }
        if(Session::has('client')){
            $model = new HomeModel();
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
            $data['nav'] = "my profile";
            $data['profile_nav'] = "profile";
            $data['title'] = Session::get('client')['first_name'].' '.Session::get('client')['last_name'].' Profile';
            $data['meta'] = Session::get('client')['first_name'].' '.Session::get('client')['last_name'].' Profile';
            $data['profile'] = $model->getData('tbl_client', array('id'=> Session::get('client')['id']), 'first');
            //$data['address'] = $model->getData('tbl_order', array('client_id'=> Session::get('client')['id'], 'payment_status'=> 'Done', 'is_active'=>'1'), 'first', array('id'=> 'DESC'));
            return view('client.my_profile', $data);
        }else{
            return  redirect('/');
        }

    }

    public function my_address(){
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = '/';
        }
        if(Session::has('client')){
            $model = new HomeModel();
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
            $data['nav'] = "my profile";
            $data['profile_nav'] = "my-address";
            $data['title'] = Session::get('client')['first_name'].' '.Session::get('client')['last_name'].' Profile';
            $data['meta'] = Session::get('client')['first_name'].' '.Session::get('client')['last_name'].' Profile';
            $data['profile'] = $model->getData('tbl_client', array('id'=> Session::get('client')['id']), 'first');
            $data['address'] = $model->getData('tbl_client_address', array('client_id'=> Session::get('client')['id'], 'is_active'=>'1'), 'get');
            return view('client.my_address', $data);
        }else{
            return  redirect('/signin');
        }

    }

    public function wishlist(){
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = '/';
        }
        if(Session::has('client')){
            $model = new HomeModel();
            $data['title'] = "";
            $data['wishlist'] = $model->getData('tbl_wishlist', array('user_id' => Session::get('client')['id'],'is_active'=>'1'), 'get', array('id'=>'desc'));
            /*if (!empty($data['wishlist'])) {
                foreach ($data['wishlist'] as $row) {
                    if ($row->prod_type == '1') {
                        $productData = $model->getData('tbl_product', array('id' => $row->prod_id, 'is_active' => '1'), 'get');
                        // Store the product data in $data['product']
                        $data['product'][] = $productData;
                    } elseif ($row->prod_type == '2') {
                        $healthboxData = $model->getData('tbl_healthbox', array('id' => $row->prod_id, 'is_active' => '1'), 'get');
                        // Store the healthbox data in $data['healthbox']
                        $data['healthbox'][] = $healthboxData;
                    }
                }
            }*/

            //echo '<pre>';print_r($data);exit;
            $data['title'] = "";
            $data['meta'] = "";
            $data['nav'] = "wishlist";
            $data['profile_nav'] = "user";
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
            return view('pages.wishlist', $data);
        }else{
            return  redirect('/signin');
        }
    }


    public function addWishlist(Request $request){
        if(Session::has('client')){
            $post = $request->all();
            $model = new FunctionModel();
            if(isset($post['type']) && ($post['type'] === '1' || $post['type'] === '2')){
                $check = null;
                $checkWishlist = null;
                if($post['type'] === '1'){
                    $check = $model->getData('tbl_product', array('id' => $post['product_id'], 'is_active' => '1'), 'first');
                    $checkWishlist = $model->getData('tbl_wishlist', array('prod_id' => $post['product_id'], 'prod_type' => '1', 'is_active' => '1'), 'first');
                }
                elseif ($post['type'] === '2'){
                    $check = $model->getData('tbl_healthbox', array('id' => $post['product_id'], 'is_active' => '1'), 'first');
                    $checkWishlist = $model->getData('tbl_wishlist', array('prod_id' => $post['product_id'], 'prod_type' => '2', 'is_active' => '1'), 'first');
                }
                if ($check === null) {
                    // If $check is null, return "Product Not Found" message
                    return json_encode(array('msg' => 'Product Not Found', 'code' => 400));
                } elseif ($checkWishlist !== null) {
                    // If $checkWishlist is not null, return "Product already added to wishlist" message
                    return json_encode(array('msg' => 'Product already exist to wishlist', 'code' => 400));
                }
                if ($check != null && $checkWishlist == null){
                    //echo '<pre>';print_r($checkWishlist);exit;
                    $data = array(
                        'user_id'       => Session::get('client')['id'],
                        'prod_type'     => $post['type'],
                        'prod_id'       => $post['product_id'],
                        'is_active'     => '1',
                        'created_at'    => date('Y-m-d h:i:s', time()),
                        'updated_at'    => date('Y-m-d h:i:s', time()),
                    );

                    $sql = FunctionModel::insert_data('tbl_wishlist', $data);

                    if($sql['code'] == 200){
                        return json_encode(array('msg'=> 'Product added to Wishlist..', 'code'=> 200));
                    }else{
                        return json_encode(array('msg'=> 'Product added to Wishlist getting error..', 'code'=> 400));
                    }
                }else{
                    return json_encode(array('msg'=> 'Product Not Found getting error..', 'code'=> 400));
                }
            }else{
                return json_encode(array('msg'=> 'Invalid type in request.', 'code'=> 400));
            }
        }else{
            return json_encode(array('code'=> 519, 'msg'=> 'please login to  add to wishlist'));
        }
    }
    public function removeWishlist(Request $request){
        $post = $request->all();
        $model = new FunctionModel();
        //echo '<pre>';print_r($post);exit;
        $sql = $model->update_data('tbl_wishlist', array('id'=> $post['id']), array('is_active'=> '2', 'updated_at'=>date('Y-m-d h:i:s', time())));
        if($sql['code'] == 200){
            return json_encode(array('msg'=> 'Product Remove to Wishlist..', 'code'=> 200));
        }else{
            return json_encode(array('msg'=> 'Product Remove to Wishlist getting error..', 'code'=> 400));
        }
    }

    public function storeImages($pic,$destinationPath, $width, $height){
        //$originalImage= $request->file('filename');
        $thumbnailImage = Image::make($pic);
        $thumbnailPath = $destinationPath.'/thumbnail_images/';
        $originalPath = $destinationPath;
        $file = time().$pic->getClientOriginalName();
        $thumbnailImage->save($originalPath.$file);
        $thumbnailImage->resize($width, $height);
        $thumbnailImage->save($thumbnailPath.$file);
        return $file;
    }

    public function order_history(){
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = '/';
        }
        if(Session::has('client')){
            $model = new HomeModel();
            $data['profile'] = $model->getData('tbl_client', array('id' => Session::get('client')['id']), 'first');
            $model = new HomeModel();
            $data['title'] = "Order History";
            $data['meta'] = "Order History";
            $data['nav'] = "home";
            $data['profile_nav'] = "order-history";
            $data['order'] = $model->orders(array('tbl_order.client_id'=> Session::get('client')['id']), 'paginate', array('tbl_order.id'=> 'Desc'), array('tbl_order.status'=> 'card'));
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
            return view('client.order_history', $data);
        }else{
            return redirect('/signin');
        }

    }

    public function invoice($order_id){
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = '/';
        }
        if (Session::has('client')) {
            $data['title'] = "";
            $data['meta'] = "";
            $data['nav'] = "invoice";
            $data['profile_nav'] = "order-history";
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
            $model = new HomeModel();
            $data['profile'] = $model->getData('tbl_client', array('id' => Session::get('client')['id']), 'first');
            $data['order'] = $model->orders(array('tbl_order.order_id'=>base64_decode($order_id)), 'first');
            $data['order_item'] = $model->getData('tbl_order_item', array('order_id' => base64_decode($order_id)), 'get');
            //echo '<pre>'; print_r($data); exit;
            return view('client.invoice', $data);
            /*$pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');*/
        } else {
            return redirect('/signin');
        }
    }

    public function order_details($order_id){
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = '/';
        }
        if(Session::has('client')){
            $model = new HomeModel();
            $data['profile'] = $model->getData('tbl_client', array('id' => Session::get('client')['id']), 'first');
            $model = new HomeModel();
            $order_id       = base64_decode($order_id);
            $data['title'] = "Order History";
            $data['meta'] = "Order History";
            $data['nav'] = "home";
            $data['profile_nav'] = "order-history";
            $data['order']  = $model->orders(array('tbl_order.is_active'=>'1', 'tbl_order.order_id'=> $order_id), 'first');
            $data['order_item'] = $model->getData('tbl_order_item', array('order_id'=>$order_id), 'get');
            $data['data']   = json_decode($this->getSlipdata($order_id), true);
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
            //echo '<pre>'; print_r($data); exit;
            return view('client.order-details', $data);
        }else{
            return redirect('/signin');
        }

    }

    public function getSlipdata ($order_id) {
        $timestamp = time();
        $appID = 5442;
        $key = 'EhpboEifcc8=';
        $secret = 'p+z3U1a8AgQuI1IYNWGevgc7z0c19Jz45wZ5uLfXou3zb3lJ7iyKoyKG7djIwcBfiKvFJsMzdHBcjHnOwho95A==';

        $sign = "key:". $key ."id:". $appID. ":timestamp:". $timestamp;
        $authtoken = rawurlencode(base64_encode(hash_hmac('sha256', $sign, $secret, true)));
        $ch = curl_init();

        $header = array(
            "x-appid: $appID",
            "x-timestamp: $timestamp",
            "x-sellerid:49203",
            "x-version:3", // for auth version 3.0 only
            "Authorization: $authtoken"
        );

        curl_setopt($ch, CURLOPT_URL, 'https://api.shyplite.com/getSlip?orderID='.urlencode($order_id));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        return $server_output;
    }

    public function order_tracking($awbNo, $order_id){
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = '/';
        }
        if (Session::has('client')) {
            $model = new HomeModel();
            $data['profile'] = $model->getData('tbl_client', array('id' => Session::get('client')['id']), 'first');
            $data['title'] = "Order Tracking";
            $data['meta'] = "Order Tracking";
            $data['nav'] = "Order History";
            $data['profile_nav'] = "order-history";
            $data['profile'] = $model->getData('tbl_client', array('id' => Session::get('client')['id']), 'first');
            $data['order'] = $model->orders(array('tbl_order.order_id'=>base64_decode($order_id)), 'first');
            $data['order_item'] = $model->getData('tbl_order_item', array('order_id' => base64_decode($order_id)), 'get');
            $data['data']       = json_decode($this->track(base64_decode($awbNo)), true);
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
            //echo '<pre>'; print_r($data); exit;
            return view('client.order_tracking', $data);

        } else {
            return redirect('/signin');
        }
    }

    public function track($awbNo) {
        $timestamp = time();
        $appID = 5442;
        $key = 'EhpboEifcc8=';
        $secret = 'p+z3U1a8AgQuI1IYNWGevgc7z0c19Jz45wZ5uLfXou3zb3lJ7iyKoyKG7djIwcBfiKvFJsMzdHBcjHnOwho95A==';
        $sign = "key:". $key ."id:". $appID. ":timestamp:". $timestamp;
        $authtoken = rawurlencode(base64_encode(hash_hmac('sha256', $sign, $secret, true)));
        $ch = curl_init();
        $header = array(
            "x-appid: $appID",
            "x-timestamp: $timestamp",
            "x-sellerid:49203",
            "x-version:3", // for auth version 3.0 only
            "Authorization: $authtoken"
        );
        curl_setopt($ch, CURLOPT_URL, 'https://api.shyplite.com/track/'.$awbNo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        return $server_output;
    }

    public function update_password(Request $request){
        if(Session::has('client')){
            $model = new HomeModel();
            $post = $request->all();
            $client = $model->getData('tbl_client', array('id'=> Session::get('client')['id']), 'first');
            if($client!=""){
                if(md5($post['old_password']) == $client->password){
                    if($post['confirm_password'] == $post['new_password']){
                        $sql = $model->update_data('tbl_client', array('id'=> Session::get('client')['id']), array('password'=> md5($post['new_password']), 'salt_password'=>base64_encode($post['new_password'])));
                        if($sql['code'] == 200){
                            Session::flash('success', 'Thanks! Password update successful..');
                        }else{
                            Session::flash('error', 'Opps! Getting error.');
                        }

                    }else{
                        Session::flash('warning', 'Opps! Confirm password not match.');
                    }

                }else{
                    Session::flash('warning', 'Opps! Old password not match.');
                }
                return redirect($_SERVER['HTTP_REFERER']);
            }else{
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            return redirect('/signin');
        }
    }

    public function update_profile(Request  $request){
        if(Session::has('client')){
            $post = $request->all();
            $model = new HomeModel();
            /*if($request->hasFile('my_file')) {
                $image       = $request->file('my_file');
                $path = "assets/images/client/";
                $uploadImage = $this->storeImages($image, $path, 300, 300);
                $post['input']['profile_pic']  = $path.'/thumbnail_images/'.$uploadImage;
            }*/
            $sql = $model->update_data('tbl_client', array('id'=>Session::get('client')['id']), $post['input']);
            if($sql['code'] == 200){
                Session::flash('success', 'Thanks! Your profile is updated..');
            }else{
                Session::flash('danger', 'Opps! Getting error');
            }
            return redirect($_SERVER['HTTP_REFERER']);
        }else{
            return redirect('/');
        }
    }

    public function add_address(Request $request){
        if(Session::has('client')){
            $post = $request->all();
            $data = array(
                'client_id' => $post['customer_id'],
                'locality'  => $post['locality'],
                'address'   => $post['address'],
                'zip'       => $post['zip'],
                'city'      => $post['city'],
                'state'     => $post['state'],
                'country'   => $post['country'],
                'type'      => $post['type']
            );

            if($post['address_id'] !=""){
                $sql = FunctionModel::update_data('tbl_client_address', array('id'=> $post['address_id']), $data);
                if($sql['code'] == 200){
                    return json_encode(array('code'=> 200, 'msg'=>'Your address update successful'));
                }else{
                    return json_encode(array('code'=> 319, 'msg'=>'Your address already updated'));
                }
            }else{
                $data['is_active'] = '1';
                $data['date_time'] = date('Y-m-d', time());
                $sql = FunctionModel::insert_data('tbl_client_address', $data);
                if($sql['code'] == 200){
                    return json_encode(array('code'=> 200, 'msg'=>'Your address added successful'));
                }else{
                    return json_encode(array('code'=> 319, 'msg'=>'Your address already added'));
                }
            }
        }else{
            return json_encode(array('code'=> 400, 'msg'=> 'getting session error.'));
        }

    }



}
