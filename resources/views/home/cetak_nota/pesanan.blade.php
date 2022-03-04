<!DOCTYPE html>
<html lang="en">
<head>
  <title>AdminLTE 3 | Dashboard</title>
  <link rel="stylesheet" href="{{public_path('AdminLTE/dist/css/adminlte.min.css')}}">
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

</head>




<body>
  <div style="display: flex; align-items: center;">
    <span class="time" style="font-size: 15px">Pesanan ID: {{$riwayat_nota->id_pesanan}}</span>
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
                @php
                $gambar = $pesanan->produk->foto ?? "0";
                if ($gambar == "0"){
                    $path = public_path('img/image_not_available.png');
                }
                else {
                    $path = public_path('img/produk/thumbnail/300x300/').$pesanan->produk->foto;
                    if (File::exists($path)) {

                    }
                    else{
                    $path = public_path('img/image_not_available.png');
                    }
                }
                @endphp
                <img class="img-fluid" src="{{$path}}" style="width: 50px; border-radius: 0.2em; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
              </span>
              <span style="width: 85%; margin-left: 1em; display: flex; align-items: center;">
                {{$pesanan->produk->nama}}
              </span>
            </div>
          </td>
          <td>
            <div style="display: -webkit-box;display: flex;-webkit-box-pack:space-between;  justify-content: space-between;">
              <div>Rp.</div> 
              <div>{{number_format($pesanan->harga_satuan, 0, '.', '.')}}</div>
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
          @if ($riwayat_nota->pengantaran == 'Diantarkan')
          <b>Diantarkan ke alamat</b><br>
          {{$riwayat_nota->penerima}} | {{$riwayat_nota->no_telp_penerima}}<br>
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
            <img src="{{public_path('katalog_assets/assets/img/logo/frozen_palu_red.png')}}" class="checkout-bank-transfer-item__icon" style="width: 2em; margin-right: 1em; width: 4em;">
          </div>
        </div>
        @else
        <b>Transfer melalui</b><br>
        <div style="display: -webkit-box;display: flex; margin-top: 0.5em;">
          <div class="checkout-bank-transfer-item__icon-container" style="width: 25%; margin-right: 0.5em;">
            <img src="{{public_path('bank/').$riwayat_nota->bank->img}}" class="checkout-bank-transfer-item__icon" style="width: 4em;">
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
       <div style="margin-right: 1em; margin-top: 0.5em;">{{$qrcode->size(80)->generate(url('/')."/cetak-nota/pesanan/".$riwayat_nota->id_pesanan)}}</div>
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
</body>
</html>
