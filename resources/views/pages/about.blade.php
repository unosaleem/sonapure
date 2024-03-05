@extends('layout.home_master')
@section('body') 
<section class="parallax-section single-par" data-scrollax-parent="true">
    <div class="bg par-elem "  data-bg="{{asset('assets')}}/images/all/55.jpg" data-scrollax="properties: { translateY: '30%' }"></div>
    <div class="overlay op7"></div>
    <div class="container">
        <div class="section-title center-align big-title">
            <h2><span>About Our Company</span></h2>
            <span class="section-separator"></span>
            <div class="breadcrumbs fl-wrap"><a href="#">Home</a><a href="#">Pages</a><span>About us</span></div>
        </div>
    </div>
    <div class="header-sec-link">
        <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down"></i></a> 
    </div>
</section>
 <!--  section  end-->
 <section   id="sec1" data-scrollax-parent="true">
    <div class="container">
        <div class="section-title">
            <h2> How We Work</h2>
            <div class="section-subtitle">who we are</div>
            <span class="section-separator"></span>
            <p>Explore some of the best tips from around the city from our partners and friends.</p>
        </div>
        <!--about-wrap -->
        <div class="about-wrap">
            <div class="row">
                <div class="col-md-6">
                    <div class="list-single-main-media fl-wrap" style="box-shadow: 0 9px 26px rgba(58, 87, 135, 0.2);">
                        <img src="{{asset('assets')}}/images/all/55.jpg" class="respimg" alt="">
                        <a href="https://vimeo.com/70851162" class="promo-link   image-popup"><i class="fal fa-video"></i><span>Our Story</span></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ab_text">
                        <div class="ab_text-title fl-wrap">
                            <h3>Our Awesome  Team <span>Story</span></h3>
                            <h4>Check video presentation to find   out more about us .</h4>
                            <span class="section-separator fl-sec-sep"></span>
                        </div>
                        <p>Ut euismod ultricies sollicitudin. Curabitur sed dapibus nulla. Nulla eget iaculis lectus. Mauris ac maximus neque. Nam in mauris quis libero sodales eleifend. Morbi varius, nulla sit amet rutrum elementum, est elit finibus tellus, ut tristique elit risus at metus. Sed tempor iaculis massa faucibus feugiat. </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.
                        </p>
                        <a href="#sec3" class="btn color2-bg float-btn custom-scroll-link">Our Team <i class="fal fa-users"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- about-wrap end  --> 
        <span class="fw-separator"></span>
        <div class=" single-facts bold-facts fl-wrap">
            <!-- inline-facts -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="1254">1254</div>
                        </div>
                    </div>
                    <h6>New Visiters Every Week</h6>
                </div>
            </div>
            <!-- inline-facts end -->
            <!-- inline-facts  -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="12168">12168</div>
                        </div>
                    </div>
                    <h6>Happy customers every year</h6>
                </div>
            </div>
            <!-- inline-facts end -->
            <!-- inline-facts  -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="2172">2172</div>
                        </div>
                    </div>
                    <h6>Won Awards</h6>
                </div>
            </div>
            <!-- inline-facts end -->
            <!-- inline-facts  -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="732">732</div>
                        </div>
                    </div>
                    <h6>New Listing Every Week</h6>
                </div>
            </div>
            <!-- inline-facts end -->
        </div>
    </div>
</section>
<!--section end--> 
@stop