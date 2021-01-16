@extends('layout.default')

@section('content')
<div class="subheader py-2 {{ Metronic::printClasses('subheader', false) }}" id="kt_subheader">
  <div class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-baseline flex-wrap mr-5">
      <h5 class="text-dark font-weight-bold my-1 mr-5">
        User History
      </h5>
      <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('management.login-history') }}" class="text-muted">User History</a>
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
      <h3 class="card-label font-weight-bolder text-white">User History
        <div class="text-muted pt-2 font-size-lg">show Datatable from table User History</div>
      </h3>
    </div>
    <div class="card-toolbar pt-1 pb-0">
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
<script type="text/javascript">
  var start_date = "";
  var end_date = "";
  $(document).ready(function() {
    $("#datatable_wrapper").removeClass("dataTables_wrapper form-inline dt-bootstrap no-footer");
    $("#datatable_wrapper").addClass("dataTables_wrapper dt-bootstrap4 no-footer");
    $("div.datesearchbox").html('<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearch" placeholder="Search by date range"> </div>');
    document.getElementsByClassName("datesearchbox")[0].style.textAlign = "center";
    $("#datesearch").attr("readonly",true);
    $('#datesearch').daterangepicker({
       autoUpdateInput: false
     });

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
				url : '{{ route('management.login-history.data') }}',
				headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
				}
		},
		columns : [
				{ title: 'Login at', data : 'created_at', name: 'created_at', class: 'text-center', defaultContent: '-', class: 'text-center dt-body-nowrap'},
				{ title: 'Username', data : 'user.username', name: 'user.username', class: 'text-center', defaultContent: '-', class: 'text-center dt-body-nowrap'},
				{ title: 'IP Address', data : 'ip', name: 'ip', class: 'text-center', defaultContent: '-', class: 'text-center dt-body-nowrap'},
				{ title: 'Browser', data : 'browser', name: 'browser', class: 'text-center', defaultContent: '-', class: 'text-center dt-body-nowrap'},
				{ title: 'Platform', data : 'platform', name: 'platform', class: 'text-center', defaultContent: '-', class: 'text-center dt-body-nowrap'},
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
</script>
@endsection
