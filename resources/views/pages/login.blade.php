<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SONA Pure Essentials</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{!! URL::asset('assets') !!}/images/favicon.ico" rel="icon">
        <link href="{!! URL::asset('assets') !!}/images/favicon.ico" rel="apple-touch-icon">
        <link href="{!! URL::asset('assets') !!}/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="{!! URL::asset('assets') !!}/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link href="{!! asset('assets') !!}/css/login-style.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div class="img-story2"></div>
        <div id="container">
            <div class="login">
                <div class="content">
                    <div class="toplogo">
                        <a href="{!! url('/') !!}">
                            <img width="100%"  src="{!! asset('assets') !!}/images/green-logo.png" alt="">
                        </a>
                    </div>
                    <h1>Log In</h1>
                    @include('include.flash-msg')
                    <form method="post" action="{{url('/sign-in')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="url" value="{!! $url !!}"/>
                        <div class="login-content">
                            <div class="input-div one">
                                <div class="i"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </div>
                                <div class="div-box">
                                    <input type="email" name="email" class="input"  required="required" >
                                </div>
                            </div>
                            <div class="input-div pass">
                                <div class="i"> <i class="fa fa-key" aria-hidden="true"></i> </div>
                                <div class="div-box">
                                    <input type="password" name="password" class="input"  required="required" >
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="remember" for="remember">
                                <input type="checkbox" id="remember" />
                                <span>Remember me</span>
                            </label>
                            <span class="forget">
                                <a href="{!! url('/forgot-password') !!}" id="register">Reset Password?</a>
                            </span>
                            <span class="clearfix"></span>
                        </div>
                        <button type="submit" class="button-btn">Log In</button>
                    </form>
                    <span class="loginwith">
                        <a href="{{url('/signup')}}">Create account</a>
                    </span>
                    <span class="copy"> </span>
                </div>
            </div>
            <div class="page front">
                <div class="content">
                    <p>Welcome to</p>
                    <h2><a style="color:white !important;" href="{{url('/')}}">SONA Pure Essentials</a></h2>
                </div>
            </div>
            <div class="page back">
                <div class="content">
                    <p>Welcome to</p>
                    <h1>SONA Pure Essentials</h1>
                    <button type="" id="login" class="back-button">
                        <svg xmlns="" width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 8 8 12 12 16" />
                            <line x1="16" y1="12" x2="8" y2="12" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </body>
</html>

