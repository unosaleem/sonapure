@extends('layout.home_master')
@section('css')
    <link href="{{asset('assets/css/payment-style.css')}}"  rel="stylesheet" type="text/css">
<style>
.footer-middle {
    margin: 0px;
}
footer .footer-inner {
    margin: auto;
    overflow: hidden;
    padding: 150px 0px;
    padding-bottom: 0px;
}
</style>
@stop
@section('body')
    @php
        $model = new \App\HomeModel();
        $order_item = $model->getData('tbl_order_item', array('order_id'=> $cart->order_id, 'status'=>'card'), 'get');
        //$order_item = $model->getData('tbl_order_service_item', array('order_id'=> $card->order_id, 'status'=>'card'), 'get');
        $profile= $model->getData('tbl_client', array('id'=> Session::get('client')['id']), 'first');
        $cartTotal = 0;
    @endphp
    <div class="img-story2"></div>
    <div class="inner-grid"></div>
    <section class="pay-grid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="steps">
                        <div class="line"></div>
                        <div class="step">
                            <div class="circle2 "><!--<i class="fa fa-info-circle" aria-hidden="true"></i>-->1</div>
                            <div class="label">Cart<span class="responsive_hide"> </span></div>
                        </div>
                        <div class="step">
                            <div class="circle2 active"><!--<i class="fa fa-credit-card" aria-hidden="true"></i>-->2</div>
                            <div class="label">Checkout<span class="responsive_hide"> </span></div>
                        </div>
                        <div class="step">
                            <div class="circle2"><!--<i class="fa fa-check" aria-hidden="true"></i>-->3</div>
                            <div class="label">Payment Options</div>
                        </div>
                        <div class="step">
                            <div class="circle2"><!--<i class="fa fa-check" aria-hidden="true"></i>-->4</div>
                            <div class="label">Complete Payment </div>
                        </div>
                    </div>
                </div>
                @if(count($order_item)!=0)
                <div class="col-md-12">
                    <h5 class="header-title">Checkout</h5>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-borderless table-shopping-cart">
                                <thead class="text-muted">
                                <tr class="small2 text-uppercase">
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order_item as $row)
                                <tr>
                                    <td>
                                        <figure class="itemside align-items-center">
                                            <div class="aside"><img src="{!! asset($row->product_image) !!}" class="img-sm"></div>
                                            <figcaption class="info">
                                                <a href="#" class="title text-dark" data-abc="true">{!! ucfirst($row->product_name) !!}</a>
                                                <p class="small2">{!! $row->size !!}</p>
                                            </figcaption>
                                        </figure>
                                    </td>

                                    <td>{!! number_format($row->price, 2).' X '.$row->qty !!}</td>
                                    <td><div class="price-wrap"> <span class="price"><i class="fa fa-inr" aria-hidden="true"></i> {!! number_format($row->total_price, 2) !!}/-</span> </div></td>
{{--                                    <td class="d-md-block"><a href="" class="btn btn-light" data-abc="true"> <i class="fa fa-trash" aria-hidden="true"></i></a></td>--}}
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="header-title">Shipping address </h5>
                            <form class="shipping-info">
                                <div class="address-grid"> {{--<a href=""><i class="fa fa-edit"></i> Change </a>--}}
                                    <ul>
                                        <li>{!! ucfirst($cart->first_name).' '.ucfirst($cart->last_name) !!}</li>
                                        <li>{!! $cart->shipping_locality.', '.$cart->shipping_address !!}</li>
                                        <li>{!! $cart->shipping_city.', '.$cart->shipping_state.' '.$cart->shipping_post_code !!}</li>
                                        <li>{!! $cart->shipping_country !!}</li>
                                        <li>Phone: {!! $cart->mobile !!}</li>
                                    </ul>
                                    <div class="form-group">
                                        <label>Have coupon?</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control coupon" name="" placeholder="Coupon code">
                                            <span class="input-group-append">
                                            <button class="btn btn-primary btn-apply coupon">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="shipping-info-a">Add delivery instructions</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <h5 class="header-title">Order Summary</h5>
                    <form method="post" class="form-delivery" action="{!! url('check-out/payment') !!}">
                        {!! csrf_field() !!}
                        <input type="hidden" value="{!! $order_id !!}" id="order_id" name="where[order_id]" required/>
                        <input type="hidden" value="{!! $cart->total_amount !!}" id="payment" name="input[total_amount]" required/>
                        <input type="hidden" value="" id="razorpay_order_id" name="input[razorpay_order_id]"/>
                        <input type="hidden" value="" id="razorpay_payment_id" name="input[razorpay_payment_id]"/>
                        <input type="hidden" value="" id="coupon_amount" name="input[coupon_amount]"/>
                        <input type="hidden" value="" id="coupon_code" name="input[coupon_code]"/>

                        <input type="hidden" value="{!! Session::get('client')['id'] !!}" name="input[client_id]" required/>
                        <div class="card">
                            <div class="card-body">
                                <dl class="dlist-align">
                                    <dt>Subtotal:</dt>
                                    <dd class="text-right cartsub_amount"><i class="fa fa-inr" aria-hidden="true"></i>{!! number_format($cart->total_amount-00, 2) !!}/-</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Shipping:</dt>
                                    <dd class="text-right text-danger">Calculated at next step</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Discount:</dt>
                                    <dd class="text-right text-danger">- <i class="fa fa-inr" aria-hidden="true"></i> 0.00/-</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Total:</dt>
                                    <dd class="text-right text-dark final_amount"><strong><i class="fa fa-inr" aria-hidden="true"></i> {!! number_format($cart->total_amount, 2) !!}/-</strong></dd>
                                </dl>
                                <!--                    <hr> <a href="#" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Make Purchase </a> <a href="#" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Continue Shopping</a>-->
<!--
                                <dl class="dlist-align">
                                    <dt>Cod :</dt>
                                    <dd class="text-right">
                                        <input type="radio" class="cod" value="cod" name="payment_method" required>
                                    </dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Pay Now :</dt>
                                    <dd class="text-right">
                                        <input type="radio" class="paynow" value="online" name="payment_method" readonly>
                                    </dd>
                                </dl>

-->
								  <div class="inputGroup btn btn-out btn-primary btn-square btn-main" title="click for cash on delivery" style="width: 100% !important;">
                                    <input id="radio1" type="radio" class="cod" value="cod" name="payment_method" required/>
                                    <label for="radio1">CASH ON DELIVERY</label>
                                  </div>
                                    <div class="inputGroup btn btn-out btn-primary btn-square btn-main" title="click for pay now" style="width: 100% !important;">
                                        <input id="radio2" type="radio" class="payNow" value="ccavenue " name="payment_method" required/>
                                        <label for="radio2">Pay Now</label>
                                    </div>
{{--                                  <div class="inputGroup btn btn-out btn-success btn-square btn-main" title="Pay Now">--}}
{{--                                    <input id="radio2" type="radio" class="paynow" value="online" name="payment_method" readonly/>--}}
{{--                                    <label for="radio2"> Pay Now </label>--}}
{{--                                  </div>--}}


                            </div>

                        </div>
<!--
                        <div class="col-sm-12 form-group mb-0">
                            <button type="submit" class="submit-btn">Place Order</button>
                        </div>
-->
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@section('js')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="text/javascript">

        function payhere(amnt, order_id) {
            var options = {
                "key": "rzp_test_GYGASg8wej4Z0k",
                "amount":amnt, // INR 299.35
                "name": "SONA Pure Essentials",
                "currency": "INR",
                "image": "{!! URL::asset('assets/images/logo.png') !!}",
                "handler": function (response){
                    //console.log(response);
                    //return false;
                    if(response.razorpay_payment_id != ""){
                        alert("Payment success full please submit.");
                        $("#razorpay_order_id").val(order_id);
                        $("#razorpay_payment_id").val(response.razorpay_payment_id);
                        $("#payment_method").val("online");
                        $("form.form-delivery").submit();
                    }else{
                        alert("Getting error try again.");
                        location.reload();
                    }

                    //alert(response.razorpay_payment_id);
                },
                "prefill": {
                    "name": "{!! ucfirst($cart->first_name) !!}"+' '+"{!! ucfirst($cart->last_name) !!}",
                    "email": "{!! ucfirst($cart->email) !!}",
                    "contact": "{!! $cart->mobile !!}",
                },
                "notes": {
                    "address": "note value"
                },
                "theme": {
                    "color": "rgb(66 31 25)"
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
            //$("#payment_method").val("cod");
            $("form.form-delivery").submit();
        });

        $(document).on("click", ".payNow", function (){
            //$("#payment_method").val("ccavenue");
            $("form.form-delivery").submit();
        });

    </script>
@stop
