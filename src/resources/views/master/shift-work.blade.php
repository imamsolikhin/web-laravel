@extends('layout.default')

@section('content')
<div class="subheader py-2 {{ Metronic::printClasses('subheader', false) }}" id="kt_subheader">
  <div class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-baseline flex-wrap mr-5">
      <h5 class="text-dark font-weight-bold my-1 mr-5">
        {{ $module }}
      </h5>
      <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ $auth }}" class="text-muted">{{ $module }}</a>
        </li>
        <li class="breadcrumb-item">
          <a href="#view" class="text-muted">View</a>
        </li>
      </ul>
    </div>
  </div>
</div>

@include('inc.error-list')
@include('inc.success-notif')
@include('inc.danger-notif')
<div class="card card-custom">
  <div class="card-header bg-danger flex-wrap border-1 pt-1 pb-0 mb-2" style="min-height: 0;">
    <div class="card-title pt-1 pb-1">
      <h3 class="card-label font-weight-bolder text-white">{{ $module }}
        <div class="text-muted pt-2 font-size-lg">show Datatable from table {{ $module }}</div>
      </h3>
    </div>
    <div class="card-toolbar pt-1 pb-0">
      <a href="#" onclick="show_data('')" class="btn btn-primary font-weight-bolder" style="background-color: #1e1e2d;border-color: #0c8eff;">
        <span class="svg-icon svg-icon-md">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <rect x="0" y="0" width="24" height="24"></rect>
              <circle fill="#000000" cx="9" cy="15" r="6"></circle>
              <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
            </g>
          </svg>
        </span>Add New
      </a>
    </div>
  </div>
  <div class="card-body pt-1">
    <table class="table table-bordered table-hover w100" cellspacing="0" id="datatable" style="width: 1070px !important;"></table>
  </div>
</div>


<!-- Modal-->
<div class="modal fade" id="modal-form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger pt-3 pb-3">
                <h5 class="modal-title text-white bold" id="modal">Form {{ $module }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" id="form-input" action="{{ $path }}/save" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" class="form-control" id="method" name="_method" placeholder="Enter method" value="POST"/>
                <div class="card-body pt-3">
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">{{ $module }} ID</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="id" name="id" placeholder="Enter id" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">{{ $module }} Name</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">{{ $module }} Status</label>
                            <div class="col-lg-8">
                                <input id="status" name="status" data-switch="true" type="checkbox" checked="checked" data-on-text="Enabled" data-handle-width="200" data-handle-font="1"  data-off-text="Disabled" data-on-color="warning" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"></label>
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-success font-weight-bold">Save</button>
                                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

{{-- Styles Section --}}
@section('styles')
<link rel="stylesheet" href="{{ config('app.url') }}plugins/custom/datatables/datatables.bundle.css">
<link rel="stylesheet" href="{{ config('app.url') }}css/inject.css">
@endsection

{{-- Scripts Section --}}
@section('scripts')
@include ('inc.confirm-delete-modal')
<script src="{{ config('app.url') }}plugins/custom/datatables/datatables.bundle.js"></script>
<script src="{{ config('app.url') }}js/inject.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('[data-switch=true]').bootstrapSwitch('state', true);
    $('.datetimepicker-input').datetimepicker({
        format: 'dd-mm-yyyy hh:ii'
    });
  });

  $('[data-switch=true]').bootstrapSwitch();
  var table = $('#datatable').dataTable({
    pageLength: 5,
    responsive: true,
    searchDelay: 800,
    processing: true,
    serverSide: true,
    searching: true,
    lengthMenu: [[5, 10, 25, 50, 100, 200, -1], [5, 10, 25, 50, 100, 200, "All"]],
    ajax: {
      method: 'POST',
      url : '{{ $data }}',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    columns: [
      {title: "No", data: 'DT_RowIndex', orderable: false, searchable: false, autoHide: false},
      {title: "{{ $module }} ID", data: 'id', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: true},
      {title: "{{ $module }} Name", data: 'name', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: true},
      {title: "Author", data: 'author', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: true},
      {title: "Status", data: 'active', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: true},
      {title: "Actions", data: 'action', orderable: false, responsivePriority: -1},
    ],
    columnDefs: [
      {
        targets: [0,-1],
        className: 'text-center visible dt-body-nowrap'
      },
    ],
    initComplete: function() {
      $('.tl-tip').tooltip();
    }
  });

  function show_data(id = "") {
      if (id !== "") {
          $.ajax({
              url: "{{ $path }}/data/" + id,
              type: "GET",
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              success: function (response) {
                if(!response){
                  showDialog.show("data "+id+" not found");
                }
                  $('#form-input').trigger("reset");
                  $("#form-input").attr("action", "{{ $path }}/"+id);
                  $('#method').val("PUT");

                  $('#id').val(response.data.id);
                  $('#name').val(response.data.name);
                  $('#status').bootstrapSwitch('state', response.data.status);
                  $('#modal-form').modal('show');
                  $('#id').attr('readonly',true)
              },
              error: function (xhr, status, error) {
                  showDialog.show(xhr.status + " " + status + " " + error, false);
              }
          });
      } else {
          $('#form-input').trigger("reset");
          $("#form-input").attr("action", "{{ $path }}");
          $('#method').val("POST");
          $('#modal-form').modal('show');
          $('#id').attr('readonly',false)
          document.getElementById("id").focus();
      }
  }

  function refresh_table() {
      $('#datatable').dataTable().ajax.reload();
  }

  function format_date(val) {
      var date_arr = val.split(" ");
      var time = date_arr[1];
      var date_id_arr = date_arr[0].split("-");
      var date_fix = date_id_arr[2] + "-" + date_id_arr[1] + "-" + date_id_arr[0];
      var date_transaction = date_fix + " " + time;
      return date_transaction;
  }
</script>
@endsection
