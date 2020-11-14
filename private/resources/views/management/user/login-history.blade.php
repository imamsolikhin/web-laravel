@extends('layout.default')

@section('content')
	<div class="card card-custom">
        <div class="card-header border-1 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">User Login Histories
                </h3>
            </div>
        </div>
		<div class="card-body">
			<table class="table table-bordered table-hover table-striped w100" cellspacing="0" id="datatable" style="width: 1070px !important;">
			</table>
		</div>
	</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ config('app.url') }}global/vendor/datatables-bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" href="{{ config('app.url') }}global/vendor/datatables-responsive/dataTables.responsive.min.css">
    <link rel="stylesheet" href="{{ config('app.url') }}plugins/custom/datatables/datatables.bundle.css">
@endsection

@section('scripts')
    <script src="{{ config('app.url') }}global/vendor/datatables/jquery.dataTables.js"></script>
    <script src="{{ config('app.url') }}global/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
    <script src="{{ config('app.url') }}global/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').dataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    method: 'POST',
                    url : '{{ route('management.login-history.data') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns : [
                    { title: 'Login at', data : 'created_at', name: 'created_at', class: 'text-center', defaultContent: '-'},
                    { title: 'Username', data : 'user.username', name: 'user.username', class: 'text-center', defaultContent: '-'},
                    { title: 'IP Address', data : 'ip', name: 'ip', class: 'text-center', defaultContent: '-'},
                    { title: 'Browser', data : 'browser', name: 'browser', class: 'text-center', defaultContent: '-'},
                    { title: 'Platform', data : 'platform', name: 'platform', class: 'text-center', defaultContent: '-'},
                ],
                order: [[ 0, "desc" ]]
            });
        });
    </script>
@endsection
