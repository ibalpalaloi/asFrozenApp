<?php
function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);     
  return $pecahkan[2] . '-' . $bulan[ (int)$pecahkan[1] ] . '-' . $pecahkan[0];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/vali-template/css/main.css">
  <link rel="stylesheet" href="<?=url('/')?>/public/plugins/fontawesome-free-5.15.1-web/css/all.css">

  <style type="text/css">

    table  tr{
      border: 1px solid black;
    }



    table {
      font-size: 13px !important;
    }
  </style>

</head> 
<body>

  <div class="badan">
    <h5 style="text-align: center; font-size: 18px;">
      DAFTAR PRODUK<br>{{$kategori}}

    </h5>
    <br>
  </div>
  <table style="width: 100%;">
    <thead>
      <tr>
        <th style="border: 1px solid black; font-size: 13px; padding: 5px 10px 5px 10px; width: 5%;text-align: center;">No</th>
        <th style="border: 1px solid black; font-size: 13px; padding: 5px 10px 5px 10px; width: 45%;text-align: center;">Nama Produk</th>        
        <th style="border: 1px solid black; font-size: 13px; padding: 5px 10px 5px 10px; width: 20%;text-align: center;">Kategori</th>        
        <th style="border: 1px solid black; font-size: 13px; padding: 5px 10px 5px 10px; width: 20%;text-align: center;">Harga</th>
        <th style="border: 1px solid black; font-size: 13px; padding: 5px 10px 5px 10px; width: 10%;text-align: center;">Stok</th>
      </tr>               
    </thead>
    <tbody>
      @foreach ($produk as $row)
      <tr>
        <td style="border: 1px solid black; font-size: 13px; padding: 5px 10px 5px 10px; width: 5%;text-align: center;">{{$loop->iteration}}</td>
        <td style="border: 1px solid black; font-size: 13px; padding: 5px 10px 5px 10px; width: 45%;text-align: left;">{{$row->nama}}</td>        
        <td style="border: 1px solid black; font-size: 13px; padding: 5px 10px 5px 10px; width: 20%;text-align: left;">{{$row->kategori->kategori ?? ""}}</td>        
        <td style="border: 1px solid black; font-size: 13px; padding: 5px 10px 5px 10px; width: 20%;text-align: right;">{{number_format($row->harga, 0, '.', '.')}}</td>
        <td style="border: 1px solid black; font-size: 13px; padding: 5px 10px 5px 10px; width: 10%;text-align: right;">{{$row->stok_produk->stok ?? ""}}</td>
      @endforeach 
    </tbody>
  </table>
</div>
</div>


</body>
</html>