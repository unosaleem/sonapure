<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\FunctionModel;
use App\HomeModel;
use App\ShopModel;
use Softon\Indipay\Facades\Indipay;
use Cart;
use Image;
use Mail;
use Session;


class HomeController extends Controller{

    public function sendSms($mobile, $message, $templateid){
        //---------------------------------
        $message=urlencode($message);
        $url = "http://sms.margsoft.org/sms_api/sendsms.php?";
        $prm = "username=sonapure&password=19Bvc@Du0pW8b&mobile=" . $mobile . "&sendername=SOPURE&message=" . $message . "&templateid=" . $templateid;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $prm);
        $return_val = curl_exec($ch);
        if($return_val=="")
            return array('code' => 319, 'msg'=> 'please check msg');
        else
            return array('code' => 200, 'msg'=> 'msg send', 'return'=> $return_val);
    }

    public function smstest(){
        //$name = "developer testing";
        $orderId = "00001001";
        $amount = 000.00;
        $mobile = "8982404473";
        $tempId = "1607100000000229937";
        $msg = "Thank you for placing an order with SONA Pure Essentials! ". "Your Order ID: " .$orderId. " AMOUNT ". $amount. ". --- SPE";

        //echo $msg; exit;
        $smsQuery = $this->sendSms($mobile, $msg, $tempId);
        //echo '<pre>'; print_r($smsQuery);
    }

    public static function cURLget($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
        //echo $curl_scraped_page;
        return $curl_scraped_page;
    }

    public function is_mobile(){
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $iPod = stripos($useragent, "iPod");
        $iPad = stripos($useragent, "iPad");
        $iPhone = stripos($useragent, "iPhone");
        $Android = stripos($useragent, "Android");
        $iOS = stripos($useragent, "iOS");
        //-- You can add billion devices
        $DEVICE = ($iPod||$iPad||$iPhone||$Android||$iOS);

        if ($DEVICE !=true) {
            return  array('code' =>200 ,'device' =>'web' );
        }else{
            return  array('code' =>201 ,'device' =>'mobile' );
        }
    }

    public function index(){
        $data['title'] = " Sona Pure Essentials  || index";
        $data['meta'] = "";
        $data['nav'] = "home";
        /*$data['product'] = HomeModel::product_details(array('tbl_product.is_front'=> '1', 'tbl_product.is_active'=>'1'), 'get');*/
        $data['slider'] = FunctionModel::getData('tbl_slider', array('is_active'=>'1'), 'get');
        $data['category'] = FunctionModel::getData('tbl_category', array('is_active'=>'1'), 'get');
        $data['product'] = FunctionModel::getData('tbl_product', array('is_front'=> '1', 'is_active'=>'1'), 'get');
        $data['healthbox'] = FunctionModel::getData('tbl_healthbox', array('is_front'=> '1', 'is_active'=>'1'), 'get');
        $data['testimonials'] = FunctionModel::getData('tbl_testimonials', array('is_active'=>'1'), 'get');
        $data['healthbox_banner'] = FunctionModel::getData('tbl_brand', array('is_active'=>'1'), 'get');
        $data['bestSeller'] = FunctionModel::getData('tbl_banner', array('is_active'=>'1'), 'get');
        //echo '<pre>'; print_r($data); exit;
        $data['type'] = $this->is_mobile();
        return view('pages.index', $data);

    }

    public function logout(){
        Session::forget('client');
        return redirect('/');
    }

    public function about_sona(){
        $data['title'] = "About  Sona Pure Essentials ";
        $data['meta'] = "";
        $data['nav'] = "about-sona";
        $data['type'] = $this->is_mobile();
        return view('pages.about_sona', $data);
    }

    public function our_essence(){
        $data['title'] = "About  Sona Pure Essentials ";
        $data['meta'] = "";
        $data['nav'] = "our_essence";
        $data['type'] = $this->is_mobile();
        return view('pages.our_essence', $data);
    }

    public function our_methods(){
        $data['title'] = "About  Sona Pure Essentials ";
        $data['meta'] = "";
        $data['nav'] = "our-methods";
        $data['type'] = $this->is_mobile();
        return view('pages.our_methods', $data);
    }

    public function certifications(){
        $data['title'] = "About  Sona Pure Essentials ";
        $data['meta'] = "";
        $data['nav'] = "certifications";
        $data['type'] = $this->is_mobile();
        return view('pages.certifications', $data);
    }

    public function the_health_box(){
        $data['title'] = "About  Sona Pure Essentials ";
        $data['meta'] = "";
        $data['nav'] = "the-health-box";
        $data['healthbox'] = FunctionModel::getData('tbl_healthbox', array('is_front'=> '1', 'is_active'=>'1'), 'get', array('id'=>'desc'));
        $data['type'] = $this->is_mobile();
        return view('pages.the_health_box', $data);
    }

    public function our_story(){
        $data['title'] = "About  Sona Pure Essentials ";
        $data['meta'] = "";
        $data['nav'] = "our-story";
        $data['type'] = $this->is_mobile();
        return view('pages.our_story', $data);
    }
    
    public function our_lab_report(){
        $data['title'] = "About  Sona Pure Essentials ";
        $data['meta'] = "";
        $data['nav'] = "our-lab-report";
        $data['type'] = $this->is_mobile();
        return view('pages.our_lab_report', $data);
    }

    public function about(){
        $data['title'] = "About  Sona Pure Essentials ";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "about";
        $data['type'] = $this->is_mobile();
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        return view('pages.about', $data);
    }

    public function contact(){
        $data['title'] = "Sona Pure Essentials  || Contact  ";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "contact";
        $data['type'] = $this->is_mobile();
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        $data['hide_footer'] = false;
        return view('pages.contact', $data);
    }

	public function our_strength(){
        $data['title'] = "Sona Pure Essentials  || our strength  ";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "our_strength";
        $data['type'] = $this->is_mobile();
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        $data['hide_footer'] = false;
        return view('pages.our_strength', $data);
    }

	public function our_team(){
        $data['title'] = "Sona Pure Essentials  || our team  ";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "our_team";
        $data['type'] = $this->is_mobile();
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        $data['hide_footer'] = false;
        return view('pages.our_team', $data);
    }

	public function our_associatespartners(){
        $data['title'] = "Sona Pure Essentials  || our associates partners  ";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "our_associatespartners";
        $data['type'] = $this->is_mobile();
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        $data['hide_footer'] = false;
        return view('pages.our_associatespartners', $data);
    }

	public function event_media(){
        $data['title'] = "Sona Pure Essentials  || event media  ";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "event_media";
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        $data['event'] = FunctionModel::getData('tbl_event', array('is_active'=>'1'), 'get',  array('id'=>'desc'));
        $data['hide_footer'] = false;
        return view('pages.event_media', $data);
    }
	public function event_details($event_url){
        $data['title'] = "Sona Pure Essentials  || event media  ";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "event_media";
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        $data['event'] = FunctionModel::getData('tbl_event', array('event_url'=>$event_url,'is_active'=>'1'), 'first');
        $data['gallery'] = FunctionModel::getData('tbl_event_media', array('is_active'=>'1', 'event_id'=> $data['event']->id), 'get',  array('id'=>'desc'));
        $data['hide_footer'] = false;
        return view('pages.boss_ladies', $data);
    }

	public function photo_gallery(){
        $data['title'] = "Sona Pure Essentials  || photo gallery  ";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "photo_gallery";
        $data['type'] = $this->is_mobile();
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        $data['hide_footer'] = false;
        return view('pages.photo_gallery', $data);
    }
    public function boss_ladies(){
        $data['title'] = "Sona Pure Essentials  || boss ladies  ";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "boss_ladies";
        $data['type'] = $this->is_mobile();
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        $data['hide_footer'] = false;
        return view('pages.boss_ladies', $data);
    }
    

    public function privacy_policy(){
        $data['title'] = "Sona Pure Essentials  || Privacy Policy";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "privacy_policy";
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        return view('pages.privacy_policy', $data);
    }

    public function shipping_and_return(){
            $data['title'] = "Sona Pure Essentials  || Return  / shipping";
            $data['meta'] = "";
            $data['type'] = $this->is_mobile();
            $data['nav'] = "shipping_and_return";
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
            return view('pages.shipping_and_return', $data);
        }

    public function refund_and_cancellation(){
            $data['title'] = "Sona Pure Essentials  || Refund / Cancellation Policy";
            $data['meta'] = "";
            $data['type'] = $this->is_mobile();
            $data['nav'] = "refund_and_cancellation";
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
            return view('pages.refund_and_cancellation', $data);
        }

    public function terms_and_conditions(){
        $data['title'] = "Sona Pure Essentials  || Terms and Condition";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "terms_and_conditions";
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        return view('pages.terms_and_conditions', $data);
    }

    public function disclaimer(){
        $data['title'] = "Sona Pure Essentials  || disclaimer";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "disclaimer";

        return view('pages.disclaimer', $data);
    }

    public function help_faq(){
        $data['title'] = "Sona Pure Essentials  || help faq";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "help-faq";

        return view('pages.help-faq', $data);
    }

    public function wishlist(){
        $data['title'] = "Sona Pure Essentials  || wishlist";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "wishlist";

        return view('pages.wishlist', $data);
    }

    public function product_details($product_url){
        $data['title'] = " Sona Pure Essentials  || Product Details";
        $data['meta'] = " Sona Pure Essentials ";
        $data['nav'] = "product_details";
        $data['type'] = $this->is_mobile();
        $data['product'] = HomeModel::product_details(array('tbl_product.product_url'=> $product_url, 'tbl_product.is_active'=> '1','tbl_product_price.is_active'=> '1'), 'first', array('tbl_product_price.selling_price'=> 'asc'));
//        echo '<pre>'; print_r($data['product']); exit;
        if($data['product'] !=""){
            $data['product_gallery'] = FunctionModel::getData('tbl_product_gallery', array('product_id'=> $data['product']->id, 'is_active'=> '1'), 'get');
            $data['product_banners'] = FunctionModel::getData('tbl_product_banners', array('product_id'=> $data['product']->id, 'is_active'=> '1'), 'get');
            $data['product_price'] = FunctionModel::getData('tbl_product_price', array('product_id'=> $data['product']->id, 'is_active'=> '1'), 'get', array('selling_price'=> 'asc'));
            $data['faq'] = FunctionModel::getData('tbl_faq', array('product_id'=> $data['product']->id, 'is_active'=> '1'), 'get', array('id'=> 'desc'));
            //echo '<pre>'; print_r($data); exit;
            return view('pages.detail', $data);

        }else{

        }
    }

    public function product_healthbox_details($product_url){
        $data['title'] = " Sona Pure Essentials  || Healthbox Details";
        $data['meta'] = " Sona Pure Essentials ";
        $data['nav'] = "product_details";
        $data['type'] = $this->is_mobile();
        $data['product'] = ShopModel::getData('tbl_healthbox', array('product_url'=> $product_url, 'is_active'=> '1'), 'first');
//        echo '<pre>'; print_r($data['product']); exit;
        if($data['product'] !=""){
            $data['product_gallery'] = FunctionModel::getData('tbl_healthbox_gallery', array('product_id'=> $data['product']->id, 'is_active'=> '1'), 'get');
            $data['product_banners'] = FunctionModel::getData('tbl_healthbox_banner', array('product_id'=> $data['product']->id, 'is_active'=> '1'), 'get');
            $data['faq'] = FunctionModel::getData('tbl_faq_healthbox', array('product_id'=> $data['product']->id, 'is_active'=> '1'), 'get', array('id'=> 'desc'));
            return view('pages.healthbox_detail', $data);
        }else{

        }
    }

    /*
     * @auth: digital nawab
     * @param : product price, qty, size for buy
     * @return : add to card -> open guest-order page
     * @date : 02-04-2022
    */
    public function buy_now_product(Request $request){
        $post = $request->all();
        $product = FunctionModel::getData('tbl_product', array('id'=> $post['product_id']), 'first');
        $cartItem = Cart::instance('shopping')->add($post['product_id'], $product->product_title, $post['qty'], $post['price'],0,array('type'=>'1','size'=>$post['size'], 'image'=>$product->product_image));
        if($cartItem){
            $shopping=count(Cart::instance('shopping')->content());
            return json_encode(array('msg'=> 'Product added to card..', 'url'=> url('buy-now-product'), 'code'=> 200, 'count'=>$shopping));
        }else{
            return json_encode(array('msg'=> 'Product added to card getting error..', 'code'=> 400, 'count'=> count(Cart::instance('shopping')->content())));
        }

        //echo '<pre>'; print_r($post); exit;
    }

    public function buy_now_healthbox(Request $request){
        $post = $request->all();
        $product = FunctionModel::getData('tbl_healthbox', array('id'=> $post['product_id']), 'first');
        $cartItem = Cart::instance('shopping')->add($post['product_id'], $product->product_title, $post['qty'], $post['price'],0,array('type'=>'2','size'=>$post['size'], 'image'=>$product->product_image));
        if($cartItem){
            $shopping=count(Cart::instance('shopping')->content());
            return json_encode(array('msg'=> 'Product added to card..', 'url'=> url('buy-now-product'), 'code'=> 200, 'count'=>$shopping));
        }else{
            return json_encode(array('msg'=> 'Product added to card getting error..', 'code'=> 400, 'count'=> count(Cart::instance('shopping')->content())));
        }

        //echo '<pre>'; print_r($post); exit;
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function post_cart_out(Request $request){
        $post = $request->all();
        //echo '<pre>'; print_r($post); exit;
        $check_mobile = FunctionModel::getData('tbl_client', array('email'=> $post['email']), 'first');
        if($check_mobile !=""){
            Session::flash('warning', $post['email'].' already exists.Please login with your email ID and password.');
            return redirect($_SERVER['HTTP_REFERER']);
        }else{
            $password = $this->generateRandomString(6);
            $data_client = array(
                'first_name' => $post['fname'],
                'last_name' => $post['lname'],
                'email' => $post['email'],
                'mobile' => $post['phone'],
                'gender' => $post['gender'],
                'password' => md5($password),
                'salt_password' => base64_encode($password),
                'is_active'=> '1',
                'date_time' => date('Y-m-d', time())
            );
            $sql = FunctionModel::insert_data('tbl_client', $data_client);
            if($sql['code'] == 200){
                $client_id = $sql['last_id'];
                $data_address = array(
                    'client_id' => $client_id,
                    'locality'  => $post['locality'],
                    'address'   => $post['address'],
                    'zip'       => $post['zip'],
                    'city'      => $post['city'],
                    'state'     => $post['state'],
                    'country'   => $post['country'],
                    'type'      => 'home',
                    'date_time' => date('Y-m-d', time()),
                    'is_active' => '1'
                );
                $sql_address = FunctionModel::insert_data('tbl_client_address', $data_address);
                if($sql_address['code'] == 200){
                    $client = array(
                        'id' => $client_id,
                        'first_name' => $post['fname'],
                        'last_name' => $post['lname'],
                        'email' => $post['email'],
                        'mobile' => $post['phone']
                    );
                    Session::put('client', $client);
                    $order_id = $this->generate_order(Cart::instance('shopping')->content());
                    Session::put('order', $order_id['order_id']);

                    /*$to_name = $post['fname'].' '.$post['lname'];
                    $to_email = $post['email'];
                    $data['client'] = $data_client;*/
                    //echo '<pre>'; print_r($data); exit;
                    /*Mail::send('mail.register-mail', $data, function($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)->subject(' Sona Pure Essentials  Welcome Mail');
                        $message->from('no-reply@sonapureessentials.com','Sona Pure Essentials');
                    });*/
                    return redirect('/check-out');
                }
            }
        }
    }

    public function cart()
    {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = '/';
        }
            $data['title'] = "Sona Pure Essentials  || Cart";
            $data['meta'] = "";
            $data['nav'] = "cart";
            $data['url'] = $url;
            $data['type'] = $this->is_mobile();
            $data['card'] = Cart::instance('shopping')->content();
        //echo '<pre>'; print_r($data); exit;
            return view('pages.cart', $data);

    }

    public function checkout(){
        $url = url()->current();
        if(Session::has('client')){
            $model = new ShopModel();
            $data['order_id'] = Session::get('order');
            $data['title'] = "Sona Pure Essentials  || Checkout";
            $data['meta'] = "";
            $data['nav'] = "checkout";
            $data['type'] = $this->is_mobile();
            $data['cart'] = $model->getData('tbl_order', array('payment_status'=> 'Not Connect', 'order_id'=>$data['order_id']), 'first');
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
            //echo '<pre>'; print_r($data); exit;
            return view('pages.checkout', $data);
        }
        else{
            return redirect('/404');
        }

    }

    public function post_cart_out_user(Request $request){
        if(Session::has('client')){
            $post = $request->all();
            $model = new ShopModel();
            //echo '<pre>'; print_r($post); exit;

            $this->validate($request, [
                'customer_address_id' => 'required',
            ], [
                'customer_address_id.required' => 'The customer address field is required please add and select address .',
            ]);
            $order_id = $this->generate_order(Cart::instance('shopping')->content(), $post['customer_address_id']);
            if($order_id['code'] == 200) {
                //echo '<pre>'; print_r($order_id); exit;
                $data['order_id'] = $order_id['order_id'];
                $data['card'] = $model->getData('tbl_order', array('payment_status' => 'Not Connect', 'order_id' => $order_id['order_id']), 'first');
                Session::put('order', $data['order_id']);
                return redirect('check-out');
            }
        }
    }

    public function generate_order($shopping, $customer_address_id=""){
        $model = new ShopModel();

//        echo '<pre>'; print_r($shopping); exit;
        if(count($shopping)!="0"){
            $Oid = $model->getLastId('tbl_order', 'id' );
            if($Oid == ""){
                $tempId = 0;
            }else{
                $tempId = $Oid->id;
            }
            $orderId = 'SOP'.date('Y', time()).($tempId+1);
            $total = 0;
            $total_tax = 0;
            if(count($shopping)!= 0) {
                if ($shopping !="") {
//                    echo $shopping->options->type; exit;
                    foreach ($shopping as $key => $row) {
                        //echo $row->options->size; exit;
                        $order = array();
                        if($row->options->type == '1'){
                            $products = $model->getData('tbl_product', array('id' => $row->id), 'first');
                        }elseif($row->options->type == '2'){
                            $products = $model->getData('tbl_healthbox', array('id' => $row->id), 'first');

                        }else{
                            $products = $model->getData('tbl_product', array('id' => $row->id), 'first');
                        }
//                        echo '<pre>';print_r($products);exit;
                        //$products = $model->getData('tbl_product', array('id' => $row->id), 'first');
                        $amount = $row->price * $row->qty;
                        $total = $total + $amount;
                        $tax = ($amount * 18) / 118;
                        $total_tax = $total_tax + $tax;
                        $order['order_id'] = $orderId;
                        $order['product_id'] = $row->id;
                        $order['sku_number'] = $products->sku_number;
                        $order['product_name'] = $row->name;

                        $order['qty'] = $row->qty;
                        $order['size'] = $row->options->has('size') ? $row->options->size : "";
                        $order['price'] = $row->price;
                        $order['total_price'] = $row->price * $row->qty;
                        $order['product_image'] = $products->product_image;
                        $order['tax_rate'] = 18;
                        $order['tax_amount'] = $tax;
                        $order['is_active'] = '0';
                        $order['date_time'] = date('Y-m-d', time());
                        $order['type'] = $row->options->type;
                        $model->insert_data('tbl_order_item', $order);
                    }

                }
            }
            if($customer_address_id !=""){
                $client_address = FunctionModel::getData('tbl_client_address', array('is_active'=>'1', 'id'=>$customer_address_id), 'first', array('id'=>'desc'));
            }else{
                $client_address = FunctionModel::getData('tbl_client_address', array('is_active'=>'1', 'client_id'=>Session::get('client')['id']), 'first', array('id'=>'desc'));
            }

            $data = array(
                'order_id'      => $orderId,
                'delivery_fee'  => 0,
                'gst'           => $total_tax,
                'sub_total'     => $total-$total_tax,
                'total_amount'  => $total+0,
                'client_id'     => Session::get('client')['id'],
                'first_name'    => Session::get('client')['first_name'],
                'last_name'     => Session::get('client')['last_name'],
                'email'         => Session::get('client')['email'],
                'mobile'        => Session::get('client')['mobile'],
                'status'        => 'card',
                'payment_status'=> 'Not Connect',
                'is_active'     => '1',
                'date_time'     => date('Y-m-d', time()),
            );
            if($client_address !=""){
                $data['shipping_post_code'] = $client_address->zip;
                $data['shipping_locality']  = $client_address->locality;
                $data['shipping_city']      = $client_address->city;
                $data['shipping_state']     = $client_address->state;
                $data['shipping_address']   = $client_address->address;
                $data['shipping_country']   = $client_address->country;
            }
            $sql = $model->insert_data('tbl_order', $data);
            if($sql['code'] == 200){
                Cart::instance('shopping')->destroy();

                return array('code'=> 200, 'order_id' => $orderId);
            }else{
                return array('code'=> 400, 'msg'=> 'Getting Error');
            }
        }else{
            $sql = $model->getData('tbl_order', array('is_active'=> '1', 'payment_status'=>'Not Connect'), 'first', array('id'=> 'DESC'));
            if($sql !=""){
                return array('code'=> 200, 'msg'=> '', 'order_id'=> $sql->order_id);
            }else{
                return array('code'=> 400, 'msg'=> 'Getting Errors');
            }

        }

    }

    public function checkout_thankyou(){
        $url = url()->current();
        $data['type'] = $this->is_mobile();
        if(Session::has('client')){
            $model = new ShopModel();
            $order_id = $this->generate_order(Cart::instance('shopping','service')->content());
//            $order_id = $this->generate_order(Cart::instance('service')->content());
            if($order_id['code'] == 200){
                $data['order_id'] = $order_id['order_id'];
                $data['title'] = "Sona Pure Essentials  || Checkout";
                $data['meta'] = "";
                $data['nav'] = "checkout";
                $data['card'] = $model->getData('tbl_order', array('payment_status'=> 'Not Connect', 'order_id'=>$order_id['order_id']), 'first');
                $data['css'] = \Config::get('css');
                $data['js'] = \Config::get('js');
                //echo '<pre>'; print_r($data); exit;
                return view('pages.checkout_thankyou', $data);
            }else{
                return redirect('/404');
            }

        }else{
            return redirect('/signin?url='.$url);
        }
        return view('pages.checkout_thankyou', $data);
    }

    public function payment(){
        $url = url()->current();
        if(Session::has('client')){

            $model = new ShopModel();
            $order_id = $this->generate_order(Cart::instance('shopping')->content(), Cart::instance('service')->content());
            /*$order_id = $this->generate_order(Cart::instance('shopping')->content());
            $orders_id = $this->generate_order(Cart::instance('service')->content());*/
            if($order_id['code'] == 200){
                $data['order_id'] = $order_id['order_id'];
                $data['title'] = "Sona Pure Essentials  || Checkout";
                $data['meta'] = "";
                $data['nav'] = "checkout";
                $data['type'] = $this->is_mobile();
                $data['card'] = $model->getData('tbl_order', array('payment_status'=> 'Not Connect', 'order_id'=>$order_id['order_id']), 'first');
                $data['css'] = \Config::get('css');
                $data['js'] = \Config::get('js');
                //echo '<pre>'; print_r($data); exit;
                return view('pages.payment', $data);
            }else{
                return redirect('/404');
            }

        }else{
            return redirect('/signin?url='.$url);
        }
    }

    public function login(){
        if(isset($_GET['url'])){
            $url = $_GET['url'];
        }else{
            $url = '/';
        }
        if(Session::has('client')){
            return redirect($url);
        }else{
            $data['title'] = "Sona Pure Essentials  || Login";
            $data['meta'] = "Login  Sona Pure Essentials ";
            $data['nav'] = "Login";
            $data['type'] = $this->is_mobile();
            $data['url'] = $url;
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
//             echo '<pre>'; print_r($data); exit;
            return view('pages.login', $data);

        }
    }

    public function cancel_payment(){
        $data['title'] = "Sona Pure Essentials  || Login";
        $data['meta'] = "Login  Sona Pure Essentials ";
        return view('pages.payment-cancel', $data);

    }

    public function forgot_password(){
        if(isset($_GET['url'])){
            $url = $_GET['url'];
        }else{
            $url = '/';
        }
        if(Session::has('client')){
            return redirect($url);
        }else{
            $data['title'] = "Sona Pure Essentials  || Forgot Password";
            $data['meta'] = "Forgot Password  Sona Pure Essentials ";
            $data['nav'] = "Forgot";
            $data['type'] = $this->is_mobile();
            $data['url'] = $url;
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
//             echo '<pre>'; print_r($data); exit;
            return view('pages.forgot_password', $data);

        }
    }

    public function register(){
        if(isset($_GET['url'])){
            $url = $_GET['url'];
        }else{
            $url = '/';
        }
        if(Session::has('client')){
            return redirect($url);
        }else{
            $data['title'] = "Sona Pure Essentials  || Signup";
            $data['meta'] = "Sona Pure Essentials ";
            $data['nav'] = "cart";
            $data['type'] = $this->is_mobile();
            $data['url'] = $url;
            $data['css'] = \Config::get('css');
            $data['js'] = \Config::get('js');
            return view('pages.register', $data);

        }
    }

    public function post_login(Request $request){
        if(Session::has('client')){
            return redirect('/');
        }else{
            $post = $request->all();
            if(is_numeric($post['email'])){
                $customer = FunctionModel::getData('tbl_client', array('is_active'=>'1','mobile'=> trim($post['email']), 'password'=> md5(trim($post['password']))), 'first');
            }else{
                $customer = FunctionModel::getData('tbl_client', array('is_active'=>'1','email'=> trim($post['email']), 'password'=> md5(trim($post['password']))), 'first');
            }

            if($customer !=""){
                $client = array(
                    'id' => $customer->id,
                    'first_name' => $customer->first_name,
                    'last_name' => $customer->last_name,
                    'email' => $customer->email,
                    'mobile' => $customer->mobile,
                );
                Session::put('client', $client);
                if(isset($post['url'])){
                    return redirect($post['url']);
                }else{
                    return redirect($_SERVER['HTTP_REFERER']);
                }

            }else{
                Session::flash('warning', 'Email & Password not match fill correct info and please try again.');
                return redirect($_SERVER['HTTP_REFERER']);
            }

        }
    }

    public function post_register(Request $request){
        if(Session::has('client')){
            return redirect('/');
        }else{
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;
            $model = new ShopModel();
            if($post['password'] == $post['confirm_password']){
                $check = $model->getData('tbl_client', array('mobile'=> $post['input']['mobile']), 'first');
                if($check !=""){
                    Session::flash('warning', $post['input']['mobile'].' is already exits.');
                }else{
                    $data = array_merge(
                        $post['input'],
                        array(
                            'password' => md5($post['password']),
                            'salt_password' => base64_encode($post['password']),
                            'is_active' => '1',
                            'date_time' => date('Y-m-d', time()),
                        )
                    );
                    $sql = $model->insert_data('tbl_client', $data);
                    if($sql['code'] == 200){
                        $client = array(
                            'id' => $sql['last_id'],
                            'first_name' => $post['input']['first_name'],
                            'last_name' => $post['input']['last_name'],
                            'email' => $post['input']['email'],
                            'mobile' => $post['input']['mobile']
                        );
                        Session::put('client', $client);
                        $this->sendRegistermail($client);
                    }else{
                        Session::flash('error', 'Getting error please check and try again.');
                    }
                }
            }else{
                Session::flash('warning', 'Password not match please check and try again.');
            }
            return redirect($post['url']);
        }
    }

    public function thankyou($order_id){
        $model = new ShopModel();
        $data['title'] = "Sona Pure Essentials  || Thankyou";
        $data['meta'] = "";
        $data['nav'] = "contact";
        $data['type'] = $this->is_mobile();
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        $data['order_id'] = $order_id;
        //echo base64_decode($order_id); exit;
        $data['order'] = $model->orders(array('tbl_order.order_id'=> base64_decode($order_id)), 'first', array('tbl_order.id'=> 'Desc'));
        if(!Session::has('client')){
            $customer = ShopModel::getData('tbl_client', array('id'=> $data['order']->client_id), 'first');
            $client = array(
                'id' => $customer->id,
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'email' => $customer->email,
                'mobile' => $customer->mobile,
            );
            Session::put('client', $client);
        }

        //echo '<pre>'; print_r($user); exit;
        return view('pages.thankyou', $data);
    }

    public function check_coupon(Request $request){
        if(Session::has('client')){
            $post = $request->all();
            $model = new ShopModel();
            $sql = $model->check_coupon($post);
            if($sql !=""){
                return json_encode(array('code'=> 200, 'msg'=> 'Coupon valid', 'data'=> $sql));
            }else{
                return json_encode(array('code'=> 301, 'msg'=> 'Coupon not valid'));
            }
        }else{
            return json_encode(array('code'=> 404, 'msg'=> 'Authentication not found.'));
        }
    }


    // mail send--------------------------------
    public function sendmail(Request $request){
        $post = $request->all();
        $to_name = 'Sona Pure Essentials ';
        $to_email = 'unosaleem@gmail.com';
        $mail = Mail::send('pages.email_templates', $post, function($message) use ($to_name, $to_email) {
            $message->to($to_email, 'Sona Pure Essentials');
            $message->cc('traficoanalytica@gmail.com')->bcc('unosaleem@gmail.com')
                ->subject('Sona Pure Essentials');
            $message->from('support@sonapureessentials.com','Sona Pure Essentials ');
        });
        $title['title']  = ' Sona Pure Essentials ';
//        return redirect('thankyou');
        echo 'Thank You for Submitting the Form. We appreciate your submission!';

        echo "<script>
        setTimeout(function () {
            window.location.href = '/';
        }, 6000); // 20000 milliseconds (20 seconds)
    </script>";
    }

    public function sendRegistermail($client){
        $model = new ShopModel();
        $to_name = $client['first_name'].' '.$client['last_name'];
        $to_email = $client['email'];
        $data['client'] = $model->getData('tbl_client', array('id'=> $client['id']), 'first');
        $mail = Mail::send('mail.register-mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject(' Sona Pure Essentials  || Register');
            $message->from('support@sonapureessentials.com',' Sona Pure Essentials  || Registration');
        });

    }

    public function sendInvoiceMail($order_id){
        $model = new ShopModel();
        $data['order'] = $model->orders(array('tbl_order.order_id'=>$order_id), 'first');
        $data['profile'] = $model->getData('tbl_client', array('id' => $data['order']->client_id), 'first');
        $data['order_item'] = $model->getData('tbl_order_item', array('order_id' => $order_id), 'get');
        $to_name = $data['profile']->first_name.' '.$data['profile']->last_name;
        $to_email = $data['profile']->email;

//        return view('mail.order_invoice', $data);

        $mail = Mail::send('mail.order_invoice', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject(' Sona Pure Essentials  || Order Invoice');
            $message->from('support@sonapureessentials.com',' Sona Pure Essentials  || Send Invoice');
        });
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

    public function my_invoice($order_id){
        $model = new ShopModel();

        $data['order'] = $model->orders(array('tbl_order.order_id'=>base64_decode($order_id)), 'first');
        $data['profile'] = $model->getData('tbl_client', array('id' => $data['order']->client_id), 'first');
        $data['order_item'] = $model->getData('tbl_order_item', array('order_id' => base64_decode($order_id)), 'get');
        $data['word'] = $this->convert_number($data['order']->total_amount);
//        echo '<pre>'; print_r($data); exit;
        return view('admin.invoice.order_invoice', $data);
    }

    public function get_address(Request $request){
        $post = $request->all();
        $url = "http://www.postalpincode.in/api/pincode/".$post['pincode'];
        $address = $this->thiCurl($url);
        $address = json_decode($address, true);
        //echo '<pre>'; print_r(); exit;
        $data = array();
        if(count($address['PostOffice']) !=0){
            $data['district']   = $address['PostOffice'][0]['District'];
            $data['region']     = $address['PostOffice'][0]['Region'];
            $data['state']      = $address['PostOffice'][0]['State'];
            $data['country']    = $address['PostOffice'][0]['Country'];
        }
        return json_encode($data);

    }

    public function thiCurl($url){
        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$url);
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $buffer;
    }

    public function final_payment(Request $request){
        if(Session::has('client')){
            $post = $request->all();
            $model = new ShopModel();
            //echo '<pre>'; print_r($post); exit;
            $data = array();
            $Oid = $model->getLastId('tbl_order', 'id' );
            if($Oid == ""){
                $tempId = 0;
            }else{
                $tempId = $Oid->id;
            }
            $data['invoice_id'] = "SOP".($tempId+1).time();
            $profile = $model->getData('tbl_client', array('id' => Session::get('client')['id']), 'first');
            if($post['payment_method'] == "ccavenue"){
                $parameters = [
                    'amount' => $post['input']['total_amount'],
                    'redirect_url' => url('check-out/online-payment'),
                    'cancel_url' => url('check-out/cancel-payment'),
                    'order_id' => $post['where']['order_id'],
                    'name' => $profile->first_name.' '.$profile->last_name,
                    'email' => $profile->email,
                ];

                $order = Indipay::prepare($parameters);
//                echo '<pre>';print_r($order);exit;
                return Indipay::process($order);
            }elseif($post['payment_method'] == "cod"){
                $data['payment_status'] = "COD";
                if($post['input']['coupon_amount'] != ""){
                    $data['coupon_amount']= $post['input']['coupon_amount'];
                    $data['coupon_code']= $post['input']['coupon'];
                }
                $data['total_amount'] = $post['input']['total_amount'];
                $data['payment_method'] = $post['payment_method'];
                $data['status'] = 'new';
                $sql = $model->update_data('tbl_order', array('order_id'=>$post['where']['order_id']), $data);
                if($sql['code'] == 200){
                    $model->update_data('tbl_order_item', $post['where'], array('is_active'=> '1', 'status'=> 'new'));
                    $msg = "Thank you for placing an order with SONA Pure Essentials! ". "Your Order ID: " .$post['where']['order_id']. " AMOUNT ". $post['input']['total_amount']. ". --- SPE";
                    $tempId = 1607100000000229937;
                    $this->sendSms($profile->mobile, $msg, $tempId);
                    $this->sendInvoiceMail($post['where']['order_id']);
                    return redirect('thank-you/'.base64_encode($post['where']['order_id']));
                }
            }else{
                Session::flash('error', 'Getting error try again later');
                return redirect($_SERVER['HTTP_REFERER']);
            }

        }else{
            return redirect('/');
        }
    }

    public function online_payment(Request $request){
        $response = Indipay::gateway('NameOfGatewayUsedDuringRequest')->response($request);
        //echo '<pre>';print_r($response);exit;
        $model = new ShopModel();
        $Oid = $model->getLastId('tbl_order', 'id' );
        if($Oid == ""){
            $tempId = 0;
        }else{
            $tempId = $Oid->id;
        }
        if($response['order_status'] == 'Aborted'){
            //cancel Url
            $data = array(
                'razorpay_order_id' => $response['tracking_id'],
                'razorpay_payment_id' => ($response['bank_ref_no']=="" || $response['bank_ref_no']== null ? "" : $response['bank_ref_no']),
                'payment_method' => 'online',
                'payment_status' => 'cancel-payment',
                'status' => 'aborted',
            );
        }else{
            $data = array(
                'razorpay_order_id' => $response['tracking_id'],
                'razorpay_payment_id' => $response['bank_ref_no'],
                'payment_method' => 'online',
                'payment_status' => $response['payment_mode'],
                'status' => 'new',
            );
            $data['invoice_id'] = "SOP".($tempId+1).time();
        }


        $sql = $model->update_data('tbl_order', array('order_id'=>$response['order_id']), $data);
        if($sql['code'] == 200){
            $model->update_data('tbl_order_item', array('order_id'=>$response['order_id']), array('is_active'=> '1', 'status'=> 'new'));
            $user = $model->getData('tbl_order', array('order_id' => $response['order_id']), 'first');
            $profile = $model->getData('tbl_client', array('id' => $user->client_id), 'first');
            if($response['order_status'] != 'Aborted'){
                $msg = "Thank you for placing an order with SONA Pure Essentials! ". "Your Order ID: " .$response['order_id']. " AMOUNT ". $user->total_amount. ". --- SPE";
                $tempId = 1607100000000229937;
                //echo $msg; exit;
                $this->sendSms($profile->mobile, $msg, $tempId);
                $this->sendInvoiceMail($response['order_id']);
                return redirect('thank-you/'.base64_encode($response['order_id']));
            }else{
                return redirect('/check-out/cancel-payment');
            }
        }
       // echo '<pre>'; print_r($response); exit;
    }

    public function search_result(){
        $model = new ShopModel();
        $data['title'] = "Sona Pure Essentials ";
        $data['meta'] = "";
        $data['type'] = $this->is_mobile();
        $data['nav'] = "search-result";
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        if(isset($_GET['keyword'])){
            $data['title'] = $_GET['keyword'];
            $data['meta'] = $_GET['keyword'];
            $data['filter'] = array(
                'keyword'    => trim($_GET['keyword']),
                'category'   => (trim($_GET['category']) !="" ? trim($_GET['category']) : ""),
            );
            //echo '<pre>'; print_r($data['product']); exit;
            $data['product'] = $model->searchProduct($data['filter']['keyword'], $data['filter']['category']);
        }
        return view('pages.search-product', $data);
    }

    public function get_size_price(Request $request){
        $post = $request->all();
        $sql = FunctionModel::getData('tbl_product_price', array('id'=> $post['id']), 'first');
        if($sql == ""){
            return json_encode(array('code'=> 300, 'msg'=> 'data not found'));
        }else{
            return json_encode(array('code'=> 200, 'data'=> $sql));
        }

    }

    public function getCartDetails(){
        $cart = Cart::instance('shopping')->content();
        if(count($cart) !=0) {
            $html = '';
            $total = 0;
            foreach ($cart as $row){
                $price = $row->price*$row->qty;
                $total = $total+$price;
                $html .= '<li class="clearfix">
                            <img src="'.($row->options->has('image') ? asset($row->options->image) : "") .'" alt="item1">
                            <span class="item-name">'. ucfirst($row->name) .'</span>

                            <span class="item-price">
                                <i class="fa fa-inr" aria-hidden="true"></i> '. number_format(($row->price*$row->qty),2) .'
                            </span>
                            <span class="item-quantity">Quantity: '.number_format($row->qty).'</span>
                         </li>';
            }
            return json_encode(array('code'=> 200, 'total'=> number_format($total), 'items'=>$html));
        }else{

        }
    }

    public function post_forgot_password(Request $request){
        $model = new ShopModel();
        $post = $request->all();
        $data['profile'] = $model->getData('tbl_client', array('email' => trim($post['email'])), 'first');
        if($data['profile'] !=""){
            $to_name = $data['profile']->first_name.' '.$data['profile']->last_name;
            $to_email = $data['profile']->email;
//            echo '<pre>';print_r($data['profile']->id);exit;
            $mail = Mail::send('mail.forget_password', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Sona Pure Essentials Forget Password');
                $message->from('support@sonapureessentials.com',' Sona Pure Essentials');
            });

            return json_encode(array('code' => 200, 'msg' => 'Please check register email send reset password link.'));

        }else{
            return json_encode(array('code'=> 400, 'msg'=> 'Please check email this email is not found.'));
        }
    }
   /* public function post_forgot_password(Request $request){
        $post = $request->all();
        $check = FunctionModel::getData('tbl_client', array('email'=> trim($post['email']), 'is_active'=> '1'), 'first');
        if($check !=""){
            $to_name = $check->first_name.' '.$check->last_name;
            $to_email = $check->email;
            $data['data'] = $check;

            $mail = Mail::send('mail.forget_password', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject(' Sona Pure Essentials  || Order Invoice');
                $message->from('support@sonapureessentials.com',' Sona Pure Essentials  || Send Invoice');
            });
            if ($mail) {
                return json_encode(array('code' => 200, 'msg' => 'Please check register email send reset password link.'));
            }else{
                return json_encode(array('code' => 400, 'msg' => 'email send getting Error.'));
            }
        }else{
            return json_encode(array('code'=> 400, 'msg'=> 'Please check email this email is not found.'));
        }


    }*/

    public function reset_password($id){
        $data['title'] = "Sona Pure Essentials  Reset Password";
        $data['meta'] = "Reset Password  Sona Pure Essentials ";
        $data['nav'] = "Forgot";
        $data['id'] = $id;
        $data['type'] = $this->is_mobile();
        $data['css'] = \Config::get('css');
        $data['js'] = \Config::get('js');
        return view('pages.reset_password', $data);
    }


    public function check_email(Request $request){
        $post = $request->all();
        $check = FunctionModel::getData('tbl_client', array('email'=> trim($post['email'])), 'first');
        if($check !=""){
            return json_encode(array('code'=>200, 'msg'=> 'Email verifyed.'));
        }else{
            return json_encode(array('code'=>400, 'msg'=> 'Check email this email not found'));
        }
    }

    public function post_reset_password(Request $request){
        $post = $request->all();
        $data = array(
            'password' => md5(trim($post['new_password'])),
            'salt_password' => base64_encode(trim($post['new_password'])),
        );
        $sql = FunctionModel::update_data('tbl_client', array('id'=> base64_decode($post['id'])), $data);
        if($sql['code'] == 200){
            Session::flash('success', 'Your password update successful..');
        }else{
            Session::flash('warning', 'Your password update getting error try after some time..');
        }
        return redirect('/signin');


    }
 public function send_mail(){
        $data = array('name'=> 'hello', 'email'=> 'test@gmail.com');
     echo '<pre>'; print_r($data); exit;
     $to_name= 'sona';
         $to_email= 'unosaleem@gmail.com';
     $mail = Mail::send('mail.forget_password', $data, function($message) use ($to_name, $to_email) {
         $message->to($to_email, $to_name)->subject(' Sona Pure Essentials  || Order Invoice');
         $message->from('no-reply@sonapureessentials.com',' Sona Pure Essentials  || Send Invoice');
     });

 }


}
