@extends('layout.home_master')
@section('css')@stop
@section('body')
<div class="inner-grid" style="background: url(assets/images/event-media/gallery-banner.jpg) no-repeat right top;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Photo Album</h1>
            </div>
            <div class="col-lg-12 text-center">
                <div aria-label="breadcrumb" class="d-flex justify-content-center">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                        <li class="breadcrumb-item"><a class="text-white"
                                href="{!! url('/') !!}">Home</a></li>
                        <li class="breadcrumb-item text-white" aria-current="page">Event and Media</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
<section class="our-event-media">

    <div class="container">
        <div class="row">
            @foreach($event as $row)
                <div class="col-md-3 col-6">
                    <section class="polaroid-gallery">
                        <a class="polaroid" href="{!! url('event-media/'.$row->event_url) !!}">
                            <div class="inside-overlay-1">
                                <div class="placeholder"><img src="{!! URL::asset($row->image) !!}" /></div>
                            </div>
                            <div class="inside-overlay-2">
                                <div class="placeholder"><img src="{!! URL::asset($row->image) !!}" /></div>
                                <div class="info"> {!! ucfirst($row->title) !!}</div>
                            </div>
                        </a>
                    </section>
                </div>
            @endforeach

{{--
            <div class="col-md-3 col-6">
                <section class="polaroid-gallery">
                    <a class="polaroid" href="{!! url('boss-ladies') !!}">
                        <div class="inside-overlay-1">
                            <div class="placeholder"><img
                                    src="{{ asset('assets/images/Exhibitions/FICCI/1.jpg') }}" /></div>
                        </div>
                        <div class="inside-overlay-2">
                            <div class="placeholder"><img
                                    src="{{ asset('assets/images/Exhibitions/FICCI/1.jpg') }}" /></div>
                            <div class="info">FICCI</div>
                        </div>
                    </a>
                </section>
            </div>

            <div class="col-md-3 col-6">
                <section class="polaroid-gallery">
                    <a class="polaroid" href="{!! url('boss-ladies') !!}">
                        <div class="inside-overlay-1">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/FICCI-She-Rises/1.jpg') !!}" /></div>
                        </div>
                        <div class="inside-overlay-2">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/FICCI-She-Rises/1.jpg') !!}" /></div>
                            <div class="info">FICCI She Rises</div>
                        </div>
                    </a>
                </section>
            </div>

            <div class="col-md-3 col-6">
                <section class="polaroid-gallery">
                    <a class="polaroid" href="{!! url('boss-ladies') !!}">
                        <div class="inside-overlay-1">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Lucknow-Farmers-Market/1.jpg') !!}" />
                            </div>
                        </div>
                        <div class="inside-overlay-2">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Lucknow-Farmers-Market/1.jpg') !!}" />
                            </div>
                            <div class="info">Lucknow Farmers Market</div>
                        </div>
                    </a>
                </section>
            </div>

            <div class="col-md-3 col-6">
                <section class="polaroid-gallery">
                    <a class="polaroid" href="{!! url('boss-ladies') !!}">
                        <div class="inside-overlay-1">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Nature-and-Health-Fest/1.jpg') !!}" />
                            </div>
                        </div>
                        <div class="inside-overlay-2">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Nature-and-Health-Fest/1.jpg') !!}" />
                            </div>
                            <div class="info">Nature and Health Fest</div>
                        </div>
                    </a>
                </section>
            </div>

            <div class="col-md-3 col-6">
                <section class="polaroid-gallery">
                    <a class="polaroid" href="{!! url('boss-ladies') !!}">
                        <div class="inside-overlay-1">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Nosh/1.jpg') !!}" /></div>
                        </div>
                        <div class="inside-overlay-2">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Nosh/1.jpg') !!}" /></div>
                            <div class="info">Nosh</div>
                        </div>
                    </a>
                </section>
            </div>

            <div class="col-md-3 col-6">
                <section class="polaroid-gallery">
                    <a class="polaroid" href="{!! url('boss-ladies') !!}">
                        <div class="inside-overlay-1">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Panache/1.jpg') !!}" /></div>
                        </div>
                        <div class="inside-overlay-2">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Panache/1.jpg') !!}" /></div>
                            <div class="info">Panache</div>
                        </div>
                    </a>
                </section>
            </div>

            <div class="col-md-3 col-6">
                <section class="polaroid-gallery">
                    <a class="polaroid" href="{!! url('boss-ladies') !!}">
                        <div class="inside-overlay-1">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Samvardhini/1.jpg') !!}" /></div>
                        </div>
                        <div class="inside-overlay-2">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Samvardhini/1.jpg') !!}" /></div>
                            <div class="info">Samvardhini</div>
                        </div>
                    </a>
                </section>
            </div>


            <div class="col-md-3 col-6">
                <section class="polaroid-gallery">
                    <a class="polaroid" href="{!! url('boss-ladies') !!}">
                        <div class="inside-overlay-1">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Stylize/1.jpg') !!}" /></div>
                        </div>
                        <div class="inside-overlay-2">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/Stylize/1.jpg') !!}" /></div>
                            <div class="info">Stylize</div>
                        </div>
                    </a>
                </section>
            </div>

            <div class="col-md-3 col-6">
                <section class="polaroid-gallery">
                    <a class="polaroid" href="{!! url('boss-ladies') !!}">
                        <div class="inside-overlay-1">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/You-Care/1.jpg') !!}" /></div>
                        </div>
                        <div class="inside-overlay-2">
                            <div class="placeholder"><img
                                    src="{!! URL::asset('assets/images/Exhibitions/You-Care/1.jpg') !!}" /></div>
                            <div class="info">You Care</div>
                        </div>
                    </a>
                </section>
            </div> --}}


        </div>
    </div>
</section>
@stop