@extends('auth.master')

@section('head')
    <title>Sign In | {{ config('app.name') }}</title>
@endsection

@section('content')
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row-fluid flex-column bgi-size-cover bgi-position-center bgi-no-repeat p-10 p-sm-30" style="background-image: url({{asset('media/error/bg1.jpg')}});">
      <h1 class="font-weight-boldest mt-15 text-warning" style="font-size: 15rem">403</h1>
      <h3 class="font-weight-boldest text-danger">OOPS! {{$message ?? "You Don't have authority"}}</h3>
    </div>
  </div>
@endsection
