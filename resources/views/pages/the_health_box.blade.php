@extends('layout.home_master')
@section('css')@stop

<link href="{!! URL::asset('assets/css/cart.css') !!}" rel="stylesheet" type="text/css" />


@section('body')

<!-- hampers-box modal -->
<div class="modal fade" id="HelthboxModel" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog hampers-box-popup">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i
                        class="fa fa-times-circle" aria-hidden="true"></i> </button>
            </div>
            <div class="modal-body">
                <section class="innegrid">
                    <div id="" class="services">

                        <div class="row">
                            <div class="col-md-4">
                                <img src="{!! URL::asset('assets/images/gift-hampers/1.jpg') !!}" />
                            </div>
                            <div class="col-md-8">
                                <div class="_product-detail-content">
                                    <p class="_p-name"> The Health Box
                                    </p>
                                    <div class="_p-price-box">
                                        <div class="p-list"> <span class="price"> <i class="fa fa-inr"
                                                    aria-hidden="true"></i> 1400/- </span> </div>
                                        <div class="_p-features">
                                            <p>SPE’s Multiflora Honey is ethically sourced from bee hives in bee boxes
                                                of our Apiary in the forests of Uttarakhand, via certified beekeepers.
                                                The Nectar is collected from Eucalyptus, Mustard, Palash and Curry
                                                Leaves which gives it a subtle, mildly sweet flavour with multitude of
                                                health benefits, healing properties and goodness due to presence of
                                                antioxidants.&nbsp;</p>
                                        </div>
                                        <div class="_p-add-cart">
                                            <div class="_p-qty">
                                                <span>Add Quantity</span>
                                                <div class="value-button decrease_" id="decrease"
                                                    onclick="decreaseValue()">-</div>
                                                <input type="text" id="number" readonly aria-valuemin="1"
                                                    aria-valuemax="10" maxlength="2" value="1" />
                                                <div class="value-button increase_" id="increase"
                                                    onclick="increaseValue()">+</div>
                                            </div>
                                        </div>
                                        <div class="_p-qty-and-cart">
                                            <div class="_p-add-cart">
                                                <button class="btn-theme btn buy-btn buy-now" tabindex="0"> Proceed Now
                                                </button>
                                                <button class="btn-theme btn btn-success add-cart" tabindex="0"> <i
                                                        class="fa fa-shopping-cart"></i> Add to Cart </button>
                                                <button class="btn-theme wishlist-btn add-wishlist" tabindex="0"
                                                    alt="Add to Wish List">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- hampers-box modal -->

<!-- <div class="cursor"></div>
<div class="cursor cursor2"></div> -->
<div class="inner-grid" style="background: url(assets/images/inner-banners/Our-Gift-Hampers.jpg) no-repeat top center;">

<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Our Gift Hampers </h1>
            </div>
            <div class="col-lg-12 text-center">
                <div aria-label="breadcrumb" class="d-flex justify-content-center">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="https://sonapureessentials.com/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Our Gift Hampers </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="gift-hampers">
    <div class="hampers container">
        <div class="articles row">
            @foreach($healthbox as $row)
                <div class="col-md-4 col-6">
                    <article>
                      <div class="article-wrapper">
                            <figure> <img src="{!! URL::asset($row->product_image) !!}" /> </figure>
                            <div class="article-body">
                              <h2>{!! ucfirst($row->product_title) !!}</h2>
{{--                              <a href="javascript:void(0)" class="viewmore" data-id="{!! base64_encode($row->id) !!}"> View More</a>--}}
                              <a href="{!! url('/healthbox/'.$row->product_url) !!}" class="btn-giftbox"> View More</a>
                            </div>
                      </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>





@stop
@section('js')






<script>
/** Edit state script **/
$(document).on("click", ".viewmore", function() {
    let id = $(this).data("id");
    $.post('{!! url('
        admin / get - single - data ') !!}', {
            'tab': "healthbox",
            '_id': id,
            '_token': "{!! csrf_token() !!}"
        },
        function(html) {
            let obj = $.parseJSON(html);
            if (obj.code == 200) {
                $("#HelthboxModel .p-list .price").html('<i class="fa fa-inr" aria-hidden="true"></i>' + obj
                    .data['selling_price']);
                $("#HelthboxModel ._p-name").text(obj.data['product_title']);
                $("#HelthboxModel ._p-features p").html(obj.data['product_properties']);
                $("#HelthboxModel img").attr('src', obj.data['product_image']);
                $("#HelthboxModel .buy-now").attr('data-id', obj.data['id']);
                $("#HelthboxModel .buy-now").attr('data-price', obj.data['selling_price']);
                $("#HelthboxModel .add-cart").attr('data-id', obj.data['id']);
                $("#HelthboxModel .add-cart").attr('data-price', obj.data['selling_price']);
                $("#HelthboxModel .add-wishlist").attr('data-id', obj.data['id']);
                $("#HelthboxModel .add-wishlist").attr('data-type', '2');

                $("#HelthboxModel").modal("show");
            } else {
                $.alert(obj.msg);
            }
        });
});
$(document).on("click", ".add-cart", function() {
    console.log("hello");
    var price = $(this).data("price"),
        size = $(this).data("size"),
        product_id = $(this).data("id"),
        qty = $("input#number").val();
    $.post("{!! url('cart/add-cart-healthbox') !!}", {
        'price': price,
        'size': size,
        '_token': '{!! csrf_token() !!}',
        'product_id': product_id,
        'qty': qty
    }, function(html) {
        var obj = $.parseJSON(html);
        //$.alert("Product added to Cart.");
        $("a#cart span").text(obj.count);
        $("#HelthboxModel").modal("hide");
    });
});

$(document).on("click", ".buy-now", function() {
    var price = $(this).data("price"),
        size = $(this).data("size"),
        product_id = $(this).data("id"),
        qty = $("input#number").val();
    $.post("{!! url('buy-now-healthbox') !!}", {
        'price': price,
        'size': size,
        '_token': '{!! csrf_token() !!}',
        'product_id': product_id,
        'qty': qty
    }, function(html) {
        var obj = $.parseJSON(html);
        if (obj.code == 200) {
            $("a#cart span").text(obj.count);
            window.location.href = obj.url;
        }

    });
});
$(document).on("click", ".add-wishlist", function() {
    var type = $(this).data("type"),
        product_id = $(this).data("id");
    $.post("{!! url('my-profile/add-wishlist') !!}", {
        'type': type,
        '_token': '{!! csrf_token() !!}',
        'product_id': product_id
    }, function(html) {
        var obj = $.parseJSON(html);

        if (obj.code === 519) {
            var url = window.location.href;
            $.alert(obj.msg);
            window.location.href = '/signin?url=' + url; // Adjust the URL as needed

        } else {
            $.alert(obj.msg);
            setTimeout(function() {
                window.location.reload(true);
            }, 2000);
        }

    });
});
$('.add-wishlist').click(function() {
    $(this).find('i').toggleClass('fa fa-heart fi-rs-heart')

});
</script>




<script>
function decreaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    if (value > 1) {
        value--;
        document.getElementById('number').value = value;
    }
}

function increaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    if (value < 10) {
        value++;
        document.getElementById('number').value = value;
    }
}
</script>


@stop