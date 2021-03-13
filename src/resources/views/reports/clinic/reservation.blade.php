<!doctype html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <title>@isset($title){{$title}}@endisset</title>
  <style type="text/css">
    *, input, textarea {
       font-size: 1rem;
       font-weight: 900;
    }
  </style>
  </head>
  <body style="width: 40rem;">
    <div class="card" style="border-radius: 10px; background-color:#bbbaa9">
      <div style="padding-top:10px;"/>
      <div class="card" style="border-radius: 10px;margin: 0px 10px; background-color:#3a4138">
        <table>
          <tr>
            <td><img style="border-radius:10px; margin:0px 2px; height:80px" src="https://terapigarangarang.com/wp-content/uploads/2019/04/logo-terapi-garang-arang.png" alt="" width="200"/></td>
            <td><label style="font-size:1.5rem; color: #999889;">MEDICAL TERAPI & HERBAL</label></td>
          </tr>
        </table>
      </div>
      <div style="padding-top:5px;"/>
      <div class="card" style="border-radius: 10px;margin: 0px 10px; background-color:#c3cebe; color:#3a4138;">
         <table width="100%">
           <tr>
             <td valign="mid">
               <center>
                 <img style="border-radius:10px; margin:2px" src="https://terapigarangarang.com/wp-content/uploads/2019/04/IMG-1544-Copy.jpg" alt="" height="300" width="230"/>
                 <label>JAM OPERASIONAL</label>
                 <br/>
                 <label>08:00-17:00 WIB</label>
               </center>
             </td>
             <td valign="top" width="100%">
               <table  width="100%">
                 <tr><td valign="top" style="white-space: nowrap">No Reservasi</td><td valign="top">:</td><td valign="top" style="text-align: justify; text-justify: newspaper;"><input style="border-radius:5px; width:98%;" value="RSM001-150621001"/></td></tr>
                 <tr><td valign="top">Kunjungan</td><td valign="top">:</td><td valign="top" style="text-align: justify; text-justify: newspaper;"><input style="border-radius:5px; width:98%;" value="Minggu, 15 Jun 2021 13:00"/></td></tr>
                 <tr><td valign="top">Nama</td><td valign="top">:</td><td valign="top" style="text-align: justify; text-justify: newspaper;"><input style="border-radius:5px; width:98%;" value="Imam Solikhin"/></td></tr>
                 <tr><td valign="top">No Telp</td><td valign="top">:</td><td valign="top" style="text-align: justify; text-justify: newspaper;"><input style="border-radius:5px; width:98%;" value="081808178118"/></td></tr>
                 <tr><td valign="top">Keluhan</td><td valign="top">:</td><td valign="top" style="text-align: justify; text-justify: newspaper;"><textarea style="border-radius:5px; width:98%;height:4rem">Pusing karena kurang tidur semalaman</textarea></td></tr>
                 <tr><td valign="top">Alamat</td><td valign="top">:</td><td valign="top" style="text-align: justify; text-justify: newspaper;" height="100"><textarea style="border-radius:5px; width:98%; height:6rem">Taman Griya Permai, Jl. Pinang Griya Raya, RT.001/RW.005, Pinang, Kec. Pinang, Kota Tangerang, Banten 15145</textarea></td></tr>
                 <tr><td valign="top">Cust Services</td><td valign="top">:</td><td valign="top" style="text-align: justify; text-justify: newspaper;"><input style="border-radius:5px; width:98%;" value="Anna / 081808178118"/></td></tr>
               </table>
             </td>
           </tr>
         </table>
      </div>
      <div style="padding-top:5px;"/>
      <div class="card" style="border-radius: 10px;padding: 3px 10px; margin: 0px 10px; background-color:#3a4138;">
        <center style="color:#999889;">
          <label>STROKE SYARAF KEJEPIT NYERI SENDI</label>
          <br>
          <label>REMATIK ASAM URAT</label>
          <br>
          <label>Jl. Raden Saleh, Ruko bumi permata indah blok RI No. 38C meruya utara</label>
        </center>
      </div>
      <div style="padding-bottom:10px;"/>
    </div>
  </body>
  @if ($is_btn)
    <div style="text-align: center;">
      <form action="{{$btn_url}}">
          <input type="submit" value="download" />
      </form>
    </div>
  @endif
  </html>
