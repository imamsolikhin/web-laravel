@extends('auth.master')

@section('head')
    <title>Sign In | {{ config('app.name') }}</title>
@endsection

@section('content')
<div class="login-signin">
    <div class="mb-20">
        <h3>Sign In To Admin</h3>
        <p class="opacity-60 font-weight-bold">Enter your details to login to your account:</p>
    </div>
    <form class="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        @if (Session::has('notif_error'))
            @component('inc.alert')
                {{ Session::get('notif_error') }}
            @endcomponent
        @endif
        @include('inc.error-list')
        @include('inc.success-notif')
        <div class="form-group">
            <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5" type="text" placeholder="Email" name="login" value="{{ old('login') }}" required autocomplete="off"/>
        </div>
        <div class="form-group">
            <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5" type="password" placeholder="Password" name="password" required/>
        </div>
        <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8">
            <div class="checkbox-inline">
                <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                <input type="checkbox" name="remember"/>
                <span></span>
                Remember me
                </label>
            </div>
            <a href="javascript:;" id="kt_login_forgot" class="text-white font-weight-bold">Forget Password ?</a>
        </div>
        <div class="form-group text-center mt-10">
            <button type="submit" id="#" class="btn btn-pill btn-outline-white font-weight-bold opacity-90 px-15 py-3">Sign In</button>
        </div>
    </form>
    <div class="mt-10">
        <span class="opacity-70 mr-4">
        Don't have an account yet?
        </span>
        <a href="javascript:;" id="kt_login_signup" class="text-white font-weight-bold">Sign Up</a>
    </div>
</div>
@endsection