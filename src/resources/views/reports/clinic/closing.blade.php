<!doctype html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <title>@isset($title_report){{$title_report}}@endisset</title>
  <style type="text/css">
      * {
          font-family: Verdana, Arial, sans-serif;
      }
      table{
          font-size: 80%;
      }
      foot tr td{
          font-weight: bold;
          font-size: x-small;
      }
      .gray {
          background-color: lightgray
      }
      tr.border_bottom td {
        border-bottom: 1px black;
        border-bottom-style: dashed;
        border-bottom-width: thin;
      }
      tr.no_border td {
        border-bottom:0;
        border-bottom-style: 0;
        border-bottom-width: 0;
      }
  </style>
  </head>
  <body>
    <table width="100%">
      <tr>
          <td valign="top"><img src="{{asset('media/logos/stars.png')}}" alt="" width="150"/></td>
          <td align="right">
              <label style="font-size:200%; font-weight:900">Gudang Dunia</label>
              <pre style="font-size:100%; font-weight:900">
                {{sess_company("id")}}
                {{sess_company("name")}}
              </pre>
          </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
            @isset($title_report)
              <strong style="font-size:200%; font-weight:900">{{$title_report}}</strong>
            @endisset
        </td>
      </tr>
    </table>
    <table width="100%">
      <tr align="center">
        @isset($from_date)
          <td><strong>From:{{$from_date}}</strong></td>
        @endisset
        @isset($to_date)
          <td><strong>To:{{$to_date}}</strong></td>
        @endisset
      </tr>
    </table>
    <!-- <br/> -->
    <table width="100%">
      <head>
        <tr style="background-color: lightgray;">
          <th style="text-align:right;">#</th>
          <th style="text-align:center;">Foto Pasien</th>
          <th style="text-align:center;">Bukti Closing</th>
          <th style="text-align:center;">Keterangan Closing</th>
          <th style="text-align:left;">Approval</th>
        </tr>
      </head>
      <body>
          @isset($data_list)
              @foreach ($data_list as $value)
                <tr class="border_bottom">
                  <td scope="row" style="text-align:right; font-size:100%; font-weight:800;">{{$loop->index+1}}</td>
                  <td scope="row" style="text-align:center;"><img src="{{asset('media/users/300_21.jpg')}}" alt="" width="250"/></td>
                  <td scope="row" style="text-align:center;"><img src="{{asset('media/users/300_21.jpg')}}" alt="" width="250"/></td>
                  <td scope="row" valign="mid">
                    <table width="100%" style="font-size:100%; font-weight:800;">
                      <tr class="no_border"><td scope="row">Nama Pasien</td><td>:</td><td>{{ucwords($value->nama_lengkap)}}</td></tr>
                      <tr class="no_border"><td scope="row">No Reservasi</td><td>:</td><td>{{$value->delivery_ref}}</td></tr>
                      <tr class="no_border"><td scope="row">Kunjungan</td><td>:</td><td>{{date('d-m-Y H:i', strtotime($value->created_at))}}</td></tr>
                      <tr class="no_border"><td scope="row">Nama CS</td><td>:</td><td>{{ucwords($value->created_by)}}</td></tr>
                    </table>
                    <td scope="row"></td>
                  </td>
                <tr>
                  @php
                      $total = isset($total) ? $total + $loop->index+1 : 0;
                  @endphp
              @endforeach
          @endisset
      </body>
      <foot>
          <tr>
              <td colspan="6" style="border-bottom: thick double black;"></td>
          </tr>
          <tr>
              <td colspan="3"></td>
              <td align="right"><strong>Total Closing</strong> </td>
              <td align="right" class="gray"><strong>{{number_format(count($data_list), 0, ',', '.')}} Pasien</strong></td>
          </tr>
      </foot>
    </table>
  </body>

  @if ($is_btn)
    <div style="text-align: center;">
      <form action="{{$btn_url}}">
          <input type="submit" value="download" />
      </form>
    </div>
  @endif
  </html>
