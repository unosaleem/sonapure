@extends('layout.home_master')
@section('css')
    <link type="text/css" rel="stylesheet" href="{!! asset('assets') !!}/css/dashboard-style.css">
    <link type="text/css" rel="stylesheet" href="{!! asset('assets') !!}/css/payment-style.css">
    <style>
        tr {vertical-align: middle;}
        .btn{padding:5px 16px;margin:5px;text-transform:capitalize;font-family:cursive}table.product-table td{padding:5px 8px}.btn-primary{border-color:#0d6efd;background-color:#0d6efd;color:#fff}.btn-primary:hover{border-color:#ec3059;background-color:#ec3059;color:#fff}.card-header h4{color:#fff}.card-header{padding:.5rem 1rem;margin-bottom:0;background-color:rgb(0 103 56);border-bottom:1px solid rgba(0,0,0,.125);color:#fff}
        .header-dropdown:hover .dropdown-menu{display: block !important; /*left: -150px !important;*/ right: 0px !important;}.dropdown-menu a{padding-left: 15px} .header-dropdown.dropdown-toggle::after{display: none !important;}.dropdown-toggle::after{display: none;}
        .card-box{background-color:#fff;background-clip:border-box;border:1px solid #e7eaed;padding:1.5rem;margin-bottom:24px;border-radius:.25rem}.avatar-xl{height:20rem;width:20rem;outline:0}.rounded-circle{border-radius:50%!important}.nav-pills .nav-link.active,.nav-pills .show>.nav-link{color:#fff;background-color:#1abc9c}.nav-pills .nav-link{border-radius:.25rem}.navtab-bg li>a{background-color:#f7f7f7;margin:0 5px}.nav-pills>li>a,.nav-tabs>li>a{color:#6c757d;font-weight:600}.mb-4,.my-4{margin-bottom:2.25rem!important}.tab-content{padding:20px 0 0 0}.progress-sm{height:5px}.m-0{margin:0!important}.table .thead-light th{color:#6c757d;background-color:#f1f5f7;border-color:#dee2e6}.social-list-item{height:2rem;width:2rem;line-height:calc(2rem - 4px);display:block;border:2px solid #adb5bd;border-radius:50%;color:#adb5bd}.text-purple{color:#6559cc!important}.border-purple{border-color:#6559cc!important}.timeline{margin-bottom:50px;position:relative}.timeline:before{background-color:#dee2e6;bottom:0;content:"";left:50%;position:absolute;top:30px;width:2px;z-index:0}.timeline .time-show{margin-bottom:30px;margin-top:30px;position:relative}.timeline .timeline-box{background:#fff;display:block;margin:15px 0;position:relative;padding:20px}.timeline .timeline-album{margin-top:12px}.timeline .timeline-album a{display:inline-block;margin-right:5px}.timeline .timeline-album img{height:36px;width:auto;border-radius:3px}@media (min-width:768px){.timeline .time-show{margin-right:-69px;text-align:right}.timeline .timeline-box{margin-left:45px}.timeline .timeline-icon{background:#dee2e6;border-radius:50%;display:block;height:20px;left:-54px;margin-top:-10px;position:absolute;text-align:center;top:50%;width:20px}.timeline .timeline-icon i{color:#98a6ad;font-size:13px;position:absolute;left:4px}.timeline .timeline-desk{display:table-cell;vertical-align:top;width:50%}.timeline-item{display:table-row}.timeline-item:before{content:"";display:block;width:50%}.timeline-item .timeline-desk .arrow{border-bottom:12px solid transparent;border-right:12px solid #fff!important;border-top:12px solid transparent;display:block;height:0;left:-12px;margin-top:-12px;position:absolute;top:50%;width:0}.timeline-item.timeline-item-left:after{content:"";display:block;width:50%}.timeline-item.timeline-item-left .timeline-desk .arrow-alt{border-bottom:12px solid transparent;border-left:12px solid #fff!important;border-top:12px solid transparent;display:block;height:0;left:auto;margin-top:-12px;position:absolute;right:-12px;top:50%;width:0}.timeline-item.timeline-item-left .timeline-desk .album{float:right;margin-top:20px}.timeline-item.timeline-item-left .timeline-desk .album a{float:right;margin-left:5px}.timeline-item.timeline-item-left .timeline-icon{left:auto;right:-56px}.timeline-item.timeline-item-left:before{display:none}.timeline-item.timeline-item-left .timeline-box{margin-right:45px;margin-left:0;text-align:right}}@media (max-width:767.98px){.timeline .time-show{text-align:center;position:relative}.timeline .timeline-icon{display:none}}.timeline-sm{padding-left:110px}.timeline-sm .timeline-sm-item{position:relative;padding-bottom:20px;padding-left:40px;border-left:2px solid #dee2e6}.timeline-sm .timeline-sm-item:after{content:"";display:block;position:absolute;top:3px;left:-7px;width:12px;height:12px;border-radius:50%;background:#fff;border:2px solid #f37d8a}.timeline-sm .timeline-sm-item .timeline-sm-date{position:absolute;left:-104px}@media (max-width:420px){.timeline-sm{padding-left:0}.timeline-sm .timeline-sm-date{position:relative!important;display:block;left:0!important;margin-bottom:10px}}
    </style>
@stop
@section('body')
    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="assets/images/bg/page-title-1.webp" style="padding-bottom: 0;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title">
                        <h1 class="title">Order Details</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/my-profile/order-history')}}">Order History</a></li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->
    <div class="clearfix"></div>
    <section>
        <div class="container theme-container">
            <div class="row mb-4">
                <div class="col-lg-3 col-xl-3">
                    @include('client.include.nav_client')
                </div>
                <!-- end col-->

                <div class="col-lg-9 col-xl-9">
                    <div class="card-boxs ">
                        <div class="tab-contents">
                            <div class="tab-pane active" id="about-me">
                                @include('include.flash-msg')
                                <section class="section shadow">
                                    <article  class="container theme-container">
                                        <div class="row">
                                            <div class="col-md-6 p-3">
                                                <div class="card green-border light-bg" style="padding:10px 10px 10px 10px; ">
                                                    <div class="card-header">
                                                        <h4>Shipping Details </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <ul>
                                                            <li><strong>Customer Name : </strong> {!! ucfirst($order->first_name).' '.ucfirst($order->last_name) !!}</li>
                                                            <li><strong>Contact Number : </strong> {!! $order->mobile !!}</li>
                                                            <li><strong>E-mail : </strong> {!! $order->email !!}</li>
                                                            <li><strong>Shipping Address : </strong> {!! $order->shipping_address.', '.$order->shipping_district.', '.$order->shipping_city.', '.$order->shipping_state.','.$order->shipping_post_code !!}</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6 p-3">
                                                <div class="card green-border light-bg" style="padding:10px 10px 10px 10px; ">
                                                    <div class="card-header">
                                                        <h4>Order Details</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <ul>
                                                            <li><strong>Order Number : </strong> {!! ucfirst($order->order_id) !!}</li>
                                                            <li><strong>Order Date : </strong> {!! date('d-m-Y', strtotime($order->date_time)) !!}</li>
                                                            <li><strong>Payment Method : </strong> {!! ucfirst($order->payment_method) !!}</li>
                                                            <li>
                                                                <strong>Other Info : </strong>
                                                                <a class="hintT-left p-1" data-hint="Download Invoice" href="{{url('/my-profile/invoice', base64_encode($order->order_id))}}"><img width="35"  src="{{asset('assets')}}/images/pdf.png" alt=""></a>
                                                                @if($order->status == "shipments")
                                                                    <a class="hintT-right p-1" data-hint="Order Tracking" href="{{url('/my-profile/order-tracking', array(base64_encode($data['awbNo']), base64_encode($order->order_id)))}}"><img width="35"  src="{{asset('assets')}}/images/Order.png" alt=""></a>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="card green-border light-bg" style="padding:10px 10px 10px 10px; ">
                                                    <div class="card-header">
                                                        <h4>Order Product Details</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="light-bg default-box-shadow table-responsive">
                                                            <table class="cart-wishlist-table inventory table product-table">
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th class="name" colspan="2">Product</th>
                                                                    <th class="price">tax</th>
                                                                    <th class="quantity">Tax Amount</th>
                                                                    <th class="subtotal">Total Amount</th>
                                                                    <th class="subtotal">Status</th>

                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                    $tax = 0;
                                                                @endphp
                                                                @if(count($order_item)!=0)
                                                                    @foreach($order_item as $key=>$row)
                                                                        @php
                                                                            $tax = $tax+$row->tax_amount;
                                                                        @endphp
                                                                        <tr>
                                                                            <td class="m-0"><span >{!! $key+1 !!}</span></td>
                                                                            {{--                                                                        <td class="thumbnail">--}}
                                                                            {{--                                                                            <a href="#"><img src="{!! asset($product->header_image)  !!}" alt="{!! $row->name !!}"></a>--}}
                                                                            {{--                                                                        </td>--}}
                                                                            <td  class="thumbnail m-0"><img src="{!! URL::asset($row->product_image) !!}" width="50" alt=""></td>
                                                                            <td  class="name m-0">
                                                                                <a href="#">
                                                                                    <span >{!! ucfirst($row->product_name) !!}</span>
                                                                                    <span> {!! $row->sku_number !!}</span>
                                                                                </a>
                                                                            </td>

                                                                            <td class="quantity text-center m-0">
                                                                                <div class="quantity buttons-add-minus text-center">
                                                                                    <span >{!! number_format($row->qty) !!}  x &#x20B9; {!! number_format(($row->total_price-$row->tax_amount)/$row->qty, 2) !!}</span>
                                                                                </div>
                                                                            </td>
                                                                            <td class="price p-2 text-right m-0"><span class="text-left float-left i-block d-sm-none">Tax Amount:</span><span>{!! number_format($row->tax_amount, 2) !!}</span></td>

                                                                            <td class="subtotal p-2 bg-pink text-right m-0"  ><span class="text-left float-left i-block d-sm-none">Total:</span><span> {!! number_format($row->total_price, 2) !!}</span></td>
                                                                            <td class="subtotal p-2 m-0 text-right" style="background: #88c251;color: white;text-align: center;vertical-align: middle;"><span class="text-left float-left i-block d-sm-none">Status: </span><span>{!! ucfirst($row->status) !!} </span></td>

                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </section>
                            </div>
                            <!-- end settings content-->
                        </div>
                        <!-- end tab-content -->
                    </div>
                    <!-- end card-box-->
                </div>
                <!-- end col -->
            </div>
        </div>
    </section>
    <div class="clearfix"></div>

@stop
@section('js')
    <script type="text/javascript">
        $("input[type='image']").click(function() {
            $("input[id='my_file']").click();
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("input[type='image']").attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("input[id='my_file']").change(function() {
            readURL(this);
        });
    </script>
@stop


