@extends('layout.default')

@section('content')
	<div class="card card-custom">
	    @include('inc.error-list')
	    <form class="form" action="{{ route('management.user.update', $user->id) }}" method="POST">
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
	                <div class="col-lg-4">
	                    <label>Name:</label>
	                    <input type="text" class="form-control" name="name" value="{{ old('name') ?: $user->name }}" placeholder="Enter Name" required />
	                    <span class="form-text text-muted">Please enter your Name</span>
	                </div>
	                <div class="col-lg-4">
	                    <label>Email</label>
	                    <input type="email" class="form-control" name="email" value="{{ old('email') ?: $user->email }}" placeholder="Enter Email" required />
	                    <span class="form-text text-muted">Please enter your Email</span>
	                </div>
	                <div class="col-lg-4">
	                    <label>Username:</label>
	                    <div class="input-group">
	                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
	                        <input type="text" class="form-control" name="username" value="{{ old('username') ?: $user->username }}" placeholder="Enter Username" required/>
	                    </div>
	                    <span class="form-text text-meted">Please enter your username</span>
	                </div>
	            </div>
	            <div class="form-group row">
	                <div class="col-lg-4">
	                    <label>Role:</label>
	                    <div class="input-group">
	                        <select class="form-control select2" id="role" name="role" data-placeholder="Choose One" required>
	                            <option></option>
	                            @foreach ($roles as $role)
	                            <option value="{{ $role->id }}" {{ old('role', $user->role->id) == $role->id ? 'selected' : '' }}>{{ $role->display_name }}</option>
	                            @endforeach
	                        </select>
	                    </div>
	                    <span class="form-text text-meted">Please enter your role</span>
	                </div>
	                <div class="col-lg-4">
	                    <label>Access</label>
	                    <div class="input-group">
	                        <select class="form-control select2" id="access" data-placeholder="Choose One" name="access">
	                            <option></option>
	                            <option value="1" {{ (!$user->client_property_id) && (!$user->client_id) ? 'selected' : '' }}>All Clients</option>
	                            <option value="2" {{ ($user->client_property_id) && (!$user->client_id) ? 'selected' : '' }}>All Clients on Specific Property</option>
	                            <option value="3" {{ ($user->client_property_id) && ($user->client_id) ? 'selected' : '' }}>Specific Client</option>
	                        </select>
	                    </div>
	                    <span class="form-text text-muted">Please enter Access</span>
	                </div>
	                <div class="col-lg-4" id="div-client-property" hidden>
	                    <label>Client Property:</label>
	                    <div class="input-group">
	                        <select class="form-control select2" id="client_property_id" data-placeholder="Choose One" name="client_property_id">
	                            <option></option>
	                            @foreach ($clientProperties as $clientProperty)
	                                <option value="{{ $clientProperty->id }}" {{ old('client_property_id', $user->client_property_id) == $clientProperty->id ? 'selected' : '' }}>{{ $clientProperty->name }}</option>
	                            @endforeach
	                        </select>
	                    </div>
	                    <span class="form-text text-meted">Please enter client property</span>
	                </div>
	                <div class="col-lg-4" id="div-client" hidden>
	                    <label>Client:</label>
	                    <div class="input-group">
	                        <select class="form-control select2" id="client_id" data-placeholder="Choose One" name="client_id">
	                            <option></option>
	                            @foreach ($clients as $client)
	                                <option value="{{ $client->id }}" {{ old('client_id', $user->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
	                            @endforeach
	                        </select>
	                    </div>
	                    <span class="form-text text-meted">Please enter client</span>
	                </div>
	            </div>
	            <div class="form-group row">
	                <div class="col-lg-4">
	                    <label>Active:</label>
						<span class="switch switch-primary">
							<label>
								<input type="checkbox" name="active"  value="1" {{ old('active', $user->active) == 1 ? 'checked' : '' }}/>
								<span></span>
							</label>
						</span>
	                </div>
	            </div>
	        </div>
	        <div class="card-footer">
	            <div class="row">
	                <div class="col-lg-6">
	                    <a href="{{ route('management.user.index') }}" class="btn btn-danger">Back</a>
	                </div>
	                <div class="col-lg-6 text-right">
	                    <button type="submit" class="btn btn-primary">Update</button>
	                </div>
	            </div>
	        </div>
	    </form>
	</div>
@endsection

@section('styles')
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            if($('#access').val() == "" || $('#access').val() == 1) {
                $('#div-client-property').attr('hidden', '');
                $('#div-client').attr('hidden', '');
            }
            else if($('#access').val() == 2) {
                $('#div-client-property').removeAttr('hidden');
                $('#div-client').attr('hidden', '');
            }
            else if($('#access').val() == 3) {
                $('#div-client-property').attr('hidden', '');
                $('#div-client').removeAttr('hidden');
            }
            $('#access').on('change', function() {
                if($('#access').val() == "" || $('#access').val() == 1) {
                    $('#div-client-property').attr('hidden', '');
                    $('#div-client').attr('hidden', '');
                }
                else if($('#access').val() == 2) {
                    $('#div-client-property').removeAttr('hidden');
                    $('#div-client').attr('hidden', '');
                }
                else if($('#access').val() == 3) {
                    $('#div-client-property').attr('hidden', '');
                    $('#div-client').removeAttr('hidden');
                }
            });

            $('#role').select2({
                'placeholder' : 'Choose One',
                'width' : '100%',
                tags : true,
                'allowClear' : true
            });

            $('#access').select2({
                'placeholder' : 'Choose One',
                'width' : '100%',
                tags : true,
                'allowClear' : true
            });

            $('#client_property_id').select2({
                'placeholder' : 'Choose One',
                'width' : '100%',
                tags : true,
                'allowClear' : true
            });

            $('#client_id').select2({
                'placeholder' : 'Choose One',
                'width' : '100%',
                tags : true,
                'allowClear' : true
            });
        });
    </script>
@endsection