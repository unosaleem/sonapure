<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="dark" data-sidebar="light" data-sidebar-size="lg">
<head>

    <meta charset="utf-8" />
    <title>{!! $title !!}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sona Pure admin dashboard" name="description" />
    <meta content="digitalnawab" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{!! URL::asset('assets/images/favicon.ico') !!}">

    <!-- Layout config Js -->
    <script src="{!! URL::asset('assets-admin/js/layout.js') !!}"></script>
    <!-- Bootstrap Css -->
    <link href="{!! URL::asset('assets-admin/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{!! URL::asset('assets-admin/css/icons.min.css') !!}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{!! URL::asset('assets-admin/css/app.min.css') !!}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{!! URL::asset('assets-admin/css/custom.min.css') !!}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('style')
    @yield('css')
</head>

<body>

<!-- Begin page -->
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="{!! url('/dash') !!}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{!! URL::asset('assets/images/green-logo.png') !!}" alt="" height="22">
                        </span>
                            <span class="logo-lg">
                            <img src="{!! URL::asset('assets/images/green-logo.png') !!}" alt="" height="17">
                        </span>
                        </a>

                        <a href="{!! url('/') !!}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{!! URL::asset('assets/images/green-logo.png') !!}" alt="" height="22">
                        </span>
                            <span class="logo-lg">
                            <img src="{!! URL::asset('assets/images/green-logo.png') !!}" alt="" height="17">
                        </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                        <span class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>

                <div class="d-flex align-items-center">

                    <div class="dropdown d-md-none topbar-head-dropdown header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            <i class="bx bx-search fs-22"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                             aria-labelledby="page-header-search-dropdown">
                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                    <div class="dropdown topbar-head-dropdown ms-1 header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-category-alt fs-22'></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg p-0 dropdown-menu-end">
                            <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fw-semibold fs-15"> Shortcuts Apps  </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="p-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="{!! url('admin/dashboard') !!}">
                                            <img src="{!! URL::asset('assets-admin/images/brands/github.png') !!}" alt="Github">
                                            <span>Dashboard</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="{!! url('admin/shop/shop-product') !!}">
                                            <img src="{!! URL::asset('assets-admin/images/brands/bitbucket.png') !!}" alt="bitbucket">
                                            <span>Products</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="{!! url('admin/order/all-orders') !!}">
                                            <img src="{!! URL::asset('assets-admin/images/brands/dribbble.png') !!}" alt="dribbble">
                                            <span>Orders</span>
                                        </a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    {{--<div class="dropdown topbar-head-dropdown ms-1 header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-bell fs-22'></i>
                            <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">
                                3
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                             aria-labelledby="page-header-notifications-dropdown">

                            <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                        </div>
                                        <div class="col-auto dropdown-tabs">
                                            <span class="badge badge-soft-light fs-13"> 4 New</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-2 pt-2">
                                    <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                        id="notificationItemsTab" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab"
                                               aria-selected="true">
                                                All (4)
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab"
                                               aria-selected="false">
                                                Messages
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab"
                                               aria-selected="false">
                                                Alerts
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="tab-content" id="notificationItemsTabContent">
                                <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                    <div data-simplebar style="max-height: 300px;" class="pe-2">
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                                </div>
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-2 lh-base">Your <b>Elite</b> author Graphic
                                                            Optimization <span class="text-secondary">reward</span> is
                                                            ready!
                                                        </h6>
                                                    </a>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> Just 30 sec ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                               id="all-notification-check01">
                                                        <label class="form-check-label"
                                                               for="all-notification-check01"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                                class="text-reset notification-item d-block dropdown-item position-relative active">
                                            <div class="d-flex">
                                                <img src="assets/images/users/avatar-2.jpg"
                                                     class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                            graph 🔔.</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 48 min ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                               id="all-notification-check02" checked>
                                                        <label class="form-check-label"
                                                               for="all-notification-check02"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                <span
                                                        class="avatar-title bg-soft-danger text-danger rounded-circle fs-16">
                                                    <i class='bx bx-message-square-dots'></i>
                                                </span>
                                                </div>
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-2 fs-13 lh-base">You have received <b
                                                                    class="text-success">20</b> new messages in the conversation
                                                        </h6>
                                                    </a>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                               id="all-notification-check03">
                                                        <label class="form-check-label"
                                                               for="all-notification-check03"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <img src="assets/images/users/avatar-8.jpg"
                                                     class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">We talked about a project on linkedin.</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 4 hrs ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                               id="all-notification-check04">
                                                        <label class="form-check-label"
                                                               for="all-notification-check04"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="my-3 text-center">
                                            <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                                All Notifications <i class="ri-arrow-right-line align-middle"></i></button>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel"
                                     aria-labelledby="messages-tab">
                                    <div data-simplebar style="max-height: 300px;" class="pe-2">
                                        <div class="text-reset notification-item d-block dropdown-item">
                                            <div class="d-flex">
                                                <img src="assets/images/users/avatar-3.jpg"
                                                     class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">James Lemire</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">We talked about a project on linkedin.</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 30 min ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                               id="messages-notification-check01">
                                                        <label class="form-check-label"
                                                               for="messages-notification-check01"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-reset notification-item d-block dropdown-item">
                                            <div class="d-flex">
                                                <img src="assets/images/users/avatar-2.jpg"
                                                     class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                            graph 🔔.</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                               id="messages-notification-check02">
                                                        <label class="form-check-label"
                                                               for="messages-notification-check02"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-reset notification-item d-block dropdown-item">
                                            <div class="d-flex">
                                                <img src="assets/images/users/avatar-6.jpg"
                                                     class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">Kenneth Brown</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">Mentionned you in his comment on 📃 invoice #12501.
                                                        </p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 10 hrs ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                               id="messages-notification-check03">
                                                        <label class="form-check-label"
                                                               for="messages-notification-check03"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-reset notification-item d-block dropdown-item">
                                            <div class="d-flex">
                                                <img src="assets/images/users/avatar-8.jpg"
                                                     class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">We talked about a project on linkedin.</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 3 days ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                               id="messages-notification-check04">
                                                        <label class="form-check-label"
                                                               for="messages-notification-check04"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="my-3 text-center">
                                            <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                                All Messages <i class="ri-arrow-right-line align-middle"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab">
                                    <div class="w-25 w-sm-50 pt-3 mx-auto">
                                        <img src="assets/images/svg/bell.svg" class="img-fluid" alt="user-pic">
                                    </div>
                                    <div class="text-center pb-5 mt-2">
                                        <h6 class="fs-18 fw-semibold lh-base">Hey! You have no any notifications </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}

                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{!! url('assets-admin/images/users/avatar-1.jpg') !!}"
                                 alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{!! Session::get('admin')['user_name'] !!}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">Founder</span>
                            </span>
                        </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <h6 class="dropdown-header">Welcome {!! Session::get('admin')['user_name'] !!}!</h6>
                            <a class="dropdown-item" href="{!! url('admin/my-profile') !!}">
                                <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Profile</span>
                            </a>

                            <a class="dropdown-item" href="{!! url('admin/my-setting') !!}">
                                <i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                            <a class="dropdown-item" href="{!! url('auth/logout') !!}">
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle" data-key="t-logout">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="{!! url('/') !!}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{!! url('assets/images/green-logo.png') !!}" alt="" height="22">
                    </span>
                <span class="logo-lg">
                        <img src="{!! url('assets/images/green-logo.png') !!}" alt="" height="85">
                    </span>
            </a>
            <!-- Light Logo-->
            <a href="{!! url('/') !!}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{!! url('assets/images/green-logo.png') !!}" alt="" height="22">
                    </span>
                <span class="logo-lg">
                        <img src="{!! url('assets/images/green-logo.png') !!}" alt="" height="85">
                    </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div id="scrollbar">
            <div class="container-fluid">

                <div id="two-column-menu">
                </div>
                <ul class="navbar-nav" id="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link menu-link {!! $nav == "home" ? "active" : "" !!}" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="{!! $nav == "home" ? "true" : "false" !!}" aria-controls="sidebarDashboards">
                            <i class="ri-dashboard-2-line"></i>
                            <span data-key="t-dashboards">Dashboard</span>
                        </a>
                        <div class="collapse menu-dropdown {!! $nav == "home" ? "show" : "" !!}" id="sidebarDashboards">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{!! url('/dash') !!}" class="nav-link {!! $nav == "home" ? "active" : "" !!}" data-key="t-analytics"> Analytics </a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a href="dashboard-crm.html" class="nav-link" data-key="t-crm"> CRM </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="index.html" class="nav-link" data-key="t-ecommerce"> Ecommerce </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="dashboard-crypto.html" class="nav-link" data-key="t-crypto"> Crypto </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="dashboard-projects.html" class="nav-link" data-key="t-projects"> Projects </a>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </li>
                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Products Management</span></li>
                    <!-- Start Product Management -->
                    <li class="nav-item">
                        <a class="nav-link {!! $nav == "shop-product-size" ? "active" : "" !!}" href="{!! url('admin/shop/shop-product-size') !!}">
                            <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Product Size</span>
                        </a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link {!! $nav == "new-product" || $nav == "all-category" ? "active" : "" !!}" href="#sidebarAppsCategory" data-bs-toggle="collapse" role="button" aria-expanded="{!! $nav == "new-product" || $nav == "shop-product" ? "true" : "false" !!}" aria-controls="sidebarApps">
                            <i class="ri-apps-2-line"></i> <span data-key="t-apps">Category</span>
                        </a>
                        <div class="collapse menu-dropdown {!! $nav == "new-category" || $nav == "shop-product" ? "show" : "" !!}" id="sidebarAppsCategory">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/new-category') !!}" class="nav-link {!! $nav == "new-category" ? "active" : "" !!}" data-key="t-calendar"> New Category </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/all-category') !!}" class="nav-link {!! $nav == "all-category" ? "active" : "" !!}" data-key="t-chat"> All Category </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {!! $nav == "new-product" || $nav == "shop-product" ? "active" : "" !!}" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="{!! $nav == "new-product" || $nav == "shop-product" ? "true" : "false" !!}" aria-controls="sidebarApps">
                            <i class="ri-apps-2-line"></i> <span data-key="t-apps">Products</span>
                        </a>
                        <div class="collapse menu-dropdown {!! $nav == "new-product" || $nav == "shop-product" ? "show" : "" !!}" id="sidebarApps">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/new-product') !!}" class="nav-link {!! $nav == "new-product" ? "active" : "" !!}" data-key="t-calendar"> New Products </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/shop-product') !!}" class="nav-link {!! $nav == "shop-product" ? "active" : "" !!}" data-key="t-chat"> Products List </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {!! $nav == "new-health-product" || $nav == "list-health-products"  ? "active" : "" !!}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="{!! $nav == "new-health-product" || $nav == "list-health-products" ? "true" : "false" !!}" aria-controls="sidebarLayouts">
                            <i class="ri-rocket-line"></i> <span data-key="t-layouts">Health Box</span>
                        </a>
                        <div class="collapse menu-dropdown {!! $nav == "new-health-product" || $nav == "list-health-products" ? "show" : "" !!}" id="sidebarLayouts">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/new-healthbox') !!}" class="nav-link {!! $nav == "new-health-product" ? "active" : "" !!}" data-key="t-horizontal">New Health Box</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/shop-healthbox') !!}" class="nav-link {!! $nav == "list-health-products" ? "active" : "" !!}" data-key="t-detached">List Health Boxies</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <!-- End Product Management -->
                    <!-- Start Order Management -->
                   <li class="menu-title">
                        <i class="ri-more-fill"></i>
                        <span data-key="t-components">Event Management</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link {!! $nav == "new-testimonial" || $nav == "shop-testimonial" ? "active" : "" !!}" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button" aria-expanded="{!! $nav == "new-testimonial" || $nav == "shop-testimonial" ? "true" : "false" !!}" aria-controls="sidebarAdvanceUI">
                            <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Event & Media</span>
                        </a>
                        <div class="collapse menu-dropdown {!! $nav == "new-event" || $nav == "shop-event" ? "show" : "" !!}" id="sidebarAdvanceUI">
                            <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/new-event') !!}" class="nav-link {!! $nav == "new-event" ? "active" : "" !!}" data-key="t-nestable-list">
                                        New Event
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/shop-event') !!}" class="nav-link {!! $nav == "shop-event" ? "active" : "" !!}" data-key="t-sweet-alerts">
                                        List Event
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <!-- Start Order Management -->
                    <li class="menu-title">
                        <i class="ri-more-fill"></i>
                        <span data-key="t-components">Order Management</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link {!! $nav == "shipment-orders" || $nav == "all-orders" || $nav == "new-orders" || $nav == "process-orders" ? "active" : "" !!}" href="#orderManagement" data-bs-toggle="collapse" role="button" aria-expanded="{!! $nav == "shipment-orders" || $nav == "all-orders" || $nav == "new-orders" || $nav == "process-orders" ? "true" : "false" !!}" aria-controls="sidebarAuth">
                            <i class="ri-edit-circle-line"></i> <span data-key="t-authentication">Orders </span>
                        </a>
                        <div class="collapse menu-dropdown {!! $nav == "shipment-orders" ||$nav == "shipping-orders" || $nav == "all-orders" || $nav == "new-orders" || $nav == "process-orders" ? "show" : "" !!}" id="orderManagement">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{!! url('admin/order/all-orders') !!}" class="nav-link {!! $nav == "all-orders" ? "active" : "" !!}" data-key="t-basic">
                                        All Orders
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{!! url('admin/order/new-orders') !!}" class="nav-link {!! $nav == "new-orders" ? "active" : "" !!}" data-key="t-cover">
                                        New Orders
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{!! url('admin/order/process-orders') !!}" class="nav-link {!! $nav == "process-orders" ? "active" : "" !!}" data-key="t-cover">
                                        Process Orders
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{!! url('admin/order/shipment-orders') !!}" class="nav-link {!! $nav == "shipment-orders" ? "active" : "" !!}" data-key="t-cover">
                                        Shipment Orders
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a  href="{!! url('admin/order/shipping-orders') !!}" class="nav-link {!! $nav == "shipping-orders" ? "active" : "" !!}" data-key="t-cover">Pickuped Orders</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="menu-title"><i class="ri-more-fill"></i>
                        <span data-key="t-components">Web Management</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link {!! $nav == "new-slider" ? "active" : "" !!}" href="{!! url('admin/shop/new-slider') !!}" >
                            <i class="ri-pencil-ruler-2-line"></i> <span data-key="t-base-ui">Home Slider</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link menu-link {!! $nav == "new-testimonial" || $nav == "shop-testimonial" ? "active" : "" !!}" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button" aria-expanded="{!! $nav == "new-testimonial" || $nav == "shop-testimonial" ? "true" : "false" !!}" aria-controls="sidebarAdvanceUI">
                            <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Best Seller Banner</span>
                        </a>
                        <div class="collapse menu-dropdown {!! $nav == "new-banner" || $nav == "shop-banner" ? "show" : "" !!}" id="sidebarAdvanceUI">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/new-banner') !!}" class="nav-link {!! $nav == "new-banner" ? "active" : "" !!}" data-key="t-nestable-list">
                                        New Banner
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/shop-banner') !!}" class="nav-link {!! $nav == "shop-banner" ? "active" : "" !!}" data-key="t-sweet-alerts">
                                        List Banner
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link {!! $nav == "new-testimonial" || $nav == "shop-testimonial" ? "active" : "" !!}" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button" aria-expanded="{!! $nav == "new-testimonial" || $nav == "shop-testimonial" ? "true" : "false" !!}" aria-controls="sidebarAdvanceUI">
                            <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Testimonial</span>
                        </a>
                        <div class="collapse menu-dropdown {!! $nav == "new-testimonial" || $nav == "shop-testimonial" ? "show" : "" !!}" id="sidebarAdvanceUI">
                            <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/new-testimonial') !!}" class="nav-link {!! $nav == "new-testimonial" ? "active" : "" !!}" data-key="t-nestable-list">
                                        New Testimonial
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{!! url('admin/shop/shop-testimonial') !!}" class="nav-link {!! $nav == "shop-testimonial" ? "active" : "" !!}" data-key="t-sweet-alerts">
                                        List Testimonial
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="menu-title"><i class="ri-more-fill"></i>
                        <span data-key="t-components">Report Management</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link {!! $nav == "order-reports" || $nav == "customer-reports" ? "active" : "" !!}" href="#sidebarForms" data-bs-toggle="collapse" role="button" aria-expanded="{!! $nav == "order-reports" || $nav == "customer-reports" ? "true" : "false" !!}" aria-controls="sidebarForms">
                            <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Reports</span>
                        </a>
                        <div class="collapse menu-dropdown {!! $nav == "order-reports" || $nav == "customer-reports" ? "show" : "" !!}" id="sidebarForms">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{!! url('admin/reports/order-reports') !!}" class="nav-link {!! $nav == "order-reports" ? "active" : "" !!}" data-key="t-basic-elements">
                                        Order Reports
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{!! url('admin/reports/customer-reports') !!}" class="nav-link {!! $nav == "customer-reports" ? "active" : "" !!}" data-key="t-form-select"> Customer Reports </a>
                                </li>

                            </ul>
                        </div>
                    </li>



                </ul>
            </div>

        </div>
    </div>

    <div class="vertical-overlay"></div>


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                @yield('page-title')

                @yield('body')

            </div>

        </div>


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Sona Pure.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Digital Nawab
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>


</div>





<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>

<script src="{!! URL::asset('assets-admin/libs/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<script src="{!! URL::asset('assets-admin/libs/simplebar/simplebar.min.js') !!}"></script>
<script src="{!! URL::asset('assets-admin/libs/node-waves/waves.min.js') !!}"></script>
<script src="{!! URL::asset('assets-admin/libs/feather-icons/feather.min.js') !!}"></script>
<script src="{!! URL::asset('assets-admin/js/pages/plugins/lord-icon-2.1.0.js') !!}"></script>
<script src="{!! URL::asset('assets-admin/js/plugins.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{!! URL::asset('assets-admin/js/app.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield('script')
@yield('script-function')
</body>

</html>
