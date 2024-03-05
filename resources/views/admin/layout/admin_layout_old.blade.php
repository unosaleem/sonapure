<!DOCTYPE html>
<html lang="en" data-footer="true" data-override='{"attributes": {"placement": "vertical" }}'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>{!! $title !!}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{!! URL::asset('assets-admin/images/favicon.png') !!}"/>

    <link rel="stylesheet" href="{!! URL::asset('assets-admin/dist/icons/themify-icons/themify-icons.css') !!}" type="text/css">

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&amp;display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{!! URL::asset('assets-admin/dist/icons/bootstrap-icons-1.4.0/bootstrap-icons.min.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/dist/icons/font-awesome/css/font-awesome.min.css') !!}" type="text/css">

    <link rel="stylesheet" href="{!! URL::asset('assets-admin/dist/css/bootstrap-docs.css') !!}" type="text/css">
    @yield('css')
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/dist/css/app.min.css') !!}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .item-action-buttons {
            display: none !important;
        }
    </style>
</head>
<body>


<!-- preloader -->
<div class="preloader">
    <img src="{!! URL::asset('assets-admin') !!}/images/logo.png" alt="logo">
{{--    <div class="preloader-icon"></div>--}}
</div>
<!-- ./ preloader -->


  @include('admin.include.admin_nav')
<!-- layout-wrapper -->
<div class="layout-wrapper">
   {{-- <!-- header -->
    <div class="header">
        <div class="menu-toggle-btn"> <!-- Menu close button for mobile devices -->
            <a href="#">
                <i class="bi bi-list"></i>
            </a>
        </div>
        <!-- Logo -->
        <a href="{!! url('/dash') !!}" class="logo">
            <img width="100" src="{!! asset(assets-) !!}.svg" alt="logo">
        </a>
        <!-- ./ Logo -->
        <div class="page-title">Overview</div>
        <form class="search-form">
            <div class="input-group">
                <button class="btn btn-outline-light" type="button" id="button-addon1">
                    <i class="bi bi-search"></i>
                </button>
                <input type="text" class="form-control" placeholder="Search..."
                       aria-label="Example text with button addon" aria-describedby="button-addon1">
                <a href="#" class="btn btn-outline-light close-header-search-bar">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </form>
        <div class="header-bar ms-auto">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-notify" data-count="2" data-sidebar-target="#notifications">
                        <i class="bi bi-bell icon-lg"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link nav-link-notify" data-count="3" data-bs-toggle="dropdown">
                        <i class="bi bi-cart2 icon-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                        <h6 class="m-0 px-4 py-3 border-bottom">Shopping Cart</h6>
                        <div class="dropdown-menu-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center">
                                    <a href="#" class="text-danger me-3" title="Remove">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="#" class="me-3 flex-shrink-0 ">
                                        <img src="{!! URL::asset('assets-admin') !!}/images/products/3.jpg" class="rounded" width="60"
                                             alt="...">
                                    </a>
                                    <div>
                                        <h6>Digital clock</h6>
                                        <div>1 x $1.190,90</div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center">
                                    <a href="#" class="text-danger me-3" title="Remove">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="#" class="me-3 flex-shrink-0 ">
                                        <img src="{!! URL::asset('assets-admin') !!}/images/products/4.jpg" class="rounded" width="60"
                                             alt="...">
                                    </a>
                                    <div>
                                        <h6>Toy Car</h6>
                                        <div>1 x $139.58</div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center">
                                    <a href="#" class="text-danger me-3" title="Remove">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="#" class="me-3 flex-shrink-0 ">
                                        <img src="{!! URL::asset('assets-admin') !!}/images/products/5.jpg" class="rounded" width="60"
                                             alt="...">
                                    </a>
                                    <div>
                                        <h6>Sunglasses</h6>
                                        <div>2 x $50,90</div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center">
                                    <a href="#" class="text-danger me-3" title="Remove">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="#" class="me-3 flex-shrink-0 ">
                                        <img src="{!! URL::asset('assets-admin') !!}/images/products/6.jpg" class="rounded" width="60"
                                             alt="...">
                                    </a>
                                    <div>
                                        <h6>Cake</h6>
                                        <div>1 x $10,50</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="m-0 px-4 py-3 border-top small">Sub Total : <strong
                                class="text-primary">$1.442,78</strong></h6>
                    </div>
                </li>
                <li class="nav-item ms-3">
                    <button class="btn btn-primary btn-icon">
                        <i class="bi bi-plus-circle"></i> Add Product
                    </button>
                </li>
            </ul>
        </div>
        <!-- Header mobile buttons -->
        <div class="header-mobile-buttons">
            <a href="#" class="search-bar-btn">
                <i class="bi bi-search"></i>
            </a>
            <a href="#" class="actions-btn">
                <i class="bi bi-three-dots"></i>
            </a>
        </div>
        <!-- ./ Header mobile buttons -->
    </div>
    <!-- content -->--}}
    <div class="content ">

        @yield('page-title')
        @yield('body')
    </div>

    <!-- content-footer -->
    <footer class="content-footer">
        <div>© 2022 SONAPURE ESSENTIALS - <a href="https://www.digitalnawab.com/" target="_blank">Digital Nawab</a></div>

    </footer>
    <!-- ./ content-footer -->
</div>

<!-- Bundle scripts -->
<script src="{!! URL::asset('assets-admin') !!}/libs/bundle.js"></script>
<!-- Main Javascript file -->
@yield('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{!! URL::asset('assets-admin') !!}/dist/js/app.min.js"></script>
@yield('js')
</body>
<!-- Mirrored from acorn-html-classic-dashboard.coloredstrategies.com/Interface.Content.Menu.VerticalSemiHidden.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Nov 2021 12:29:55 GMT -->
</html>

