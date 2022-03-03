<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=url('/')?>/public/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=url('/')?>/public/AdminLTE/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <!-- Daterange picker -->

  <!-- summernote -->
  
  <style>
    ion-icon {
      font-size: 17px;
    }
  </style>

  <?php
// fungsi untuk konversi tanggal ke indonesia
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
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  }
  ?>

  <style type="text/css">
    .card-header:after {
      content: none;
    }
  </style>
</head>
<style>
  .border_table {
    border: 1px solid black;
    text-align: center;
  }

  .table_pesanan {
    width: 100%;
    border-collapse: collapse;
  }

  .loader-container{
    width: 100%;
    height: 100vh;
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
  }  
</style>

<div class="modal fade" id="modal_loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding: 1.5em; padding: 0px;">
  <div class="modal-dialog modal-dialog-centered" role="document" style="padding: 0px; position: relative;">
    <div class="modal-content st0" style="border-radius: 1.2em; display: flex; justify-content: center; align-items: center; margin: 8em 1em 0em 1em; color: white; border: #353535;">
      <div class="loader-container">
        <div class="spinner-border text-danger" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
  </div>
</div>


<body class="hold-transition sidebar-mini layout-fixed">
  <audio id="myAudio">
    <source src="{{asset('/public/audio/mixkit-doorbell-single-press-333.mp3')}}" type="audio/mpeg">
    </audio>

    <div class="modal fade" id="modal-notif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            {{ csrf_field() }}
            <div style="text-align: center;">
              <i class="" id="icon" style="font-size: 5em;"></i>
              <h4 style="margin-top: 0.5em;" id="header"></h4>
              <div style="margin-top: 0.5em;" id="pesan-error-notif"></div>
            </div>  
          </div>
          <div class="modal-footer" id="modal-footer-notif" data-dismiss="modal" style="color: white; display: flex; justify-content: center;">
            Tutup
          </div>
        </div>
      </div>
    </div>



    <div style="display: flex; align-items: center;">
      <span class="time" style="font-size: 15px">ID: {{$riwayat_nota->id_pesanan}}</span>
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <th>No.</th>
          <th style="position: relative;">Produk</th>
          <th style="text-align: center;">Harga Satuan</th>
          <th style="text-align: center;">Jumlah</th>
          <th style="text-align: center;">Subtotal</th>
        </thead>
        <tbody id="tbody_daftar_pesanan">
          @php
          $total_pesanan = 0;
          @endphp

          @foreach ($riwayat as $pesanan)
          <tr id="row_{{$pesanan->id}}">
            <td>{{$loop->iteration}}</td>
            <td>
              <div style="width: 100%;">
                <span style="width: 10%;">
                  <img class="img-fluid" src="<?=url('/')?>/public/img/produk/thumbnail/300x300/{{$pesanan->data_produk->foto}}" style="width: 50px; border-radius: 0.2em; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
                </span>
                <span style="width: 85%; margin-left: 1em; display: flex; align-items: center;">
                  {{$pesanan->data_produk->nama}}
                </span>
              </div>
            </td>
            <td>
              <div style="display: -webkit-box;display: flex;-webkit-box-pack:space-between;  justify-content: space-between;">
                <div>Rp.</div> <div>{{number_format($pesanan->harga_satuan, 0, '.', '.')}}</div>
              </div>
            </td>
            <td style="text-align: center;">x{{$pesanan->jumlah}}</td>
            <td>
              <div style="display: -webkit-box;display: flex;-webkit-box-pack:space-between;  justify-content: space-between;">
                <?php $total_pesanan += $pesanan->jumlah * $pesanan->harga_satuan; ?>
                <div>Rp.</div> <div>{{number_format($pesanan->jumlah * $pesanan->harga_satuan, 0, '.', '.')}}</div>
              </div>                  
            </td>
          </tr>
          @endforeach
        </tbody>              
      </table>
      <hr>
      <table class="table">
        <tbody>
          <td style="width: 33%;">
            <span>
              @if ($riwayat_nota->pengantaran == 'Diantarkan')
              <b>Diantarkan ke alamat</b><br>
              {{$riwayat_nota->nama_penerima}} | {{$riwayat_nota->nomor_penerima}}<br>
              {{$riwayat_nota->alamat}}<br>
              {{$riwayat_nota->kelurahan}}, {{$riwayat_nota->kecamatan}}, {{$riwayat_nota->kota}}
              @else
              <b>Ambil ditempat</b><br>
              {{$riwayat_nota->nama_penerima}} | {{$riwayat_nota->nomor_penerima}}<br>
              Toko AsFrozen, Jl. Mandala No. 1<br>
              Birobuli Utara, Palu Selatan, Kota Palu         
              @endif
            </td>
            <td style="width: 33%;">
             @if ($riwayat_nota->pembayaran == 'COD')
             <b>Cash On Delivery (COD)</b><br>
             <div class="checkout-bank-transfer-item__card" style="display: flex; margin-top: 0.5em;">
              <div class="checkout-bank-transfer-item__icon-container">
                <img src="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_palu_red.png" class="checkout-bank-transfer-item__icon" style="width: 2em; margin-right: 1em; width: 4em;">
              </div>
            </div>
            @else
            <b>Transfer melalui</b><br>
            <div style="display: -webkit-box;display: flex; margin-top: 0.5em;">
              <div class="checkout-bank-transfer-item__icon-container" style="width: 25%; margin-right: 0.5em;">
                <img src="<?=url('/')?>/public/bank/{{$riwayat_nota->bank->img}}" class="checkout-bank-transfer-item__icon" style="width: 4em;">
              </div>
              <div style="width: 70%;">
                <div class="checkout-bank-transfer-item__main" style="line-height: 0.8em;">
                  {{$riwayat_nota->bank->nama_bank}}
                </div>
                <div class="checkout-bank-transfer-item__description">
                  <small>Perlu upload bukti transfer</small>
                </div>
                <div>{{$riwayat_nota->bank->nomor_rekening}}</div>
              </div>
            </div>
            @endif
          </td>
          <td style="width: 33%; display: -webkit-box;display: flex;">
           <div style="margin-right: 1em; margin-top: 0.5em;">{{$qrcode->size(80)->generate($riwayat_nota->id_pesanan)}}</div>
           <div style="margin-top: 0.2em;width: 100%;">
            <div style="display: -webkit-box;display: flex;-webkit-box-pack:space-between; justify-content: space-between;">
              <div class="col-md-6">Subtotal</div>
              <div class="col-md-6" style="display: -webkit-box;display: flex;-webkit-box-pack:space-between; justify-content: space-between;">   
                <div>: Rp. </div>
                <div id="sub_total_pesanan">{{number_format($total_pesanan, 0, ".", ".")}}</div>
              </div>
            </div>
            <div style="display: -webkit-box;display: flex;-webkit-box-pack:space-between; justify-content: space-between;">
              <div class="col-md-6">Ongkir</div>
              <div class="col-md-6" style="display: -webkit-box;display: flex;-webkit-box-pack:space-between; justify-content: space-between;">
                <div>: Rp.</div>
                <div>{{number_format($riwayat_nota->ongkos_kirim, 0, '.', '.')}}</div>
              </div>
            </div>
            <div style="display: -webkit-box;display: flex;-webkit-box-pack:space-between; justify-content: space-between;">
              <div class="col-md-6">    
                <b>Total</b>
              </div>
              <div class="col-md-6" style="display: -webkit-box;display: flex;-webkit-box-pack:space-between; justify-content: space-between;">
                <div>: Rp.</div>
                <div><b id="total_pesanan">{{number_format($riwayat_nota->ongkos_kirim+$total_pesanan, 0, ".", ".")}}</b></div>
              </div>
            </div>
          </div>
        </td>
      </tbody>
    </table>
  </div>
</div>


