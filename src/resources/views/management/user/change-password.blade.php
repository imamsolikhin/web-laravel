@extends('layout.default')

@section('content')
	<div class="card card-custom">
        @include('inc.error-list')
        @include('inc.success-notif')
	    <form class="form" action="{{ isset($id) ? route('management.user.other.update-password', $id) : route('management.user.update-password') }}" method="POST">
	    	{!! csrf_field() !!}
	        {!! method_field('PUT') !!}
	        <div class="card-header border-1 pt-6 pb-0">
	            <div class="card-title">
	                <h3 class="card-label">Edit User
	                </h3>
	            </div>
	        </div>
	        <div class="card-body">
	            <div class="form-group row">
	                <div class="col-lg-12">
	                    <label>Name:</label>
	                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name" required />
	                    <span class="form-text text-muted">Please enter your Name</span>
	                </div>
	                <div class="col-lg-12">
	                    <label>Email</label>
	                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email" required />
	                    <span class="form-text text-muted">Please enter your Email</span>
	                </div>
	                <div class="col-lg-12">
	                    <label>Username:</label>
	                    <div class="input-group">
	                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
	                        <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Enter Username" required/>
	                    </div>
	                    <span class="form-text text-meted">Please enter your username</span>
	                </div>
	            </div>
	        </div>
	        <div class="card-footer">
	            <div class="row">
	                <div class="col-lg-12 text-right">
	                    <button type="submit" class="btn btn-primary">Update Password</button>
	                </div>
	            </div>
	        </div>
	    </form>
	</div>
@endsection


@section('styles')
@endsection

@section('scripts')
@endscript