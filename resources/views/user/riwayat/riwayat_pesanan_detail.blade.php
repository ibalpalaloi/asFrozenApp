@extends("layouts.user_data")

@section('title-header')
Riwayat Pemesanan
@endsection

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<style type="text/css">
    td {
        font-size: 0.8em !important;
    }

    body {
        font-size: 0.8em !important;
    }
</style>
@endsection


@section('content')
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
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>


<div class="card shadow p-3 mb-5 bg-white rounded">
    <div tabindex="0" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide11">

        <div style="padding: 20px;">
            <div style=" display: flex; justify-content: space-between; width: 100%">
                <h6>ID. {{$riwayat_nota->id_pesanan}}</h6>
                <h6>{{tgl_indo(date('Y-m-d', strtotime($riwayat_nota->waktu_pemesanan)))}} [{{date('H:i', strtotime($riwayat_nota->waktu_pemesanan))}}]</h6>
            </div>
            <table class="table" >
                <thead>
                  <th>No.</th>
                  <th style="position: relative;font-size: 0.8em;">Produk</th>
                  <th style="text-align: center;font-size: 0.8em;">Harga Satuan</th>
                  <th style="text-align: center;font-size: 0.8em;">Jumlah</th>
                  <th style="text-align: center;font-size: 0.8em;">Subtotal</th>
              </thead>
              <tbody id="tbody_daftar_pesanan">
                  @php
                  $total_pesanan = 0;
                  @endphp

                  @foreach ($riwayat as $pesanan)
                  <tr id="row_{{$pesanan->id}}">
                    <td style="font-size: 0.8em;">{{$loop->iteration}}</td>
                    <td style="font-size: 0.8em;">
                      <div style="width: 100%; display: flex; margin-bottom: 0em;">
                        <div style="width: 10%;">
                          <img class="img-fluid" src="<?=url('/')?>/img/produk/thumbnail/300x300/{{$pesanan->data_produk->foto}}" style="width: 100%; border-radius: 0.2em; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
                      </div>
                      <div style="width: 85%; margin-left: 1em; display: flex; align-items: center;">
                          {{$pesanan->data_produk->nama}}
                      </div>
                  </div>
              </td>
              <td style="font-size: 0.8em;">
                  <div style="display: flex; justify-content: space-between;">
                    <div>Rp.</div> <div>{{number_format($pesanan->harga_satuan, 0, '.', '.')}}</div>
                </div>
            </td>
            <td style="text-align: center;font-size: 0.8em;">x{{$pesanan->jumlah}}</td>
            <td style="font-size: 0.8em;">
              <div style="display: flex; justify-content: space-between;">
                <?php $total_pesanan += $pesanan->jumlah * $pesanan->harga_satuan; ?>
                <div>Rp.</div> <div>{{number_format($pesanan->jumlah * $pesanan->harga_satuan, 0, '.', '.')}}</div>
            </div>                  
        </td>
    </tr>
    @endforeach
</tbody>              
</table>
<hr>
<div class="row" style="margin-left: 0.5em;margin-right: 0.5em;">
    <div class="col-md-4" style="font-size: 0.8em;">
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
  </div>
  <div class="col-md-4"  style="font-size: 0.8em;">
      @if ($riwayat_nota->pembayaran == 'COD')
      <b>Cash On Delivery (COD)</b><br>
      <div class="checkout-bank-transfer-item__card" style="display: flex; margin-top: 0.5em;">
        <div class="checkout-bank-transfer-item__icon-container">
          <img src="<?=url('/')?>/katalog_assets/assets/img/logo/frozen_palu_red.png" class="checkout-bank-transfer-item__icon" style="width: 2em; margin-right: 1em; width: 4em;">
      </div>
  </div>
  @else
  <b>Transfer melalui</b><br>
  <div class="checkout-bank-transfer-item__card" style="display: flex; margin-top: 0.3em;">
    <div class="checkout-bank-transfer-item__icon-container">
      <img src="<?=url('/')?>/bank/{{$riwayat_nota->bank->img}}" class="checkout-bank-transfer-item__icon" style="width: 2em; margin-right: 1em; width: 4em;">
  </div>
  <div>
      <div class="checkout-bank-transfer-item__main" style="line-height: 0.8em;">
        {{$riwayat_nota->bank->nama_bank}}
    </div>
    <div class="checkout-bank-transfer-item__description">
        <small>Perlu upload bukti transfer</small>
    </div>
    <div>(Dicek Manual)</div>
</div>
</div>
@endif
</div>
<div class="col-md-4" style="display: flex; font-size: 0.8em;">
  <div style="margin-right: 1em; margin-top: 0.5em;">{{$qrcode->size(60)->generate($riwayat_nota->id_pesanan)}}</div>
  <div style="margin-top: 0.2em;width: 100%;">
    <div class="row">
      <div style="width: 50%; padding-left: 1em;">Subtotal</div>
      <div style="display: flex; justify-content: space-between; width: 50%;">   
        <div>: Rp. </div>
        <div id="sub_total_pesanan">{{number_format($total_pesanan, 0, ".", ".")}}</div>
    </div>
</div>
<div class="row">
  <div style="width: 50%; padding-left: 1em;">Ongkir</div>
  <div style="display: flex; justify-content: space-between; width: 50%;">   
    <div>: Rp.</div>
    <div>{{number_format($riwayat_nota->ongkos_kirim, 0, '.', '.')}}</div>
</div>
</div>
<div class="row">
  <div style="width: 50%; padding-left: 1em;">Total</div>
  <div style="display: flex; justify-content: space-between; width: 50%;">   
    <div>: Rp.</div>
    <div><b id="total_pesanan">{{number_format($riwayat_nota->ongkos_kirim+$total_pesanan, 0, ".", ".")}}</b></div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>


</div>
@endsection

@section('footer')
<script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
  });
});
</script>
@endsection
