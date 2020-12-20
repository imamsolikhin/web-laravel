@extends('layout.default')

@section('content')
<div class="card card-custom">
    @include('inc.success-notif')
    <div class="card-header flex-wrap border-1 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">User List
                <div class="text-muted pt-2 font-size-sm">show Datatable from table user</div>
            </h3>
        </div>
        <div class="card-toolbar">
            <a id="add-btn" class="btn btn-primary py-2">
                <i class="menu-icon">{{ Metronic::getSVG("media/svg/icons/Code/Plus.svg", "svg-icon svg-icon-md") }}</i>
                Add User
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped w100" cellspacing="0" id="datatable" style="width: 1070px !important;">
        </table>
    </div>
</div>
<br>

<div class="card card-custom"  id="add-form" {!! (count($errors) == 0) ? "style='display: none;'" : '' !!}>
    @include('inc.error-list')
    <form class="form" action="{{ route('management.user.store') }}" method="POST">
        {!! csrf_field() !!}
        <div class="card-header border-1 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">User List
                </h3>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-8">
                    <label>Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name" required />
                    <span class="form-text text-muted">Please enter your Name</span>
                </div>
                <div class="col-lg-4">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email" required />
                    <span class="form-text text-muted">Please enter your Email</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Username:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Enter Username" required/>
                    </div>
                    <span class="form-text text-meted">Please enter your username</span>
                </div>
                <div class="col-lg-4">
                    <label>Password:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-passport"></i></span></div>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password" required/>
                    </div>
                    <span class="form-text text-meted">Please enter your Password</span>
                </div>
                <div class="col-lg-4">
                    <label>Confirm Password:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-passport"></i></span></div>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Confirm Password" required/>
                    </div>
                    <span class="form-text text-meted">Please enter your confirm password</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Role:</label>
                    <div class="input-group">
                        <select class="form-control select2" id="role" name="role" data-placeholder="Choose One" required>
                            <option></option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                {{ $role->display_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <span class="form-text text-meted">Please enter your role</span>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-6">
                    <button type="button" id="cancel-btn" class="btn btn-danger">Cancel</button>
                </div>
                <div class="col-lg-6 text-right">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


{{-- Styles Section --}}
@section('styles')
    <link rel="stylesheet" href="{{ config('app.url') }}global/vendor/datatables-bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" href="{{ config('app.url') }}global/vendor/datatables-responsive/dataTables.responsive.min.css">
    <link rel="stylesheet" href="{{ config('app.url') }}plugins/custom/datatables/datatables.bundle.css">
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ config('app.url') }}global/vendor/datatables/jquery.dataTables.js"></script>
    <script src="{{ config('app.url') }}global/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
    <script src="{{ config('app.url') }}global/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').dataTable({
                responsive: true,
                searchDelay: 800,
                processing: true,
                serverSide: true,
                select: true,
                searching: true,
                ajax: {
                    method: 'POST',
                    url : '{{ route('management.user.data') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns : [
                    { title:'Name', data: 'name', name: 'name', defaultContent: '-', class: 'text-center' },
                    { title:'Username',  data: 'username', name: 'username', defaultContent: '-', class: 'text-center' },
                    { title:'role', data: 'role_display_name', name: 'roles.display_name', defaultContent: '-', class: 'text-center' },
                    { title:'access', data: 'access', name: 'access', defaultContent: '-', searchable: false, orderable: false, class: 'text-center' },
                    { title:'Active', data: 'active', name: 'active', defaultContent: '-', searchable: false, orderable: false, class: 'text-center' },
                    { title:'Action.....', data: 'action', name: 'action', searchable: false, orderable: false, class: 'text-center' }
                ],
                initComplete: function() {
                    $('.tl-tip').tooltip();
                    @if (count($errors) > 0)
                        jQuery("html, body").animate({
                            scrollTop: $('#add-form').offset().top - 100 // 66 for sticky bar height
                        }, "slow");
                    @endif
                }
            });

            $('#add-btn').click(function(e) {
                $('#add-form').toggle();
                jQuery("html, body").animate({
                    scrollTop: $('#add-form').offset().top - 100 // 66 for sticky bar height
                }, "slow");
            });

            $('#cancel-btn').click(function(e) {
                $('#add-form').toggle();
                jQuery("html, body").animate({
                    scrollTop: $('body').offset().top - 100 // 66 for sticky bar height
                }, "slow");
            });

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
