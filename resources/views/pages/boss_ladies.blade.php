@extends('layout.home_master')
@section('css')@stop
<link rel="stylesheet" type="text/css" media="all" href="../assets/css/lightgallery.css">
@section('body')
<div class="inner-grid" style="background: url({!! asset($event->banner_image) !!})">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>{!!  ucfirst($event->title)!!} </h1>
            </div>
            <div class="col-lg-12 text-center">
                <div aria-label="breadcrumb" class="d-flex justify-content-center">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="{!! url('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="{!! url('event-media') !!}">Event and Media</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{!!  ucfirst($event->title)!!}</li>
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
                    @foreach($gallery as $row)
                        <a href="" class="polaroid-card" data-responsive="" data-src="{!! URL::asset($row->image) !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
                            <img src="{!! URL::asset($row->image) !!}" alt="">
                        </a>
                    @endforeach
                </section>
            </div>
        </div>
    </div>
</section>


<script src="{!! URL::asset('assets/js/lightgallery.js') !!}"></script>
<script src="{!! URL::asset('assets/js/lg-pager.js') !!}"></script>
<script src="{!! URL::asset('assets/js/lg-autoplay.js') !!}"></script>
<script src="{!! URL::asset('assets/js/lg-fullscreen.js') !!}"></script>
<script src="{!! URL::asset('assets/js/lg-zoom.js') !!}"></script>
<script src="{!! URL::asset('assets/js/lg-hash.js') !!}"></script>
<script>lightGallery(document.getElementById('lightgallery'));</script>
@stop