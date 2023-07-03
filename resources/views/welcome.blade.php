<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Rigroutes</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body class="hold-transition login-page Lighting-login-bg">
        <div class="landing-page-section">
            <div class="login-box">
                <div class="login-logo">
                    <img src="{{ asset('img/landing-page-logo.png') }}" alt="logo" />
                </div>
            </div>

            <div class="sign-btn-top">
                @auth
                    <a href="{{ url('/home') }}" class="page-top-sign-btn">Home</a>
                @else
                    <!-- /.login-box -->
                    <a href="{{ route('login') }}" class="page-top-sign-btn"><img src="{{ asset('img/icon/user-landing.png') }}" /> Sign in</a>
                @endauth
            </div>
        </div>
        <!-- AdminLTE App -->
        <script src="{{ asset('js/adminlte.min.js') }}"></script>
    </body>
</html>
