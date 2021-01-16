@extends('layout.default')

@section('content')
<div class="subheader py-2 {{ Metronic::printClasses('subheader', false) }}" id="kt_subheader">
  <div class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-baseline flex-wrap mr-5">
      <h5 class="text-dark font-weight-bold my-1 mr-5">
        Roles
      </h5>
      <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('management.role.index') }}" class="text-muted">Roles</a>
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
      <h3 class="card-label font-weight-bolder text-white">Roles
        <div class="text-muted pt-2 font-size-lg">show Datatable from table Roles</div>
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

   @isset ($menu_parent)
     @foreach($menu_parent as $menu)
       	<div class="card-body pt-0 role_auth" id="role_auth_{{ $menu->id }}">
     					<div class="col-md-12">
     						<div class="table-responsive">
                  <div class="card-header bg-danger p-2 pb-0">
                    <div class="card-title pb-0 mb-0">
       							    <h3 class="text-white pb-0 mb-0" style="font-weight:900"><div id="color-picker-1" class="mx-auto">Menu Auth {{ $menu->name }} <label class="role_name"></label></div></h3>
                    </div>
                  </div>
     								<table id="datatable_auth_{{ $menu->id }}" class="datatable_detail table table-bordered table-hover w100 dataTable no-footer dtr-inline" cellspacing="0">
     										<thead>
     											<tr>
     													<th class="text-left text-white dt-body-nowrap pt-1 pb-1" style="font-size:1.2rem;">No</th>
     													<th class="text-center text-white dt-body-nowrap pt-1 pb-1" style="font-size:1.2rem;">Menu</th>
     													<th class="text-center text-white dt-body-nowrap pt-1 pb-1" style="font-size:1.2rem;">View</th>
     													<th class="text-center text-white dt-body-nowrap pt-1 pb-1" style="font-size:1.2rem;">Create</th>
     													<th class="text-center text-white dt-body-nowrap pt-1 pb-1" style="font-size:1.2rem;">Update</th>
     													<th class="text-center text-white dt-body-nowrap pt-1 pb-1" style="font-size:1.2rem;">Delete</th>
     											</tr>
     										</thead>
     										<tbody></tbody>
     								</table>
     						</div>
     					</div>
       	</div>
        <style>
            #datatable_auth_{{ $menu->id }}{
              margin-top: 0px !important;
              margin-bottom: 0px !important;
            }
            #datatable_auth_{{ $menu->id }} tbody td {
                padding: 0 0;
                border-bottom-width: 0;
            }
        </style>
     @endforeach
   @endisset
</div>

<!-- Modal-->
<div class="modal fade" id="modal-form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger pt-3 pb-3">
                <h5 class="modal-title text-white bold" id="modal">New Roles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" id="form-input" action="{{ route('management.role.store') }}" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" class="form-control" id="method" name="_method" placeholder="Enter method" value="POST"/>
                <div class="card-body pt-3">
                    <div class="mb-1" hidden>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">id</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="id" name="id" placeholder="AUTO" value="" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Role Name</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Display Name</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Enter Name" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Description</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="description" name="description" placeholder="Enter Name" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Status</label>
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
<link rel="stylesheet" href="{{ config('app.url') }}global/vendor/datatables-bootstrap/dataTables.bootstrap.css">
<link rel="stylesheet" href="{{ config('app.url') }}global/vendor/datatables-responsive/dataTables.responsive.min.css">
<link rel="stylesheet" href="{{ config('app.url') }}plugins/custom/datatables/datatables.bundle.css">
<link rel="stylesheet" href="{{ config('app.url') }}css/inject.css">
@endsection

{{-- Scripts Section --}}
@section('scripts')
@include ('inc.confirm-delete-modal')
<script src="{{ config('app.url') }}global/vendor/datatables/jquery.dataTables.js"></script>
<script src="{{ config('app.url') }}global/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
<script src="{{ config('app.url') }}global/vendor/datatables-responsive/dataTables.responsive.js"></script>
<script src="{{ config('app.url') }}css/inject.css"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('[data-switch=true]').bootstrapSwitch('state', true);
  });

  // loading data from array
  var data = [{
          id: 0,
          text: 'Pilih'
      }, {
          id: 1,
          text: 'Optional'
      }];
  $('.select2').select2({
      placeholder: "Select a value",
      data: data
  });


  $('.datetimepicker-input').datetimepicker({
      format: 'dd-mm-yyyy hh:ii'
  });
  $('[data-switch=true]').bootstrapSwitch();
  var table = $('#datatable').dataTable({
    pageLength: 5,
    responsive: true,
    searchDelay: 800,
    processing: true,
    serverSide: true,
    select: true,
    searching: true,
    lengthMenu: [[5, 10, 25, 50, 100, 200, -1], [5, 10, 25, 50, 100, 200, "All"]],
    ajax: {
      method: 'POST',
      url : '{{ route('management.role.data') }}',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    columns: [
      {title: "No", data: 'DT_RowIndex', defaultContent: '-', class: 'text-center dt-body-nowrap', orderable: false, searchable: false, autoHide: false},
      // {title: "Role ID", data: 'id', defaultContent: '-', class: 'text-center dt-body-nowrap', autoHide: false},
      {title: "Role Name", data: 'name', defaultContent: '-', class: 'text-center dt-body-nowrap', autoHide: false},
      {title: "Display Name", data: 'display_name', defaultContent: '-', class: 'text-center dt-body-nowrap', autoHide: false},
      {title: "Description", data: 'description', defaultContent: '-', class: 'text-center dt-body-nowrap', autoHide: false},
      {title: "Status", data: 'active', defaultContent: '-', class: 'text-center dt-body-nowrap'},
      {title: "Actions", data: 'action', orderable: false, class: 'text-center dt-body-nowrap', responsivePriority: -1},
    ],
    order: [[1, 'asc']],
    bStateSave: true,
    columnDefs: [
      {
        targets: [0,-1],
        className: 'text-center visible dt-body-nowrap'
      },
    ]
  });

  	$('#datatable tbody').on( 'click', 'tr', function () {
      $(".datatable_detail tbody>tr").remove();
      if ($(this).hasClass('selected')) {
          table.$('tr.selected').removeClass('selected');
          $(this).removeClass('selected');
          $(".role_name").text('');
      }
      else {
          table.$('tr.selected').removeClass('selected');
          $(this).addClass('selected');
          var id = $(this).find("td:eq(1)").html();
          $(".role_name").text(" : "+$(this).find("td:eq(2)").html());
          $(".role_auth").loading("start");
          $.ajax({
              url: "{{ route('management.role.show.auth','') }}/"+id,
              type: "GET",
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              success: function (response) {
                if(response.data["role_auth"]){
                    for (var x in response.data["menu_parent"]){
                        $("#datatable_auth_"+response.data["menu_parent"][x].id+" tbody>tr").remove();
                        var table = document.getElementById("datatable_auth_"+response.data["menu_parent"][x].id).getElementsByTagName('tbody')[0];
                        var no = 1;
                        for (var i in response.data["role_auth"]){
                            if(response.data["role_auth"][i].parent_id == response.data["menu_parent"][x].id){
                              var row = table.insertRow(-1);
                              row.insertCell(0).innerHTML = '<label class="col-12 text-left pt-1 pb-1">'+(no)+'</label>';
                              row.insertCell(1).innerHTML = '<label class="col-12 text-left pt-1 pb-1">'+response.data["role_auth"][i].name+'</label>';
                              row.insertCell(2).innerHTML = '<label class="col-12 text-center pt-1 pb-1">'+rdb_create(response.data["role_auth"][i].id,response.data["role_auth"][i].view,"view",response.data["menu_parent"][x].id)+'</label>';
                              row.insertCell(3).innerHTML = '<label class="col-12 text-center pt-1 pb-1">'+rdb_create(response.data["role_auth"][i].id,response.data["role_auth"][i].create,"create",response.data["menu_parent"][x].id)+'</label>';
                              row.insertCell(4).innerHTML = '<label class="col-12 text-center pt-1 pb-1">'+rdb_create(response.data["role_auth"][i].id,response.data["role_auth"][i].update,"update",response.data["menu_parent"][x].id)+'</label>';
                              row.insertCell(5).innerHTML = '<label class="col-12 text-center pt-1 pb-1">'+rdb_create(response.data["role_auth"][i].id,response.data["role_auth"][i].delete,"delete",response.data["menu_parent"][x].id)+'</label>';
                              no++;
                            }
                        }
                    }
                  }
									$(".role_auth").loading("stop");
              },
              error: function (xhr, status, error) {
                $(".role_auth").loading("stop");
              }
          });
        }
      });

  function rdb_create(id, sts, flag, tbl){
      var rdb = '';
      var cols = "column_status_"+id+"_"+flag;
      var str_cols = "'column_status_"+id+"_"+flag+"'";
      var str_flag = "'"+flag+"'";
      if (sts){
        rdb += '<div class="btn-group-sm btn-group-toggle" data-toggle="buttons">';
        rdb += '    <label class="btn btn-light-primary active"><input type="radio" name="'+cols+'" value="1" onchange="authChange('+id+','+str_cols+','+str_flag+','+tbl+')" checked/><span></span>On</label>';
        rdb += '    <label class="btn btn-light-danger "><input type="radio" name="'+cols+'" value="0" onchange="authChange('+id+','+str_cols+','+str_flag+','+tbl+')" /><span></span>Off</label>';
        rdb += '</div>';
      }else{
        rdb += '<div class="btn-group-sm btn-group-toggle" data-toggle="buttons">';
        rdb += '    <label class="btn btn-light-primary "><input type="radio" name="'+cols+'" value="1" onchange="authChange('+id+','+str_cols+','+str_flag+','+tbl+')" /><span></span>On</label>';
        rdb += '    <label class="btn btn-light-danger active"><input type="radio" name="'+cols+'" value="0" onchange="authChange('+id+','+str_cols+','+str_flag+','+tbl+')" checked/><span></span>Off</label>';
        rdb += '</div>';
      }
      return rdb;
  }

  function authChange(id, cols, flag, tbl){
    $("#datatable_auth_"+tbl).loading("start");
    $.ajax({
        url: "{{ route('management.role.update.auth',['','',''])}}/"+id+"/"+flag+"/"+$("input[name='"+cols+"']:checked").val(),
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function (response) {
            $("#datatable_auth_"+tbl).loading("stop");
        },
        error: function (xhr, status, error) {
            $("#datatable_auth_"+tbl).loading("stop");
        }
    });
  }


  function show_data(id = "") {
      if (id !== "") {
          $.ajax({
              url: "{{ route('management.role.store')}}/" + id,
              type: "GET",
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              success: function (response) {
                  $("#form-input").attr("action", "{{ route('management.role.update','')}}/"+id);
                  $('#form-input').trigger("reset");
                  $('#method').val("PUT");

                  $('#id').val(response.data.id);
                  $('#name').val(response.data.name);
                  $('#display_name').val(response.data.display_name);
                  $('#description').val(response.data.description);
                  $('#status').bootstrapSwitch('state', response.data.status);
                  $('#modal-form').modal('show');
                  $('#id').focus();
              },
              error: function (xhr, status, error) {
                  alert_show(xhr.status + " " + status + " " + error, false);
              }
          });
      } else {
          $("#form-input").attr("action", "{{ route('management.role.store')}}");
          $('#form-input').trigger("reset");
          $('#method').val("POST");

          $('#id').focus();
          $('#status').bootstrapSwitch('state', true);
          $('#modal-form').modal('show');
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
