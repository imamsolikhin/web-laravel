@extends('auth.master')

@section('head')
    <title>Sign In | {{ config('app.name') }}</title>
@endsection

@section('content')
  <div class="d-flex flex-column flex-root">
      <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-row-fluid bg-white" id="kt_login">
          <div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-40" style="background-image:url(https://image.freepik.com/free-vector/isometric-laptop-background-template_52683-7079.jpg )">
              <div class="d-flex flex-row-fluid flex-column justify-content-between">
                  <div class="flex-column-fluid d-flex flex-column justify-content-center">
                      <h3 class="font-size-h1 mb-5 text-white">HPI MANAGEMENT</h3>
                      <p class="font-weight-lighter text-white opacity-80">-.</p>
                  </div>
                  <div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
                      <div class="opacity-70 font-weight-bold text-white">Powered by NUIS 2020</div>
                  </div>
              </div>
          </div>
          <div class="flex-row-fluid d-flex flex-column position-relative p-1 overflow-hidden">
              <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
                  <div class="login-form login-signin">
                      <div class="text-center mb-0 mb-lg-5">
                        <h3 class="font-size-h1"><b>LOGIN</b></h3>
                        <!-- <h3 class="font-size-h1 mb-5 text-white">HPI MANAGEMENT</h3>
                          <a href="#" class="flex-column-auto mt-5">
                              <img src="#" class="max-h-70px" alt="" />
                          </a> -->
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
                              <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-50 rounded-pill border-0 py-4 px-8 mb-5" type="text" placeholder="username" name="login" value="{{ old('login') }}" required autocomplete="off"/>
                          </div>
                          <div class="form-group">
                              <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-50 rounded-pill border-0 py-4 px-8 mb-5" type="password" placeholder="password" name="password" required autocomplete="off"/>
                          </div>
                          <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                              <div class="col-md-12 row">
                                  <div class="col-md-4">
                                      <div class="form-group row">
                                          <button type="submit" href="javascript:void(0)" class="btn btn-primary font-weight-bold px-9 py-2 my-2">Login</button>
                                      </div>
                                  </div>
                                  <div class="col-4">
                                      <div class="form-group">
                                          <select class="custom-select form-control" name="sess_month" required>
                                              <?php $mytime = Carbon\Carbon::now();?>
                                              <?php for ($m = 1; $m <= 12; ++$m) { ?>
                                                  <option value="<?php echo $m; ?>" <?php echo $active = (date("m", strtotime($mytime->toDateTimeString())) == $m) ? 'Selected' : ''; ?>><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                                              <?php } ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-4">
                                      <div class="form-group">
                                          <select class="custom-select form-control" name="sess_year" required>
                                              <?php for ($m = 2019; $m <= 2025; ++$m) { ?>
                                                  <option value="<?php echo $m; ?>" <?php echo $active = (date("Y", strtotime($mytime->toDateTimeString())) == $m) ? 'Selected' : ''; ?>><?php echo $m; ?></option>
                                              <?php } ?>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
              <div class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">
                  <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">� 2020 TEAM&nbsp;&nbsp;R&D</div>
              </div>
          </div>
      </div>
  </div>
@endsection
