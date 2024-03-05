
<!-- menu -->
<div class="menu p-4 ">
   <!-- <div class="menu-header">
        <a href="{!! url('/dash') !!}" class="menu-header-logo">
            <img src="{!! asset('assets-admin') !!}/images/logo.png" alt="logo">
        </a>
        <a href="{!! url('/dash') !!}" class="btn btn-sm menu-close-btn">
            <i class="bi bi-x"></i>
        </a>
    </div>-->
    <div class="menu-body">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown">
                <div class="avatar me-3">
                    <img src="{!! URL::asset('assets/images/logo.png') !!}"
                         class="rounded-circle" alt="image">
                </div>
                <div>
                    <div class="fw-bold">{!! Session::get('admin')['user_name'] !!}</div>
                    <small class="text-muted">Admin</small>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">

                <a href="{!! url('auth/logout') !!}" class="dropdown-item d-flex align-items-center text-danger"
                   target="_blank">
                    <i class="bi bi-box-arrow-right dropdown-item-icon"></i> Logout
                </a>
            </div>
        </div>
        <ul>
            <li class="menu-divider">E-Commerce</li>
            <li>
                <a  class="{!! $nav == "home" ? "active" : "" !!}" href="{{url('/dash')}}"><span class="nav-link-icon"><i class="bi bi-bar-chart"></i></span><span>Dashboard</span></a>
            </li>
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-truck"></i>
                    </span>
                    <span>Products Management</span>
                </a>
                <ul>
                    <li>
                        <a href="{!! url('admin/shop/shop-product-size') !!}" class="{!! $nav == "shop-product-size" ? "active" : "" !!}">
                            <span class="label">Product Size</span>
                        </a>

                    </li>
                    <li>
                        <a href="#">
                            <span>Products</span>
                        </a>
                        <ul>
                            <li>
                                <a href="{!! url('admin/shop/new-product') !!}" class="{!! $nav == "new-product" ? "active" : "" !!}">
                                    <span class="label">New Products</span>
                                </a>
                            </li>
                            <li>
                                <a href="{!! url('admin/shop/shop-product') !!}" class="{!! $nav == "shop-product" ? "active" : "" !!}">
                                    <span class="label">All Products</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-wallet2"></i>
                    </span>
                    <span>Health Box</span>
                </a>
                <ul>
                    <li>
                        <a href="{!! url('admin/shop/new-healthbox') !!}" class="{!! $nav == "new-product" ? "active" : "" !!}">
                            <span class="label">New Health Box</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! url('admin/shop/shop-healthbox') !!}" class="{!! $nav == "shop-product" ? "active" : "" !!}">
                            <span class="label">All Health Box</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-wallet2"></i>
                    </span>
                    <span>Combo Product</span>
                </a>
                <ul>
                    <li>
                        <a href="{!! url('admin/shop/new-combo-product') !!}" class="{!! $nav == "new-combo" ? "active" : "" !!}">
                            <span class="label">New Combo Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! url('admin/shop/shop-combo-product') !!}" class="{!! $nav == "shop-combo" ? "active" : "" !!}">
                            <span class="label">All Combo Products</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="#" class="">
                    <span class="nav-link-icon">
                        <i class="bi bi-receipt"></i>
                    </span>
                    <span>Orders</span>
                </a>
                <ul>
                    <li>
                        <a  href="{!! url('admin/order/all-orders') !!}" class="{!! $nav == "all-orders" ? "active" : "" !!}">All Orders</a>
                    </li>
                    <li>
                        <a  href="{!! url('admin/order/new-orders') !!}" class="{!! $nav == "new-orders" ? "active" : "" !!}">New Orders</a>
                    </li>
                    <li>
                        <a  href="{!! url('admin/order/process-orders') !!}" class="{!! $nav == "process-orders" ? "active" : "" !!}">Process Orders</a>
                    </li>
                    <li>
                        <a  href="{!! url('admin/order/shipment-orders') !!}" class="{!! $nav == "shipment-orders" ? "active" : "" !!}">Shipment Orders</a>
                    </li>
                    <li>
                        <a  href="{!! url('admin/order/shipping-orders') !!}" class="{!! $nav == "shipping-orders" ? "active" : "" !!}">Shipping Orders</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{!! url('admin/shop/new-slider') !!}" class="{!! $nav == "new-slider" ? "active" : "" !!}">
                    <span class="nav-link-icon">
                        <i class="bi bi-wallet2"></i>
                    </span>
                    <span> Home Slider</span>
                </a>

            </li>
            {{--<li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi  bi-file-earmark-text"></i>
                    </span>
                    <span>Certificate</span>
                </a>
                <ul>
                    <li>
                        <a href="{!! url('admin/shop/shop-brand') !!}" class="{!! $nav == "shop-brand" ? "active" : "" !!}">All Certificate</a>
                    </li>
                    <li>
                        <a href="{!! url('admin/shop/new-brand') !!}" class="{!! $nav == "shop-brand" ? "active" : "" !!}">New Certificate</a>
                    </li>


                </ul>
            </li>
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-receipt"></i>
                    </span>
                    <span>About Home</span>
                </a>
                <ul>
                    <li>
                        <a href="{!! url('admin/shop/new-welcome-about') !!}" class="{!! $nav == "new-welcome-about" ? "active" : "" !!}">Welcome About</a>
                    </li>
                    <li>
                        <a href="{!! url('admin/shop/all-home-about') !!}" class="{!! $nav == "home-about" ? "active" : "" !!}">About Us</a>
                    </li>

                    <li>
                        <a href="{!! url('admin/shop/new-welcome-about') !!}" class="{!! $nav == "new-director-about" ? "active" : "" !!}">Director About </a>
                    </li>
                </ul>
            </li>--}}
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-chat-square"></i>
                    </span>
                    <span>Testimonial</span>
                </a>
                <ul>
                    <li>
                        <a  href="{!! url('admin/shop/shop-testimonial') !!}" class="{!! $nav == "shop-testimonial" ? "active" : "" !!}">All Testimonial</a>
                    </li>
                    <li>
                        <a  href="{!! url('admin/shop/new-testimonial') !!}" class="{!! $nav == "new-testimonial" ? "active" : "" !!}">New Testimonial</a>
                    </li>


                </ul>
            </li>
            <li>
                <a href="#">
                    <span class="nav-link-icon">
                        <i class="bi bi-bar-chart"></i>
                    </span>
                    <span>Reports</span>
                </a>
                <ul>
                    <li>
                        <a  href="{!! url('admin/reports/order-reports') !!}" class="{!! $nav == "order-reports" ? "active" : "" !!}">Order Reports</a>
                    </li>
                    <li>
                        <a  href="{!! url('admin/reports/customer-reports') !!}" class="{!! $nav == "customer-reports" ? "active" : "" !!}">Customer Reports</a>
                    </li>


                </ul>
            </li>

        </ul>
    </div>
</div>
<!-- ./  menu -->
