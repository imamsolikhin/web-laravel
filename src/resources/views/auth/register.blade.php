@extends('auth.master')

@section('head')
    <title>Sign In | {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="login-signup">
        <div class="mb-20">
            <h3>Sign Up</h3>
            <p class="opacity-60">Enter your details to create your account</p>
        </div>
        <form class="form text-center" id="kt_login_signup_form">
            <div class="form-group ">
                <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8" type="text" placeholder="Fullname" name="fullname"/>
            </div>
            <div class="form-group">
                <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off"/>
            </div>
            <div class="form-group">
                <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8" type="password" placeholder="Password" name="password"/>
            </div>
            <div class="form-group">
                <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8" type="password" placeholder="Confirm Password" name="cpassword"/>
            </div>
            <div class="form-group text-left px-8">
                <div class="checkbox-inline">
                    <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                    <input type="checkbox" name="agree"/>
                    <span></span>
                    I Agree the <a href="#" class="text-white font-weight-bold ml-1">terms and conditions</a>.
                    </label>
                </div>
                <div class="form-text text-muted text-center"></div>
            </div>
            <div class="form-group">
                <button id="kt_login_signup_submit" class="btn btn-pill btn-outline-white font-weight-bold opacity-90 px-15 py-3 m-2">Sign Up</button>
                <button id="kt_login_signup_cancel" class="btn btn-pill btn-outline-white font-weight-bold opacity-70 px-15 py-3 m-2">Cancel</button>
            </div>
        </form>
    </div>
@endsection