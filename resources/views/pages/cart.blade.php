@extends('layout.home_master')

@section('css')
    <link href="{{asset('assets/css/payment-style.css')}}"  rel="stylesheet" type="text/css">
<style>
.footer-middle {
    margin: 0px;
}
.modal{
    background: white;
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

        $cart = Cart::instance('shopping')->content();
        $total = 0;
        //echo '<pre>'; print_r($cart); exit;
    @endphp
    <div class="img-story2"></div>
    <div class="inner-grid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1> Shopping Cart</h1>
            </div>
            <div class="col-lg-12 text-center">
                <div aria-label="breadcrumb" class="d-flex justify-content-center">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                        <li class="breadcrumb-item"><a class="text-white"
                                href="https://sonapureessentials.com/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Shopping Cart </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    </div>
    <section class="pay-grid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="steps">
                        <div class="line"></div>
                        <div class="step">
                            <div class="circle2 active"><!--<i class="fa fa-info-circle" aria-hidden="true"></i>-->1</div>
                            <div class="label">Cart<span class="responsive_hide"> </span></div>
                        </div>
                        <div class="step">
                            <div class="circle2"><!--<i class="fa fa-credit-card" aria-hidden="true"></i>-->2</div>
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
                <!--   <div class="col-md-12"><h5 class="header-title"></h5></div>	-->
                @if(count($cart) !=0)
                <div class="col-md-7">
                    <h5 class="header-title">Cart</h5>
                    @include('include.flash-msg')
                    @error('customer_address_id')
                    <div class="alert alert-warning">{{ $message }}</div>
                    @enderror
                    @if(Session::has('client'))
                        @php
                            //echo '<pre>'; print_r(Session::get('client')); exit;
                            $client_address = \App\FunctionModel::getData('tbl_client_address', array('is_active'=>'1', 'client_id'=>Session::get('client')['id']), 'get')
                        @endphp
                        <form class="shipping-info" method="post" action="{!! url('/cart-out-user') !!}">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <h5>Shipping Address</h5>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <button type="button" data-customer="{!! Session::get('client')['id'] !!}" class="btn btn-sm btn-warning add-address" style="float: right"> +Add Address</button>
                                </div>
                                <div class="col-md-12">
                                    @if(count($client_address) !=0)
                                        @foreach($client_address as $row_address)
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="radio" name="customer_address_id" value="{!! $row_address->id !!}" required> {!! ucfirst($row_address->type) !!}
                                                        </div>
                                                        <div class="col-md-6" >
                                                            {{--<a href="javascript:void(0)" data-address="{!! $row_address->id !!}" data-customer="{!! Session::get('client')['id'] !!}" style="float: right"><i class="fa fa-edit"></i> Change </a>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="address-grid">
                                                        <ul>
                                                            <li>{!! ucfirst(Session::get('client')['first_name']).' '.ucfirst(Session::get('client')['last_name']) !!}</li>
                                                            <li>{!! $row_address->locality !!}</li>
                                                            <li>{!! $row_address->address !!}</li>
                                                            <li>{!! $row_address->city.', '.$row_address->state.' '.$row_address->zip !!}</li>
                                                            <li>{!! $row_address->country !!}</li>
                                                            <li>Phone: {!! Session::get('client')['mobile'] !!}</li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-12  text-center">
                                    <button type="submit" class="btn btn-sm submit-btn">Next > </button>
                                </div>
                            </div>
                        </form>
                    @else
                        {{--<form class="shipping-info" action="{!! url('sign-in') !!}" method="post">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Login</h3>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="email">Email/Mobile Number</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email/mobile." required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password." required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <button type="submit" class="btn btn-sm btn-warning">Login</button>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <button type="button" class="btn btn-sm btn-outline-dark forgetPassword" style="float: right">Forget Password</button>
                                </div>
                                <div class="col-sm-12">
                                    <input type="checkbox" class="form-check d-inline" id="chb" required>
                                    <label for="chb" class="form-check-label">&nbsp;Update me on order status, news and exclusive offers via SMS, RCS, WhatsApp and Email </label>
                                </div>
                            </div>
                        </form>--}}
                        <form class="shipping-info" method="post" action="{!! url('cart-out') !!}">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>Contact Information</h5>
                                </div>
                                <div class="col-sm-6" >
                                    <div style="float: right">
                                        Already have an account? <a href="{!! url('/signin?url='.url()->current()) !!}">Log in</a>
                                    </div>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email2" placeholder="Enter your email" required>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <input type="checkbox" class="form-check d-inline" id="chb" required>
                                    <label for="chb" class="form-check-label">&nbsp;Update me on order status, news and exclusive offers via SMS, RCS, WhatsApp and Email </label>
                                </div>

                                <div class="col-sm-12">
                                    <h5>Shipping Address</h5>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="name-f">First Name</label>
                                    <input type="text" class="form-control" name="fname" id="name-f" placeholder="Enter your first name." required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="name-l">Last name</label>
                                    <input type="text" class="form-control" name="lname" id="name-l" placeholder="Enter your last name." required>
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="address-1">House/Flat Number</label>
                                    <input type="address" class="form-control" name="locality" id="address-1" placeholder="Locality/House/Street no." required>
                                </div>
                                <div class="col-sm-8 form-group">
                                    <label for="address-2">Address </label>
                                    <input type="address" class="form-control" name="address" id="address-2" placeholder="Village/City Name." required>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="zip">Pin Code</label>
                                    <input type="text" class="form-control" name="zip" id="zip" placeholder="Pin Code" required>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="state">City</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Enter your city name." required>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="state">State</label>
                                    <input type="address" class="form-control" name="state" id="state" placeholder="Enter your state name." required>
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="Country">Country</label>
                                    <input type="text" class="form-control" name="country" id="country" placeholder="Country" required>
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="sex">Gender</label>
                                    <select id="sex" name="gender" class="form-control browser-default custom-select">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="tel">Contact No.</label>
                                    <input type="tel" name="phone" class="form-control" id="tel" placeholder="+91-" required>
                                </div>

                                {{--<div class="col-sm-6 form-group">
                                    <label for="pass">Password</label>
                                    <input type="Password" name="password" class="form-control" id="pass" placeholder="Enter your password." required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="pass2">Confirm Password</label>
                                    <input type="Password" name="cnf-password" class="form-control" id="pass2" placeholder="Re-enter your password." required>
                                </div>--}}
                                <div class="col-sm-12">
                                    <input type="checkbox" class="form-check d-inline" id="chb2" checked>
                                    <label for="chb" class="form-check-label">&nbsp;	Save this information for next time </label>
                                </div>
                                <div class="col-md-12  text-center">
                                    <button type="submit" class="btn btn-sm submit-btn">Next > </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="col-md-5">
                    <h5 class="header-title">Your Order</h5>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-borderless table-shopping-cart">
                                <thead class="text-muted">
                                <tr class="small2 text-uppercase">
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($cart) !=0)
                                    @foreach($cart as $row)
                                        @php
                                            $price = $row->price*$row->qty;
                                            $total = $total+$price;
                                        @endphp
                                        <tr class="cart-cal" >
                                            <td>
                                                <figure class="itemside align-items-center">
                                                    <div class="aside">
                                                        <img src="{!! $row->options->has('image') ? URL::asset($row->options->image) : "" !!}" class="img-sm">
                                                    </div>
                                                    <figcaption class="info">
                                                        <a href="#" class="title text-dark" data-abc="true">
                                                            {!! $row->name !!}

                                                        </a>
                                                        <p class="small2">{!! $row->options->has('size') ? $row->options->size : "" !!}</p>

                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td>
                                                <span class="price">
                                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                                        {!! number_format(($row->price)) !!}
                                                </span> X
                                                <select class="form-control qty" id="qty_{!! $row->rowId !!}" data-row="{!! $row->rowId !!}" data-price="{!! $row->price !!}">
                                                    <option value="1" {!! $row->qty == 1 ? "selected" : ""  !!}>1</option>
                                                    <option value="2" {!! $row->qty == 2 ? "selected" : ""  !!}>2</option>
                                                    <option value="3" {!! $row->qty == 3 ? "selected" : ""  !!}>3</option>
                                                    <option value="4" {!! $row->qty == 4 ? "selected" : ""  !!}>4</option>
                                                    <option value="5" {!! $row->qty == 5 ? "selected" : ""  !!}>5</option>
                                                    <option value="6" {!! $row->qty == 6 ? "selected" : ""  !!}>6</option>
                                                    <option value="7" {!! $row->qty == 7 ? "selected" : ""  !!}>7</option>
                                                    <option value="8" {!! $row->qty == 8 ? "selected" : ""  !!}>8</option>
                                                    <option value="9" {!! $row->qty == 9 ? "selected" : ""  !!}>9</option>
                                                    <option value="10" {!! $row->qty == 10 ? "selected" : ""  !!}>10</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="price-wrap">
                                                    <span class="price">
                                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                                        {!! number_format(($row->price*$row->qty),2) !!}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="d-md-block">
                                                <a href="javascript:void(0)" data-id="{!! $row->rowId !!}" class="btn btn-light remove" data-abc="true">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <form>
                        <div class="form-group">
                            <label>Have coupon?</label>
                            <div class="input-group">
                                <input type="text" class="form-control coupon" name="" placeholder="Coupon code">
                                <span class="input-group-append">
                                    <button class="btn btn-primary btn-apply coupon">Apply</button>
                                </span>
                            </div>
                        </div>
                    </form>
                    <h5 class="header-title">Order Summary</h5>
                    <div class="card">
                        <div class="card-body">
                            <dl class="dlist-align sub-total">
                                <dt>Subtotal:</dt>
                                <dd class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> {!! $total !!}/-</dd>
                            </dl>
                            <dl class="dlist-align">
                                <dt>Shipping:</dt>
                                <dd class="text-right text-danger">Calculated at next step</dd>
                            </dl>
                            <dl class="dlist-align">
                                <dt>Discount:</dt>
                                <dd class="text-right text-danger">- <i class="fa fa-inr" aria-hidden="true"></i> 0.00/-</dd>
                            </dl>
                            <dl class="dlist-align total">
                                <dt>Total:</dt>
                                <dd class="text-right text-dark"><strong><i class="fa fa-inr" aria-hidden="true"></i> {!! $total !!}/-</strong></dd>
                            </dl>
                            <!--                    <hr> <a href="#" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Make Purchase </a> <a href="#" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Continue Shopping</a>-->

                        </div>
                    </div>
                    {{--<div class="text-center">
                        <a class="btn btn-sm submit-btn" href="{!! url('/') !!}">Continue to shipping</a>
                    </div>--}}
                </div>
                @else
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-center">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="mt-4">Your Cart Is Empty</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                @endif

            </div>
        </div>
    </section>
    <div class="modal fade" id="add-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Shipping Address</h5>
                </div>
                <form method="post" id="add_address_form">
                    {!! csrf_field() !!}
                    <input type="hidden" id="customer_id" name="customer_id" value="" required/>
                    <input type="hidden" id="address_id" name="address_id" value="" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" name="type" required="">
                                        <option value="">Select Type</option>
                                        <option value="home">Home</option>
                                        <option value="office">Office</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" placeholder="Locality" name="locality" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" placeholder="Zip" name="zip" required="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea  class="form-control" placeholder="Address" name="address" required=""></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" placeholder="City" name="city" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" placeholder="State" name="state" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" placeholder="Country" name="country" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="ForgetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forget Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formForgetPassword">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Write Your Email" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Click Here</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')


    <script>
        $(document).on("click", ".remove", function (){
            var id = $(this).data('id');
            $.get("{!! url('cart/remove-cart-product') !!}", {'id' : id}, function (html){
                $.alert("Product Removed Successfully.");
                $("#card_data_"+id).remove();
                location.reload();
            });
        });

        $(document).on("click", ".forgetPassword", function (){
            $("#ForgetPasswordModal").modal("show");
        });

        $("#formForgetPassword").submit(function (){
            $.post("{!! url('/forget-password') !!}", $(this).serialize(), function (html){
                console.log(html);
                return false;
            });
            return false;
        });

        $(document).on("change", "#zip", function(){

            var val = $(this).val();
            if(val !=""){
                $.post("{!! url('get-address') !!}", {'_token' : '{!! csrf_token() !!}', 'pincode' : val }, function(html){
                    var obj = $.parseJSON(html);

                    //$("#shipping_city").val(obj['region']);
                    $("#city").val(obj['region']);
                    $("#state").val(obj['state']);
                    $("#country").val(obj['country']);
                    return false;
                });
            }
        });

        $(document).on("change", "#add-address-modal input[name=zip]", function(){
            var val = $(this).val();
            if(val !=""){
                $.post("{!! url('get-address') !!}", {'_token' : '{!! csrf_token() !!}', 'pincode' : val }, function(html){
                    console.log(html);
                    var obj = $.parseJSON(html);

                    //$("#shipping_city").val(obj['region']);
                    $("#add-address-modal input[name=city]").val(obj['region']);
                    $("#add-address-modal input[name=state]").val(obj['state']);
                    $("#add-address-modal input[name=country]").val(obj['country']);
                    return false;
                });
            }
        });

        $(document).on("change", ".qty", function(){
            var rowId = $(this).data("row"), price = $(this).data("price"), qty = $(this).val();
            $.post("{!! url('cart/update-cart') !!}", {'id' : rowId, 'qty' : qty, 'price': price, '_token': "{!! csrf_token() !!}" }, function(html){
                if(html == 200){
                    location.reload();
                }
            });

        });

        $(document).on("click", ".add-address", function (){
            var customer = $(this).data("customer");
            $("#add-address-modal #customer_id").val(customer);
            $("#add-address-modal").modal("show");
        });

        $(document).on("submit", "form#add_address_form", function(){
            $.post("{!! url('my-profile/add-address') !!}", $(this).serialize(), function(html){
                console.log('html');
                var obj = $.parseJSON(html);
                if(obj.code == 200){
                    alert(obj.msg);
                    setInterval(function(){ location.reload() }, 3000);
                }
            });
            return false;
        });


    </script>
@stop
