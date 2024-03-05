<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoginModel;
use App\FunctionModel;
use App\ShopModel;
use Session;

class LoginController extends Controller
{
    //
    public function login(){
        if(Session::has('admin')){
            return redirect('admin/dashboard');
        }else{
            $data['title'] = "Sonapure essentials | Admin";
            $data['nav'] = 'login';
            return view('admin.login.admin_login', $data);
        }
    }

    public function login_auth(Request $request){
        if(Session::has('admin')){
            return redirect('/dash');
        }else{
            $request->validate([
                'email'          => 'required',
                'password'       => 'required',

            ],[
                'email.required' => 'Email is required',
                'password.required' => 'Password is required',
            ]);
            $post = $request->all();

            $sql = LoginModel::loginAuth(array('tbl_login.email'=> trim($post['email']), 'tbl_login.password'=>trim(md5($post['password'])), 'tbl_login.is_active'=>'1'), 'first');
            //echo '<pre>'; print_r($sql); exit;
            if($sql !=""){
                //put session
                $data = (array)$sql;
                Session::put('admin', $data);
                return redirect('/dash');
            }else{
                Session::flash('error', 'Try again email and password not match.');
                return redirect('/dash');
            }
        }
    }

    public function dashboard(){
        if(Session::has('admin')){
            //$model = new ShopModel;
            $data['title'] = "Sonapure essentials | Admin";
            $data['nav'] = 'home';
            if(isset($_GET['date'])){
                $data['order'] = array(
                        'total_earning'=> ShopModel::getSum('tbl_order', array('status'=> 'deliver', 'is_active'=>'3'), 'total_amount', $_GET['date']),
                        'total_delivery'=> ShopModel::orders(array('tbl_order.status'=> 'deliver', 'tbl_order.is_active'=>'3'), 'count', '', '', $_GET['date']),
                        'total_customer'=> ShopModel::getData('tbl_client', array('is_active'=>'1'), 'count', '', '', $_GET['date']),
                        'total_order'=> ShopModel::getData('tbl_order', array('is_active'=>'1'), 'count', '', '', $_GET['date'])
                    );
            }else{
                $date = date('Y-m-d', strtotime('-30Days')).' to '.date('Y-m-d', time());
                $data['order'] = array(
                        'total_earning'=> ShopModel::getSum('tbl_order', array('status'=> 'deliver', 'is_active'=>'3'), 'total_amount', $date),
                        'total_delivery'=> ShopModel::orders(array('tbl_order.status'=> 'deliver', 'tbl_order.is_active'=>'3'), 'count', '', '', $date),
                        'total_customer'=> ShopModel::getData('tbl_client', array('is_active'=>'1'), 'count', '', '', $date),
                        'total_order'=> ShopModel::getData('tbl_order', array('is_active'=>'1'), 'count', '', '', $date)
                    );
            }
            $data['resent_orders'] = ShopModel::recent_order('', 'paginate', array('tbl_order_item.id'=> 'Desc'));
            //echo '<pre>'; print_r($data); exit;
            $data['order_map'] = '';
            return view('admin.admin.admin_dashboard', $data);
        }else{
            return redirect('/dash');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/dash');
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
}
