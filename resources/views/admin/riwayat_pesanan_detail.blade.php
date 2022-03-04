@extends('layouts.admin')
@section('header')
<link rel="stylesheet" href="<?=url('/')?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
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
@endsection
@section('body')
<div id="tambah_pesanan_modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <input type="text" name="" id="input_id_produk" hidden>
          <input type="text" name="" id="input_id_nota" hidden>
          <input type="text" name="" id="input_harga_satuan" hidden>
          <div class="col-8">
            <input type="text" class="form-control" id="input_nama_produk">
          </div>
          <div class="col-2">
            <input type="number" class="form-control" id="input_jumlah">
          </div>
          <div class="col-2">
            <button onclick="simpan_pesanan_baru()">Simpan</button>
          </div>
        </div>
        <br>
        <label for="form-control">Cari Produk</label>
        <input type="text" class="form-control" id="cari_produk">
        <br>
        <div style="height: 350px; overflow-y: scroll">
          <table class="table">
            <thead>
              <tr>
                <th width="40%">Produk</th>
                <th width="15%">Stok</th>
                <th width="15%">Diskon</th>
                <th width="30%">harga</th>
              </tr>
            </thead>
            <tbody id="tbody_tabel_tambah_produk" >

            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; width: 100%;">
          <div style="display: flex; align-items: center;">
            <span class="time" style="font-size: 15px">ID: {{$riwayat_nota->id_pesanan}}</span>
          </div>
        </div>
        <div class="card-body">
          <table class="table" >
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
                  <div style="width: 100%; display: flex; margin-bottom: 0em;">
                    <div style="width: 10%;">
                      <img class="img-fluid" src="<?=url('/')?>/public/img/produk/thumbnail/300x300/{{$pesanan->data_produk->foto}}" style="width: 100%; border-radius: 0.2em; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
                    </div>
                    <div style="width: 85%; margin-left: 1em; display: flex; align-items: center;">
                      {{$pesanan->data_produk->nama}}
                    </div>
                  </div>
                </td>
                <td>
                  <div style="display: flex; justify-content: space-between;">
                    <div>Rp.</div> <div>{{number_format($pesanan->harga_satuan, 0, '.', '.')}}</div>
                  </div>
                </td>
                <td style="text-align: center;">x{{$pesanan->jumlah}}</td>
                <td>
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
            <div class="col-md-4">
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
            <div class="col-md-4">
              @if ($riwayat_nota->pembayaran == 'COD')
              <b>Cash On Delivery (COD)</b><br>
              <div class="checkout-bank-transfer-item__card" style="display: flex; margin-top: 0.5em;">
                <div class="checkout-bank-transfer-item__icon-container">
                  <img src="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_palu_red.png" class="checkout-bank-transfer-item__icon" style="width: 2em; margin-right: 1em; width: 4em;">
                </div>
              </div>
              @else
              <b>Transfer melalui</b><br>
              <div class="checkout-bank-transfer-item__card" style="display: flex; margin-top: 0.3em;">
                <div class="checkout-bank-transfer-item__icon-container">
                  <img src="<?=url('/')?>/public/bank/{{$riwayat_nota->bank->img}}" class="checkout-bank-transfer-item__icon" style="width: 2em; margin-right: 1em; width: 4em;">
                </div>
                <div>
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
            </div>
            <div class="col-md-4" style="display: flex;">
              <div style="margin-right: 1em; margin-top: 0.5em;" hidden>{{$qrcode->size(80)->generate($riwayat_nota->id_pesanan)}}</div>
              <div style="margin-top: 0.2em;width: 100%;">
                <div class="row">
                  <div class="col-md-6">Subtotal</div>
                  <div class="col-md-6" style="display: flex; justify-content: space-between;">   
                    <div>: Rp. </div>
                    <div id="sub_total_pesanan">{{number_format($total_pesanan, 0, ".", ".")}}</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">Ongkir</div>
                  <div class="col-md-6" style="display: flex; justify-content: space-between;">   
                    <div>: Rp.</div>
                    <div>{{number_format($riwayat_nota->ongkos_kirim, 0, '.', '.')}}</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">    
                    <b>Total</b>
                  </div>
                  <div class="col-md-6" style="display: flex; justify-content: space-between;">   
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
  </div>
</div>
</div>

@endsection
@section('footer')
<script src="<?=url('/')?>/public/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=url('/')?>/public/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=url('/')?>/public/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=url('/')?>/public/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

  function tambah(){
    $("#modal_tambah").modal('show');
  }

  function control_time(id_pesanan, status){
    if (status == 'pause'){
      var countdown = $("#countdown_"+id_pesanan).html();
      $("#pause_countdown_"+id_pesanan).html(countdown);
      $("#pause_countdown_"+id_pesanan).prop('hidden', false);
      $("#countdown_"+id_pesanan).prop('hidden', true);
      $("#btn_pause_"+id_pesanan).prop('hidden', true);
      $("#btn_play_"+id_pesanan).prop('hidden', false);
      $.ajax({
        type: "get",
        url: "<?=url('/')?>/admin/daftar-pesanan/"+id_pesanan+"/control/pause?waktu="+countdown,
        success:function(data){
          // alert(data);
        }
      });
    }
    else {
      $("#pause_countdown_"+id_pesanan).prop('hidden', true);
      $("#countdown_"+id_pesanan).prop('hidden', false);      
      $("#btn_pause_"+id_pesanan).prop('hidden', false);
      $("#btn_play_"+id_pesanan).prop('hidden', true);
      $.ajax({
        type: "get",
        url: "<?=url('/')?>/admin/daftar-pesanan/"+id_pesanan+"/control/run",
        dataType: "json",
        success:function(data){
          var menit = data.menit;
          var detik = data.detik;
          var id = data.id;
          countdown_start(menit, detik, id);

          function countdown_start(minutes, seconds, id) {
            function tick(){
              counter = document.getElementById("countdown_"+id);
              counter.innerHTML = minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
              seconds--;
              if (seconds >= 0) {
                setTimeout(tick, 1000);

              } 
              else {
                if (minutes >= 1) {
                  setTimeout(function () {countdown_start(minutes - 1, 59, id);}, 1000);
                }
              }
            }
            tick();
          }
        }
      });
    }
  }

  function show_modal_tambah_pesanan(id_nota){
    $('#input_id_nota').val(id_nota);
    $('#input_id_produk').val('');
    $('#input_nama_produk').val('');
    $('#input_jumlah').val('');
    $('#tambah_pesanan_modal').modal('show');
  }




</script>
<script>
  var nota = {!! json_encode($riwayat_nota) !!};

  $(document).ready(function(){
    get_total_pesanan();
  });
  function get_total_pesanan()
  {
    $.ajax({
      type: "get",
      url: "<?=url('/')?>/get-total-harga-pesanan/"+nota['id'],
      success:function(data){
        console.log(data.data['ongkir']);
        $('#sub_total_pesanan').html(data.data['total_sub_harga'].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
        $('#total_pesanan').html(data.data['total_harga'].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
      }
    })
  }
</script>
@include('script.daftar_pesanan_script')
@endsection