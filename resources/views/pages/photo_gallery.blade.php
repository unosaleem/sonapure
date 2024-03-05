@extends('layout.home_master')
@section('css')@stop
<link rel="stylesheet" type="text/css" media="all" href="../assets/css/lightgallery.css">
@section('body')
<div class="inner-grid"></div>
<section class="our-event-media">
    <h4>Photo Gallery</h4>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">

                <section class="polaroid-gallery" id="lightgallery">

                    <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
                        <img src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" alt="">
                        
                    </a>

                    <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
                        <img src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" alt="">
                       
                    </a>

                    <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
                        <img src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" alt="">
                      
                    </a>

                    <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
                        <img src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" alt="">
                      
                    </a>

                    <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
                        <img src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" alt="">
                       
                    </a>

                    <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
                        <img src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" alt="">
                       
                    </a>

                    <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
                        <img src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" alt="">
                       
                    </a>

                    <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
                        <img src="{!! URL::asset('assets/images/event-media/1.jpeg') !!}" alt="">
                        
                    </a>



                </section>

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


<script>
            lightGallery(document.getElementById('lightgallery'));</script>
@stop