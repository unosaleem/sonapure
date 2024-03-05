@extends( 'layout.home_master' )

@section('body')

@if(count($slider) !=0)
<section class="">
    <div id="myCarousel" class="carousel slide slider-bg" data-ride="carousel">
        <div class="carousel-inner item-img">

           {{-- <div class="carousel-item active">
                <div class="zoominheader slider-2">
                     <!-- <img src="{!! URL::asset('assets/images/slider-banner/Banner-2.jpg') !!}" alt=""> -->
                    </div>
                <div class="carousel-caption slidertitle">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                 <h3>Indulge</h3>
                                  <h2>in the Essence of Nature with</h2>
                                <h1>   Sona Pure Essentials</h1>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="zoominheader slider-3"> </div>
                <div class="carousel-caption slidertitle">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h3>Savor Purity &</h3>
                                  <h2>  Strengthen Immunity with Our</h2>
                                <h1> Traditionally extracted  </h1>
                                <h2>  A2 Gir Cow Ghee</h2>


                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="zoominheader slider-4">  </div>
                <div class="carousel-caption slidertitle">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h3>Rediscover</h3>
                                  <h2>the joy of cooking with </h2>
                                <h1>  the simplicity and purity  </h1>
                                <h2> of our natural groceries.</h2> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="zoominheader slider-5"> </div>
                <div class="carousel-caption slidertitle">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h3>Welcome to</h3>
                                <h1> Sona Pure Essentials</h1>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="zoominheader slider-6">  </div>
                <div class="carousel-caption slidertitle">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h3>Welcome to</h3>
                                <h1>  Sona Pure Essentials </h1>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
                        </div>
                    </div>
                </div>
            </div>--}}


            @foreach($slider as $key=>$row)
                <div class="carousel-item {!! $key == 0 ? " active" : "" !!}">
                    <div class="zoominheader slider-4" style="background-image: url({!! URL::asset($row->slider_image) !!});"></div>
                    <div class="carousel-caption slidertitle">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    @if(!empty($row->slider_title))
                                        <h3> {!! $row->slider_title !!}</h3>
                                    @endif

                                    @if(!empty($row->slider_sub_title))
                                        <h2> {!! $row->slider_sub_title !!}</h2>
                                    @endif
                                    @if(!empty($row->slider_header))
                                        <h1>  {!! $row->slider_header !!} </h1>
                                    @endif
                                    @if(!empty($row->slider_text))
                                        <h2>{!! $row->slider_text !!}</h2>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <i class="fa fa-angle-left"
            aria-hidden="true"></i> </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"> <i class="fa fa-angle-right"
            aria-hidden="true"></i> </a>
</section>
@endif

<!-- <section class="wel_com_grid">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-12">


                <div class="img-wrapper img-wrapper1 wow fadeInLeft" data-wow-offset="1" data-wow-duration="1s"
                    data-wow-delay="0.2s"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                    <img class="img-fluid" src="{!! URL::asset('assets/images/wel-img.png') !!}" alt="" />
                </div>
                <div class="wel-content wow fadeInRight" data-wow-offset="1" data-wow-duration="1s"
                    data-wow-delay="0.2s"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInRight;">
                    <h2> <b>Welcome to</b> The World of Health & Wellness </h2>
                    <p>"SONA Pure Essentials: Nurturing Health and Wellness Through Nature's Bounty"</p>
                    <p>We understand that health and wellness are not just luxuries but essential components of a
                        fulfilling life. At SONA Pure Essentials, we recognize the profound impact that natural,
                        wholesome products can have on one's overall well-being. Our dedication to producing organic
                        items comes from the realisation that what we put into our bodies directly influences our
                        health. We envision a world where people embrace the inherent goodness of nature to nurture
                        their bodies, minds, and spirits. By partnering closely with farmers, beekeepers, and rural
                        women, we contribute to local communities while ensuring the authenticity of our products.
                        Through the age-old Vedic methods we employ for extraction, combined with eco-friendly
                        packaging, we strive to create a harmony between personal wellness and environmental
                        sustainability. SONA Pure Essentials is more than a brand; it's our heartfelt commitment to
                        helping you lead a life steeped in health and well-being.</p>
                    <p> Founded by Surabhi Gupta, SONA Pure Essentials transcends the realm of a brand; it's an odyssey
                        towards complete holistic health and wellness.</p>

                    <a href="{!! url('our-story') !!}" class="readmore"> Know More <i class="fa fa-angle-right"
                            aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section class="wel_com_grid">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="img-wrapper wow fadeInLeft" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                    <img class="img-fluid" src="{!! URL::asset('assets/images/wel-img2.jpg') !!}" alt="">
                </div>

                <div class="wel-content wow fadeInRight" data-wow-offset="1" data-wow-duration="1s"
                    data-wow-delay="0.2s"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInRight;">
                    <h2> <span>Who We Are</span> Celebrating Nature's Best through our Products</h2>
                    <p>In our unwavering commitment to delivering the purest essence of Mother Nature, SONA Pure
                        Essentials operates within a harmonious ecosystem. We collaborate closely with farmers,
                        dedicated beekeepers, and talented rural village women, united by a shared mission: to provide
                        you with 100% pure, authentic products of unparalleled quality, delivered directly to your
                        doorstep. Every order you place with us plays a vital role in empowering and enriching the lives
                        of these extraordinary individuals. It offers them the chance to earn a dignified livelihood and
                        receive the genuine recognition they deserve for their relentless hard work and dedication. At
                        SONA Pure Essentials, we believe in the transformative power of nature, and we invite you to be
                        a part of this meaningful journey towards empowerment and fulfillment</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="about-pic"> <img src="{!! URL::asset('assets/images/pic4.png') !!}"
                                    class="img-fluid">
                                <article>
                                    <h4>No Artificial Colours</h4>
                                    <p>Flavors as Nature Intended.</p>
                                </article>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about-pic"> <img src="{!! URL::asset('assets/images/pic2.png') !!}"
                                    class="img-fluid">
                                <article>
                                    <h4>Good For Health </h4>
                                    <p>Good for Health, Great for Life. </p>
                                </article>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about-pic"> <img src="{!! URL::asset('assets/images/pic1.png') !!}"
                                    class="img-fluid">
                                <article>
                                    <h4> Naturally Grown</h4>
                                    <p>100% Natural, Guaranteed or Your Money Back!</p>
                                </article>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about-pic"> <img src="{!! URL::asset('assets/images/pic3.png') !!}"
                                    class="img-fluid">
                                <article>
                                    <h4> Zero Preservatives Perfection</h4>
                                    <p>Keeping It Real with No Preservatives.</p>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 wel-img2-img-mobile"> <img
                    src="{!! URL::asset('assets/images/wel-img2-mobile.jpg') !!}" alt=""> </div>
        </div>
    </div>
</section>


<section class="video-bg-grid">
    <!-- <div class="overlay"></div> -->
    <video id="myVideo" class="video" src="{!! URL::asset('assets/Video/sona-video.mp4') !!}" loop muted autoplay
        playsinline></video>
    <div class="sona-video-btn">
        <button class="buttonbtn uk-button uk-button-primary second" onclick="pauseVid()" type="button"> <i
                class="fa fa-pause" aria-hidden="true"></i></button>
        <button class="buttonbtn uk-button uk-button-primary first" onclick="playVid()" type="button"> <i
                class="fa fa-play" aria-hidden="true"></i></button>
    </div>
</section>


@if(count($category)!=0)
<section class="product-grid ">
    <div class="container position-relative">
        <div class="head-title">
            <h3> Product Range </h3>
        </div>
        @foreach($category as $ket=>$row_category)
        @php
            $model = new \App\FunctionModel();
            $products = \App\FunctionModel::getData('tbl_product', array('is_active'=> '1',
            'category_id'=>$row_category->id, 'is_front'=> '1',), 'get', array('id'=>'desc'));
        @endphp
        @if(count($products)!=0)
        <div class="product-steps">
{{--            <h3 class="left-banner-title">{!! ucfirst($row_category->category_title_eng) !!}</h3>--}}
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-banner-grid">
                    <img src="{!! URL::asset($row_category->banner_images) !!}" alt="">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="owl-carousel-box">
                        <div class="owl-carousel owl-theme wow fadeIn" data-items="4" data-wow-offset="1" data-wow-duration="1s"
                            data-wow-delay="0.2s"
                            style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeIn;">
                            @foreach($products as $row)
                            @php
                            $price = \App\FunctionModel::getData('tbl_product_price', array('is_active'=> '1',
                            'product_id'=>$row->id), 'first', array('selling_price'=>'asc'));
                            $size_temp = \App\FunctionModel::getData('tbl_product_price', array('is_active'=> '1',
                            'product_id'=>$row->id), 'get', array('selling_price'=>'asc'));
                            $gallery = \App\FunctionModel::getData('tbl_product_gallery', array('is_active'=> '1',
                            'product_id'=>$row->id), 'first');
                            $price_temp = $price->selling_price;
                            $size = $price->size;
                            @endphp
                            <div class="item">
                                <div class="product-card">
                                    <div class="card-product">
                                        <div class="product-img">
                                            <img src="{!! URL::asset(($gallery !="")? $gallery->image_url : $row->product_image) !!}"
                                                alt="" class="img-fluid" />
                                            <img src="{!! URL::asset($row->product_image) !!}" alt=""
                                                class="img-fluid" />
                                        </div>
                                    </div>
                                    <div class="card-title">
                                        <h1>{!! $row->product_title !!} </h1>
                                        <h3>{!! $row->product_tag !!}</h3>
                                        <p><span class="fa fa-star checked"></span> <span
                                                class="fa fa-star checked"></span> <span
                                                class="fa fa-star checked"></span> <span
                                                class="fa fa-star checked"></span> <span class="fa fa-star"></span></p>
                                        <select class="form-control-sm change_size float-right"
                                            data-parent="{!! $row->id !!}">
                                            @foreach($size_temp as $key=>$row_price)
                                            <option value="{!! $row_price->id !!}">{!! $row_price->size !!} </option>
                                            @endforeach
                                        </select>
                                        <div class="product-rate" id="price_{!! $row->id !!}"><i class="fa fa-inr"
                                                aria-hidden="true"></i> {!! number_format($price->selling_price, 2) !!}
                                        </div>
                                        <div class="clearfix"></div>
                                        <a href="javascript:void(0)" id="bag_{!! $row->id !!}"
                                            data-id="{!! $row->id !!}" data-price="{!! $price_temp !!}"
                                            data-size="{!! $size !!}" class="btn-product-card addcart">
                                            {{--                                              <i class="fa fa-shopping-bag" aria-hidden="true"></i>--}}
                                            Add to Cart </a>

                                        <a href="{!! url('shop', $row->product_url) !!}"
                                            class="btn-product-card buynow">
                                            {{--                                              <i class="fa fa-shopping-cart" aria-hidden="true"></i>--}}
                                            Buy Now </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</section>
@endif





@if(count($healthbox) !=0)
<section class="health-grid2">
    <div id="slider-animation" class="carousel slide" data-ride="carousel">
        <!-- The slideshow -->
        <div class="carousel-inner health-slider"> @foreach($healthbox as $key=>$row)
            @php
            $gallery = \App\FunctionModel::getData('tbl_healthbox_banner', array('is_active'=> '1', 'product_id'=>
            $row->id), 'get');
            @endphp
            @foreach($gallery as $key=>$gallery_rows)
            <div class="carousel-item {!! $key==0 ? " active" : "" !!}"> <img
                    src="{!! URL::asset(($gallery_rows !="")? $gallery_rows->image_url : $row->product_banner_image) !!}"
                    alt=""> </div>
            @endforeach
            @endforeach
        </div>
        <a class="left carousel-control" href="#slider-animation" data-slide="prev"> <i class="fa fa-angle-left"
                aria-hidden="true"></i> </a> <a class="right carousel-control" href="#slider-animation"
            data-slide="next"> <i class="fa fa-angle-right" aria-hidden="true"></i> </a>
    </div>

    <article>
        <h2>Our Gift Hampers</h2>
        <p>Unlock a Healthier You with our carefully curated Health Box Packed with Nutrient - Rich Goodness for your
            Wellness Journey . Elevate your gifting game with our Wellness Treasure Chest - The box filled with our
            products- a thoughtful gift for nurturing Health and Happiness </p>
        <!-- <a href="{!! url('healthbox', $row->product_url) !!}">View Gift Hampers</a> -->
        <a href="{!! url('the-health-box') !!}">View Gift Hampers</a>
       
    </article>

</section>
@endif


@if(count($bestSeller) != 0 )
<section class=" best-sellers">
    <div class="container">
        <div class="head-title">
            <h3> Best Seller of the Month </h3>
        </div>
        <div id="slider-animation" class="carousel slide" data-ride="carousel">
            <!-- The slideshow -->
            <div class="carousel-inner health-slider">
                @foreach($bestSeller as $key=>$rows)
                    <div class="carousel-item {!! $key==0 ? " active" : "" !!}">
                        <a href="{!! isset($rows->banner_title) != '' ? $rows->banner_title : 'Javascript:void(0)' !!}">
                            <img src="{!! URL::asset($rows->banner_url) !!}">
                        </a>
                    </div>
                @endforeach
            </div>
{{--            <a class="left carousel-control" href="#slider-animation" data-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </a>--}}
{{--            <a class="right carousel-control" href="#slider-animation" data-slide="next"> <i class="fa fa-angle-right" aria-hidden="true"></i> </a>--}}
        </div>
    </div>
</section>
@endif

<section class="safe_product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="cunter-box wow fadeInUp" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="counter col_fourth"> <span class="icon-1x"> <img
                                src="{!! URL::asset('assets/images/cunter1.png') !!}" alt="" class="img-responsive">
                        </span>
                        <div class="counter-box-1">
                            <h2 class="timer count-title count-number" data-to="1000" data-speed="1500"></h2>
                            <span>+</span>
                            <p class="count-text ">Satisfied Customer </p>
                        </div>
                    </div>
                    <div class="counter col_fourth"> <span class="icon-1x icon-2x"> <img
                                src="{!! URL::asset('assets/images/cunter2.png') !!}" alt="" class="img-responsive">
                        </span>
                        <div class="counter-box-1">
                            <h2 class="timer count-title count-number" data-to="50" data-speed="1500"></h2>
                            <span>+</span>
                            <p class="count-text ">Expert Team </p>
                        </div>
                    </div>
                    <div class="counter col_fourth"> <span class="icon-1x icon-3x"> <img
                                src="{!! URL::asset('assets/images/cunter3.png') !!}" alt="" class="img-responsive">
                        </span>
                        <div class="counter-box-1">
                            <h2 class="timer count-title count-number" data-to="75" data-speed="1500"></h2>
                            <span>+</span>
                            <p class="count-text ">Farmers and Beekeepers </p>
                        </div>
                    </div>

                    <!--
          <div class="counter col_fourth end"> <span class="icon-1x icon-5x"> <img src="{!! URL::asset('assets/images/cunter4.png') !!}" alt="" class="img-responsive"> </span>
            <div class="counter-box-1">
              <h2 class="timer count-title count-number" data-to="5" data-speed="1500"></h2>
              <span>&nbsp;</span>
              <p class="count-text ">Awards Winning</p>
            </div>
          </div>
-->
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ourmethods-grid" id="ourmethods-slider">
    <div class="container">
        <div class="head-title">
            <h3> Our Methods</h3>

        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12 col-6">
                        <div class="method-slider">
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Honey-1.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Honey-2.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Honey-3.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Honey-4.jpg') !!}" alt=""></div>
                            <h2>Bee Keeping Farms</h2>
                        </div>
                    </div>
                    <div class="col-md-12 col-6">
                        <div class="method-slider">
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Kesar-1.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Kesar-2.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Kesar-3.jpg') !!}" alt=""></div>
                            <h2>Traditionally grown, handpicked from the farms of Pampore, Kashmir</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="method-slider method3">
                    <div class="method3 photo"><img src="{!! URL::asset('assets/images/Methods/Oil-1.jpg') !!}" alt=""></div>
                    <div class="method3 photo"><img src="{!! URL::asset('assets/images/Methods/Oil-2.jpg') !!}" alt=""></div>
                    <div class="method3 photo"><img src="{!! URL::asset('assets/images/Methods/Oil-3.jpg') !!}" alt=""></div>
                    <div class="method3 photo"><img src="{!! URL::asset('assets/images/Methods/Oil-4.jpg') !!}" alt=""></div>
                    <h2>Cold-Pressed Method for Mustard Oil </h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12 col-6">
                        <div class="method-slider">
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Ghee-1.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Ghee-2.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Ghee-3.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Ghee-4.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Ghee-5.jpg') !!}" alt=""></div>
                            <h2> Ghee making from
                                Bilona method</h2>
                        </div>
                    </div>
                    <div class="col-md-12 col-6">
                        <div class="method-slider">

                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Turmeric-1.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Turmeric-2.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Turmeric-3.jpg') !!}" alt=""></div>
                            <div class="photo"><img src="{!! URL::asset('assets/images/Methods/Turmeric-4.jpg') !!}" alt=""></div>
                            <h2>Traditionally grown, handpicked from the foothills of West Jainita Hills, Meghalaya</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--
<section class="video-bg-grid">
    <div class="overlay"></div>
    <video id="myVideo" class="video" src="{!! URL::asset('assets/Video/sona-video.mp4') !!}" loop muted autoplay
        playsinline></video>
    <div class="sona-video-btn">
        <button class="buttonbtn uk-button uk-button-primary second" onclick="pauseVid()" type="button"> <i
                class="fa fa-pause" aria-hidden="true"></i></button>
        <button class="buttonbtn uk-button uk-button-primary first" onclick="playVid()" type="button"> <i
                class="fa fa-play" aria-hidden="true"></i></button>
    </div>
</section>
-->
<section class="client-grid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="head-title">
                    <h3>Our Associates </h3>

                    <p class="text-center">SONA Pure Essentials is proud to have established meaningful associations
                        with various esteemed organizations and partners. <br> These collaborations are a testament to
                        our dedication to quality, sustainability, and the pursuit of holistic well-being. </p>
                </div>
                <div class="owl-carousel vendor-carousel">
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <div class="client-box"> <img src="{!! URL::asset('assets/images/JBR.jpg') !!}"
                                    class="img-fluid"> </div>
                        </div>
                    </div>

                    <div class="ct-carousel-item">
                        <div class="slide">
                            <div class="client-box"><img src="{!! URL::asset('assets/images/Hyatt-Dehradun.jpg') !!}"
                                    class="img-fluid"> </div>
                        </div>
                    </div>
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <div class="client-box"><img
                                    src="{!! URL::asset('assets/images/Marriott-International.jpg') !!}"
                                    class="img-fluid"> </div>
                        </div>

                    </div>
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <div class="client-box"><img src="{!! URL::asset('assets/images/Taj-Lucknow.jpg') !!}"
                                    class="img-fluid"> </div>
                        </div>

                    </div>
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <div class="client-box"> <img src="{!! URL::asset('assets/images/Taj-Varanasi.jpg') !!}"
                                    class="img-fluid"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<section class="testimonial-grid">
    <div class="container">
        <div id="testimonial_095"
            class="carousel slide testimonial_095_indicators testimonial_095_control_button thumb_scroll_x swipe_x ps_easeOutSine"
            data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">
            <div class="testimonial_095_header wow fadeInDown" data-wow-offset="1" data-wow-duration="1s"
                data-wow-delay="0.2s"
                style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInDown;">
                <h5>Customer Spotlight </h5>
            </div>
            <div class="carousel-inner" role="listbox">
                @foreach($testimonials as $key=>$row)
                <!-- First Slide -->
                <div class="carousel-item {!! $key == 0 ? " active" : "" !!}">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="testimonial_095_slide"> <img
                                    src="{!! URL::asset('assets/images/testimonial-icon.png') !!}" alt=""
                                    class="testimonial_icon">
                                <p> {!! $row->message !!}
                                </p>
                                <a href="#"> <img src="{!! URL::asset($row->image) !!}" alt="" class="img-fluid"> </a>
                                <h5><strong>{!! $row->name !!}</strong> <span>{!! $row->designation !!}</span></h5>
                                <!--
                                <div class="pull-right">
                                    <a href="#" class="testimonial-video" data-toggle="modal"
                                        data-target="#videoModal-whatsay1"
                                        data-theVideo="https://www.youtube.com/embed/3gsphLn6gXE"> <i class="fa fa-play"
                                            aria-hidden="true"></i> </a>
                                    <div class="modal fade" id="videoModal-whatsay1" tabindex="-1" role="dialog"
                                        aria-labelledby="videoModal-whatsay1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;</button>
                                                    <iframe class="sona-video"
                                                        src="https://www.youtube.com/embed/3gsphLn6gXE"
                                                        title="YouTube video player" frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
-->
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{--                <!-- First Slide -->--}}
                {{--                <div class="carousel-item">--}}
                {{--                    <div class="row">--}}
                {{--                        <div class="col-md-8 offset-md-2">--}}
                {{--                            <div class="testimonial_095_slide"> <img--}}
                {{--                                    src="{!! URL::asset('assets/images/testimonial-icon.png') !!}" alt=""--}}
                {{--                                    class="testimonial_icon">--}}
                {{--                                <p>Thankyou SONA Pure Essentials for the best quality cold pressed virgin coconut oil .--}}
                {{--                                    I was so bothered before as no other oil was suiting my new born till I found this--}}
                {{--                                    one my baby and me just loved it. </p>--}}
                {{--                                <a href="#"> <img src="{!! URL::asset('assets/images/user.png') !!}" alt=""--}}
                {{--                                        class="img-fluid"> </a>--}}
                {{--                                <h5><strong>Sudha Chauhan </strong> <span> House Maker</span></h5>--}}
                {{--                                <!----}}
                {{--                                <div class="pull-right">--}}
                {{--                                    <a href="#" class="testimonial-video" data-toggle="modal"--}}
                {{--                                        data-target="#videoModal-whatsay2"--}}
                {{--                                        data-theVideo="https://www.youtube.com/embed/3gsphLn6gXE"> <i class="fa fa-play"--}}
                {{--                                            aria-hidden="true"></i> </a>--}}
                {{--                                    <div class="modal fade" id="videoModal-whatsay2" tabindex="-1" role="dialog"--}}
                {{--                                        aria-labelledby="videoModal-whatsay2" aria-hidden="true">--}}
                {{--                                        <div class="modal-dialog">--}}
                {{--                                            <div class="modal-content">--}}
                {{--                                                <div class="modal-body">--}}
                {{--                                                    <button type="button" class="close" data-dismiss="modal"--}}
                {{--                                                        aria-hidden="true">&times;</button>--}}
                {{--                                                    <iframe class="sona-video"--}}
                {{--                                                        src="https://www.youtube.com/embed/3gsphLn6gXE"--}}
                {{--                                                        title="YouTube video player" frameborder="0"--}}
                {{--                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
                {{--                                                        allowfullscreen></iframe>--}}
                {{--                                                </div>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{---->--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                <!-- First Slide -->--}}
                {{--                <div class="carousel-item">--}}
                {{--                    <div class="row">--}}
                {{--                        <div class="col-md-8 offset-md-2">--}}
                {{--                            <div class="testimonial_095_slide"> <img--}}
                {{--                                    src="{!! URL::asset('assets/images/testimonial-icon.png') !!}" alt=""--}}
                {{--                                    class="testimonial_icon">--}}
                {{--                                <p>I have been using the A2 Gir Cow Bilona Ghee since a while. But recently I have--}}
                {{--                                    started using the immunity mix and now I rarely face cough and cold problems. It has--}}
                {{--                                    actually elevated our coping mechanism and we feel healthy and active. </p>--}}
                {{--                                <a href="#"> <img src="{!! URL::asset('assets/images/user.png') !!}" alt=""--}}
                {{--                                        class="img-fluid"> </a>--}}
                {{--                                <h5><strong>Shivani Gupta </strong> <span>Housewife</span></h5>--}}
                {{--                                <!----}}
                {{--                                <div class="pull-right">--}}
                {{--                                    <a href="#" class="testimonial-video" data-toggle="modal"--}}
                {{--                                        data-target="#videoModal-whatsay2"--}}
                {{--                                        data-theVideo="https://www.youtube.com/embed/3gsphLn6gXE"> <i class="fa fa-play"--}}
                {{--                                            aria-hidden="true"></i> </a>--}}
                {{--                                    <div class="modal fade" id="videoModal-whatsay2" tabindex="-1" role="dialog"--}}
                {{--                                        aria-labelledby="videoModal-whatsay2" aria-hidden="true">--}}
                {{--                                        <div class="modal-dialog">--}}
                {{--                                            <div class="modal-content">--}}
                {{--                                                <div class="modal-body">--}}
                {{--                                                    <button type="button" class="close" data-dismiss="modal"--}}
                {{--                                                        aria-hidden="true">&times;</button>--}}
                {{--                                                    <iframe class="sona-video"--}}
                {{--                                                        src="https://www.youtube.com/embed/3gsphLn6gXE"--}}
                {{--                                                        title="YouTube video player" frameborder="0"--}}
                {{--                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
                {{--                                                        allowfullscreen></iframe>--}}
                {{--                                                </div>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{---->--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <a class="carousel-control-prev" href="#testimonial_095" data-slide="prev"> <span
                    class="fa fa-chevron-left"></span> </a> <a class="carousel-control-next" href="#testimonial_095"
                data-slide="next"> <span class="fa fa-chevron-right"></span> </a>
        </div>
    </div>
</section>


<section class="client-grid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="head-title">
                    <h3>Our Certifications </h3>
                    <p class="text-center">SONA Pure Essentials takes pride in its numerous certifications,
                        demonstrating our unwavering commitment to quality and sustainability. We have received
                        certifications from renowned organizations, including FSSAI , MAKE IN INDIA , EQUINOX LABS
                        ensuring that our products meet the highest standards of organic production, ethical sourcing,
                        and environmental responsibility.
                    </p>
                </div>

                <div class="owl-carousel certifications-logos">
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <!-- <a href="{!! url('certifications') !!}" class="client-box2"><img src="{!! URL::asset('assets/images/Client1.png') !!}"></a> -->

                            <a href="{!! URL::asset('assets/Certifications/FSSAI-CERTIFICATE-NEW-2023.pdf') !!}"
                                class="btn effect-1" target="_blank" data-toggle="tooltip" title="Food Safety and Standards Authority of India"><img
                                    src="{!! URL::asset('assets') !!}/images/Client1.png" alt=""> <span>SONA Pure
                                    Essentials proudly holds an FSSAI (Food Safety and Standards Authority of India)
                                    license, assuring our customers of the highest standards of food safety and quality
                                    in our products.</span> </a>
                        </div>
                    </div>
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <a href="#" class="btn effect-1" target="_blank" data-toggle="tooltip" title="Make in India"><img
                                    src="{!! URL::asset('assets') !!}/images/Client2.png" alt=""> <span>SONA Pure
                                    Essentials proudly holds a "Make in India" license, a testament to our dedication to
                                    supporting the Indian economy and promoting local manufacturing. </span></a>


                        </div>
                    </div>
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <a href="#" class="btn effect-1" target="_blank" data-toggle="tooltip" title="Equinox Labs"><img
                                    src="{!! URL::asset('assets') !!}/images/Client3.png" alt=""> <span>SONA Pure
                                    Essentials is honored to be licensed by Equinox Labs, a respected authority in
                                    quality assurance and safety. </span></a>


                        </div>
                    </div>
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <a href="{!! URL::asset('assets/Certifications/Udyam-Registration-Certificate.pdf') !!}" class="btn effect-1" target="_blank" data-toggle="tooltip" title="Msme Udyam Registration Consultancy Portal"><img
                                    src="{!! URL::asset('assets') !!}/images/Client4.png" alt=""> <span>We understand
                                    the importance of a smooth and hassle-free registration experience, and we strive to
                                    provide the best service possible. </span> </a>


                        </div>
                    </div>
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <a href="#" class="btn effect-1" target="_blank" data-toggle="tooltip" title="International Organization for Standardization"><img
                                    src="{!! URL::asset('assets') !!}/images/Client5.png" alt=""> <span>With the ISO
                                    license, we ensure that our customers receive products that adhere to globally
                                    recognized quality benchmarks</span> </a>


                        </div>
                    </div>
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <a href="#" class="btn effect-1" target="_blank" data-toggle="tooltip" title="National Accreditation Board for Testing and Calibration Laboratories (NABL)"><img
                                    src="{!! URL::asset('assets') !!}/images/Client6.png" alt=""> <span>NABL
                                    accreditation assures our customers that our products undergo rigorous testing and
                                    calibration processes, meeting the highest industry standards</span></a>


                        </div>
                    </div>
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <a href="{!! URL::asset('assets/Certifications/Certified-Organic.pdf') !!}" class="btn effect-1" target="_blank" data-toggle="tooltip" title="Certified Organic"><img
                                    src="{!! URL::asset('assets') !!}/images/Client7.png" alt=""> <span>This
                                    certification assures our customers that our offerings are crafted with pure,
                                    natural ingredients, free from synthetic chemicals or pesticides.</span></a>


                        </div>
                    </div>
                    <div class="ct-carousel-item">
                        <div class="slide">
                            <a href="{!! URL::asset('assets/Certifications/GST-CERTIFICATE.pdf') !!}"
                                class="btn effect-1" target="_blank" data-toggle="tooltip" title="GST registration"><img
                                    src="{!! URL::asset('assets') !!}/images/Client8.png" alt=""> <span>The next GST
                                    Council meeting is scheduled to be held at Srinagar, J&K on 18th and 19th May, 2017.
                                    The Central Government has already informed that GST will be rolled-out from 1st
                                    July, 2017. </span></a>
                        </div>
                    </div>

                    <div class="ct-carousel-item">
                        <div class="slide">
                            <a href="{!! URL::asset('assets/Certifications/SPE-LABOUR-REG.pdf') !!}"
                                class="btn effect-1" target="_blank" data-toggle="tooltip" title="Labour Department,
Government of Uttar Pradesh"><img
                                    src="{!! URL::asset('assets') !!}/images/Client9.png" alt=""> <span>The Principal
                                    Secretary is the head of the Labour & Employment Department. </span></a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>


<div class="toast" id="liveToast" style="display: none;">
    <div class="toast-body"> Some text inside the toast body </div>
</div>
@stop
@section('script')



@stop
