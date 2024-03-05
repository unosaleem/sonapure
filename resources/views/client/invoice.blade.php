@extends('layout.home_master')
@section('css')
    <style>
        h1{font:bold 100% sans-serif;letter-spacing:.5em;text-align:center;text-transform:uppercase}table{font-size:75%;table-layout:fixed;width:100%}table{border-collapse:separate;border-spacing:2px}td,th{border-width:1px;padding:.5em;position:relative;text-align:left}td,th{border-radius:.25em;border-style:solid}th{background:#eee;border-color:#bbb}td{border-color:#ddd}headers{margin:0 0 3em}headers:after{clear:both;content:"";display:table}headers h1{background:#006738;border-radius:.25em;color:#fff;margin:0 0 1em;padding:.5em 0}headers address{float:left;font-size:95%;font-style:normal;line-height:1.25;margin:0 1em 2.5em 0}article address.norm h4{font-size:125%;font-weight:700}article address.norm{float:left;font-size:95%;font-style:normal;font-weight:400;line-height:.5;margin:0 1em 1em 0}headers address p{margin:0 0 .25em}headers img,headers span{display:block;float:right}headers span{margin:0 0 1em 1em;max-height:25%;max-width:60%;position:relative}headers img{max-height:100%;max-width:100%}headers input{cursor:pointer;height:100%;left:0;opacity:0;position:absolute;top:0;width:100%}article,article address,table.inventory,table.meta{margin:0 0 3em}article:after{clear:both;content:"";display:table}article h1{clip:rect(0 0 0 0);position:absolute}article address{float:left;font-size:125%;font-weight:700}table.balance,table.meta{float:right;width:36%}table.balance:after,table.meta:after{clear:both;content:"";display:table}table.meta th{width:40%}table.meta td{width:60%}table.inventory{clear:both;width:100%}table.inventory th:first-child{width:50px}table.inventory th:nth-child(2){width:300px}table.inventory th{font-weight:700;text-align:center}table.inventory td:nth-child(1){width:26%}table.inventory td:nth-child(2){width:38%}table.inventory td:nth-child(3){text-align:right;width:12%}table.inventory td:nth-child(4){text-align:right;width:12%}table.inventory td:nth-child(5){text-align:right;width:12%}table.balance td,table.balance th{width:50%}table.balance td{text-align:right}aside h1{border:none;border-width:0 0 1px;margin:0 0 1em}aside h1{border-color:#999;border-bottom-style:solid}table.sign{float:left;width:220px}table.sign img{width:100%}table.sign tr td{border-color:transparent}@media print{*{-webkit-print-color-adjust:exact}html{background:0 0;padding:0}body{box-shadow:none;margin:0}span:empty{display:none}.add,.cut{display:none}}.cart-wishlist-table tbody tr td{padding:12px 10px 12px 20px;vertical-align:middle;border-color:#ededed}@page{margin:0}
    </style>
    <style>.card-box{background-color:#fff;background-clip:border-box;border:1px solid #e7eaed;padding:1.5rem;margin-bottom:24px;border-radius:.25rem}.avatar-xl{height:20rem;width:20rem;outline:0}.rounded-circle{border-radius:50%!important}.nav-pills .nav-link.active,.nav-pills .show>.nav-link{color:#fff;background-color:#1abc9c}.nav-pills .nav-link{border-radius:.25rem}.navtab-bg li>a{background-color:#f7f7f7;margin:0 5px}.nav-pills>li>a,.nav-tabs>li>a{color:#6c757d;font-weight:600}.mb-4,.my-4{margin-bottom:2.25rem!important}.tab-content{padding:20px 0 0 0}.progress-sm{height:5px}.m-0{margin:0!important}.table .thead-light th{color:#6c757d;background-color:#f1f5f7;border-color:#dee2e6}.social-list-item{height:2rem;width:2rem;line-height:calc(2rem - 4px);display:block;border:2px solid #adb5bd;border-radius:50%;color:#adb5bd}.text-purple{color:#6559cc!important}.border-purple{border-color:#6559cc!important}.timeline{margin-bottom:50px;position:relative}.timeline:before{background-color:#dee2e6;bottom:0;content:"";left:50%;position:absolute;top:30px;width:2px;z-index:0}.timeline .time-show{margin-bottom:30px;margin-top:30px;position:relative}.timeline .timeline-box{background:#fff;display:block;margin:15px 0;position:relative;padding:20px}.timeline .timeline-album{margin-top:12px}.timeline .timeline-album a{display:inline-block;margin-right:5px}.timeline .timeline-album img{height:36px;width:auto;border-radius:3px}@media (min-width:768px){.timeline .time-show{margin-right:-69px;text-align:right}.timeline .timeline-box{margin-left:45px}.timeline .timeline-icon{background:#dee2e6;border-radius:50%;display:block;height:20px;left:-54px;margin-top:-10px;position:absolute;text-align:center;top:50%;width:20px}.timeline .timeline-icon i{color:#98a6ad;font-size:13px;position:absolute;left:4px}.timeline .timeline-desk{display:table-cell;vertical-align:top;width:50%}.timeline-item{display:table-row}.timeline-item:before{content:"";display:block;width:50%}.timeline-item .timeline-desk .arrow{border-bottom:12px solid transparent;border-right:12px solid #fff!important;border-top:12px solid transparent;display:block;height:0;left:-12px;margin-top:-12px;position:absolute;top:50%;width:0}.timeline-item.timeline-item-left:after{content:"";display:block;width:50%}.timeline-item.timeline-item-left .timeline-desk .arrow-alt{border-bottom:12px solid transparent;border-left:12px solid #fff!important;border-top:12px solid transparent;display:block;height:0;left:auto;margin-top:-12px;position:absolute;right:-12px;top:50%;width:0}.timeline-item.timeline-item-left .timeline-desk .album{float:right;margin-top:20px}.timeline-item.timeline-item-left .timeline-desk .album a{float:right;margin-left:5px}.timeline-item.timeline-item-left .timeline-icon{left:auto;right:-56px}.timeline-item.timeline-item-left:before{display:none}.timeline-item.timeline-item-left .timeline-box{margin-right:45px;margin-left:0;text-align:right}}@media (max-width:767.98px){.timeline .time-show{text-align:center;position:relative}.timeline .timeline-icon{display:none}}.timeline-sm{padding-left:110px}.timeline-sm .timeline-sm-item{position:relative;padding-bottom:20px;padding-left:40px;border-left:2px solid #dee2e6}.timeline-sm .timeline-sm-item:after{content:"";display:block;position:absolute;top:3px;left:-7px;width:12px;height:12px;border-radius:50%;background:#fff;border:2px solid #f37d8a}.timeline-sm .timeline-sm-item .timeline-sm-date{position:absolute;left:-104px}@media (max-width:420px){.timeline-sm{padding-left:0}.timeline-sm .timeline-sm-date{position:relative!important;display:block;left:0!important;margin-bottom:10px}}</style>
@stop
@section('body')

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="assets/images/bg/page-title-1.webp" style="padding-bottom: 0;">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">My Invoice</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}}">Home</a></li>
                            <li class="breadcrumb-item active">My Invoice</li>
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
            <div class="row">
                <div class="col-lg-3 col-xl-3">
                    @include('client.include.nav_client')
                    <!-- end card-box -->
                </div>
                <!-- end col-->

                <div class="col-lg-9 col-xl-9">
                    <div class="card-boxs">
                        <div class="tab-contents">
                            <div class="tab-pane active" id="about-me">
                                @include('include.flash-msg')
                                <section class="section ">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="shadow-lg p-3">
                                                    <headers>
                                                        <h1>Invoice</h1>
                                                        <address >
                                                            <p> Email : contact@bhaavyakapur.com </p>
                                                            <p> Address : 1/1, Gokhle Marg, Opposite Red Hill School </p>
                                                            <p> Lucknow, Uttar Pradesh 226001</p>
                                                            <p> Contact-Number : +91-8881888794 </p>
                                                            <p> GSTN : 09AAFCB9247C1ZN </p>
                                                        </address>
                                                        <span><img alt="it" src="{{asset('assets')}}/images/logo.png" width="70"></span>
                                                    </headers>
                                                    <div class="row">
                                                        <h1>Recipient</h1>
                                                        <div class="col-md-6">
                                                            <address class="norms">
                                                                <h4>{!! ucfirst($order->client_first_name).' '.ucfirst($order->client_last_name) !!}</h4>
                                                                <p class="p-0 m-0"> {!! ucfirst($order->client_email) !!} <br>
                                                                <p class="p-0 m-0"> {!! ucfirst($order->address).($order->address1 != " ".$order->address1 ? "" : "") !!} <br>
                                                                <p class="p-0 m-0"> {!! ucfirst($order->city).' '.$order->post_code.','.ucfirst($order->country) !!} <br>
                                                                <p class="p-0 m-0"> Phone: {!! $order->mobile !!}</p>
                                                            </address>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <table class="metas" style="margin: 0 0 3em;">
                                                                <tr>
                                                                    <th><span >Invoice #</span></th>
                                                                    <td><span >{!! $order->invoice_id !!}</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <th><span >Order Id #</span></th>
                                                                    <td><span >{!! $order->order_id !!}</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <th><span>Date</span></th>
                                                                    <td><span>{!! date('d-m-Y', strtotime($order->date_time)) !!}</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <th><span>Total Amount</span></th>
                                                                    <td><span id="prefix" >&#x20B9; </span><span>{!! number_format($order->total_amount, 2) !!}</span></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <article>

                                                        <table class="cart-wishlist-table inventory table product-table">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th class="name" colspan="2">Product</th>
                                                                <th class="price">Price</th>
                                                                <th class="quantity">Quantity</th>
                                                                <th class="quantity">Tax Amount</th>
                                                                <th class="subtotal">Total</th>

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
                                                                        <td colspan="2" class="name m-0">
                                                                            <a href="#">
                                                                                <span >{!! $row->product_name !!}</span>
                                                                                <span> {!! $row->sku_number !!}</span>
                                                                            </a>
                                                                        </td>
                                                                        <td class="price m-0"><span class="text-left float-left i-block d-sm-none">Price:</span><span>{!! $row->price !!}</span></td>
                                                                        <td class="quantity text-center m-0">
                                                                            <div class="quantity buttons-add-minus text-center">
                                                                                <span >{!! $row->qty !!} x {!! number_format(($row->total_price-$row->tax_amount)/$row->qty, 2) !!}</span>
                                                                            </div>
                                                                        </td>

                                                                        <td class="subtotal m-0"  ><span class="text-left float-left i-block d-sm-none">Tax Amount:</span><span> {!! number_format($tax, 2) !!}</span></td>
                                                                        <td class="subtotal  bg-pink m-0 " style="background: #aeb4b7 ;color: white"><span class="text-left float-left i-block d-sm-none">Total: </span><span>{!! number_format($row->total_price) !!}</span></td>

                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                            </tbody>
                                                        </table>

                                                        <div class="row align-items-center">
                                                            <div class="col-md-7 order-lg-last  order-xs-first">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td class="text-center" align="center"><img src="{!! asset('assets/signature.png') !!}" alt="sdd"></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="col-md-5 order-lg-first order-xs-last">
                                                                <table width="100%" class="balances">
                                                                    <tr>
                                                                        <th><span>Sub Total</span></th>
                                                                        <td><span data-prefix>&#x20B9;</span><span>{!! number_format($order->sub_total, 2) !!}</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><span>Tax</span></th>
                                                                        <td><span data-prefix>&#x20B9;</span><span>{!! number_format($tax, 2) !!}</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><span>Delivery Charge</span></th>
                                                                        <td><span data-prefix>&#x20B9;</span><span>{!! number_format(50, 2) !!}</span></td>
                                                                    </tr>
                                                                    @if($order->coupon_amount !=0)
                                                                        <tr>
                                                                            <th><span>Saving</span></th>
                                                                            <td><span data-prefix>&#x20B9;</span><span>{!! number_format($order->coupon_amount, 2) !!}</span></td>
                                                                        </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <th><span>Total</span></th>
                                                                        <td><span data-prefix>&#x20B9;</span><span>{!! number_format($order->total_amount, 2) !!}</span></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>


                                                    </article>
                                                    <aside>
                                                        <h1><span >Additional Notes</span></h1>
                                                        <div >
                                                            <p>We offer limited 10 days refund policy and 30 days workmanship warranty on all of our services. For more details, please read our refund policy below.</p>
                                                        </div>
                                                    </aside>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

