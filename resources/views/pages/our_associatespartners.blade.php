@extends('layout.home_master')
@section('css')@stop
@section('body')
<div class="inner-grid" style="background: url(assets/images/inner-banners/Our-Associates.jpg) no-repeat top center;">
<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Our Associates Partners</h1>
            </div>
            <div class="col-lg-12 text-center">
                <div aria-label="breadcrumb" class="d-flex justify-content-center">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                        <li class="breadcrumb-item"><a class="text-white"
                                href="https://sonapureessentials.com/">Home</a></li>
                        <li class="breadcrumb-item text-white" aria-current="page">About Us</li>
                        <li class="breadcrumb-item active" aria-current="page">Our Associates Partners</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
<section class="our-associatespartners">

  <div class="container">
    <div class="row">
      <div class="col-md-4 col-6">
     
       <div class="slide">
            <div class="client-box"> <img src="{!! URL::asset('assets/images/JBR.jpg') !!}" class="img-fluid"> </div>
          </div>
          </div>
          <div class="col-md-4 col-6">
       <div class="slide">
            <div class="client-box"><img src="{!! URL::asset('assets/images/Hyatt-Dehradun.jpg') !!}" class="img-fluid"> </div>
          </div>
          </div>
          <div class="col-md-4 col-6">
       <div class="slide">
            <div class="client-box"><img src="{!! URL::asset('assets/images/Marriott-International.jpg') !!}" class="img-fluid"> </div>
          </div>
          </div>
          <div class="col-md-4 col-6">
       <div class="slide">
            <div class="client-box"><img src="{!! URL::asset('assets/images/Taj-Lucknow.jpg') !!}" class="img-fluid"> </div>
          </div>
          </div>
          <div class="col-md-4 col-6">
        <div class="slide">
            <div class="client-box"> <img src="{!! URL::asset('assets/images/Taj-Varanasi.jpg') !!}" class="img-fluid"> </div>
          </div>
          </div>
    
    </div>
    </div>
  </div>
</section>
@stop 