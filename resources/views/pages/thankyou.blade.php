@extends('layout.home_master')
@section('css')

<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
<link href="{!! URL::asset('assets/css/payment-style.css') !!}" rel="stylesheet">
<style>
.footer-middle {
    margin: 0px;
}
</style>
@stop
@section('body')
    <div class="inner-grid"></div>
    <section class="pay-grid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-thank-you">
                        <div class="wrapper-1">
                            <div class="wrapper-2">
                                <img src="{!! URL::asset('assets/images/check-success.gif') !!}" alt="" width="110px"><br><br>
                                <h1>Thank You !</h1>
                                <p>Thanks for subscribing to our news letter. </p>
                                <p>you should receive a confirmation email soon </p>
                                <a href="{!! url('my-invoice', $order_id) !!}" target="_blank" class="invoice-btn"> Invoice Download <i class="fa fa-download" aria-hidden="true"></i></a>
                                    <a href="{!! url('/') !!}" class="invoice-btn"> Continue Shopping <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('js')

@stop
