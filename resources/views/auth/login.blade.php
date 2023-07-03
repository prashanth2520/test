@extends('layouts.auth')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="javascript:;">
            <img src="{{ asset('img/landing-page-logo.png') }}" alt="logo" height="100" width="130" />
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card lighting-card-section">
        <div class="card-body login-card-body">
            <p class="login-box-msg">SIGN IN</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail address" autofocus />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span><img src="{{ asset('img/icon/mail.png') }}" class="img-fluid" alt="icon" /></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span><img src="{{ asset('img/icon/lock.png') }}" class="img-fluid" alt="icon" /></span>
                        </div>
                    </div>
                    <div class="pass">
                        <input type="checkbox" class="pass-show" onclick="myFunction()">Show Password</input>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6 form-check forgot-section text-left">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="col-6 forgot-section">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                    </div>
                </div>
                <div class="login-btn-section">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>


@endsection
