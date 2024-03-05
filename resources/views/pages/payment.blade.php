@extends('layout.home_master')

@section('css')
    <link type="text/css" rel="stylesheet" href="{{asset('assets')}}/css/cart.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <style>
        div.stickys {
            position: fixed;
            z-index: 99999;
            top: 170px;

        }
        .text-left{text-align:left !important}
        .bg-pink{background: #fce1e7;}
        .card,.bg-gray{background: #efefef;}

        #checkout{margin-top: 130px;}
		.footer-middle {
    margin: 0px;
}
    </style>
@stop
@section('body')
    @php
        $model = new \App\HomeModel();
        $order_item = $model->getData('tbl_order_item', array('order_id'=> $card->order_id, 'status'=>'card'), 'get');

        $profile= $model->getData('tbl_client', array('id'=> Session::get('client')['id']), 'first');
        $cartTotal = 0;
    @endphp


    <!--start breadcrumb-->
    <div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40" style="margin-top: 80px">

    </div>
    <!--end breadcrumb-->

    <!-- Checkout Section Start -->
    <!--start shop cart-->
    <section class="py-4 cart-image">
        <div class="container">
            <div class="shop-cart">
                <div class="row">
                    <div class="col-12 col-xl-2"></div>
                    <div class="col-12 col-xl-8">
                        <div class="checkout-details">
                            <div class="card bg-transparent rounded-0 shadow-none">
                                <div class="card-body mt-3">
                                    <div class="steps steps-light">
                                        <a class="step-item active" href="#">
                                            <div class="step-progress"><span class="step-count">1</span>
                                            </div>
                                            <div class="step-label"><i class='bx bx-cart'></i>Cart</div>
                                        </a>
                                        <a class="step-item active " href="javascript:;">
                                            <div class="step-progress"><span class="step-count">2</span>
                                            </div>
                                            <div class="step-label"><i class='bx bx-user-circle'></i>Details</div>
                                        </a>
                                        {{--<a class="step-item" href="javascript:;">
                                            <div class="step-progress"><span class="step-count">3</span>
                                            </div>
                                            <div class="step-label"><i class='bx bx-cube'></i>Shipping</div>
                                        </a>--}}
                                        <a class="step-item active current" href="javascript:;">
                                            <div class="step-progress"><span class="step-count">3</span>
                                            </div>
                                            <div class="step-label"><i class='bx bx-credit-card'></i>Payment</div>
                                        </a>
                                        <a class="step-item" href="javascript:;">
                                            <div class="step-progress"><span class="step-count">4</span>
                                            </div>
                                            <div class="step-label"><i class='bx bx-check-circle'></i>Review</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="">
                                            <img src="{!! $profile->profile_pic == "" ? "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" : asset($profile->profile_pic) !!}" width="90" alt="" class="rounded-circle p-1 border">
                                        </div>
                                        <div class="ms-2 text-left ">
                                            <h6 class="mb-0 ">{!! $profile->first_name.' '.$profile->last_name !!}</h6>
                                            <p class="mb-0">{!! $profile->email !!}</p>
                                        </div>
                                       {{-- <div class="ms-auto">	<a href="{{url('my-profile/profile')}}" class="btn btn-light btn-ecomm"><i class='bx bx-edit'></i> Edit Profile</a>
                                        </div>--}}
                                    </div>
                                    <div class="border p-3">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12 col-xl-12">
                                                    <div class="order-summary">
                                                        <div class="card-body">
                                                            <div class="card rounded-0 border bg-transparent shadow-none">
                                                                <div class="card-body">
                                                                    <p class="fs-5">Apply Discount Code</p>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control rounded-0" name="coupon_code" placeholder="Enter discount code">
                                                                        <button class="btn btn-dark btn-ecomm" type="button">Apply Discount</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card rounded-0 border bg-transparent shadow-none">
                                                                <div class="card-body">
                                                                    <p class="fs-5">Order summary</p>
                                                                    <div class="my-3 border-top"></div>
                                                                    @if(count($order_item)!=0)
                                                                        @foreach($order_item as $row)
                                                                            <div class="d-flex align-items-center">
                                                                                <a class="d-block flex-shrink-0" href="javascript:;">
                                                                                    <img src="{!! asset($row->product_image) !!}" width="75" alt="Product">
                                                                                </a>
                                                                                <div class="ps-2 text-left">
                                                                                    <p class="mb-1"><a href="javascript:;" class="text-dark">{!! ucfirst($row->product_name) !!}</a></p>
                                                                                    <div class="widget-product-meta"><span class="me-2"><strong>{!! number_format($row->total_price, 2) !!}</strong></span><span class="">x <strong>{!! $row->qty !!}</strong></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="my-3 border-top"></div>
                                                                        @endforeach
                                                                    @endif



                                                                </div>
                                                            </div>
                                                            <div class="card rounded-0 border bg-transparent mb-0 shadow-none">
                                                                <div class="card-body text-left">
                                                                    <p class="mb-2">Cart Amount:
                                                                        <span class="float-end cart_gst">
                                                                            @php
                                                                                $cartTotal=$card->total_amount-0;
                                                                                $gst=($cartTotal*18)/118;
                                                                            @endphp
                                                                            {!! number_format($cartTotal-$gst,2) !!}
                                                                        </span>
                                                                    </p>
                                                                    <p class="mb-2">GST @18%: <span class="float-end gst_amount"><b>{!! number_format($gst,2) !!}</b></span></p>
                                                                    <p class="mb-2">Sub Total Amount: <span class="float-end cartsub_amount"><b>{!! number_format($card->total_amount-00, 2) !!}</b></span></p>
                                                                    <p class="mb-2">Shipping Charges: <span class="float-end ship_amount"> <b>00.00</b></span></p>

                                                                    <div class="my-3 border-top"></div>
                                                                    <h5 class="mb-0 main_total">
                                                                        Order Total:
                                                                        <strong>
                                                                            <span class="final_amount float-end">{!! number_format($card->total_amount, 2) !!}</span>
                                                                        </strong>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 learts-mb-30">
                                                            <div class="order-payment">
                                                                <div class="payment-method">
                                                                    <div class="accordion" id="paymentMethod">
                                                                        <div class="row p-3">
                                                                            <form method="post" class="form-delivery" >
                                                                                <div class="row">
                                                                                    {!! csrf_field() !!}
                                                                                    <input type="hidden" value="{!! $order_id !!}" id="order_id" name="where[order_id]" required/>
                                                                                    <input type="hidden" value="{!! $card->total_amount !!}" id="payment" name="input[total_amount]" required/>
                                                                                    <input type="hidden" value="" id="razorpay_order_id" name="input[razorpay_order_id]"/>
                                                                                     <input type="hidden" value="" id="razorpay_payment_id" name="input[razorpay_payment_id]"/>
                                                                                     <input type="hidden" value="" id="coupon_amount" name="input[coupon_amount]"/>
                                                                                     <input type="hidden" value="" id="coupon_code" name="input[coupon_code]"/>
                                                                                     <input type="hidden" id="payment_method" name="payment_method" value=""/>
                                                                                    <input type="hidden" value="{!! Session::get('client')['id'] !!}" name="input[client_id]" required/>
                                                                                    <div class="col-md-6">
                                                                                        <div class="d-grid">
                                                                                            <button type="button"  class="btn btn-ecomm btn-info cod" style="margin-bottom: 10px">
                                                                                                Cash on delivery
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="d-grid">
                                                                                            <button type="button"  class="btn btn-ecomm btn-success paynow">
                                                                                                Pay Now
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@stop

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="text/javascript">


        $(".applyCoupon").on("click", function(){
            $.post("{!! url('/check-coupon') !!}", {'_token': "{!! csrf_token() !!}", 'coupon': $("#coupon_code").val()}, function (html){
                var obj = $.parseJSON(html);
                cardAmount = "{!! $card->total_amount-50 !!}";
                if(obj.code == 200){
                    $("#coupon_msg").css("color", "#0da12d");
                    $("#coupon_msg").text(obj.msg);
                    if(obj.data['discount_type'] == "rs"){
                        coupon = parseFloat(obj.data['discount']);
                        amount = parseFloat(cardAmount)-coupon+50;
                        $(".coupon_amount td span").html(coupon);
                        $("tr.total td span").text(amount);
                        $("input[name='input[coupon_amount]']").val(coupon);
                        $("input[name='input[total_amount]']").val(amount);
                    }else{
                        //coupon = parseFloat(obj.data['discount']);
                        coupon = (parseFloat(cardAmount)*parseFloat(obj.data['discount']))/100;
                        amount = parseFloat(cardAmount)-parseFloat(coupon)+50;
                        $(".coupon_amount td span").html(coupon);
                        $("tr.total td span").text(amount);
                        $("input[name='input[coupon_amount]']").val(coupon);
                        $("input[name='input[total_amount]']").val(amount);
                    }

                }else if(obj.code == 301){
                    $("#coupon_msg").css("color", "#ee051d");
                    $("#coupon_msg").text(obj.msg);
                    $("input[name='input[coupon_amount]']").val("");
                }else{
                    location.reload();
                }
                return false;
            });
            return false;
        });

        function payhere(amnt, order_id) {
            var options = {
                "key": "rzp_test_EZyGyRXgOf80pO",
                "amount":amnt, // INR 299.35
                "name": "Matrika Green",
                "currency": "INR",
                "image": "{!! URL::asset('assets/images/logo.png') !!}",
                "handler": function (response){
                    //console.log(response);
                    //return false;
                    if(response.razorpay_payment_id != ""){
                        $.alert("Payment success full please submit.");
                        $("#razorpay_order_id").val(order_id);
                        $("#razorpay_payment_id").val(response.razorpay_payment_id);
                        $("#payment_method").val("online");
                        $("form.form-delivery").submit();
                    }else{
                        $.alert("Getting error try again.");
                        location.reload();
                    }

                    //alert(response.razorpay_payment_id);
                },
                "prefill": {
                    "name": "{!! ucfirst($card->first_name) !!}"+' '+"{!! ucfirst($card->last_name) !!}",
                    "email": "{!! ucfirst($card->email) !!}",
                    "contact": "{!! $card->mobile !!}",
                },
                "notes": {
                    "address": "note value"
                },
                "theme": {
                    "color": "#006738"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();

        }

        $(document).on("click", ".paynow", function(){
            var val = parseInt($("input[name='input[total_amount]']").val())*100;
            var order_id = "{!! $order_id !!}";
            payhere(val, order_id);

        });

        $(document).on("click", ".cod", function (){
            $("#payment_method").val("cod");
            $("form.form-delivery").submit();
        });

    </script>

@stop
