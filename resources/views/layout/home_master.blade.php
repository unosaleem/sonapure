<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>{!! ucfirst($title) !!}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{!! URL::asset('assets/images/favicon.ico') !!}" rel="icon">
    <link href="{!! URL::asset('assets/images/favicon.ico') !!}" rel="apple-touch-icon">
    <link href="{!! URL::asset('assets/css/bootstrap.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! URL::asset('assets/css/font-awesome.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! URL::asset('assets/css/stylesheet.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! URL::asset('assets/css/responsive.css') !!}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" media="all" href="{!! URL::asset('assets/css/animate.min.css') !!}">
    <link rel="stylesheet" type="text/css" media="all" href="{!! URL::asset('assets/css/owl.carousel.css') !!}">
    <link rel="stylesheet" type="text/css" media="all" href="{!! URL::asset('assets/css/owl.theme.css') !!}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css"
        integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="https://db.onlinewebfonts.com/c/7780323b031a6775ce34221c4fd34988?family=Battle+Andy" rel="stylesheet" type="text/css"/>

    @yield('link')
    @yield('css')
</head>

<body>

    <div class="social_nav">
        <ul>
            <li>
                <a href="https://hi-in.facebook.com/sonapureessentials/" target="blank">
                    <i class="fa fa-facebook"></i><span>Facebook</span>
                </a>
            </li>
            <li><a href="https://www.instagram.com/sona_pure_essentials/" target="blank"><i
                        class="fa fa-instagram"></i><span>Instagram</span></a></li>

            <li><a href="https://www.linkedin.com/company/sona-pure-essentials/" target="blank"><i
                        class="fa fa-linkedin" aria-hidden="true"></i><span>Linkedin</span></a></li>
            <li><a href="https://wa.me/919839646686" target="blank"><i
                        class="fa fa-whatsapp"></i><span>Whatsapp</span></a></li>

        </ul>
    </div>
    <div id="sideNavi">
        <div class="side-navi-item item1">
            <a href="{!! URL::asset('assets/pdf/SONA-Brochure.pdf') !!}" target="_blank">
                <img src="{!! URL::asset('assets/images/brochure.png') !!}" class="img-responsive"> e-Brochure
            </a>
        </div>
    </div>
    @include('include.home_header')
    @yield('slider')
    @yield('body')
    <section class="container">
        <div class="subscribe-grid  wow fadeInUp" data-wow-offset="1" data-wow-duration="1s" data-wow-delay="0.2s"
            style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
            <div class="newsletter">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-xs-12 col-sm-12">
                        <div class="news-text">
                            <h2> <span>don't miss our deals</span> EXCLUSIVE<br>
                                OFFERS & SALE</h2>
                            <p>
                                Place Your Orders at <span>+91-9839646686</span><br>
                                Mail Us at <a href="mailto:support@sonapureessentials.com"
                                    target="_blank">support@sonapureessentials.com</a>
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
    <footer>
        @if(!isset($hide_footer) || !$hide_footer )
        <div class="footer-inner">
            <div class="container">
                <div class="footer-middle">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <!-- <div class="footer-column">
                                <div class="contacts-info">
                                    <h3>Email</h3>
                                    <div class="email-footer">
                                        <a href="mailto:support@sonapureessentials.com">support@sonapureessentials.com</a>
                                    </div>
                                    <h3>Place Orders At</h3>
                                    <div class="phone-footer">+91-9839646686</div>
                                    <h3>Address</h3>
                                    <address>
                                        17 / 1A, Madan Mohan Malviya Marg,
                                        Lucknow-226001, UP, India <br>
                                    </address>
                                </div>
                            </div> -->
                            <div class="footer-column">
                                <div class="foot-text">
                                    <a href="{!! url('/') !!}" class="footer-logo">
                                        <img src="{!! URL::asset('assets/images/green-logo.png') !!}" class="" alt="">
                                    </a>
                                    <p><b>FARM TO PALM <br> Serving Nature's Best!!! <br> Spreading Health And
                                            Happiness</b> </p>
                                    <p>100% Pure & Authentic | Zero Preservatives | No Added Colour</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="footer-column">
                                <h4>Policies</h4>
                                <ul class="links first-child">
                                    <!-- <li><a href="{!! url('the-health-box') !!}">The Health Box</a></li>
                                    <li><a href="{!! url('our-story') !!}">Our Story</a></li>
                                    <li><a href="{!! url('certifications') !!}" title=""> Certification</a></li> -->


                                    <li><a href="{!! url('terms-and-conditions') !!}" title=""> Terms and Conditions</a>
                                    </li>
                                    <li><a href="{!! url('privacy-policy') !!}" title="">Privacy Policy </a></li>
                                    <li><a href="{!! url('refund-and-cancellation') !!}" title=""> Refund and
                                            Cancellation</a></li>
                                    <li><a href="{!! url('shipping-and-return') !!}" title=""> Shipping and Return</a>
                                    <li><a href="{!! url('help-&-faq') !!}" title=""> Help & FAQ</a></li>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-12">
                            <div class="footer-column footer-column-last">
                                <h4>Support</h4>
                                <ul class="links">
                                    <li><a href="{!! url('signin') !!}" title=""> My Account</a></li>
                                    <li><a href="{!! url('cart') !!}" title=""> Shopping Cart</a></li>
                                    <li><a href="{!! url('disclaimer') !!}" title=""> Collaboration</a></li>
                                    <li><a href="{!! url('the-health-box') !!}" title="Our Gift Hampers">Our Gift Hampers</a></li>
                                    <li><a href="{!! url('contact-us') !!}" title=""> Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="footer-column footer-column-last">
                                <h4>Address</h4>
                                <div class="contacts-info">
                                    <address>
                                        17 / 1A, First Floor, Madan Mohan Malviya Marg,
                                        Lucknow-226001, UP, India
                                    </address>
                                </div>

                                <div class="footer-social">
                                    <ul class="d-flex justify-content-between align-items-center">
                                        <li>
                                            <a href="https://hi-in.facebook.com/sonapureessentials/" target="blank">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li><a href="https://www.instagram.com/sona_pure_essentials/" target="blank"><i
                                                    class="fa fa-instagram"></i></a></li>

                                        <li><a href="https://www.linkedin.com/company/sona-pure-essentials/"
                                                target="blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="https://wa.me/919839646686" target="blank"><i
                                                    class="fa fa-whatsapp"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

            <!--container-->
        </div>
        @endif
        <!--footer-inner-->

        <!--footer-middle-->
        <div class="footer-bg"></div>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-6 coppyleft"> Copyright © 2024-25 | SONA Pure Essentials Pvt. Ltd. | All rights
                        reserved
                    </div>
                    <div class="col-sm-6 col-xs-6 coppyright"> Powered by |
                        <a href="https://www.margsoft.com/" target="_blank">MARGSOFT Technologies (P) Limited</a>
                    </div>
                </div>
            </div>
        </div>
        <!--footer-bottom-->
        <!-- BEGIN SIMPLE FOOTER -->
    </footer>
    <div class="scroll-top-wrapper ">
        <span class="scroll-top-inner">
            <img src="{!! URL::asset('assets/images/scroll-top.png') !!}" alt="">
        </span>
    </div>
    <!-- <div class="right-corder-container whatapp-us">
    <a class="right-corder-container-button" target="_blank" href="https://wa.me/919839646686">
        <span class="short-text"><i class="fa fa-whatsapp" aria-hidden="true"></i></span>
    </a>
</div> -->
{{--    <script src="{!! URL::asset('assets/js/jquery-3.6.0.min.js') !!}"></script>--}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{!! URL::asset('assets/js/bootstrap.js') !!}"></script>
    <script src="{!! URL::asset('assets/js/owl.carousel.min.js') !!}"></script>
    <noscript>
        <script src="{!! URL::asset('assets/js/testimonial.js') !!}"></script>
    </noscript>
    <script src="{!! URL::asset('assets/js/slick.js') !!}"></script>
    <script type="text/javascript" src="{!! URL::asset('assets/js/wow.min.js') !!}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"
        integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('script')
    @yield('js')
    <script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

    <script>
    $(function() {
        let ms = {};
        let timeout = 2000;
        let tag_ms = $("#ourmethods-slider").find('.method-slider');
        tag_ms.each(function(k, el) {
            // console.log(k,el);
            ms[k] = {};
            let each_photo = $(el).find('.photo');
            each_photo.eq(0).show();

            ms[k]['photo_length'] = each_photo.length;
            ms[k]['active'] = 0;
            ms[k]['el'] = el;

            timeout = timeout + 2000;
            setInterval(ourslider_move, timeout, k, ms[k]);
        });

        function ourslider_move(ka, va) {

            let currentPosition = va.active;
            let photo = $(va.el).find('.photo');

            let speed = 500;

            let nextPhoto = 0;
            if (va.active < (va.photo_length - 1)) {
                nextPhoto = (currentPosition + 1);
            }
            photo.eq(currentPosition).fadeOut(speed);
            photo.eq(nextPhoto).fadeIn(speed);
            ms[ka]['active'] = nextPhoto;

        }
    })
    </script>

    <script>
    //product
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            autoplay: true,
            dots: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsiveClass: true,
            navText: ['<i class="fa fa-chevron-left"></i>',
            '<i class="fa fa-chevron-right"></i>'],
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: true
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: true,
                    margin: 10
                }
            }
        })

    })
    //all client
    $(document).ready(function() {
        $("#news-slider").owlCarousel({
            items: 3,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [1000, 2],
            itemsMobile: [650, 1],
            navigationText: false,
            autoPlay: true,
            autoplayTimeout: 3000,
        });
    });

    //scroll top
    </script>
    <script>
    $(document).ready(function() {
        $("#myModal").modal('show');
    });
    $(window).on('load', function() {

        setTimeout(function() {
            $('.preloader').addClass('preloader-deactivate');
        }, 3000);

    });
    </script>
    <script>
    autoPlayYouTubeModal();

    //FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
    function autoPlayYouTubeModal() {
        var trigger = $("body").find('[data-toggle="modal"]');
        trigger.click(function() {
            var theModal = $(this).data("target"),
                videoSRC = $(this).attr("data-theVideo"),
                videoSRCauto = videoSRC + "?autoplay=1";
            $(theModal + ' iframe').attr('src', videoSRCauto);
            $(theModal + ' button.close').click(function() {
                $(theModal + ' iframe').attr('src', videoSRC);
            });
        });
    }
    </script>
    <script>
    //wow
    wow = new WOW({
        animateClass: 'animated',
        offset: 100,
        callback: function(box) {
            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
    });
    /*wow.init();
    document.getElementById('moar').onclick = function () {
        var section = document.createElement('section');
        section.className = 'section--purple wow fadeInDown';
        this.parentNode.insertBefore(section, this);
    };*/

    //wow
    </script>
    <script>
    //header-fixed//

    $(document).ready(function() {
        $(window).bind('scroll', function() {
            var navHeight = $("#box1").height();
            ($(window).scrollTop() > navHeight) ? $('nav').addClass('goToTop'): $('nav').removeClass(
                'goToTop');
        });
    });
    // shopping-cart //
    (function() {
        $(document).click(function() {
            var $item = $(".shopping-cart");
            if ($item.hasClass("active")) {
                $item.removeClass("active");
            }
            if ($("input.search_box_active").length > 0) {
                $("input.search_box_active").toggleClass("search_box_active");
            }
        });

        $('.shopping-cart').each(function() {
            var delay = $(this).index() * 50 + 'ms';
            $(this).css({
                '-webkit-transition-delay': delay,
                '-moz-transition-delay': delay,
                '-o-transition-delay': delay,
                'transition-delay': delay
            });
        });
        $('#cart').click(function(e) {
            e.stopPropagation();
            $.get("{!! url('get-cart-details') !!}", function(html) {
                var obj = $.parseJSON(html);
                if (obj.code == 200) {
                    $(".shopping-cart .shopping-cart-header .shopping-cart-total span.total").html(
                        '<i class="fa fa-inr" aria-hidden="true"></i> ' + obj.total + '/-');
                    $(".shopping-cart ul.shopping-cart-items").html(obj.items);
                }
            });
            $(".shopping-cart").toggleClass("active");
        });

        $('#addtocart').click(function(e) {
            e.stopPropagation();
            $(".shopping-cart").toggleClass("active");
        });
    })();

    //tab megamenu
    $('.nav-tabs > li > a').hover(function() {
        $(this).tab('show');
    });

    $(document).ready(function() {

        $(function() {

            $(document).on('scroll', function() {

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
            $('html, body').animate({
                scrollTop: offsetTop
            }, 500, 'linear');
        }

    });
    </script>
    <script>
    $(document).on("click", ".addcart", function() {
        var price = $(this).data("price"),
            size = $(this).data("size"),
            product_id = $(this).data("id");
        $.post("{!! url('cart/add-cart-product') !!}", {
            'price': price,
            'size': size,
            '_token': '{!! csrf_token() !!}',
            'product_id': product_id,
            'qty': 1
        }, function(html) {
            var obj = $.parseJSON(html);
            //$('.toast-body').text(obj.msg);
            $("a#cart span").text(obj.count);
            location.reload();
        });
    });
    $(document).on("click", ".addcartheathbox", function() {
        var price = $(this).data("price"),
            size = $(this).data("size"),
            product_id = $(this).data("id");
        $.post("{!! url('cart/add-cart-healthbox') !!}", {
            'price': price,
            'size': size,
            '_token': '{!! csrf_token() !!}',
            'product_id': product_id,
            'qty': 1
        }, function(html) {
            var obj = $.parseJSON(html);
            //$('.toast-body').text(obj.msg);
            $("a#cart span").text(obj.count);
            //$('#liveToast').toast('show');
        });
    });

    $(document).on("change", ".change_size", function() {

        var parent = $(this).data("parent"),
            id = $(this).val();
        $.post("{!! url('/get-size-price') !!}", {
            "id": id,
            "_token": "{!! csrf_token() !!}"
        }, function(html) {
            var obj = $.parseJSON(html);
            if (obj.code == 200) {
                $("div#price_" + parent).html('<i class="fa fa-inr" aria-hidden="true"></i> ' + obj
                    .data['selling_price'].toFixed(2) + '');
                $("a#bag_" + parent).attr("data-price", obj.data['selling_price']);
                $("a#bag_" + parent).attr("data-size", obj.data['size']);
                //console.log($('section.product-grid').html());
                  $('section.product-grid').load($('section.product-grid').html());
            } else {
                location.reload();
            }
        });

    });
    </script>
    <script>
    $('#myCarousel').carousel({
        pause: true,
        interval: 5000,
    });

    $('#slider-animation').carousel({
        pause: true,
        interval: 5000,
    });
    //product
    // $(document).ready(function() {
    //     $('.owl-carousel').owlCarousel({
    //         loop: true,
    //         margin: 10,
    //         autoplay: false,
    //         dots: true,
    //         autoplayTimeout: 3000,
    //         autoplayHoverPause: true,
    //         responsiveClass: true,
    //         responsive: {
    //             0: {
    //                 items: 2,
    //                 nav: true
    //             },

    //             576: {
    //                 items: 2,
    //                 nav: true
    //             },
    //             768: {
    //                 items: 2,
    //                 nav: true
    //             },
    //             992: {
    //                 items: 3,
    //                 nav: true,
    //                 loop: true,
    //                 margin: 20
    //             }
    //         }
    //     })

    // })


    //Associates
    $(".vendor-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 600,
        items: 4,
        dots: false,
        loop: true,
        nav: true,
        navText: ['<i class="fa fa-chevron-left"></i>',
            '<i class="fa fa-chevron-right"></i>'
        ],
        responsive: {
            320: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1024: {
                items: 5
            }


        }
    });


    //Certifications
    $(".certifications-logos").owlCarousel({
        autoplay: true,
        smartSpeed: 600,
        items: 4,
        dots: false,
        loop: true,
        margin: 10,
        nav: true,
        navText: ['<i class="fa fa-chevron-left"></i>',
            '<i class="fa fa-chevron-right"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 4
            }


        }
    });
    </script>
    <script>
    autoPlayYouTubeModal();

    //FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
    function autoPlayYouTubeModal() {
        var trigger = $("body").find('[data-toggle="modal"]');
        trigger.click(function() {
            var theModal = $(this).data("target"),
                videoSRC = $(this).attr("data-theVideo"),
                videoSRCauto = videoSRC + "?autoplay=1";
            $(theModal + ' iframe').attr('src', videoSRCauto);
            $(theModal + ' button.close').click(function() {
                $(theModal + ' iframe').attr('src', videoSRC);
            });
        });
    }
    </script>


</body>

</html>