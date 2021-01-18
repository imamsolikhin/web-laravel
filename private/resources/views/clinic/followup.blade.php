@extends('layout.default')

@section('content')
<div class="subheader py-2 {{ Metronic::printClasses('subheader', false) }}" id="kt_subheader">
  <div class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-baseline flex-wrap mr-5">
      <h5 class="text-dark font-weight-bold my-1 mr-5">
        Follow Up
      </h5>
      <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('clinic.index','followup') }}" class="text-muted">Follow Up</a>
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
      <h3 class="card-label font-weight-bolder text-white">Follow Up
        <div class="text-muted pt-2 font-size-lg">show Datatable from table Follow Up</div>
      </h3>
    </div>
    <div class="card-toolbar pt-1 pb-0">
      <a href="#" onclick="show_data('')" class=" mr-2 btn btn-primary font-weight-bolder" style="background-color: #1e1e2d;border-color: #0c8eff;">
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
      <div class="dropdown dropdown-inline">
          <button type="button" class="btn btn-tool btn-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="la la-download text-white"></i> Tools
          </button>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
              <ul class="navi flex-column navi-hover py-2" id="btn_tools">
                  <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">
                      Export Tools
                  </li>
                  <li class="navi-item">
                      <a href="javascript:;" data-action="0" class="navi-link tool-action" id="export_print">
                          <span class="navi-icon"><i class="la la-print"></i></span>
                          <span class="navi-text">Print</span>
                      </a>
                  </li>
                  <li class="navi-item">
                      <a href="javascript:;" data-action="1" class="navi-link tool-action" id="export_copy">
                          <span class="navi-icon"><i class="la la-copy"></i></span>
                          <span class="navi-text">Copy</span>
                      </a>
                  </li>
                  <li class="navi-item">
                      <a href="javascript:;" data-action="2" class="navi-link tool-action" id="export_pdf">
                          <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>
                          <span class="navi-text">PDF</span>
                      </a>
                  </li>
                  <li class="navi-item">
                      <a href="javascript:;" data-action="3" class="navi-link tool-action" id="export_excel">
                          <span class="navi-icon"><i class="la la-file-excel-o"></i></span>
                          <span class="navi-text">Excel</span>
                      </a>
                  </li>
                  <li class="navi-item">
                      <a href="javascript:;" data-action="4" class="navi-link tool-action" id="export_csv">
                          <span class="navi-icon"><i class="la la-file-text-o"></i></span>
                          <span class="navi-text">CSV</span>
                      </a>
                  </li>
                  <li class="navi-item">
                      <a href="javascript:;" data-action="5" class="navi-link tool-action" id="export_reload">
                          <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>
                          <span class="navi-text">RELOAD</span>
                      </a>
                  </li>
              </ul>
          </div>
      </div>
    </div>
  </div>
  <div class="card-body pt-1">
    <div hidden><input id="start-date"/><input id="end-date"/></div>
    <table class="table table-bordered table-hover w100" cellspacing="0" id="datatable" style="width: 1070px !important;"></table>
  </div>
</div>


<!-- Modal-->
<div class="modal fade" id="modal-form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger pt-3 pb-3">
                <h5 class="modal-title text-white bold" id="modal">New Follow Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" id="form-input" action="{{ route('clinic.index','followup') }}" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" class="form-control" id="method" id="_method" name="_method" placeholder="Enter method" value="POST"/>
                <div class="card-body pt-3">
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">id</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="id" name="id" placeholder="AUTO" value="" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Iklan</label>
                            <div class="col-lg-8">
                                <select class="form-control select2" id="advertise_id" name="advertise_id" style="width: 100%;">
                                  <option value="" selected>Chose Advertise</option>
                                   @isset ($advertise_list)
                                     @foreach($advertise_list as $advertise)
                                      <option value="{{ $advertise->id }}">{{ $advertise->name }}</option>
                                     @endforeach
                                   @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Interaksi</label>
                            <div class="col-lg-8">
                                <select class="form-control select2" id="interaction_id" name="interaction_id" style="width: 100%;">
                                  <option value="" selected>Chose Follow Up</option>
                                   @isset ($interaction_list)
                                     @foreach($interaction_list as $interaction)
                                      <option value="{{ $interaction->id }}">{{ $interaction->name }}</option>
                                     @endforeach
                                   @endisset
                               </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Sapaan</label>
                            <div class="col-lg-8">
                                <select class="form-control select2" id="gender_id" name="gender_id" style="width: 100%;">
                                  <option value="" selected>Chose </option>
                                   @isset ($gender_list)
                                     @foreach($gender_list as $gender)
                                      <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                     @endforeach
                                   @endisset
                               </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Name Pasien</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter Name" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">No Telfon</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Name" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Keluhan</label>
                            <div class="col-lg-8">
                                <textarea class="form-control tagify" id="consultation" name='consultation' placeholder="keluhan" value=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">status</label>
                            <div class="col-lg-8">
                                <input id="status" name="status" data-switch="true" type="checkbox" checked="checked" data-off-text="Kunjungan" data-handle-width="200" data-on-text="Reservasi" data-off-color="info" data-on-color="warning" />
                            </div>
                        </div>
                    </div>
                    <div class="is_reqs">
                        <div class="mb-1">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Umur</label>
                                <div class="col-lg-8">
                                    <input type="number" class="form-control" id="age" name="age" placeholder="Enter age" value=""/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Kota</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="city_id" name="city_id" placeholder="Enter City" value=""/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Alamat</label>
                                <div class="col-lg-8">
                                    <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter Alamat" value=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Konfirmasi</label>
                                <div class="col-lg-8">
                                    <select class="form-control select2" id="confirmation_id" name="confirmation_id" style="width: 100%;">
                                      <option value="" selected>Chose </option>
                                       @isset ($confirmation_list)
                                         @foreach($confirmation_list as $confirmation)
                                          <option value="{{ $confirmation->id }}">{{ $confirmation->name }}</option>
                                         @endforeach
                                       @endisset
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Kedatangan</label>
                                <div class="col-lg-8">
                                    <div class="input-icon">
                                        <input type="input" class="form-control datetimepicker-input" placeholder="dd/mm/yyyy" id="schedule_date" name="schedule_date" data-date-format="dd-mm-yyyy hh:ii" value="<?php echo date('d-m-Y H:i'); ?>"/>
                                        <span>
                                            <i class="far fa-calendar-alt text-muted"></i>
                                        </span>
                                    </div>
                                </div>
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
<script src="{{ config('app.url') }}js/inject.js"></script>
<script type="text/javascript">
  var start_date = "";
  var end_date = "";
  $(document).ready(function() {
    $(".is_reqs").hide();
    $("div.datesearchbox").html('<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearch" placeholder="Search by date range"> </div>');
    document.getElementsByClassName("datesearchbox")[0].style.textAlign = "center";
    $("#datesearch").attr("readonly",true);
    $('#datesearch').daterangepicker({
       autoUpdateInput: false
     });
     //menangani proses saat apply date range
      $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
         $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
         $("#start-date").val(picker.startDate.format('YYYY-MM-DD'));
         $("#end-date").val(picker.endDate.format('YYYY-MM-DD'));
         refresh_table();
      });

      $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $("#start-date").val('');
        $("#end-date").val('');
        refresh_table();
      });
  });

  $('#status').on('switchChange.bootstrapSwitch', function (event, state) {
      var x = $(this).data('on-text');
      var y = $(this).data('off-text');
      if ($("#status").is(':checked')) {
          $(".is_reqs").show(500);
      } else {
          $(".is_reqs").hide(500);
      }
  });

  $('.select2').select2();

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
      url : '{{ route('clinic.list','followup') }}',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      data: function (d) {
        d.from_date = $("#start-date").val();
        d.to_date = $("#end-date").val();
      }
    },
    columns: [
      {title: "No", data: 'DT_RowIndex', defaultContent: '-', class: 'text-center dt-body-nowrap', orderable: false, searchable: false, autoHide: false},
      {title: "Iklan", data: 'advertise_id', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: true},
      {title: "Follow Up", data: 'interaction_id', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: true},
      {title: "Pasien", data: 'full_name', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      {title: "No Telf", data: 'phone', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      {title: "Konsultasi", data: 'consultation', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      {title: "Status", data: 'active', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      {title: "Actions", data: 'action', orderable: false, responsivePriority: -1},
    ],
    order: [[1, 'asc']],
    bStateSave: true,
    dom:  "<'row'<'col-sm-6'l><'col-sm-3' <'datesearchbox'>><'col-sm-3'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    columnDefs: [
      {
        targets: [0,-1],
        className: 'text-center dt-body-nowrap'
      },
    ],
    buttons: [
      {
        extend: 'print',
        text: 'Print current page',
        autoPrint: true,
        customize: function (win) {
          $(win.document.body)
          .css('font-size', '10pt')
          .prepend(
            '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
          );
          $(win.document.body).find('table')
          .addClass('compact')
          .css('font-size', 'inherit');
        },
        exportOptions: {
          columns: [0, 1, 'visible'],
          modifier: {
            page: 'current'
          },
        }
      }, {
        extend: 'copy',
        className: 'btn default',
        exportOptions: {
          columns: [0, 1, 'visible']
        }
      }, {
        extend: 'pdf',
        className: 'btn default',
        exportOptions: {
          columns: [0, 1, 'visible']
        }
      }, {
        extend: 'excelHtml5',
        className: 'btn default',
        excelStyles: {
          template: 'blue_medium',
        },
        exportOptions: {
          columns: [0, 1, 'visible']
        }
      }, {
        extend: 'csvHtml5',
        className: 'btn default',
        exportOptions: {
          columns: [0, 1, 'visible']
        }
      }, {
        text: 'Reload',
        className: 'btn default',
        action: function (e, dt, node, config) {
          dt.ajax.reload();
          alert_show('Datatable reloaded!', false);
        }
      },
      'colvis'
    ],
  });
  $('#btn_tools > li > a.tool-action').on('click', function () {
      var action = $(this).attr('data-action');
      table.dataTable().button(action).trigger();
  });

  function show_data(id = "") {
      if (id !== "") {
          $.ajax({
              url: "{{ route('clinic.data',['followup',''])}}/" + id,
              type: "GET",
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              success: function (response) {
                  $("#form-input").attr("action", "{{ route('clinic.update',['followup',''])}}/"+id);
                  $('#form-input').trigger("reset");
                  $('#method').val("POST");

                  $('#id').val(response.data.id);
                  $('#advertise_id').val(response.data.advertise_id).trigger('change');
                  $('#interaction_id').val(response.data.interaction_id).trigger('change');
                  $('#gender_id').val(response.data.gender_id).trigger('change');
                  $('#confirmation_id').val(response.data.confirmation_id).trigger('change');
                  $('#full_name').val(response.data.full_name);
                  $('#age').val(response.data.age);
                  $('#phone').val(response.data.phone);
                  $('#consultation').text(response.data.consultation);
                  $('#address').val(response.data.address);
                  $('#city_id').val(response.data.city_id);
                  $('#schedule_date').val(response.data.schedule_date);
                  $('#lock_status').val(response.data.lock_status);
                  $('#closing_status').val(response.data.closing_status);
                  if (response.data.status === 1 || response.data.status === "1") {
                      $('#status').bootstrapSwitch('state', response.data.status);
                      $(".is_reqs").show(500);
                  } else {
                      $('#status').bootstrapSwitch('state', false);
                      $(".is_reqs").hide(500);
                  }
                  $('#modal-form').modal('show');
                  $('#id').focus();
              },
              error: function (xhr, status, error) {
                  alert_show(xhr.status + " " + status + " " + error, false);
              }
          });
      } else {
          $("#form-input").attr("action", "{{ route('clinic.save','followup')}}");
          $('#form-input').trigger("reset");
          $('#method').val("POST");

          $('#id').focus();
          $('#modal-form').modal('show');
          $('#id').focus();
          $('#status').bootstrapSwitch('state', false);
          $(".is_reqs").hide(500);
      }
  }

  function refresh_table() {
      table.fnDraw();
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
