
<!DOCTYPE HTML>
<html lang="en">

<!-- Mirrored from townhub.kwst.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 Dec 2021 06:22:47 GMT -->
<head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="author" content="Digital Nawab" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!--=============== DYnamic Link  ===============-->
        <title>{{$title}}</title>
        <meta name="description" content="{{(isset($description) ? $description : " ")}}"/>
        <link rel="canonical" href="{{url()->current()}}" />
        <link rel="icon" href="{{asset('assets')}}/images/favicon.ico" type="image/x-icon/png" />
        <link rel="shortcut icon" type="image/x-icon/png" href="{{asset('assets')}}/images/favicon.ico" />
        <link rel="apple-touch-icon image_src" href="{{asset('assets')}}/images/favicon.ico">
        <!--=============== Css Link  ===============-->
        <link href="{!! URL::asset('assets') !!}/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="{!! URL::asset('assets') !!}/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link href="{!! URL::asset('assets') !!}/css/stylesheet.css" rel="stylesheet" type="text/css">
	    <link href="{!! URL::asset('assets/css/payment-style.css') !!}"  rel="stylesheet" type="text/css">
        <link href="{!! URL::asset('assets') !!}/css/responsive.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" media="all" href="{!! URL::asset('assets') !!}/css/animate.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @yield('css')
        <style>

            @media only screen and (max-width: 600px) {}
        </style>
    </head>
    <body>
        <div class="social_nav">
            <ul>
                <li><a href="https://hi-in.facebook.com/sonapureessentials/" target="blank"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
                <li><a href="" target="blank"><i class="fa fa-instagram"></i><span>Instagram</span></a></li>
                <li><a href="" target="blank"><i class="fa fa-linkedin" aria-hidden="true"></i><span>Linkedin</span></a></li>
            </ul>
        </div>
        <div id="sideNavi">
            <div class="side-navi-item item1"> <a href="{!! URL::asset('assets') !!}/pdf/SONA-Brochure.pdf" target="_blank"> <img src="{!! URL::asset('assets') !!}/images/brochure.png" class="img-responsive"> e-Brochure </a> </div>
        </div>
        <div class="search-input">
            <div class="icon-close material-icons"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAABmJLR0QA/wD/AP+gvaeTAAACVElEQVR4nO3cwW4TMRSF4QNIaVC7YYOyhncufQ5ALZQXKPA83VSJysK1Gg2asT1jj689/ydF3STR9TkZNfJElgAAAAAAAAAAAICevSv0voeXv0+F3n9tV5I+SHqsPUjIZ0l/JT1LOkm6kbSvOtEye7k1nOTW9FtujWb9kRv0/HGnNkvYy80+XM9DzaGmHPT/sK2WMBa+fxzGX1rPlV4v1ZZLCIV/lHRZbbqAa40P3kIJofCf5dZo1k7SV00v4Kek97UGnLCT9E3Ts/+Q7Q+QpDZL6CZ8r6USugvfa6GEbsP3LJfQffiexRI2E75nqYTNhe9ZKGGz4Xs1S9h8+F6NEgh/YM0SCH/EGiUQfkDJEgg/UokSCD9RzhIIf6YcJRD+QktKIPxM5pRA+JmllED4hcSU8EvSbeA5hL9ATAmEX9jcEgg/o9QSCL+AnaTvCod/r4bCf1t7gERvMj0HiWK+ag6/ojZzFViXGj4lZDQ3fErIICb8e4X/MVPCDCnbC7HbFpQQac7eDiVksmRjjRIWyrGrSQkz5dxSpoREJfbzKSFSyZsplBCwxp0sShix5m1EShiocQ+XEl7UvIG++RIs/HphsyVYCP98lk2VYCn885k2UYLF8M9n67oEy+F73ZbQQvhedyW0FL7XTQkthu91UcKNphdg/cCmC4V/7Pul2nQBoSPLrH7yh0JXwklureb0dGhf6EoweWif5M7VbD18b6wEs8dWSu5Q0we5QY9yB9y1GL53IbeGo17D/1R1okgfZfhoxxku5dYEAAAAAAAAAAAAIMk/F4B/3dB1vTQAAAAASUVORK5CYII="/></div>
            <input class="input-search" placeholder="Start Typing" type="text">
        </div>
        @include('include.home_header')


        @yield('body')


        @include('include.home_footer')


        <div class="scroll-top-wrapper "> <span class="scroll-top-inner"> <img src="{!! URL::asset('assets') !!}/images/scroll-top.png" alt=""> </span> </div>
        <div class="right-corder-container whatapp-us"> <a class="right-corder-container-button" target="_blank" href="https://wa.me/9161190190"> <span class="short-text"><i class="fa fa-whatsapp" aria-hidden="true"></i></span> </a> </div>


        <!--=============== scripts  ===============-->
        <script src="{!! URL::asset('assets') !!}/js/jquery-3.6.0.min.js"></script>
        <script src="{!! URL::asset('assets') !!}/js/bootstrap.js"></script>

        <script src="{!! URL::asset('assets') !!}/js/owl.carousel.min.js"></script>
        <noscript>
            <script src="{!! URL::asset('assets') !!}/js/testimonial.js"></script>
        </noscript>
        <script src="{!! URL::asset('assets') !!}/js/slick.js"></script>
        <script type="text/javascript" src="{!! URL::asset('assets') !!}/js/wow.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @yield('js')
        <script>


            $(document).on("click", ".addcart", function (){
                var price = $(this).data("price"), size = $(this).data("size"),  product_id = $(this).data("id");
                $.post("{!! url('cart/add-cart-product') !!}", {'price' : price, 'size' : size, '_token': '{!! csrf_token() !!}', 'product_id': product_id, 'qty': 1}, function(html){
                    var obj = $.parseJSON(html);
                    //$.alert("Product added to Cart.");
                    $('.toast-body').text(obj.msg);
                    $(".cart-count span").text(obj.count);
                    $('#liveToast').toast('show');
                });
            });

            $(document).on("click", ".buy_now", function(){
                var price = $(this).data("price"), size = $(this).data("size"),  product_id = $(this).data("id");
                $.post("{!! url('buy-now-product') !!}", {'price' : price, 'size' : size, '_token': '{!! csrf_token() !!}', 'product_id': product_id, 'qty': 1}, function(html){
                    var obj = $.parseJSON(html);
                    if(obj.code == 200){
                        $(".cart-count span").text(obj.count);
                        window.location.href = obj.url;
                    }

                });
            });
			
			//search
        $('.control').click( function(){
            $('body').addClass('search-active');
            $('.input-search').focus();
        });

        $('.icon-close').click( function(){
            $('body').removeClass('search-active');
        });

        </script>

    </body>


</html>
