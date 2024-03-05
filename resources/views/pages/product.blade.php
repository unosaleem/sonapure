@extends('layout.home_master')
@section('css')

@stop
@section('body')

    @php
        $model = new \App\HomeModel();
    @endphp


@section('body') @php $model = new \App\HomeModel(); @endphp
<!-- Page Title/Header Start -->
<!--start breadcrumb-->
<section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
    <div class="container">
        <div class="page-breadcrumb d-flex align-items-center">
            <h3 class="breadcrumb-title pe-3">Shop </h3>
            <div class="ms-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="bx bx-home-alt"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">Shop</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Shop Product</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!--end breadcrumb-->

<!--start shop area-->
<section class="py-4">
    <div class="container">
        <div class="row">
            {{--<div class="col-12 col-xl-3">
                <div class="btn-mobile-filter d-xl-none"><i class='bx bx-slider-alt'></i>
                </div>
                <div class="filter-sidebar d-none d-xl-flex">
                    <div class="card rounded-0 w-100">
                        <div class="card-body">
                            <div class="align-items-center d-flex d-xl-none">
                                <h6 class="text-uppercase mb-0">Filter</h6>
                                <div class="btn-mobile-filter-close btn-close ms-auto cursor-pointer"></div>
                            </div>
                            <hr class="d-flex d-xl-none" />
                            <div class="product-categories">
                                <h6 class="text-uppercase mb-3">Categories</h6>
                                <ul class="list-unstyled mb-0 categories-list">
                                    <li><a href="javascript:;">Clothings <span class="float-end badge rounded-pill bg-primary">42</span></a>
                                    </li>
                                    <li><a href="javascript:;">Sunglasses <span class="float-end badge rounded-pill bg-primary">32</span></a>
                                    </li>
                                    <li><a href="javascript:;">Bags <span class="float-end badge rounded-pill bg-primary">17</span></a>
                                    </li>
                                    <li><a href="javascript:;">Watches <span class="float-end badge rounded-pill bg-primary">217</span></a>
                                    </li>
                                    <li><a href="javascript:;">Furniture <span class="float-end badge rounded-pill bg-primary">28</span></a>
                                    </li>
                                    <li><a href="javascript:;">Shoes <span class="float-end badge rounded-pill bg-primary">145</span></a>
                                    </li>
                                    <li><a href="javascript:;">Accessories <span class="float-end badge rounded-pill bg-primary">15</span></a>
                                    </li>
                                    <li><a href="javascript:;">Headphones <span class="float-end badge rounded-pill bg-primary">8</span></a>
                                    </li>
                                </ul>
                            </div>
                            <hr>
                            <div class="price-range">
                                <h6 class="text-uppercase mb-3">Price</h6>
                                <div class="my-4" id="slider"></div>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-dark btn-sm text-uppercase rounded-0 font-13 fw-500">Filter</button>
                                    <div class="ms-auto">
                                        <p class="mb-0">Price: $200.00 - $900.00</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="size-range">
                                <h6 class="text-uppercase mb-3">Size</h6>
                                <ul class="list-unstyled mb-0 categories-list">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="Small">
                                            <label class="form-check-label" for="Small">Small</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="Medium">
                                            <label class="form-check-label" for="Medium">Medium</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="Large">
                                            <label class="form-check-label" for="Large">Large</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="ExtraLarge">
                                            <label class="form-check-label" for="ExtraLarge">Extra Large</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <hr>
                            <div class="product-brands">
                                <h6 class="text-uppercase mb-3">Brands</h6>
                                <ul class="list-unstyled mb-0 categories-list">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="Adidas">
                                            <label class="form-check-label" for="Adidas">Adidas (15)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="Armani">
                                            <label class="form-check-label" for="Armani">Armani (26)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="CalvinKlein">
                                            <label class="form-check-label" for="CalvinKlein">Calvin Klein (24)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="Columbia">
                                            <label class="form-check-label" for="Columbia">Columbia (38)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="JhonPlayers">
                                            <label class="form-check-label" for="JhonPlayers">Jhon Players (48)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="Diesel">
                                            <label class="form-check-label" for="Diesel">Diesel (64)</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <hr>
                            <div class="product-colors">
                                <h6 class="text-uppercase mb-3">Colors</h6>
                                <ul class="list-unstyled mb-0 categories-list">
                                    <li>
                                        <div class="d-flex align-items-center cursor-pointer">
                                            <div class="color-indigator bg-black"></div>
                                            <p class="mb-0 ms-3">Black</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center cursor-pointer">
                                            <div class="color-indigator bg-warning"></div>
                                            <p class="mb-0 ms-3">Yellow</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center cursor-pointer">
                                            <div class="color-indigator bg-danger"></div>
                                            <p class="mb-0 ms-3">Red</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center cursor-pointer">
                                            <div class="color-indigator bg-primary"></div>
                                            <p class="mb-0 ms-3">Blue</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center cursor-pointer">
                                            <div class="color-indigator bg-white"></div>
                                            <p class="mb-0 ms-3">White</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center cursor-pointer">
                                            <div class="color-indigator bg-success"></div>
                                            <p class="mb-0 ms-3">Green</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center cursor-pointer">
                                            <div class="color-indigator bg-info"></div>
                                            <p class="mb-0 ms-3">Sky Blue</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="col-12 col-xl-12">
                <div class="product-wrapper">

                    <div class="product-grid">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                            @if(count($product)!=0)
                                @foreach($product as $row)
                                    <div class="col">
                                        <div class="card rounded-0 product-card">
                                            <div class="card-header bg-transparent border-bottom-0">
                                                <div class="d-flex align-items-center justify-content-end gap-3">
                                                    <a href="{!!  url('product/'.$row->product_url) !!}" class="image">
                                                        @if($row->product_discount !=0)
                                                            <span class="product-badges position-relativee">
                                                                <img  class="img-responsive position-absolute offer-img" src="{{asset('assets')}}/images/special-offer.png" alt="">
                                                                <span class="onsale">{!! $row->product_discount !!}%</span>
                                                            </span>
                                                        @endif
                                                        {{--@if($remain == 0)
                                                            <span class="product-badges">
															<img  class="img-responsive position-absolute sold-img" src="{{asset('assets')}}/images/sold-out.png" alt="">
--}}{{--                                                        <span class="onsale sold">Sold </span>--}}{{--
                                                            </span>
                                                        @endif--}}
                                                    </a>
                                                    <a class="add-to-wishlist hintT-left add-wishlist" data-id="{!! $row->id !!}" data-price="{!! $row->discount_price !!}" data-hint="Add to wishlist">
                                                        <div class="product-wishlist"> <i class='bx bx-heart'></i></div>
                                                    </a>
                                                </div>
                                            </div>
                                            <a href="{!! url('product/'.$row->product_url) !!}">
                                                <img src="{!! asset($row->header_image) !!}" class="card-img-top" alt="{!! $row->product_title_eng !!}">
                                            </a>
                                            <div class="card-body">
                                                <div class="product-info">
                                                    <a href="javascript:;">
                                                        <p class="product-catergory font-13 mb-1">{!! $row->subcategory_eng !!}</p>
                                                    </a>
                                                    <a href="javascript:;">
                                                        <h6 class="product-name mb-2">{!! $row->product_title_eng !!}</h6>
                                                    </a>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mb-1 product-price">
                                                            @if($row->product_discount !=0)
                                                                <span class="me-1 text-decoration-line-through">&#x20B9;	 {!! number_format($row->product_price, 2) !!}</span>
                                                            @endif
                                                            <span class="fs-5">&#x20B9; {!! number_format($row->discount_price, 2) !!}</span>
                                                        </div>
                                                        <div class="cursor-pointer ms-auto">
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                        </div>
                                                    </div>
                                                    <div class="product-action mt-2">
                                                        <div class="d-grid gap-2">

                                                                <a data-id="{!! $row->id !!}" data-price="{!! $row->discount_price !!}" href="javascript:void(0)" data-hint="Add to Cart"  class="btn btn-dark btn-ecomm addcart">	<i class='bx bxs-cart-add'></i>Add to Cart</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!--end row-->
                    </div>
                    <hr>
                    <nav class="d-flex justify-content-between" aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="javascript:;"><i class='bx bx-chevron-left'></i> Prev</a>
                            </li>
                        </ul>
                        <ul class="pagination">
{{--                            <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">1<span class="visually-hidden">(current)</span></span>--}}
{{--                            </li>--}}
                            @if(count($product)!=0) {!! $product->links() !!} @endif
                        </ul>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="javascript:;" aria-label="Next">Next <i class='bx bx-chevron-right'></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</section>
<!--end shop area-->


<!-- Shop Products Section Start -->

@stop @section('js')
{{--    <script src="{!! asset('assets/js/jquery.slimscroll.js') !!}"></script>--}}
    <script>
        $(document).on("click", ".filter", function () {
            var formdata = $("form#filter").serialize();
            $.get("{!! url('offer-filter') !!}", formdata, function (html) {
                var obj = $.parseJSON(html);
                $(".tab-content #data_grid").html("");
                $(".tab-content #data_grid").html(obj.grid);
                $(".tab-content #list-view").html("");
                $(".tab-content #list-view").html(obj.list);
                $(".pagination-wrapper").html(obj.links);
            });
            //alert(formdata);
        });
    </script>

@stop
