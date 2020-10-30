@extends('layout.default')

@section('content')
<div class="subheader py-2 {{ Metronic::printClasses('subheader', false) }}" id="kt_subheader">
  <div class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-baseline flex-wrap mr-5">
      <h5 class="text-dark font-weight-bold my-1 mr-5">
        Reservation
      </h5>
      <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('clinic.reservation.index') }}" class="text-muted">Reservation</a>
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
      <h3 class="card-label font-weight-bolder text-white">Reservation
        <div class="text-muted pt-2 font-size-lg">show Datatable from table Reservation</div>
      </h3>
    </div>
    <div class="card-toolbar pt-1 pb-0">
      <!-- <a href="#" onclick="show_data('')" class=" mr-2 btn btn-primary font-weight-bolder" style="background-color: #1e1e2d;border-color: #0c8eff;">
        <span class="svg-icon svg-icon-md">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <rect x="0" y="0" width="24" height="24"></rect>
              <circle fill="#000000" cx="9" cy="15" r="6"></circle>
              <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
            </g>
          </svg>
        </span>Add New
      </a> -->
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
    <table class="table table-bordered table-hover w100" cellspacing="0" id="datatable" style="width: 1070px !important;"></table>
  </div>
</div>

<!-- Modal-->
<div class="modal fade" id="modal-form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger pt-3 pb-3">
                <h5 class="modal-title text-white bold" id="modal">New Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" id="form-input" action="{{ route('clinic.reservation.store') }}" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" class="form-control" id="method" id="_method" name="_method" placeholder="Enter method" value="POST"/>
                <div class="card-body pt-3">
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Code</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="Code" name="Code" placeholder="Enter Code" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Iklan</label>
                            <div class="col-lg-8">
                                <select class="form-control select2" id="AdvertiseCode" name="AdvertiseCode" style="width: 100%;">
                                  <option value="">Chose Advertise</option>
                                   @isset ($advertise_list)
                                     @foreach($advertise_list as $advertise)
                                      <option value="{{ $advertise->Code }}">{{ $advertise->Name }}</option>
                                     @endforeach
                                   @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Reservation</label>
                            <div class="col-lg-8">
                                <select class="form-control select2" id="InteractionCode" name="InteractionCode" style="width: 100%;">
                                  <option value="">Chose Reservation</option>
                                   @isset ($interaction_list)
                                     @foreach($interaction_list as $interaction)
                                      <option value="{{ $interaction->Code }}">{{ $interaction->Name }}</option>
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
                                <select class="form-control select2" id="GenderCode" name="GenderCode" style="width: 100%;">
                                  <option value="">Chose </option>
                                   @isset ($gender_list)
                                     @foreach($gender_list as $gender)
                                      <option value="{{ $gender->Code }}">{{ $gender->Name }}</option>
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
                                <input type="text" class="form-control" id="FullName" name="FullName" placeholder="Enter Name" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">No Telfon</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="Phone" name="Phone" placeholder="Enter Name" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Keluhan</label>
                            <div class="col-lg-8">
                                <textarea class="form-control tagify" id="Consultation" name='Consultation' placeholder="keluhan" value=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Umur</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="Age" name="Age" placeholder="Enter Age" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Kota</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="CityCode" name="CityCode" placeholder="Enter City" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Alamat</label>
                            <div class="col-lg-8">
                                <textarea type="text" class="form-control" id="Address" name="Address" placeholder="Enter Alamat" value=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Konfirmasi</label>
                            <div class="col-lg-8">
                                <select class="form-control select2" id="ConfirmationCode" name="ConfirmationCode" style="width: 100%;">
                                  <option value="">Chose </option>
                                   @isset ($confirmation_list)
                                     @foreach($confirmation_list as $confirmation)
                                      <option value="{{ $confirmation->Code }}">{{ $confirmation->Name }}</option>
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
                                    <input type="input" class="form-control datetimepicker-input" placeholder="dd/mm/yyyy" id="Schedule" name="Schedule" data-date-format="dd-mm-yyyy hh:ii" value="<?php echo date('d-m-Y H:i'); ?>"/>
                                    <span>
                                        <i class="far fa-calendar-alt text-muted"></i>
                                    </span>
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
<link rel="stylesheet" href="{{ config('app.url') }}assets/examples/css/tables/datatable.css">
<link rel="stylesheet" href="{{ config('app.url') }}css/inject.css">
@endsection

{{-- Scripts Section --}}
@section('scripts')
@include ('inc.confirm-delete-modal')
<script src="{{ config('app.url') }}global/vendor/datatables/jquery.dataTables.js"></script>
<script src="{{ config('app.url') }}global/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
<script src="{{ config('app.url') }}global/vendor/datatables-responsive/dataTables.responsive.js"></script>
<script type="text/javascript">
  var start_date = "";
  var end_date = "";
  $(document).ready(function() {
    $(".is_reqs").hide();
    $("#datatable_wrapper").removeClass("dataTables_wrapper form-inline dt-bootstrap no-footer");
    $("#datatable_wrapper").addClass("dataTables_wrapper dt-bootstrap4 no-footer");
    $("div.datesearchbox").html('<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearch" placeholder="Search by date range"> </div>');
    document.getElementsByClassName("datesearchbox")[0].style.textAlign = "center";
    $("#datesearch").attr("readonly",true);
    $('#datesearch').daterangepicker({
       autoUpdateInput: false
     });
     //menangani proses saat apply date range
      $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
         $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
         start_date=picker.startDate.format('YYYY-MM-DD');
         end_date=picker.endDate.format('YYYY-MM-DD');
         refresh_table();
      });

      $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        start_date='';
        end_date='';
        refresh_table();
      });
  });

  $('[data-switch=true]').bootstrapSwitch('state', true);
  $('#Status').on('switchChange.bootstrapSwitch', function (event, state) {
      var x = $(this).data('on-text');
      var y = $(this).data('off-text');
      if ($("#Status").is(':checked')) {
          $(".is_reqs").hide(500);
      } else {
          $(".is_reqs").show(500);
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
      url : '{{ route('clinic.reservation.data') }}',
      data: {from_date:start_date, to_date:end_date},
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    columns: [
      {title: "No", data: 'DT_RowIndex', defaultContent: '-', class: 'text-center dt-body-nowrap', orderable: false, searchable: false, autoHide: false},
      {title: "Status", data: 'active', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      {title: "Iklan", data: 'AdvertiseCode', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: true},
      {title: "Reservation", data: 'InteractionCode', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: true},
      {title: "Pasien", data: 'Pasien', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      {title: "No Telf", data: 'Phone', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      // {title: "Age", data: 'Age', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      {title: "Consultation", data: 'Consultation', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      // {title: "Address", data: 'Address', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      // {title: "CityCode", data: 'CityCode', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      // {title: "CofirmationCode", data: 'CofirmationCode', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      // {title: "ReservationDate", data: 'ReservationDate', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
      // {title: "LockStatus", data: 'LockStatus', defaultContent: '-', class: 'text-center dt-body-nowrap', autohide: false},
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
              url: "{{ route('clinic.reservation.store')}}/" + id,
              type: "GET",
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              success: function (response) {
                  $("#form-input").attr("action", "{{ route('clinic.reservation.update','')}}/"+id);
                  $('#form-input').trigger("reset");
                  $('#method').val("PUT");
                  $('#Code').attr("readonly", true);
                  $('#Code').val(response.data.Code);
                  $('#CompanyCode').val(response.data.CompanyCode);
                  $('#BranchCode').val(response.data.BranchCode);
                  $('#ShipWorkCode').val(response.data.ShipWorkCode);
                  $('#AdvertiseCode').val(response.data.AdvertiseCode).trigger('change');
                  $('#InteractionCode').val(response.data.InteractionCode).trigger('change');
                  $('#GenderCode').val(response.data.GenderCode).trigger('change');
                  $('#ConfirmationCode').val(response.data.ConfirmationCode).trigger('change');
                  $('#FullName').val(response.data.FullName);
                  $('#Age').val(response.data.Age);
                  $('#Phone').val(response.data.Phone);
                  $('#Consultation').text(response.data.Consultation);
                  $('#Address').val(response.data.Address);
                  $('#CityCode').val(response.data.CityCode);
                  $('#Schedule').val(response.data.Schedule);
                  $('#LockStatus').val(response.data.LockStatus);
                  $('#ClosingStatusCode').val(response.data.ClosingStatusCode);
                  $('#ClosingBy').val(response.data.ClosingBy);
                  $('#ClosingDate').val(response.data.ClosingDate);
                  $('#ImgPatient').val(response.data.ImgPatient);
                  $('#ImgReservation').val(response.data.ImgReservation);
                  $('#ImgConference').val(response.data.ImgConference);
                  $('#ImgClosing').val(response.data.ImgClosing);
                  $('#modal-form').modal('show');
                  $('#Code').focus();
              },
              error: function (xhr, status, error) {
                  alert_show(xhr.status + " " + status + " " + error, false);
              }
          });
      } else {
          $("#form-input").attr("action", "{{ route('clinic.reservation.store')}}");
          $('#form-input').trigger("reset");
          $('#method').val("POST");
          $('#Code').attr("readonly", false);
          $('#Code').focus();
          $('#modal-form').modal('show');
          $('#Code').focus();
          $('#Status').bootstrapSwitch('state', true);
          $(".is_reqs").hide(500);
      }
  }

  function refresh_table() {
      table = table.dataTable();
      oSettings = table.fnSettings();
      table.fnClearTable(this);
      for (var i = 0; i < json.aaData.length; i++) {
          table.oApi._fnAddData(oSettings, json.aaData[i]);
      }

      oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
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
