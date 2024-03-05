  @php
      $product = \App\FunctionModel::getData('tbl_product', array('is_active'=>'1', 'is_front'=> '1'), 'get');
      $wishlist = array();
      if(Session::has('client')){
          $profile= \App\FunctionModel::getData('tbl_client', array('id'=> Session::get('client')['id']), 'first');
          $wishlist= \App\FunctionModel::getData('tbl_wishlist', array('user_id'=> Session::get('client')['id'],'is_active'=>'1'), 'get');
      }

//      echo '<pre>'; print_r($wishlist); exit;
      $card = Cart::instance('shopping')->content();

  @endphp

  <header class="topheader">
      <!-- box1 -->
      <div id="box1" class="home"> </div>
      <!-- /box1 -->
      <nav class="nav-bar">
          <div class="container">
              <div class="wrapper">
                  <div class="logo">
                      <a href="{!! url('/') !!}">
                          <img src="{!! URL::asset('assets/images/green-logo.png') !!}" class="img-fluid" alt="SONA Pure Essentials">
                      </a>
                  </div>
                  <input type="radio" name="slider" id="menu-btn">
                  <input type="radio" name="slider" id="close-btn">
                  <ul class="nav-links">
                      <label for="close-btn" class="btn close-btn">
                          <img src="{!! URL::asset('assets/images/close.svg') !!}" alt="">
                      </label>
                      <li>
                          <a href="#" class="desktop-item">About Us <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                          <input type="checkbox" id="showDrop">
                          <label for="showDrop" class="mobile-item">About Us <i class="fa fa-angle-down" aria-hidden="true"></i></label>
                          <ul class="drop-menu">
                              <!-- <li><a href="{!! url('about-sona') !!}">About SONA Pure Essentials </a></li> -->
                             <li><a href="{!! url('our-essence') !!}">Our Essence</a></li>
                              <li><a href="{!! url('our-methods') !!}">Our Methods</a></li>
                              <li><a href="{!! url('certifications') !!}">Our Certifications</a></li>
							  <!-- <li><a href="{!! url('our-strength') !!}"> Our Strength</a></li> -->
							  <li><a href="{!! url('our-team') !!}">Our Team</a></li>
							   <li><a href="{!! url('our-story') !!}">Our Story</a></li>
							   <li><a href="{!! url('our-associatespartners') !!}"> Our Associates and Partners</a></li>
                               <li><a href="{!! url('our-lab-report') !!}"> Our Lab Report</a></li>
                               
                          </ul>
                      </li>
                      <li>
                          <a href="#" class="desktop-item">Products <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                          <input type="checkbox" id="showMega">
                          <label for="showMega" class="mobile-item">Products <i class="fa fa-angle-down" aria-hidden="true"></i></label>
                          <div class="container mega-box">
                              <div class="content">
                                    <div class="row">

                                       <div class="col-md-3">
                                          @if(count($product) !=0)
                                              <ul class="nav nav-tabs tabs-left" id="style-scroll">
                                                  @foreach($product as $key=>$row)
                                                      <li class="{!! $key == '0' ? "active" : "" !!}">
                                                          <a href="#{!! $row->product_url !!}" data-toggle="tab" onclick="window.location.href = '{!! url('shop', $row->product_url) !!}';">{!! $row->product_title !!}</a>
                                                          <a href="{!! url('shop', $row->product_url) !!}" class="product-mobile-view">{!! $row->product_title !!}</a>
                                                      </li>
                                                  @endforeach
                                              </ul>
                                          @endif

                                      </div>
                                      <div class="col-md-9">
                                          @if(count($product) !=0)
                                              <div class="tab-content">
                                                  @foreach($product as $key=>$row)
                                                      <div class="tab-pane {!! $key == '0' ? "active" : "" !!}" id="{!! $row->product_url !!}">
                                                          <a href="{!! url('shop', $row->product_url) !!}">
                                                              <img src="{!! URL::asset($row->product_banner_image) !!}" alt="">
                                                          </a>
                                                      </div>
                                                  @endforeach
                                              </div>
                                          @endif
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </li>
                      <li><a href="{!! url('the-health-box') !!}">Our Gift Hampers</a></li>
                      <li class="logo-center">
                          <a href="{!! url('/') !!}">
                              <svg width="150" height="150" viewBox="0 0 100 100">
                                  <symbol id="twinkle" viewBox="0 0 100 100">
                                      <g class="group" opacity="0.8">
                                          <g class="large">
                                              <path id="large" d="M41.25,40 L42.5,10 L43.75,40 L45, 41.25 L75,42.5 L45,43.75 L43.75,45 L42.5,75 L41.25,45 L40,43.75 L10,42.5 L40,41.25z " fill="white" />
                                          </g>
                                          <g class="large-2" transform="rotate(45)">
                                              <use xlink:href="#large" />
                                          </g>
                                          <g class="small">
                                              <path id="small" d="M41.25,40 L42.5,25 L43.75,40 L45,41.25 L60,42.5 L45,43.75 L43.75,45 L42.5,60 L41.25,45 L40,43.75 L25,42.5 L40,41.25z" fill="white" />
                                          </g>
                                      </g>
                                  </symbol>
                                  <use xlink:href="#twinkle" x="0" y="0" width="50" height="50" />
                              </svg>
                              <img src="{!! URL::asset('assets/images/green-logo.png') !!}" class="img-fluid" alt="SONA Pure Essentials">
                          </a>
                      </li>
                      <li><a href="{!! url('event-media') !!}">Event and Media</a></li>
                      <li><a href="{!! url('contact-us') !!}">Contact Us</a></li>
                  </ul>
                  <label for="menu-btn" class="btn menu-btn">
                      <img src="{!! URL::asset('assets/images/bar.svg') !!}" alt="">
                  </label>
                  <div class="navbar-right">
                      <ul class="top_bar_contact_list">
                      <li class="nav-item">
                              <a href="{!! url('/my-profile/wishlist') !!}">
                              <i class="fa fa-heart-o" aria-hidden="true"></i><span class="badge">{!!  count($wishlist) != 0 ? count($wishlist) :'0' !!}</span>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="javascript:void(0)" id="cart">
                              <img src="{!! URL::asset('assets/images/cart-icon.svg') !!}" class="img-fluid">
                                  <span class="badge">{!! count($card) !=0 ? count($card) : 0 !!}</span>
                              </a>
                              <div class="shopping-cart">
                                  <div class="shopping-cart-header">
                                      <div class="shopping-cart-total">
                                          <span class="lighter-text">Total:</span>
                                          <span class="main-color-text total">
                                            <i class="fa fa-inr" aria-hidden="true"></i> 00.00
                                        </span>
                                      </div>
                                  </div>
                                  <ul class="shopping-cart-items">
                                      {{--<li class="clearfix">
                                          <img src="{!! URL::asset('assets/images/card-1.png') !!}" alt="item1" />
                                          <span class="item-name">Turmeric</span> <span class="item-detail">(हरिद्रा/हल्दी)</span>
                                          <span class="item-price"><i class="fa fa-inr" aria-hidden="true"></i> 999.00</span>
                                          <span class="item-quantity">Quantity: 01</span>
                                      </li>--}}
                                  </ul>
                                  <a href="{!! url('/cart') !!}" class="button">
                                      <i class="fa fa-check" aria-hidden="true"></i> View on Cart
                                  </a>
                              </div>
                          </li>
                          <li class="nav-item">
                              <div class="right">
                                  @if(Session::has('client'))
                                      <span class="login-button toggle-login">
                                        <span>{!! ucfirst($profile->first_name) !!}</span>
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                      </span>
                                      <div class="login">
                                          <div class="triangle"></div>
                                          <ul>
                                              <li><a href="{!! url('/my-profile/profile') !!}">My Account</a></li>
                                              <li><a href="{{url('/my-profile/order-history')}}"> Order History</a></li>
                                              <li><a href="{{url('/logout')}}">Logout</a></li>
                                          </ul>
                                      </div>
                                  @else
                                      <span class="login-button toggle-login">
                                        <span>Login </span><i class="fa fa-angle-down" aria-hidden="true"></i>
                                      </span>
                                      <div class="login">
                                          <div class="triangle"></div>
                                          <ul>
                                              <li><a href="{!! url('signin') !!}"><i class="fa fa-user" aria-hidden="true"></i> Login Account </a></li>
                                          </ul>
                                      </div>
                                  @endif

                              </div>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </nav>
  </header>
