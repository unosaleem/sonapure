@extends('layout.home_master')
@section('css')
<link type="text/css" rel="stylesheet" href="{!! asset('assets') !!}/css/payment-style.css">
<style>
.modal-backdrop {
    z-index: -1;
}
.modal-box {
}
.modal-box .show-modal {
}
.modal-box .show-modal:hover, .modal-box .show-modal:focus {
}
.modal-backdrop.in {
    opacity: 0;
}
.modal-box .modal-dialog {
    margin: 70px auto 0;
}
.modal.fade .modal-dialog {
    transform: translateX(0px);
    transition: all 400ms cubic-bezier(.47, 1.64, .41, .8);
}
.modal.in .modal-dialog {
    transform: translateX(0);
}
.modal-box .modal-dialog .modal-content {
    background: #fff;
    text-align: center;
    border: none;
}
.modal-box .modal-dialog .modal-content .close {
    color: #ffffff;
    font-size: 30px;
    line-height: 15px;
    opacity: 1;
    position: absolute;
    left: auto;
    top: 30px;
    right: 25px;
    z-index: 1;
    transition: all 0.3s;
}
.modal-box .modal-dialog .modal-content .close span {
    margin: -2px 0 0 0;
    display: block;
}
.modal-content .close:hover {
    color: #1eaaf1;
}
.modal-box .modal-dialog .modal-content .modal-body {
    padding: 10px;
}
.steps .step {
    display: block;
    width: 100%;
    margin-bottom: 35px;
    text-align: center
}
.steps .step span {
    color: #606975;
    font-size: 13px;
    line-height: 18px;
    display: block;
    margin: 5px 0px;
}
.steps .step .step-icon-wrap {
    display: block;
    position: relative;
    width: 100%;
    height: 80px;
    text-align: center
}
.steps .step .step-icon-wrap::before, .steps .step .step-icon-wrap::after {
    display: block;
    position: absolute;
    top: 50%;
    width: 50%;
    height: 3px;
    margin-top: -1px;
    background-color: #e1e7ec;
    content: '';
    z-index: 1
}
.steps .step .step-icon-wrap::before {
    left: 0
}
.steps .step .step-icon-wrap::after {
    right: 0
}
.steps .step .step-icon {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    border: 1px solid #e1e7ec;
    border-radius: 50%;
    background-color: #f5f5f5;
    color: #374250;
    font-size: 28px;
    line-height: 80px;
    z-index: 5;
}
.steps .step .step-title {
    margin-top: 16px;
    margin-bottom: 0;
    color: #343a40;
    font-size: 15px;
    font-weight: 600;
}
.steps .step:first-child .step-icon-wrap::before {
    display: none
}
.steps .step:last-child .step-icon-wrap::after {
    display: none
}
.steps .step.completed .step-icon-wrap::before, .steps .step.completed .step-icon-wrap::after {
    background-color: #4caf50
}
.steps .step.completed .step-icon {
    border-color: #4caf50;
    background-color: #4caf50;
    color: #fff;
}

@media (max-width: 576px) {
.flex-sm-nowrap .step .step-icon-wrap::before, .flex-sm-nowrap .step .step-icon-wrap::after {
    display: none
}
}

@media (max-width: 768px) {
.flex-md-nowrap .step .step-icon-wrap::before, .flex-md-nowrap .step .step-icon-wrap::after {
    display: none
}
}

@media (max-width: 991px) {
.flex-lg-nowrap .step .step-icon-wrap::before, .flex-lg-nowrap .step .step-icon-wrap::after {
    display: none
}
}

@media (max-width: 1200px) {
.flex-xl-nowrap .step .step-icon-wrap::before, .flex-xl-nowrap .step .step-icon-wrap::after {
    display: none
}
}
.bg-faded, .bg-secondary {
    background-color: #f5f5f5 !important;
}
</style>
@stop
@section('body')
    <div class="inner-grid"></div>
    <section class="pay-grid">
        <div class="container">
            <h5 class="header-title">{!! Session::get('client')['first_name'].' '.Session::get('client')['last_name'] !!}</h5>
            <div class="row">
                @include('client.include.nav_client')
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="header-title">My Order History</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="accordion-container">
                                @if(count($order) !=0)
                                    @foreach($order as $key=>$row)
                                        @php
                                            $order_item = \App\Shopmodel::order_items(array('tbl_order_item.order_id'=> $row->order_id), 'get');
                                        @endphp

                                        <div class="set">
                                            <a href="javascript:void(0)" class="{!! $key==0 ? "active" : "" !!}">
                                                @php
                                                    switch($row->status){
                                                        case "new":
                                                            echo '<span class="text-info order-circle"> <svg class="svg-icon circle-check" style="fill: currentColor;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M512 99.49184a399.03232 399.03232 0 1 0 399.03232 399.03232A399.48288 399.48288 0 0 0 512 99.49184z m0 553.65632a154.624 154.624 0 1 1 98.01728-273.94048l-118.784 93.10208a33.42336 33.42336 0 0 0 20.84864 59.8016 36.864 36.864 0 0 0 12.98432-3.15392 28.672 28.672 0 0 0 6.79936-3.85024L651.264 431.7184a152.61696 152.61696 0 0 1 15.31904 66.80576A154.78784 154.78784 0 0 1 512 653.14816z m151.552-316.04736a221.51168 221.51168 0 1 0 41.3696 52.55168l87.2448-68.32128a333.53728 333.53728 0 1 1-41.32864-52.59264z"  /></svg>  Order Process</span>';
                                                        break;
                                                        case "process":
                                                            echo '<span class="text-warning order-circle">
                                                                    <svg class="svg-icon circle-check" style="fill: currentColor;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M512 99.49184a399.03232 399.03232 0 1 0 399.03232 399.03232A399.48288 399.48288 0 0 0 512 99.49184z m0 553.65632a154.624 154.624 0 1 1 98.01728-273.94048l-118.784 93.10208a33.42336 33.42336 0 0 0 20.84864 59.8016 36.864 36.864 0 0 0 12.98432-3.15392 28.672 28.672 0 0 0 6.79936-3.85024L651.264 431.7184a152.61696 152.61696 0 0 1 15.31904 66.80576A154.78784 154.78784 0 0 1 512 653.14816z m151.552-316.04736a221.51168 221.51168 0 1 0 41.3696 52.55168l87.2448-68.32128a333.53728 333.53728 0 1 1-41.32864-52.59264z"  /></svg>
                                                                    Order Dispatched
                                                                </span>';
                                                        break;
                                                        case "shipments":
                                                            echo '<span class="text-warning order-circle">
                                                                    <svg class="svg-icon circle-check" style="fill: currentColor;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M512 99.49184a399.03232 399.03232 0 1 0 399.03232 399.03232A399.48288 399.48288 0 0 0 512 99.49184z m0 553.65632a154.624 154.624 0 1 1 98.01728-273.94048l-118.784 93.10208a33.42336 33.42336 0 0 0 20.84864 59.8016 36.864 36.864 0 0 0 12.98432-3.15392 28.672 28.672 0 0 0 6.79936-3.85024L651.264 431.7184a152.61696 152.61696 0 0 1 15.31904 66.80576A154.78784 154.78784 0 0 1 512 653.14816z m151.552-316.04736a221.51168 221.51168 0 1 0 41.3696 52.55168l87.2448-68.32128a333.53728 333.53728 0 1 1-41.32864-52.59264z"  /></svg>
                                                                    Order Dispatched
                                                                </span>';
                                                        break;
                                                        case "cancel":
                                                            echo '<span class="text-warning order-circle">
                                                                    <svg class="svg-icon circle-check" style="fill: currentColor;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M512 99.49184a399.03232 399.03232 0 1 0 399.03232 399.03232A399.48288 399.48288 0 0 0 512 99.49184z m0 553.65632a154.624 154.624 0 1 1 98.01728-273.94048l-118.784 93.10208a33.42336 33.42336 0 0 0 20.84864 59.8016 36.864 36.864 0 0 0 12.98432-3.15392 28.672 28.672 0 0 0 6.79936-3.85024L651.264 431.7184a152.61696 152.61696 0 0 1 15.31904 66.80576A154.78784 154.78784 0 0 1 512 653.14816z m151.552-316.04736a221.51168 221.51168 0 1 0 41.3696 52.55168l87.2448-68.32128a333.53728 333.53728 0 1 1-41.32864-52.59264z"  /></svg>
                                                                    Order Cancel
                                                                </span>';
                                                        break;
                                                        case "deliver":
                                                            echo '<span class="text-success"><svg class="svg-icon circle-check" style="fill:#060;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M744.704 743.765333A327.509333 327.509333 0 1 0 281.685333 280.405333a327.509333 327.509333 0 0 0 463.018667 463.36z m39.296 39.253334A384 384 0 1 1 240 240.938667a384 384 0 0 1 544 542.165333z m-110.250667-399.317334a28.458667 28.458667 0 1 1 39.765334 39.765334l-220.458667 220.458666a32.981333 32.981333 0 0 1-45.184 0l-125.568-124.714666a28.458667 28.458667 0 1 1 39.765333-39.722667l105.685334 107.946667 205.994666-203.733334z"  /></svg>   Order Delivered </span>';
                                                        break;

                                                    }
                                                @endphp
                                                <ul class="tab-numberwithdate">
                                                    <li><b>Order Number:</b> {!! $row->order_id !!}</li>
                                                    <li><b>Order Date:</b> {!! date('M, d Y', strtotime($row->date_time)) !!}</li>
                                                </ul>
                                            </a>

                                            <div class="content" style="{!! $key==0 ? "display: block" : "display: none" !!};">
                                                <div class="list-group">
                                                    <div class="list-group-item bg-snow">
                                                        <div class="row w-100 no-gutters">
                                                            <div class="col-6 col-md">
                                                                <h6 class="text-charcoal mb-0 w-100">Order Id Number</h6>
                                                                <a href="" class="text-pebble mb-0 w-100 mb-2 mb-md-0">{!! $row->order_id !!}</a> </div>
                                                            <div class="col-6 col-md">
                                                                <h6 class="text-charcoal mb-0 w-100">Order Status Date</h6>
                                                                <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{!! date('M, d Y', strtotime($row->date_time)) !!}</p>
                                                            </div>
                                                            <div class="col-6 col-md">
                                                                <h6 class="text-charcoal mb-0 w-100">Total</h6>
                                                                <p class="text-pebble mb-0 w-100 mb-2 mb-md-0"><i class="fa fa-inr" aria-hidden="true"></i> {!! number_format($row->total_amount, 2) !!}/-</p>
                                                            </div>
                                                            <div class="col-6 col-md">
                                                                <h6 class="text-charcoal mb-0 w-100">Shipped To</h6>
                                                                <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{!! $row->shipping_locality.' '.$row->shipping_address.', '.$row->shipping_city.' '.$row->shipping_post_code !!}</p>
                                                            </div>
                                                            {{--<div class="col-12 col-md-3"> <a href="" class="btn btn-danger view-order w-100">View Order</a> </div>--}}
                                                        </div>
                                                    </div>
                                                    <div class="list-group-item bg-snow bg-white">
                                                        <div class="row no-gutters">
                                                            <div class="col-12 col-md-9 pr-0 pr-md-3">
                                                                {{--<div class="alert p-2 alert-success w-100 mb-5 mt-2">
                                                                    <h6 class="text-green mb-0"><b>Shipped</b></h6>
                                                                    <p class="text-green hidden-sm-down mb-0">Est. delivery between Aug 5 – Aug 9th, 2017</p>
                                                                </div>--}}
                                                                <div class="order-p-list">
                                                                    @if(count($order_item) !=0)
                                                                        @foreach($order_item as $row_item)
                                                                            <div class="row no-gutters mb-3">
                                                                                <div class="col-3 col-md-2">
                                                                                    <img class="img-fluid pr-3" src="{!! URL::asset($row_item->product_image) !!}" alt="" style="width: 100px;margin: auto;display: block;">
                                                                                </div>
                                                                                <div class="col-9 col-md-7 pr-0 pr-md-3">
                                                                                    <h6 class="text-charcoal mb-2 mb-md-1"> <a href="" class="text-charcoal">{!! ucfirst($row_item->product_title) !!} ({!!$row_item->product_hindi_title  !!})  </a> </h6>
                                                                                    <ul class="list-unstyled text-pebble mb-2">
                                                                                        <li class="">  {!! $row_item->size !!}  </li>
                                                                                    </ul>
                                                                                    <h6 class="text-charcoal text-left mb-0 mb-md-2"><i class="fa fa-inr" aria-hidden="true"></i> <b>{!! $row_item->total_price !!}/-</b></h6>
                                                                                </div>
                                                                                <div class="col-12 col-md-3 hidden-sm-down">
                                                                                    <a href="{!! url('shop', $row_item->product_url) !!}" class="btn btn-buy-again w-100 mb-2">Buy It Again</a>
                                                                                    {{--<a href="" class="btn btn-buy-again w-100">Request a Return</a>--}}
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                @if($row->status == "shipments")
                                                                    <button type="button" class="btn btn-success view-order w-100 mb-2 show-modal" data-toggle="modal" data-target="#myModal"> Track Shipment </button>
                                                                @endif
                                                                    <a href="{!! url('admin/order/order-invoice', base64_encode($row->id)) !!}" target="_blank" class="btn btn-warning view-order w-100 mb-2"> Order Invoice </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--<!-- Modal -->
    <div class="modal fade" id="myModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
                <div class="padding-bottom-3x mb-1">
                    <div class="card mb-3">
                        <div class="p-4 text-center text-white text-lg bg-dark rounded-top"><span class="text-uppercase">Tracking Order No - </span><span class="text-medium">34VB5540K83</span></div>
                        <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
                            <div class="w-100 text-center py-1 px-2"><span class="text-medium">Courier: </span> EcomExpress</div>
                            <div class="w-100 text-center py-1 px-2"><span class="text-medium">Order ID: </span> JGHJFIUEUUERII87857</div>
                            <div class="w-100 text-center py-1 px-2"><span class="text-medium">Order Placed On: </span> 16th apr 22</div>
                        </div>
                        <div class="card-body">
                            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                                <div class="step completed">
                                    <div class="step-icon-wrap">
                                        <div class="step-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                                    </div>
                                    <h4 class="step-title">Order Placed</h4>
                                    <span>20 Apr 2022, 04:13 <br>
                                                                                             Lucknow Uttar Pradesh</span> </div>
                                <div class="step completed">
                                    <div class="step-icon-wrap">
                                        <div class="step-icon"> <i class="fa fa-cube" aria-hidden="true"></i></div>
                                    </div>
                                    <h4 class="step-title">Dispatched</h4>
                                    <span>20 Apr 2022, 04:13 <br>
                                                                                          Lucknow Uttar Pradesh</span> </div>
                                <div class="step">
                                    <div class="step-icon-wrap">
                                        <div class="step-icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                                    </div>
                                    <h4 class="step-title">Out For Delivery</h4>
                                    <span></span> </div>
                                <div class="step">
                                    <div class="step-icon-wrap">
                                        <div class="step-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    </div>
                                    <h4 class="step-title">Delivered</h4>
                                    <span></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->--}}
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
                    $("#imagePreview").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("input[id='my_file']").change(function() {
            readURL(this);
        });
    </script>

	<script>
        $(document).ready(function() {
            $(".set > a").on("click", function() {
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active");
                    $(this).siblings(".content").slideUp(200);
                    $(".set > a i").removeClass("fa-angle-up").addClass("fa-angle-down");
                } else {
                    $(".set > a i").removeClass("fa-angle-up").addClass("fa-angle-down");
                    $(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-up");
                    $(".set > a").removeClass("active");
                    $(this).addClass("active");
                    $(".content").slideUp(200);
                    $(this).siblings(".content").slideDown(200);
                }
            });
        });
	</script>

@stop

