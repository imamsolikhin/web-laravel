@extends('layout.default')

@section('content')
	<div class="card card-custom">
        <div class="card-header border-1 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Role List
                </h3>
            </div>
        </div>
		<div class="card-body">
			<table class="table table-bordered table-hover table-striped" id="datatable" style="width: 1070px !important;">
			</table>
		</div>
	</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ config('app.url') }}global/vendor/datatables-bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" href="{{ config('app.url') }}global/vendor/datatables-responsive/dataTables.responsive.min.css">
    <link rel="stylesheet" href="{{ config('app.url') }}examples/css/tables/datatable.css">
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
                    url : '{{ route('management.role.data') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns : [
                    { title: 'Name', data: 'name', name: 'name', defaultContent: '-', class: 'text-center'},
                    { title: 'Display Name', data: 'display_name', name: 'display_name', defaultContent: '-', class: 'text-center'},
                    { title: 'Action.....', data: 'action', name: 'action', searchable: false, orderable: false, class: 'text-center' }
                ],
                initComplete: function() {
                    $('.tl-tip').tooltip();
                }
            });
        });
    </script>
@endsection