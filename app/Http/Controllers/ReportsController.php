<?php
namespace App\Http\Controllers;

use App\HomeModel;
use App\FunctionModel;
use Illuminate\Http\Request;
use App\ShopModel;
use Excel;
use Session;
use App\Exports\ReportsExports;

class ReportsController extends Controller{

    public function order_reports(){
        $url = url()->current();
        if(Session::has('admin')){
            $data['title'] = "Sona-Pure Reports";
            $data['nav']   = "order-reports";
            //echo '<pre>'; print_r($_GET); exit;
            if(isset($_GET['submit'])){
                $data['filter'] = array(
                    'date_validate' => trim($_GET['date_validate']),
                    'date_range'    => $_GET['date_range'],
                    'customer'      => $_GET['customer'],
                    'mobile'        => $_GET['mobile'],
                    'paid_status'   => $_GET['paid_status'],
                    'order_status'  => $_GET['order_status'],
                    'submit'        => $_GET['submit'],
                );
               $orwhere=array();
                $whereLike='';
                $where = array('tbl_order.is_active'=> '1');

                if($_GET['customer'] !=""){
                    $whereLike = $data['filter']['customer'];
                }

                if($_GET['customer'] !=""){
                    $orwhere['tbl_client.email']        = $data['filter']['customer'];
                    $orwhere['tbl_client.first_name']  = $data['filter']['customer'];
                    $orwhere['tbl_client.last_name']   = $data['filter']['customer'];
                }
                if($_GET['mobile'] !=""){
                    $where['tbl_order.mobile'] = $data['filter']['mobile'];
                }
//echo '<pre>';print_r($whereLike);exit;
                if($_GET['paid_status'] !=""){
                    $where['tbl_order.payment_status'] = $data['filter']['paid_status'];
                }
                if($_GET['paid_status'] !=""){
                    $where['tbl_order.status'] = $data['filter']['order_status'];
                }
                if($_GET['submit'] == "view"){
                    $data['data'] = ShopModel::orders($where, 'paginate', array('tbl_order.id'=> 'desc'), '', ($data['filter']['date_validate'] == "y" ? $data['filter']['date_range'] : ""), $orwhere, $whereLike);
                    return view('admin.reports.order-reports', $data);
                }elseif($_GET['submit'] == "download"){
                    $data['data'] = ShopModel::orders($where, 'get', array('tbl_order.id'=> 'desc'), '', ($data['filter']['date_validate'] == "y" ? $data['filter']['date_range'] : ""), $orwhere, $whereLike);
                    $product[0] = ['Id','Order Id','Order Date','Customer Name','Contact Number', 'Email','Shipping Address','Shipping Pin Code','Payment Status','Order Status','Tax Amount','Sub Total','Paid Amount', 'Courier Name', 'Awb Code'];
                    if(count($data['data']) !=0){
                        foreach ($data['data'] as $key=>$row){
                            $product[$key+1] = array(
                                'id'                => $key+1,
                                'order_id'          => $row->order_id,
                                'order_date'        => date('F d, Y', strtotime($row->date_time)),
                                'customer_name'     => ucfirst($row->first_name).' '.ucfirst($row->last_name),
                                'contact_number'    => $row->mobile,
                                'email'             => $row->email,
                                'shipping_address'  => $row->shipping_locality.', '.$row->shipping_city.', '.$row->shipping_state,
                                'shipping_pin_code' => $row->shipping_post_code,
                                'payment_status'    => ($row->payment_status == "Done" ? "Payed" : "Cod"),
                                'order_status'      => ucfirst($row->status),
                                'tax_amount'        => number_format($row->gst, 2),
                                'sub_total'         => number_format($row->sub_total, 2),
                                'payed_amount'      => number_format($row->total_amount, 2),
                                'courier_name'      => $row->courier_name,
                                'awb_code'          => $row->awb_code
                            );
                        }
                    }
                    $export = new ReportsExports([$product]);
                    //echo '<pre>'; print_r($export); exit;
                    $path = '/reports/'.date('d-m-Y h:m', time()).'-order-reports.xlsx';
                    $status = Excel::store($export, $path);
                    if($status == 1){
                        echo '<a href="'.url('storage/app'.$path).'" download>Click Here</a> <br/>';
                        echo '<a href="'.url('admin/reports/order-reports').'" >Back</a>';
                    }
                    //return response()->file( $csv );
                    //return Excel::download($export, $path);
                   //echo response()->download("storage/app/".$path);
                }

            }else{
                return view('admin.reports.order-reports', $data);
            }
            //echo '<pre>'; print_r($data); exit;
            //$data['data'] = $model->orders(array('tbl_order.is_active'=>'1', 'tbl_order.status'=> 'new'), 'paginate');

        }else{
            return redirect('/dash?url='.$url);
        }
    }

    public function customer_reports(){
        $url = url()->current();
        if(Session::has('admin')){
            $data['title'] = "Sona-Pure Reports";
            $data['nav']   = "customer-reports";
            //echo '<pre>'; print_r($_GET); exit;
            if(isset($_GET['submit'])){
                $data['filter'] = array(
                    'date_validate' => trim($_GET['date_validate']),
                    'date_range'    => trim($_GET['date_range']),
                    'customer'      => trim($_GET['customer']),
                    'submit'        => trim($_GET['submit']),
                );
                $where = array('tbl_client.is_active'=> '1');
                if($_GET['customer'] !=""){
                    $where['tbl_client.mobile'] = $data['filter']['customer'];
                }

                if($_GET['submit'] == "view"){
                    $data['data'] = ShopModel::CustomerDetails($where, 'paginate', array('tbl_client.id'=> 'desc'), 'y', ($data['filter']['date_validate'] == "y" ? $data['filter']['date_range'] : ""));
                    //echo '<pre>'; print_r($data['data']); exit;
                    return view('admin.reports.customer-reports', $data);
                }elseif($_GET['submit'] == "download"){
                    $data['data'] = ShopModel::CustomerDetails($where, 'get', array('tbl_client.id'=> 'desc'), 'y', ($data['filter']['date_validate'] == "y" ? $data['filter']['date_range'] : ""));
                    $product[0] = ['Id', 'Customer Name', 'Contact Mobile', 'Email', 'Gender', 'DOB', 'Order Count', 'Status', 'Join Date'];
                    if(count($data['data']) !=0){
                        foreach ($data['data'] as $key=>$row){
                            $product[$key+1] = array(
                                'id'                => $key+1,
                                'customer_name'     => ucfirst($row->first_name).' '.ucfirst($row->last_name),
                                'contact_number'    => $row->mobile,
                                'email'             => $row->email,
                                'gender'            => ucfirst($row->gender),
                                'dob'               => ($row->dob == "" ? date('F d, Y', strtotime($row->dob)) : ""),
                                'order_count'       => $row->count_orders,
                                'status'            => ($row->is_active == "1" ? "Active" : "Non-Active"),
                                'join_date'         => date('F d, Y', strtotime($row->date_time))
                            );
                        }
                    }
                    $export = new ReportsExports([$product]);
                    //echo '<pre>'; print_r($export); exit;
                    $path = '/reports/'.date('d-m-Y h:m', time()).'-customer-reports.xlsx';
                    $status = Excel::store($export, $path);
                    if($status == 1){
                        echo '<a href="'.url('storage/app'.$path).'" download>Click Here</a> <br/>';
                        echo '<a href="'.url('admin/reports/customer-reports').'" >Back</a>';
                    }
                    //return response()->file( $csv );
                    //return Excel::download($export, $path);
                    //echo response()->download("storage/app/".$path);
                }

            }else{
                return view('admin.reports.customer-reports', $data);
            }
            //echo '<pre>'; print_r($data); exit;
            //$data['data'] = $model->orders(array('tbl_order.is_active'=>'1', 'tbl_order.status'=> 'new'), 'paginate');

        }else{
            return redirect('/dash?url='.$url);
        }
    }

}
