<!--section  -->
@php
    $model = new \App\ShopModel();
    $product_search = $model->getData('tbl_shop_categories', array('is_active'=>'1'), 'get');
    $slider = $model->getData('tbl_slider', array('is_active'=>'1'), 'get');
    $service_category = $model->getData('tbl_service_category', array('is_active'=>'1'), 'get');

@endphp
{{--
 @if(count($slider)!=0)
     <!--section  -->
     <section class="hero-section"   data-scrollax-parent="true">
         <div class="bg-tabs-wrap">
             <div class="bg-parallax-wrap" data-scrollax="properties: { translateY: '200px' }">
                 <!--ms-container-->
                 <div class="slideshow-container" data-scrollax="properties: { translateY: '300px' }" >
                     <div class="swiper-container">
                         <div class="swiper-wrapper">
                             <!--ms_item-->
                             @foreach($slider as $row)
                                 <div class="swiper-slide">
                                     <div class="ms-item_fs fl-wrap full-height">
                                         <img class="" src="{!!  URL::asset($row->slider_image) !!}" data-bg="{!!  URL::asset('http://3.110.38.250/' . $row->slider_image) !!}">
                                         <div class="overlay op7"></div>
                                     </div>
                                 </div>
                                 <!--ms_item end-->
                             @endforeach

                         </div>
                     </div>
                 </div>
                 <!--ms-container end-->
             </div>
         </div>
        <div class="container small-container">
             <div class="intro-item fl-wrap">
                 <span class="section-separator"></span>
                 <div class="bubbles">
                     <h1>Explore Best Quality Product</h1>
                 </div>
                 <h3>Find some of the best tips from around the city from our partners and friends.</h3>
             </div>
             <!-- main-search-input-tabs-->
             <div class="main-search-input-tabs  tabs-act fl-wrap">
                 <!--tabs -->
                 <div class="tabs-container fl-wrap  ">
                     <!--tab -->
                     <div class="tab">
                         <div id="tab-inpt1" class="tab-content first-tab">
                             <div class="main-search-input-wrap fl-wrap">

                                action="{!! url('search-service') !!}" action="{!! url('search-result') !!}

                                 <form method="get" id="search-form" >
                                     <div class="main-search-input fl-wrap">
                                         <div class="main-search-input-item">
                                             <select  name="category" class="chosen-select" >
                                                 <option value="Lucknow" selected>Lucknow</option>
                                                 <option value="delhi">Delhi</option>
                                             </select>
                                         </div>
                                         <div class="main-search-input-item">
                                             <select  name="category" class="chosen-select" >
                                                 <option disabled selected>What Do you Want</option>
                                                 <option value="Product">Product</option>
                                                 <option value="Services">Services</option>

                                             </select>
                                         </div>
                                         <div class="main-search-input-item">
                                             <select  name="category" class="chosen-select" >
                                                 <option>What Do you Want</option>
                                                 @if(count($product_search)!=0)
                                                     @foreach($product_search as $row)
                                                         <option value="{!! $row->id !!}" {!! isset($filter) ? ($filter['category']==$row->id ? "selected" : "" ) : "" !!}>{!! ucfirst($row->category_title) !!}</option>
                                                     @endforeach
                                                 @endif
                                             </select>
                                         </div>
                                         <div class="main-search-input-item">
                                             <label><i class="fal fa-keyboard"></i></label>
                                             <input placeholder="What are you looking for?" type="search" name="keyword"  value="{!! isset($filter) ? $filter['keyword'] : "" !!}" />
                                         </div>
                                         <button class="main-search-button color2-bg"  type="submit">Search <i class="far fa-search"></i></button>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                     <!--tab end-->


                 </div>
                 <!--tabs end-->
             </div>
             <!-- main-search-input-tabs end-->
             <div class="hero-categories fl-wrap">
                 @if(count($service_category)!=0)
                     <h4 class="hero-categories_title">Just looking around ? Use quick search by category :</h4>
                     <ul class="no-list-style">
                         @foreach($service_category as $row)
                            <li><a href="{!! url('service-category/'.$row->service_url) !!}"><i><img src="{{asset( $row->service_img)}}" width="50" height="50" alt=""></i> <span>{!! $row->service_title !!}</span></a></li>
                         @endforeach
                     </ul>
                 @endif
             </div>
         </div>
         <div class="header-sec-link">
             <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down"></i></a>
         </div>
     </section>
 @endif
 <!--section end-->
--}}

@if(count($slider)!=0)
    <section class="hero-section"   data-scrollax-parent="true">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($slider as $key=>$row)
                    <div class="carousel-item {{($key==0 ? 'active' : '')}}">

                        <img src="{!!  URL::asset($row->slider_image) !!}" class="d-block w-100" alt="{!! $row->slider_title !!}">
                    </div>
                @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="header-sec-link">
            <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down"></i></a>
        </div>
    </section>
@endif
