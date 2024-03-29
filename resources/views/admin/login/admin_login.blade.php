<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
<head>
    <meta charset="utf-8" />
    <title>{!! $title !!}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sona Pure admin dashboard" name="description" />
    <meta content="digitalnawab" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{!! URL::asset('assets/images/favicon.ico') !!}">

    <!-- Layout config Js -->
    <script src="{!! URL::asset('assets-admin/js/layout.js')!!}"></script>
    <!-- Bootstrap Css -->
    <link href="{!! URL::asset('assets-admin/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{!! URL::asset('assets-admin/css/icons.min.css') !!}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{!! URL::asset('assets-admin/css/app.min.css') !!}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{!! URL::asset('assets-admin/css/custom.min.css') !!}" rel="stylesheet" type="text/css" />


</head>

<body>

<!-- auth-page wrapper -->
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="row g-0">

                            <div class="col-lg-6">
                                <div class="card-h">
                                   
                                        
                                        <p>Login</p>
                                   

                                    <div class="mt-4">
                                        <form method="post" action="{!! url('auth/login') !!}">
                                            {!! csrf_field() !!}
                                            <div class="mb-3">
                                                {{-- <label for="username" class="form-label">Email</label> --}}
                                                <input type="text" class="form-control" name="email" id="username" placeholder="Enter Email" required>
                                            </div>

                                            <div class="mb-3">
                                               
                                                {{-- <label class="form-label" for="password-input">Password</label> --}}
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" class="form-control pe-5" name="password" placeholder="Enter password" id="password-input" required>
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted mt-2" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                            </div>
                                            <div class="float-end">
                                                <a href="#" class="text-muted">Forgot password?</a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="mt-3">
                                                <button class="btn-login" type="submit">Login</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card-h auth-one-bg h-100">
                                    <div class="bg-overlay"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="{!! url('/') !!}" class="d-block text-center">
                                                <img src="{!! URL::asset('assets-admin/images/logo.png') !!}" alt="" height="140">
                                            </a>
                                        </div>
                                        <div class="mt-auto">
                                            {{-- <div class="mb-3">
                                                <i class="ri-double-quotes-l display-4 text-success"></i>
                                            </div> --}}

                                            <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                {{-- <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                </div> --}}
                                                <div class="carousel-inner text-center text-white-50">
                                                    <div class="carousel-item active">
                                                        
                                                        <p class="">Sona Pure Essentials</p>
                                                        <span>www.sonapureessentials.com</span>
                                                    </div>
                                                    {{-- <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" The theme is really great with an amazing customer support."</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <!-- end carousel -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0">
                            {{-- <script>document.write(new Date().getFullYear())</script>  --}}
                            Copyright &copy; 2022-23 <a href="https://sonapureessentials.com/" target="_blank" style="color: #060">SONA Pure Essentials</a> | All right reserved 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->

<!-- JAVASCRIPT -->
<script src="{!! URL::asset('assets-admin/libs/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<script src="{!! URL::asset('assets-admin/libs/simplebar/simplebar.min.js') !!}"></script>
<script src="{!! URL::asset('assets-admin/libs/node-waves/waves.min.js') !!}"></script>
<script src="{!! URL::asset('assets-admin/libs/feather-icons/feather.min.js') !!}"></script>
<script src="{!! URL::asset('assets-admin/js/pages/plugins/lord-icon-2.1.0.js') !!}"></script>
<script src="{!! URL::asset('assets-admin/js/plugins.js') !!}"></script>

<!-- password-addon init -->
<script src="{!! URL::asset('assets-admin/js/pages/password-addon.init.js') !!}"></script>
</body>

</html>

