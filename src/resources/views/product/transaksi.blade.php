@extends('layout.default')

@section('content')
<div class="subheader py-2 {{ Metronic::printClasses('subheader', false) }}" id="kt_subheader">
  <div class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-baseline flex-wrap mr-5">
      <h5 class="text-dark font-weight-bold my-1 mr-5">
        Transaksi
      </h5>
      <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('product.index','transaksi') }}" class="text-muted">Transaksi</a>
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
      <h3 class="card-label font-weight-bolder text-white">Transaksi
        <div class="text-muted pt-2 font-size-lg">show Datatable from table Transaksi</div>
      </h3>
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
                <h5 class="modal-title text-white bold" id="modal">New Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" id="form-input" action="{{ route('product.save','transaksi') }}" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" class="form-control" id="method" name="_method" placeholder="Enter method" value="POST"/>
                <div class="card-body pt-3">
                <div class="mb-2">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Iklan</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" id="advertise" name="advertise" style="width: 100%;">
                              <option value="" selected>Chose Advertise</option>
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
                        <label class="col-lg-4 col-form-label">Transaksi</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" id="interaction" name="interaction" style="width: 100%;">
                              <option value="" selected>Chose Transaksi</option>
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
                            <select class="form-control select2" id="gender" name="gender" style="width: 100%;">
                              <option value="" selected>Chose </option>
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
                        <label class="col-lg-4 col-form-label">Name Customer</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                        </div>
                    </div>
                </div>
                <div class="mb-1">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">No Telfon</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Keluhan</label>
                        <div class="col-lg-8">
                            <input id="kt_tagify_5" class="form-control tagify" name='tags3' placeholder="keluhan" value=""/>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                  <div class="separator separator-dashed my-3"></div>
                      <div class="form-group mb-1">
                          <div class="alert alert-custom alert-default" role="alert" style="padding: 0 2rem;">
                              <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                              <div class="alert-text">
                                  Customer Baru.
                              </div>
                          </div>
                      </div>
                      <div class="mb-1" >
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Category</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="category_order" placeholder="LEAD FOLLOWUP" value="" readonly="true"/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1" >
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Category Status</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="category_status" placeholder="NEW || RE-ORDER" value="" readonly="true"/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Jumlah</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Harga</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Biaya Kirim</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Asuransi</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Transaksi</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-2">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Market</label>
                              <div class="col-lg-8">
                                  <select class="form-control select2" id="market" name="market" style="width: 100%;">
                                    <option value="" selected>Chose </option>
                                     @isset ($market_list)
                                       @foreach($market_list as $market)
                                        <option value="{{ $market->Code }}">{{ $market->Name }}</option>
                                       @endforeach
                                     @endisset
                                 </select>
                              </div>
                          </div>
                      </div>
                      <div class="mb-2">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Kurir</label>
                              <div class="col-lg-8">
                                  <select class="form-control select2" id="courier" name="courier" style="width: 100%;">
                                    <option value="" selected>Chose </option>
                                     @isset ($courier_list)
                                       @foreach($courier_list as $courier)
                                        <option value="{{ $courier->Code }}">{{ $courier->Name }}</option>
                                       @endforeach
                                     @endisset
                                 </select>
                              </div>
                          </div>
                      </div>
                      <div class="mb-2">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">COD/TF</label>
                              <div class="col-lg-8">
                                  <select class="form-control select2" id="MarketCode" name="payment_type" style="width: 100%;">
                                    <option value="" selected>Chose </option>
                                     @isset ($payment_type_list)
                                       @foreach($payment_type_list as $payment_type)
                                        <option value="{{ $payment_type->Code }}">{{ $payment_type->Name }}</option>
                                       @endforeach
                                     @endisset
                                 </select>
                              </div>
                          </div>
                      </div>
                      <div class="mb-2">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">COD/TF</label>
                              <div class="col-lg-8">
                                  <select class="form-control select2" name="param" style="width:100%;">
                                  <option>COD</option>
                                  <option>TF</option>
                              </select>
                              </div>
                          </div>
                      </div>
                      <div class="mb-2">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Bank</label>
                              <div class="col-lg-8">
                                  <select class="form-control select2" name="param" style="width:100%;">
                                  <option>BCA</option>
                                  <option>BNI</option>
                              </select>
                              </div>
                          </div>
                      </div>
                      <div class="mb-2">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Tanggal</label>
                              <div class="col-lg-8">
                                  <div class="input-icon">
                                      <input type="input" class="form-control datetimepicker-input" placeholder="dd/mm/yyyy" id="last_date" data-date-format="dd-mm-yyyy hh:ii" value="<?php echo date('d-m-Y H:i'); ?>"/>
                                      <span>
                                          <i class="far fa-calendar-alt text-muted"></i>
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="mb-2">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Estimasi</label>
                              <div class="col-lg-8">
                                  <div class="input-icon">
                                      <input type="input" class="form-control datetimepicker-input" placeholder="dd/mm/yyyy" id="last_date" data-date-format="dd-mm-yyyy hh:ii" value="<?php echo date('d-m-Y H:i'); ?>"/>
                                      <span>
                                          <i class="far fa-calendar-alt text-muted"></i>
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="separator separator-dashed my-3"></div>
                      <div class="form-group mb-1">
                          <div class="alert alert-custom alert-default" role="alert" style="padding: 0 2rem;">
                              <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                              <div class="alert-text">
                                  Pengiriman Customer.
                              </div>
                          </div>
                      </div>
                      <div class="mb-2">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Destination</label>
                              <div class="col-lg-8">
                                  <select class="form-control select2" name="param" style="width:100%;">
                                  <option>Alamat Baru</option>
                                  <option>Destination 1</option>
                              </select>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Alamat</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">No. Rumah</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Rt</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">rw</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Desa</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Kelurahan</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Patokan</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Kecamatan</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Kota</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Provinsi</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
                              </div>
                          </div>
                      </div>
                      <div class="mb-1">
                          <div class="form-group row">
                              <label class="col-lg-4 col-form-label">Kode Pos</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="Name" placeholder="Enter Name" value=""/>
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
<script type="text/javascript">
  $(document).ready(function() {
    $(".is_reqs").hide();
    $('.select2').select2({});
    $("#datatable_wrapper").removeClass("dataTables_wrapper form-inline dt-bootstrap no-footer");
    $("#datatable_wrapper").addClass("dataTables_wrapper dt-bootstrap4 no-footer");
  });

  $('[data-switch=true]').bootstrapSwitch('state', true);
  $('#status').on('switchChange.bootstrapSwitch', function (event, state) {
      var x = $(this).data('on-text');
      var y = $(this).data('off-text');
      if ($("#status").is(':checked')) {
          $(".is_reqs").hide(500);
      } else {
          $(".is_reqs").show(500);
      }
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
      url : '{{ route('product.list','transaksi') }}',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    columns: [
      {title: "No", data: 'DT_RowIndex', defaultContent: '-', class: 'text-center dt-body-nowrap', orderable: false, searchable: false, autoHide: false},
      {title: "Code", data: 'Code', defaultContent: '-', class: 'text-center dt-body-nowrap'},
      {title: "Name", data: 'Name', defaultContent: '-', class: 'text-center dt-body-nowrap', autoHide: false},
      {title: "Status", data: 'active', defaultContent: '-', class: 'text-center dt-body-nowrap'},
      {title: "Actions", data: 'action', orderable: false, responsivePriority: -1},
    ],
    order: [[1, 'asc']],
    bStateSave: true,
    columnDefs: [
      {
        targets: [0,-1],
        className: 'text-center visible dt-body-nowrap'
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
    initComplete: function() {
      $('.tl-tip').tooltip();
      @if (count($errors) > 0)
      // jQuery("html, body").animate({
      //   scrollTop: $('#add-form').offset().top - 100 // 66 for sticky bar height
      // }, "slow");
      @endif
    }
  });

  function show_data(id = "") {
      if (id !== "") {
          $.ajax({
              url: "{{ route('product.list','transaksi')}}/" + id,
              type: "GET",
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              success: function (response) {
                  $("#form-input").attr("action", "{{ route('product.update',['transaksi',''])}}/"+id);
                  $('#form-input').trigger("reset");
                  $('#method').val("POST");

                  $('#COde').val(response.data.Code);
                  $('#Name').val(response.data.Name);
                  if (response.data.ActiveStatus === 1) {
                      $('#ActiveStatus').bootstrapSwitch('state', true);
                  } else {
                      $('#ActiveStatus').bootstrapSwitch('state', false);
                  }
                  $('#modal-form').modal('show');
                  $('#COde').focus();
              },
              error: function (xhr, status, error) {
                  alert_show(xhr.status + " " + status + " " + error, false);
              }
          });
      } else {
        $("#form-input").attr("action", "{{ route('product.save','transaksi')}}");
          $('#form-input').trigger("reset");
          $('#method').val("POST");

          $('#COde').focus();
          $('#modal-form').modal('show');
          $('#COde').focus();
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
