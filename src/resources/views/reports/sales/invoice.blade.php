<!doctype html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <title>@isset($title_report){{$title_report}}@endisset</title>
  <style type="text/css">
      * {
          font-family: Verdana, Arial, sans-serif;
          vertical-align: text-bottom;
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
          <th style="text-align:left;">No Transaksi</th>
          <th style="text-align:left;">Tanggal Transaksi</th>
          <th style="text-align:left;">Pelanggan</th>
          <th style="text-align:right;">Jumlah</th>
          <th style="text-align:right;">Biaya Pengiriman</th>
          <th style="text-align:right;">Total Transaksi</th>
        </tr>
      </head>
      <body>
          @isset($data_list)
              @foreach ($data_list as $value)
                <tr class="border_bottom">
                  <td scope="row" style="text-align:right;">{{$loop->index+1}}</td>
                  <td scope="row">{{$value->delivery_ref}}</td>
                  <td scope="row">{{date('d-m-Y H:i', strtotime($value->created_at))}}</td>
                  <td scope="row">{{ucwords($value->nama_lengkap)}}</td>
                  <td scope="row" style="text-align:right;">{{number_format($value->jml_pesanan, 0, ',', '.')}}</td>
                  <td scope="row" style="text-align:right;">{{number_format(($value->biaya_pengiriman+$value->asuransi), 2, ',', '.')}}</td>
                  <td scope="row" style="text-align:right;">{{number_format($value->total_transaksi-($value->biaya_pengiriman+$value->asuransi), 2, ',', '.')}}</td>
                <tr>
                  @php
                      $total_kurir = isset($total_kurir) ? $total_kurir + $value->biaya_pengiriman+$value->asuransi : 0;
                      $total = isset($total) ? $total + $value->total_transaksi-($value->biaya_pengiriman+$value->asuransi) : 0;
                  @endphp
              @endforeach
          @endisset
      </body>
      <foot>
          <tr>
              <td colspan="7" style="border-bottom: thick double black;"></td>
          </tr>
          <tr>
              <td colspan="5"></td>
              <td align="right">Total Pengiriman Rp </td>
              <td align="right" class="gray">{{number_format($total_kurir, 2, ',', '.')}}</td>
          </tr>
          <tr>
              <td colspan="5"></td>
              <td align="right">Total Transaksi Rp </td>
              <td align="right" class="gray">{{number_format($total, 2, ',', '.')}}</td>
          </tr>
          <tr>
              <td colspan="5"></td>
              <td align="right">Grand Total Rp </td>
              <td align="right" class="gray"><strong>{{number_format($total+$total_kurir, 2, ',', '.')}}</strong></td>
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
