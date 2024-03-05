@extends('layout.home_master')
@section('css')@stop
<link rel="stylesheet" type="text/css" media="all" href="../assets/css/lightgallery.css">
@section('body')
<div class="inner-grid">

<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Photo Gallery </h1>
            </div>
            <div class="col-lg-12 text-center">
                <div aria-label="breadcrumb" class="d-flex justify-content-center">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="https://sonapureessentials.com/">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="{!! url('event_media') !!}">Event and Media</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Boss Ladies</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
<section class="our-event-media">
  
    <div class="container">
        <div class="row">
        <div class="col-md-12 col-12">

<section class="polaroid-gallery" id="lightgallery">

    <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset('assets/images/Exhibitions/Boss-Ladies/1.jpg') !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
        <img src="{!! URL::asset('assets/images/Exhibitions/Boss-Ladies/1.jpg') !!}" alt="">
        
    </a>

    <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset('assets/images/Exhibitions/Boss-Ladies/2.jpg') !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
        <img src="{!! URL::asset('assets/images/Exhibitions/Boss-Ladies/2.jpg') !!}" alt="">
       
    </a>

    <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset('assets/images/Exhibitions/Boss-Ladies/3.jpg') !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
        <img src="{!! URL::asset('assets/images/Exhibitions/Boss-Ladies/3.jpg') !!}" alt="">
      
    </a>




</section>

</div>
</div>
        </div>
    </div>
</section>


<script src="assets/js/lightgallery.js"></script>
<script src="assets/js/lg-pager.js"></script>
<script src="assets/js/lg-autoplay.js"></script>
<script src="assets/js/lg-fullscreen.js"></script>
<script src="assets/js/lg-zoom.js"></script>
<script src="assets/js/lg-hash.js"></script>
<script>lightGallery(document.getElementById('lightgallery'));</script>
@stop