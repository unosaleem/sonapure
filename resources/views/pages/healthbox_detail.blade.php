@extends('layout.home_master')
@section('css')
    <link href="{!! URL::asset('assets/css/cart.css') !!}" rel="stylesheet" type="text/css" />
    {{--    <link href="{!! URL::asset('assets/css/lightgallery.css') !!}" rel="stylesheet" type="text/css" />--}}
    <!--    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" rel="stylesheet" type="text/css" />-->
    <link href="https://kenwheeler.github.io/slick/slick/slick-theme.css" rel="stylesheet" type="text/css" />
    <style>
        .slider-single img{width:100% !important}
        /*
            .slider-nav img {
                width: 100%;
                padding: 15px;
            }
        */
        .slider-nav {background: white}
        .slick-prev:before, .slick-next:before {
            color: #193e23;
        }
    </style>
@stop


@section('body')

    @php
        $array1 = array();
        $array2 = array();
    @endphp
    @if(count($product_gallery) !=0)
        @php
            foreach ($product_gallery as  $key=>$row){
                $mode = $key%2;
                if($mode == 0){
                    $array1[] = $row;
                }elseif($mode ==1){
                    $array2[] = $row;
                }
            }

            //echo '<pre>';print_r($array1);
            //echo '<pre>';print_r($array2);exit;
        @endphp
    @endif


    <div class="inner-grid" style="background: url({!! isset($product->header_background_banner) != null ? asset($product->header_background_banner) : asset('assets/images/inner-banner.jpg') !!}) no-repeat top center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>{!! ucfirst($product->product_title) !!} </h1>
                </div>
                <div class="col-lg-12 text-center">
                    <div aria-label="breadcrumb" class="d-flex justify-content-center">
                        <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                            <li class="breadcrumb-item"><a class="text-white" href="{!! url('/') !!}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{!! ucfirst($product->product_title) !!}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="innegrid">
        <div id="services" class="services section-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        {{--
                        <!-- Main-Slideelement -->
                        <div id="myCarousel" class="carousel slide carousel-fade demo-gallery" data-ride="carousel" data-interval="false">
                            @if(count($product_gallery) !=0)
                                <ul id="lightgallery" class="carousel-inner list-unstyled">
                                    <li class="carousel-item active" data-src="{!! URL::asset($product->product_image) !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
                                        <a href=""> <img class="img-responsive" src="{!! URL::asset($product->product_image) !!}" alt=""> </a>
                                    </li>
                                    @foreach($product_gallery as $key=>$row)
                                        <li class="carousel-item " data-src="{!! URL::asset($row->image_url) !!}" data-sub-html="" data-pinterest-text="" data-tweet-text="">
                                            <a href=""> <img class="img-responsive" src="{!! URL::asset($row->image_url) !!}" alt=""> </a>
                                        </li>
                                    @endforeach

                                </ul>
                            @endif
                        </div>
                        <!-- Thumb-Slider-Element starts -->
                         <div id="thumbSlider" class="carousel slide" data-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div data-target="#myCarousel" data-slide-to="0" class="thumb active">
                                            <img src="{!! URL::asset($product->product_image) !!}" alt="{!! ucfirst($product->product_title) !!}">
                                        </div>
                                        @if(count($product_gallery) !=0)
                                            @foreach($product_gallery as $key=>$row)
                                                <div data-target="#myCarousel" data-slide-to="{!! $key+1 !!}" class="thumb">
                                                    <img src="{!! URL::asset($row->image_url) !!}" alt="{!! ucfirst($product->product_title) !!}">
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                    @if(count($product_gallery) !=0)
                                            @foreach($product_gallery as $key=>$row)
                                                <div data-target="#myCarousel" data-slide-to="{!! $key+1 !!}" class="thumb">
                                                    <img src="{!! URL::asset($row->image_url) !!}" alt="{!! ucfirst($product->product_title) !!}">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <a class="carousel-control-prev thumbicon" href="#thumbSlider" role="button" data-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </a> <a class="carousel-control-next thumbicon" href="#thumbSlider" role="button" data-slide="next"> <i class="fa fa-angle-right" aria-hidden="true"></i> </a>
                            </div>
                        </div>

--}}

                        <div class="slider slider-single">
                            <div><img class="img-responsive" src="{!! URL::asset($product->product_image) !!}" alt="{!! ucfirst($product->product_title) !!}"></div>
                            @foreach($product_gallery as $key=>$row)
                                <div><img class="img-responsive" src="{!! URL::asset($row->image_url) !!}" alt="{!! ucfirst($product->product_title) !!}"></div>
                            @endforeach

                        </div>
                        <div class="slider slider-nav">
                            <div><img src="{!! URL::asset($product->product_image) !!}" alt="{!! ucfirst($product->product_title) !!}"></div>
                            @if(count($product_gallery) !=0)
                                @foreach($product_gallery as $key=>$row)
                                    <div><img src="{!! URL::asset($row->image_url) !!}" alt="{!! ucfirst($product->product_title) !!}"></div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="_product-detail-content">
                            <p class="_p-name"> {!! ucfirst($product->product_title) !!} ({!! ucfirst($product->product_hindi_title) !!}) <span>Batch No. {!! $product->batch_no !!}</span></p>
                            <div class="_p-price-box">
                                <div class="p-list">
                                    <span class="price">
                                        <i class="fa fa-inr" aria-hidden="true"></i> {!! $product->selling_price !!}/-
                                    </span>
                                    {{--<span class="price_mrp">
                                        <del><i class="fa fa-inr" aria-hidden="true"></i> {!! $product->price !!} </del>
                                    </span>--}}
                                </div>
                                <div class="_p-features"> <span> PROPERTIES: </span>
                                    {!! ucfirst($product->product_properties) !!}
                                </div>
                                <div class="_p-add-cart">
                                    <div class="_p-qty">
                                        <span>Add Quantity</span>
                                        <div class="value-button decrease_" id="decrease" onclick="decreaseValue()">-</div>
                                        <input type="text" id="number" value="1" />
                                        <div class="value-button increase_" id="increase" onclick="increaseValue()">+</div>
                                    </div>
                                </div>
                                <div class="_p-qty-and-cart">
                                    <div class="_p-add-cart">
                                        <button class="btn-theme btn buy-btn buy-now" tabindex="0" data-id="{!! $product->id !!}" data-size="Per-Pec" data-price="{!! $product->selling_price !!}">
                                            Proceed Now
                                        </button>
                                        <button class="btn-theme btn btn-success add-cart" tabindex="0" data-id="{!! $product->id !!}" data-size="Per-Pecs" data-price="{!! $product->selling_price !!}">
                                            <i class="fa fa-shopping-cart"></i> Add to Cart
                                        </button>
                                        <button class="btn-theme wishlist-btn add-wishlist" tabindex="0" data-id="{!! $product->id !!}" data-type="2" alt="Add to Wish List">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                {{--<div class="check_pin">
                                    <h5>Check Pincode Availability:</h5>
                                    <div class="view-check">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="" name="picodeChk">
                                        </div>
                                        <a href="#" class="picode_tag_btn">Check</a>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                @if($product->interesting_facts != '')
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="tab">
                            @if($product->about != null)
                                <button class="tablinks active" id="six">About</button>
                            @endif
                            @if($product->features != null)
                                <button class="tablinks " id="seven">Features </button>
                            @endif
                            @if($product->health_benefits != null)
                                <button class="tablinks" id="two">Health  Benefits </button>
                            @endif
                            @if($product->nutritional_facts != null)
                                <button class="tablinks" id="four">Nutritional Facts </button>
                            @endif
                            @if($product->storage_instructions != null)
                                <button class="tablinks" id="three">Storage Instructions</button>
                            @endif
                            @if($product->our_story != null)
                                <button class="tablinks" id="five">Our Story</button>
                            @endif
                            @if($product->interesting_facts != null)
                                <button class="tablinks " id="one">Interesting Facts</button>
                            @endif

                        </div>
                        @if($product->about != null)
                            <div id="six" class="tabcontent" style="display: none;">
                                {!! $product->about !!}
                            </div>
                        @endif
                        @if($product->features != null)
                            <div id="seven" class="tabcontent" style="display: none;">
                                {!! $product->features !!}
                            </div>
                        @endif
                        @if($product->health_benefits != null)
                            <div id="two" class="tabcontent" style="display: none;">
                                {!! $product->health_benefits !!}
                            </div>
                        @endif
                        @if($product->nutritional_facts != null)
                            <div id="four" class="tabcontent" style="display: none;">
                                {!! $product->nutritional_facts !!}
                            </div>
                        @endif
                        @if($product->storage_instructions != null)
                            <div id="three" class="tabcontent" style="display: none;">
                                {!! $product->storage_instructions !!}
                            </div>
                        @endif

                        @if($product->our_story != null)
                            <div id="five" class="tabcontent" style="display: none;">
                                {!! $product->our_story !!}
                            </div>
                        @endif
                        @if($product->interesting_facts != null)
                            <div id="one" class="tabcontent" style="display: none;">
                                {!! $product->interesting_facts !!}
                            </div>
                        @endif


                    </div>
                </div>
                @endif
                @if(count($faq)!= 0)
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="tab">
                                <div class="tablinks2"> FAQ </div>
                            </div>
                            <div class="tabcontent3">
                                <div class="container">
                                    <div class="accordion" id="accordionExample">
                                        @foreach($faq as $key=>$row)
                                            <div class="card">
                                                <div class="card-head" id="heading{!! $key !!}">
                                                    <h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse{!! $key !!}" aria-expanded="false" aria-controls="collapse{!! $key !!}"> {!! ucfirst($row->question) !!} </h2>
                                                </div>
                                                <div id="collapse{!! $key !!}" class="collapse" aria-labelledby="heading{!! $key !!}" data-parent="#accordionExample"><!--show-->
                                                    <div class="card-body"> {!! ucfirst($row->answer) !!}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
{{--
                @if(count($product_banners) != 0)
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach( $product_banners as $Key=>$row)
                                <div class="carousel-item {!! $key== '0' ? 'active' : '' !!}">
                                    <img class="d-block w-100" src="...{!! asset($row->image_url) !!}" alt="First slide">
                                </div>
                            @endforeach

                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                @endif --}}

               {{-- <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="tab">
                            <div class="tablinks2">Customer Reviews </div>
                        </div>
                        <div class="tabcontent2">
                            <div class="amazing-reviews viewsitems">
                                <blockquote class="viewitem">
                                    <h4> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"> </i> <i class="fa fa-star" aria-hidden="true"></i></h4>
                                    <img src="{!! URL::asset('assets/images/gray-logo.png') !!}" class="img-fluid" alt="">
                                    <div class="reviewsheader">
                                        <h3>Ashish Singh</h3>
                                        <span><i class="fa fa-calendar" aria-hidden="true"></i> Wed 12,2019 </span><span><i class="fa fa-clock-o" aria-hidden="true"></i> 12:32 PM</span> </div>
                                    <div class="clearfix"></div>
                                    <p>We have derived CULTURED GHEE from our FREE GRAZED & NATURALLY FED GIR COWS A2 Milk from our ISO 9001:2015 and FSSAI Certified Gaushala spread in 2.5Acres of Land with over 150 cows(Gaumata) in Gujrat by Hand Milking. Our shelters are made up of natural material like clay and cow dung. Sacred mantras are chanted daily to keep our cows happy and healthy.</p>
                                </blockquote>
                                <blockquote class="viewitem">
                                    <h4> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"> </i> <i class="fa fa-star" aria-hidden="true"></i></h4>
                                    <img src="{!! URL::asset('assets/images/gray-logo.png') !!}" class="img-fluid" alt="">
                                    <div class="reviewsheader">
                                        <h3>Ashish Singh</h3>
                                        <span><i class="fa fa-calendar" aria-hidden="true"></i> Wed 12,2019 </span><span><i class="fa fa-clock-o" aria-hidden="true"></i> 12:32 PM</span> </div>
                                    <div class="clearfix"></div>
                                    <p>We have derived CULTURED GHEE from our FREE GRAZED & NATURALLY FED GIR COWS A2 Milk from our ISO 9001:2015 and FSSAI Certified Gaushala spread in 2.5Acres of Land with over 150 cows(Gaumata) in Gujrat by Hand Milking. Our shelters are made up of natural material like clay and cow dung. Sacred mantras are chanted daily to keep our cows happy and healthy.</p>
                                </blockquote>
                                <blockquote class="viewitem">
                                    <h4> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"> </i> <i class="fa fa-star" aria-hidden="true"></i></h4>
                                    <img src="{!! URL::asset('assets/images/gray-logo.png') !!}" class="img-fluid" alt="">
                                    <div class="reviewsheader">
                                        <h3>Ashish Singh</h3>
                                        <span><i class="fa fa-calendar" aria-hidden="true"></i> Wed 12,2019 </span><span><i class="fa fa-clock-o" aria-hidden="true"></i> 12:32 PM</span> </div>
                                    <div class="clearfix"></div>
                                    <p>We have derived CULTURED GHEE from our FREE GRAZED & NATURALLY FED GIR COWS A2 Milk from our ISO 9001:2015 and FSSAI Certified Gaushala spread in 2.5Acres of Land with over 150 cows(Gaumata) in Gujrat by Hand Milking. Our shelters are made up of natural material like clay and cow dung. Sacred mantras are chanted daily to keep our cows happy and healthy.</p>
                                </blockquote>
                                <blockquote class="viewitem">
                                    <h4> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"> </i> <i class="fa fa-star" aria-hidden="true"></i></h4>
                                    <img src="{!! URL::asset('assets/images/gray-logo.png') !!}" class="img-fluid" alt="">
                                    <div class="reviewsheader">
                                        <h3>Ashish Singh</h3>
                                        <span><i class="fa fa-calendar" aria-hidden="true"></i> Wed 12,2019 </span><span><i class="fa fa-clock-o" aria-hidden="true"></i> 12:32 PM</span> </div>
                                    <div class="clearfix"></div>
                                    <p>We have derived CULTURED GHEE from our FREE GRAZED & NATURALLY FED GIR COWS A2 Milk from our ISO 9001:2015 and FSSAI Certified Gaushala spread in 2.5Acres of Land with over 150 cows(Gaumata) in Gujrat by Hand Milking. Our shelters are made up of natural material like clay and cow dung. Sacred mantras are chanted daily to keep our cows happy and healthy.</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@stop
@section('js')
    {{--<script src="{!! URL::asset('assets/js/cart-jquery.js') !!}"></script>
    <script src="{!! URL::asset('assets/js/gallery/picturefill.min.js') !!}"></script>
    <script src="{!! URL::asset('assets/js/gallery/lightgallery.js') !!}"></script>
    <script src="{!! URL::asset('assets/js/gallery/lg-pager.js') !!}"></script>
    <script src="{!! URL::asset('assets/js/gallery/lg-autoplay.js') !!}"></script>
    <script src="{!! URL::asset('assets/js/gallery/lg-fullscreen.js') !!}"></script>
    <script src="{!! URL::asset('assets/js/gallery/lg-zoom.js') !!}"></script>
    <script src="{!! URL::asset('assets/js/gallery/lg-hash.js') !!}"></script>
    <script src="{!! URL::asset('assets/js/gallery/lg-rotate.js') !!}"></script>--}}


    <script src="{!! URL::asset('assets/js/cart-jquery.js') !!}"></script>
    <script>
        //wow
        wow = new WOW({
            animateClass: 'animated',
            offset: 100,
            callback: function(box) {
                console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
            }
        });
        wow.init();
        document.getElementById('moar').onclick = function() {
            var section = document.createElement('section');
            section.className = 'section--purple wow fadeInDown';
            this.parentNode.insertBefore(section, this);
        };
        //wow
    </script>
    <script>
        //search
        $('.control').click( function(){
            $('body').addClass('search-active');
            $('.input-search').focus();
        });

        $('.icon-close').click( function(){
            $('body').removeClass('search-active');
        });


        //auto-slider//



        //header-fixed//

        $(document).ready(function(){
            $(window).bind('scroll', function() {
                var navHeight = $("#box1").height();
                ($(window).scrollTop() > navHeight) ? $('nav').addClass('goToTop') : $('nav').removeClass('goToTop');
            });
        });


    </script>
    <script>
        //tab megamenu
        $('.nav-tabs > li > a').hover(function () {
            $(this).tab('show');
        });
        //scroll top
        $(document).ready(function(){
            $(function(){
                $(document).on( 'scroll', function(){
                    if ($(window).scrollTop() > 100) {
                        $('.scroll-top-wrapper').addClass('show');
                    } else {
                        $('.scroll-top-wrapper').removeClass('show');
                    }
                });
                $('.scroll-top-wrapper').on('click', scrollToTop);
            });

            function scrollToTop() {
                verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
                element = $('body');
                offset = element.offset();
                offsetTop = offset.top;
                $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
            }

        });

        $(document).on("click", ".change_size", function (){
            var size = $(this).data("size"), price = $(this).data("price"), selling_price = $(this).data('sellprice');
            $(".change_size").css({'border': '1px solid #e3e3e3'});
            $(this).css({'border': '1px solid #c48484'});
            $("span.price").html('<i class="fa fa-inr" aria-hidden="true"></i> '+selling_price+" /-");
            $("span.price_mrp del").html('<i class="fa fa-inr" aria-hidden="true"></i> '+price+" /-");
            $("button.add-card").data("size", size);
            $("button.add-card").data("price", selling_price);
            $("button.buy-now").data("size", size);
            $("button.buy-now").data("price", selling_price);


        });

    </script>
    <script>
        lightGallery(document.getElementById('lightgallery'));
    </script>
    <script>
        $(document).ready(function(){
            $('.customer-logos').slick({
                slidesToShow: 4,
                slidesToScroll: 2,
                autoplay: true,
                autoplaySpeed: 1500,
                arrows: false,
                dots: false,
                pauseOnHover: false,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 2
                    }
                }]
            });
        });
    </script>
    <script>
        $(document).on("click", ".add-cart", function(){
            console.log("hello");
            var price = $(this).data("price"), size = $(this).data("size"),  product_id = $(this).data("id"), qty = $("input#number").val();
            $.post("{!! url('cart/add-cart-healthbox') !!}", {'price' : price, 'size' : size, '_token': '{!! csrf_token() !!}', 'product_id': product_id, 'qty': qty}, function(html){
                var obj = $.parseJSON(html);
                //$.alert("Product added to Cart.");
                $("a#cart span").text(obj.count);
            });
        });

        $(document).on("click", ".buy-now", function(){
            var price = $(this).data("price"), size = $(this).data("size"),  product_id = $(this).data("id"), qty = $("input#number").val();
            $.post("{!! url('buy-now-healthbox') !!}", {'price' : price, 'size' : size, '_token': '{!! csrf_token() !!}', 'product_id': product_id, 'qty': qty}, function(html){
                var obj = $.parseJSON(html);
                if(obj.code == 200){
                    $("a#cart span").text(obj.count);
                    window.location.href = obj.url;
                }

            });
        });
        $(document).on("click", ".add-wishlist", function (){
            var type = $(this).data("type"),  product_id = $(this).data("id");
            $.post("{!! url('my-profile/add-wishlist') !!}", {'type' : type,  '_token': '{!! csrf_token() !!}', 'product_id': product_id}, function(html){
                var obj = $.parseJSON(html);
                $.alert(obj.msg);
                $('.toast-body').text(obj.msg);
                $(".wishlist-counts span").text(obj.count);
                $('#liveToast').toast('show');
            });
        });
        $('.add-wishlist').click(function(){
            $(this).find('i').toggleClass('fa fa-heart fi-rs-heart')

        });

        $('.slider-single').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            adaptiveHeight: true,
            infinite: false,
            useTransform: true,
            speed: 400,
            cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
        });

        $('.slider-nav')
            .on('init', function(event, slick) {
                $('.slider-nav .slick-slide.slick-current').addClass('is-active');
            })
            .slick({
                slidesToShow: 3,
                slidesToScroll: 3,
                dots: false,
                arrows: true,
                focusOnSelect: true,
                infinite: false,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                }, {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                }, {
                    breakpoint: 420,
                    settings: {
                        slidesToShow:2,
                        slidesToScroll: 2,
                    }
                }]
            });

        $('.slider-single').on('afterChange', function(event, slick, currentSlide) {
            $('.slider-nav').slick('slickGoTo', currentSlide);
            var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
            $('.slider-nav .slick-slide.is-active').removeClass('is-active');
            $(currrentNavSlideElem).addClass('is-active');
        });

        $('.slider-nav').on('click', '.slick-slide', function(event) {
            event.preventDefault();
            var goToSingleSlide = $(this).data('slick-index');

            $('.slider-single').slick('slickGoTo', goToSingleSlide);
        });
    
    </script>
@stop
