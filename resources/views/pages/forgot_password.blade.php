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
            <h1>Forget Password</h1>
            <form method="post" id="forgetPassword">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="url" value="{!! $url !!}"/>
                <div class="login-content">
                    <div class="input-div one">
                        <div class="i"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </div>
                        <div class="div-box">
                            <input type="email" name="email" class="input" placeholder="Register Email.."  required="required" >
                        </div>

                    </div>
                    <label style="color: red; display: none" id="email-error" >Hello</label>
                </div>
                <div>
                    <span class="forget">
                        <a href="{!! url('/signin') !!}" id="register">Go to Login</a>
                    </span>
                    <span class="clearfix"></span>
                </div>
                <button type="submit" class="button-btn">Submit</button>
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
<script src="{!! URL::asset('assets/js/jquery-3.6.0.min.js') !!}"></script>
<script>
    $("form#forgetPassword").submit(function(){
         $.post('{!! url('/forgot-password') !!}', $("form#forgetPassword").serialize(), function (html){
            var obj = $.parseJSON(html);
            if(obj.code == 200){
                $("#email-error").css({'color': 'rgb(24, 60, 33)', 'display': 'block'});
                $("#email-error").text(obj.msg);
                $("input[name='email']").val('');
            }
            console.log(html);
            return false;
         });
         return false;
    });

    $(document).on("change", "input[name='email']", function (){
        var email = $(this).val();
        $.post("{!! url('/check-email') !!}", {'email' : email, '_token': "{!! csrf_token() !!}"}, function (html){
            var obj = $.parseJSON(html);
            if(obj.code==400){
                $("#email-error").css("display", "block");
                $("#email-error").text(obj.msg);
            }else{
                $("#email-error").css("display", "none");
            }
        });

    });
</script>
</body>
</html>

