@extends( 'layout.home_master' )
@section( 'css' )
	<link rel="stylesheet" type="text/css" media="all" href="{!! URL::asset('assets') !!}/css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" media="all" href="{!! URL::asset('assets') !!}/css/owl.theme.css">
	<style>
	.a-button-text {
    border: 1px solid #d1d1d1;
    padding: 2px 9px;
    font-size: 11px;
    border-radius: 100px;
    cursor: pointer;
    background-color: #f1f3f4;
}

		button.a-button-text span {
			font-size: 11px;
		}
	</style>
@stop
@section( 'body' )
@include( 'include/slider' )
	<section class="wel_com_grid">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="img-wrapper img-wrapper1 wow fadeInLeft" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;"> <img class="img-fluid" src="{!! URL::asset('assets') !!}/images/wel-img.png" alt=""/> </div>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="wel-content wow fadeInRight" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInRight;">
						<h2> <b>Welcome to</b> The World of Wellness </h2>
						<p>We bring to you this treasure from our Vedic Culture of ancient times which will rejuvenate your mind, body and soul. As you unbox our “THE H BOX”, you will find the reason behind this treasure.</p>
						<p>Our diverse product range is proudly made in India and extracted according to Indian traditions. We offer you a range of pure products like Cold Pressed Mustard Oil, Bilona Method A2 Gir Cow Ghee, High Curcumin Content Turmeric, Raw Multiflora Honey extracted directly from beekeepers, Pink Himalayan Rock Salt, Jaggery Powder and Hand Pounded Immunity Mix which are completely natural, chemical free and without preservatives. Our products are grown in natural fertiliser fed soil, hence they are richer in antioxidants and micronutrients.</p>
						<div class="welcome-img-mobile"> <img src="{!! URL::asset('assets') !!}/images/wel-img.png" alt=""> </div>
						<a href="" class="readmore"> Know More <i class="fa fa-angle-right" aria-hidden="true"></i></a> </div>
				</div>

			</div>
		</div>
	</section>
<section class="product-grid">
	<div class="container-fluid">
		<div class="head-title">
			<h3> Our Products </h3>
		</div><br><br>
		<div class="row">
			@if(count($product) !=0)
				@foreach($product as $row)
					@php
						$price = \App\FunctionModel::getData('tbl_product_price', array('is_active'=> '1', 'product_id'=> $row->id), 'first', array('id'=>'desc'));
						$size_temp = \App\FunctionModel::getData('tbl_product_price', array('is_active'=> '1', 'product_id'=> $row->id), 'get', array('id'=>'desc'));
						//echo '<pre>'; print_r($size); exit;
					@endphp
					<div class="col-md-3" id="div_{!! $row->id !!}">
						<div class="container_foto" style="background-color: {!! $row->background_color !!}"> <span>{!! ucfirst($row->product_tag) !!} </span>
							<article class="text-left" style="min-height: 170px">
								{{--<h2 style="color: {!! $row->font_color !!}">Organic</h2>--}}
								<h4 style="color: {!! $row->font_color !!}">
									<a href="{!! url('shop', $row->product_url) !!}" target="_blank">{!! $row->product_title !!}</a>
								</h4>
								@php
									$price_temp = 0; $size = 0
								@endphp
								@if($price !="")
									@php $price_temp = $price->selling_price; $size = $price->size; @endphp
									<span id="price_{!! $row->id !!}"><i class="fa fa-inr" aria-hidden="true"></i> {!! $price->selling_price !!}/-</span><br/>
								@endif
								@if(count($size_temp) !=0)
									<select class="kilogram-div change_size" data-parent="{!! $row->id !!}" aria-label="Default select example">
										@foreach($size_temp as $key=>$row_price)
											<option value="{!! $row_price->id !!}">{!! $row_price->size !!} </option>
										@endforeach
									</select>
								@endif
								<a href="javascript:void(0)" data-id="{!! $row->id !!}" data-price="{!! $price_temp !!}" data-size="{!! $size !!}" class="ver_mas addcart">Add to Cart </a>
								<a href="javascript:void(0)" data-id="{!! $row->id !!}" data-price="{!! $price_temp !!}" data-size="{!! $size !!}" class="buy_mas buy_now">Buy Now </a>
							</article>
							<a href="{!! url('shop', $row->product_url) !!}" class="why_sona_right_product" target="_blank">
								<img src="{!! URL::asset($row->product_image) !!} " alt="">
							</a>

						</div>
					</div>
				@endforeach
			@endif

		</div>
		{{--
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="row">
					<div class="col-md-4">
						<div class="container_foto container_foto6"> <span>100% Vegan, Gluten Free, Free of Fillers</span>
							<article class="text-left">
								<h2>Organic</h2>
								<h4><a href="immunity.html" target="_blank">Immunity Mix </a></h4>
								<span><i class="fa fa-inr" aria-hidden="true"></i> 999/-</span> <a href="" class="ver_mas">Add to Cart </a> <a href="immunity.html" class="buy_mas">Buy Now </a>
							</article>
							<a href="immunity.html" class="why_sona_right_product" target="_blank"><img src="{!! URL::asset('assets') !!}/images/card-5.png" alt=""> </a>
						</div>
					</div>
					<div class="col-md-4">
						<div class="container_foto container_foto7"> <span>Cultured Ghee GIR Cows By Bilona Method </span>
							<article class="text-left">
								<h2>Organic</h2>
								<h4><a href="ghee.html" target="_blank">Desi Ghee</a> </h4>
								<span><i class="fa fa-inr" aria-hidden="true"></i> 999/-</span> <a href="" class="ver_mas">Add to Cart </a> <a href="ghee.html" class="buy_mas">Buy Now </a>
							</article>
							<a href="ghee.html" class="why_sona_right_product" target="_blank"><img src="{!! URL::asset('assets') !!}/images/card-6.png" alt=""></a> </div>
					</div>
					<div class="col-md-4">
						<div class="container_foto container_foto8"> <span>Cold Pressed </span>
							<article class="text-left">
								<h2>Organic</h2>
								<h4><a href="mustardoil.html" target="_blank">Mustard Oil</a> </h4>
								<span><i class="fa fa-inr" aria-hidden="true"></i> 999/-</span> <a href="" class="ver_mas">Add to Cart </a> <a href="mustardoil.html" class="buy_mas">Buy Now </a>
							</article>
							<a href="mustardoil.html" class="why_sona_right_product" target="_blank"> <img src="{!! URL::asset('assets') !!}/images/card-7.png" alt=""></a> </div>
					</div>
				</div>
			</div>
		</div>--}}
	</div>
</section>
<section class="wel_com_grid">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="img-wrapper img-wrapper1 wow fadeInLeft" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;"> <img class="img-fluid" src="{!! URL::asset('assets') !!}/images/wel-img2.jpg" alt=""> </div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="wel-content wow fadeInRight" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInRight;">
					<h2> <span>ABOUT US</span> We Believe in Working Accredited Farmers</h2>
					<p>In the pursuit of quality products and with a motto to render purest essence of mother nature, our ecosystem at SONA Pure Essentials works closely with farmers, bee keepers and rural village women with a mission to deliver 100% pure and authentic products of exemplary quality directly to you, right at your doorstep. Your each order will contribute in empowering and creating a fulfilled life for them by giving an opportunity to earn proper livelihood and receive their genuine dues of hard work.</p>
					<div class="row">
						<div class="col-md-6">
							<div class="about-pic"> <img src="{!! URL::asset('assets') !!}/images/pic4.png" class="img-fluid">
								<article>
									<h4>No Artificial Colours</h4>
									<p>All the products are fresh and healthy.</p>
								</article>
							</div>
						</div>
						<div class="col-md-6">
							<div class="about-pic"> <img src="{!! URL::asset('assets') !!}/images/pic2.png" class="img-fluid">
								<article>
									<h4>Good for health </h4>
									<p>It is a family run company that grows 100% organic food.</p>
								</article>
							</div>
						</div>
						<div class="col-md-6">
							<div class="about-pic"> <img src="{!! URL::asset('assets') !!}/images/pic1.png" class="img-fluid">
								<article>
									<h4>100% Natural</h4>
									<p>100% money back guarantee if product is not upto the mark.</p>
								</article>
							</div>
						</div>
						<div class="col-md-6">
							<div class="about-pic"> <img src="{!! URL::asset('assets') !!}/images/pic3.png" class="img-fluid">
								<article>
									<h4> No Preservatives</h4>
									<p>Company provides you a biodynamic food.</p>
								</article>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 wel-img2-img-mobile"> <img src="{!! URL::asset('assets') !!}/images/wel-img2-mobile.jpg" alt=""> </div>
		</div>
	</div>
</section>
<section class="health-grid2">
	<div class="container">
		<div class="health-main2  wow fadeInUp" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
			<h2>The Health Box</h2>
			<ul>
				<li><i class="fa fa-circle" aria-hidden="true"></i> Turmeric (High Curcumin Content) </li>
				<li><i class="fa fa-circle" aria-hidden="true"></i> Organic Honey ( Multi-Floral) </li>
				<li><i class="fa fa-circle" aria-hidden="true"></i> Pink Rock Salt (Unrefined) </li>
				<li><i class="fa fa-circle" aria-hidden="true"></i> Jaggery (Traditionally Extracted) </li>
				<li><i class="fa fa-circle" aria-hidden="true"></i> Mustard Oil (100% Pure) </li>
				<li><i class="fa fa-circle" aria-hidden="true"></i> Cow Desi Ghee (A2 Gir) </li>
				<li><i class="fa fa-circle" aria-hidden="true"></i> Immunity Mix ( 100% Vegan) </li>
			</ul>
			<div class="clearfix"></div>
			<div class="row wow fadeInUp" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
				@foreach($combo as $row)

			<div class="col-md-9 offset-md-1">
					<div class="gift_item">
						<div class="gift_image">
							 <!-- <a href="#"> <img src="{!! asset($row->product_image) !!}" alt=""> </a> -->

						<div id="slider-animation" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators health-box-carousel-indicators">
                  <li data-target="#slider-animation" data-slide-to="0" class="active"></li>
                  <li data-target="#slider-animation" data-slide-to="1"></li>
                  <li data-target="#slider-animation" data-slide-to="2"></li>
                  <li data-target="#slider-animation" data-slide-to="3"></li>
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                  <div class="carousel-item active"> <img src="{!! asset($row->product_image) !!}" alt=""> </div>
                  <div class="carousel-item"> <img src="{!! asset($row->product_image) !!}" alt=""> </div>
                  <div class="carousel-item"> <img src="{!! asset($row->product_image) !!}" alt=""> </div>
                  <div class="carousel-item"> <img src="{!! asset($row->product_image) !!}" alt=""> </div>
                </div>
              </div>


					</div>
						<div class="gift_text">
							<h3> <a href="#">{!! $row->product_title !!}</a> </h3>
							<p> <i class="fa fa-inr" aria-hidden="true"></i> {!! $row->selling_price !!}</p>
							<a href="" class="btn-gift_item"> Add to Cart </a> </div>
					</div>
				</div>

				@endforeach

			</div>



		</div>
	</div>
</section>
<section class="founder_massge">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="img-wrapper img-wrapper1 wow fadeInLeft" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;"> <img class="img-fluid" src="{!! URL::asset('assets') !!}/images/Co-Founder.png" alt=""/> </div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="wel-content wow fadeInRight" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInRight;">
					<h2> <b>As well said by Michelle Obama,</b> "There is no limit to what we as women, can accomplish". </h2>
					<p>So, being a Co-Founder of an IT Company, a proud mother of two kids, an educationist and an entrepreneur, I believe that a disciplined routine and healthy lifestyle makes you happier, healthier and efficient. Thus, my keen interest in health blogs and recent crucial times made me mentally strong and transpired my feelings into a vision.</p>
					<div class="founder-name"> Surabhi Gupta <span>Founder & Director-SONA Pure Essentials</span> </div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="safe_product">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<div class="cunter-box wow fadeInUp" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
					<div class="counter col_fourth"> <span class="icon-1x"><img src="{!! URL::asset('assets') !!}/images/cunter1.png" alt="" class="img-responsive"> </span>
						<div class="counter-box-1">
							<h2 class="timer count-title count-number" data-to="1000" data-speed="1500"></h2>
							<span>+</span>
							<p class="count-text ">Satisfied Customer </p>
						</div>
					</div>
					<div class="counter col_fourth"> <span class="icon-1x icon-2x"> <img src="{!! URL::asset('assets') !!}/images/cunter2.png" alt="" class="img-responsive"></span>
						<div class="counter-box-1">
							<h2 class="timer count-title count-number" data-to="50" data-speed="1500"></h2>
							<span>+</span>
							<p class="count-text ">Expert Team </p>
						</div>
					</div>
					<div class="counter col_fourth"> <span class="icon-1x icon-3x"><img src="{!! URL::asset('assets') !!}/images/cunter3.png" alt="" class="img-responsive"> </span>
						<div class="counter-box-1">
							<h2 class="timer count-title count-number" data-to="75" data-speed="1500"></h2>
							<span>+</span>
							<p class="count-text ">Formers and Beekeeper </p>
						</div>
					</div>
					<div class="counter col_fourth end"> <span class="icon-1x icon-5x"><img src="{!! URL::asset('assets') !!}/images/cunter4.png" alt="" class="img-responsive"></span>
						<div class="counter-box-1">
							<h2 class="timer count-title count-number" data-to="5" data-speed="1500"></h2>
							<span>&nbsp;</span>
							<p class="count-text ">Awards Winning</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@if( count( $testimonials ) != 0 )
	<section class="testimonial-grid">
		<div class="container">
			<div id="testimonial_095" class="carousel slide testimonial_095_indicators testimonial_095_control_button thumb_scroll_x swipe_x ps_easeOutSine" data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">
				<div class="testimonial_095_header wow fadeInDown" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInDown;">
					<h5>What People Say </h5>
				</div>
				<div class="carousel-inner" role="listbox">
					<!-- First Slide -->
					@foreach($testimonials as $key=>$row)
					<div class="carousel-item {{($key==0 ? 'active' : '')}}">
						<div class="row">
							<div class="col-md-8 offset-md-2">
								<div class="testimonial_095_slide"> <img src="{!! URL::asset('assets') !!}/images/testimonial-icon.png" alt="testimonial" class="testimonial_icon">
									<p>{!! $row->message !!}</p>
									<a href="#"><img src="{!! URL::asset($row->image) !!}" alt="{!! ucfirst($row->name) !!}" class="img-fluid"></a>
									<h5>{!! ucfirst($row->name) !!} <span>{!! ucfirst($row->designation) !!}</span></h5>
									<div class="pull-right"> <a href="#" class="testimonial-video" data-toggle="modal" data-target="#videoModal-whatsay1" data-theVideo="https://www.youtube.com/embed/{!! $row->via !!}"> <i class="fa fa-play" aria-hidden="true"></i> </a>
										<div class="modal fade" id="videoModal-whatsay1" tabindex="-1" role="dialog" aria-labelledby="videoModal-whatsay1" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-body">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<iframe class="sona-video" src="https://www.youtube.com/embed/{!! $row->via !!}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach

				</div>
				<ol class="carousel-indicators">
					@foreach($testimonials as $key=>$row)
					<li data-target="#testimonial_095" data-slide-to="{{$key}}" class="{{($key==0 ? 'active' : '')}}"></li>
					@endforeach
					<!--        <li data-target="#testimonial_095" data-slide-to="2"></li>-->
				</ol>
				<a class="carousel-control-prev" href="#testimonial_095" data-slide="prev"> <span class="fa fa-chevron-left"></span> </a><a class="carousel-control-next" href="#testimonial_095" data-slide="next"> <span class="fa fa-chevron-right"></span> </a> </div>
		</div>
	</section>
@endif
<section class="client-grid">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<div class="customer-logos slider wow fadeInUp" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
					<div class="slide">
						<div class="client-box"><img src="{!! URL::asset('assets') !!}/images/Client1.png">
						</div>
					</div>
					<div class="slide">
						<div class="client-box"> <img src="{!! URL::asset('assets') !!}/images/Client2.png"> </div>
					</div>
					<div class="slide">
						<div class="client-box"> <img src="{!! URL::asset('assets') !!}/images/Client3.png"> </div>
					</div>
					<div class="slide">
						<div class="client-box"><img src="{!! URL::asset('assets') !!}/images/Client4.png"> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="container">
	<div class="subscribe-grid  wow fadeInUp" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
		<div class="newsletter">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-xs-12 col-sm-12">
					<div class="news-text">
						<h2> <span>don't miss our deals</span> EXCLUSIVE<br>
                                OFFERS & SALE</h2>
						<p>Place orders at <span>+91-9161190190</span><br>
							Mail Us at <a href="mailto:support@sonapureessentials.com" target="_blank">support@sonapureessentials.com</a>
						</p>
					</div>
				</div>
				<div class="col-lg-7 col-md-7 col-xs-12 col-sm-12">
					<form class="newsletter-form">
						<div class="form-group">
							<input type="email" placeholder="Enter your email address..." required>
						</div>
						<div class="form-group">
							<button type="submit">Subscribe Now</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@stop
@section( 'js' )
<script>
		//wow

		wow = new WOW( {
			animateClass: 'animated',
			offset: 100,
			callback: function ( box ) {
				console.log( "WOW: animating <" + box.tagName.toLowerCase() + ">" )
			}
		} );
		wow.init();
		document.getElementById( 'moar' ).onclick = function () {
			var section = document.createElement( 'section' );
			section.className = 'section--purple wow fadeInDown';
			this.parentNode.insertBefore( section, this );
		};

		//wow
	</script>
<script>
	//auto-slider//

	$( '#myCarousel' ).carousel( {
		pause: true,
		interval: 5000,
	} );





	//header-fixed//

	$( document ).ready( function () {
		$( window ).bind( 'scroll', function () {
			var navHeight = $( "#box1" ).height();
			( $( window ).scrollTop() > navHeight ) ? $( 'nav' ).addClass( 'goToTop' ): $( 'nav' ).removeClass( 'goToTop' );
		} );
	} );



	// shopping-cart //
	( function () {
		$( document ).click( function () {
			var $item = $( ".shopping-cart" );
			if ( $item.hasClass( "active" ) ) {
				$item.removeClass( "active" );
			}
			if ( $( "input.search_box_active" ).length > 0 ) {
				$( "input.search_box_active" ).toggleClass( "search_box_active" );
			}
		} );

		$( '.shopping-cart' ).each( function () {
			var delay = $( this ).index() * 50 + 'ms';
			$( this ).css( {
				'-webkit-transition-delay': delay,
				'-moz-transition-delay': delay,
				'-o-transition-delay': delay,
				'transition-delay': delay
			} );
		} );
		$( '#cart' ).click( function ( e ) {
			e.stopPropagation();
			$( ".shopping-cart" ).toggleClass( "active" );
		} );

		$( '#addtocart' ).click( function ( e ) {
			e.stopPropagation();
			$( ".shopping-cart" ).toggleClass( "active" );
		} );
	} )();
</script>
<script>
	//product
	$( document ).ready( function () {
			$( '.owl-carousel' ).owlCarousel( {
				loop: true,
				margin: 10,
				autoplay: false,
				dots: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				responsiveClass: true,
				responsive: {
					0: {
						items: 1,
						nav: true
					},
					600: {
						items: 2,
						nav: true
					},
					1000: {
						items: 2,
						nav: true,
						loop: true,
						margin: 20
					}
				}
			} )

		} )
		//tab megamenu
	$( '.nav-tabs > li > a' ).hover( function () {
		$( this ).tab( 'show' );
	} );


	//all client

	$( document ).ready( function () {
		$( "#news-slider" ).owlCarousel( {
			items: 3,
			itemsDesktop: [ 1199, 3 ],
			itemsDesktopSmall: [ 1000, 2 ],
			itemsMobile: [ 650, 1 ],
			navigationText: false,
			autoPlay: true
		} );
	} );

	//scroll top
	$( document ).ready( function () {

		$( function () {

			$( document ).on( 'scroll', function () {

				if ( $( window ).scrollTop() > 100 ) {
					$( '.scroll-top-wrapper' ).addClass( 'show' );
				} else {
					$( '.scroll-top-wrapper' ).removeClass( 'show' );
				}
			} );

			$( '.scroll-top-wrapper' ).on( 'click', scrollToTop );
		} );

		function scrollToTop() {
			verticalOffset = typeof ( verticalOffset ) != 'undefined' ? verticalOffset : 0;
			element = $( 'body' );
			offset = element.offset();
			offsetTop = offset.top;
			$( 'html, body' ).animate( {
				scrollTop: offsetTop
			}, 500, 'linear' );
		}

	} );
</script>
<script>
	$( document ).ready( function () {
		$( "#myModal" ).modal( 'show' );
	} );

	$( document ).on( "change", ".change_size", function () {
		var parent = $( this ).data( "parent" ),
			id = $( this ).val();
		$.post("{!! url('/get-size-price') !!}", {"id": id, "_token" : "{!! csrf_token() !!}"}, function (html){
			var obj = $.parseJSON(html);
			if(obj.code == 200){
				$( "#price_" + parent ).html( '<i class="fa fa-inr" aria-hidden="true"></i> ' + obj.data['selling_price'] + '/-' );
				$( "#div_" + parent + " .addcart" ).data( "price", obj.data['selling_price'] );
				$( "#div_" + parent + " .addcart" ).data( "size",  obj.data['size'] );
				$( "#div_" + parent + " .buy_now" ).data( "price", obj.data['selling_price'] );
				$( "#div_" + parent + " .buy_now" ).data( "size", obj.data['size'] );
			}else{
				location.reload();
			}
		});

	} );
</script>
<script>
	$( window ).on( 'load', function () {

		setTimeout( function () {
			$( '.preloader' ).addClass( 'preloader-deactivate' );
		}, 3000 );

	} );
</script>
<script>
	$( document ).ready( function () {
		$( '.customer-logos' ).slick( {
			slidesToShow: 4,
			slidesToScroll: 2,
			autoplay: true,
			autoplaySpeed: 1500,
			arrows: false,
			dots: false,
			pauseOnHover: false,
			responsive: [ {
				breakpoint: 768,
				settings: {
					slidesToShow: 1
				}
			}, {
				breakpoint: 520,
				settings: {
					slidesToShow: 2
				}
			} ]
		} );
	} );
</script>
<script>
	autoPlayYouTubeModal();

	//FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
	function autoPlayYouTubeModal() {
		var trigger = $( "body" ).find( '[data-toggle="modal"]' );
		trigger.click( function () {
			var theModal = $( this ).data( "target" ),
				videoSRC = $( this ).attr( "data-theVideo" ),
				videoSRCauto = videoSRC + "?autoplay=1";
			$( theModal + ' iframe' ).attr( 'src', videoSRCauto );
			$( theModal + ' button.close' ).click( function () {
				$( theModal + ' iframe' ).attr( 'src', videoSRC );
			} );
		} );
	}
</script>
@stop
