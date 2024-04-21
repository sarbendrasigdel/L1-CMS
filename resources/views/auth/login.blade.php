<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/normalize.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/responsive.css">
    <script>
        var baseUrl = "{{ url('/') }}" + '/';
    </script>
    <title>Login | Admin</title>
</head>
<body>
<div class="g-recaptcha" data-sitekey="{{config('services.google_captcha.site_key')}}"
     data-callback="onSubmitExecuteInvisibleCaptcha" data-size="invisible"></div>
<div class="login-wrap" style="background-image: url('{{asset('assets/admin/images/bg-3.jpg')}}');">
    @include('layout.common.loader')
    <div class="login effect2">
        <form id="loginForm" method="post">
            @csrf

            <div class="login-form-box">
                <div class="login-desc-top">
                    <div class="login-icon-box">
                        {{--<img src="{{asset('assets/admin')}}/images/icon/locked-icon.png" alt="">--}}
                    </div>
                    <div class="login-desc-cap">
                        <h3>You are trying to access system </h3>
                        <p>Enter your username and password to allow this</p>
                    </div>
                </div>
                <div class="login-form-wrapper">
                    <div class="lg-error lg-error-top" style="display: none">
                    </div>
                    <div class="input-group mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-user icon"></i></div>
                        </div>
                        <input type="text" name="username" class="form-control required" placeholder="Username"
                               value="">
                        <div class="lg-error lg-error-btm" id="username_error" style="display: none">
                        </div>
                    </div>
                    <div class="input-group mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-key"></i></div>
                        </div>
                        <input type="password" name="password" class="form-control required" placeholder="Password">
                        <div class="lg-error lg-error-btm" id="password_error" style="display: none">
                        </div>
                    </div>
                    <div class="">
                        <input type="hidden" name="invisibleCaptcha" class="invisibleCaptcha">
                        <div class="error-message" id="invisibleCaptcha_err"></div>
                    </div>
                </div>
                <div class="login-footer ">
                    <div class="login-remember clearfix">
                        <div class="login-btn-wrap float-right">
                            <a href="javascript:void(0);" class="btn btn-login">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{asset('assets/admin')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('assets/admin')}}/js/bootstrap.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function onSubmitExecuteInvisibleCaptcha(token) {
        $('.invisibleCaptcha').val(token);
        onSubmit(token);
        setTimeout(function () {
            grecaptcha.reset();
        }, 2000);
    }
</script>
<script src="{{asset('assets/common')}}/js/login.js"></script>

</body>
</html>
