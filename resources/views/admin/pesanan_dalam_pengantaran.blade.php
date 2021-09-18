@extends('layouts.admin');
@section("body")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pesanan Dalam Pengantaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">31/8/2021</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="timeline">
                @foreach ($nota as $data)
                    <div>
                    <div class="timeline-item">
                        <span class="time" style="font-size: 15px"><i class="fas fa-clock"></i> 12:05</span>
                        <div class="timeline-header">
                            @if ($data->pembayaran == "COD")
                                <span class="right badge badge-warning" style="font-size: 16px">COD</span>
                            @else
                                <span class="right badge badge-success" style="font-size: 16px">COD</span>
                            @endif

                            @if ($data->pengantaran = "diantarkan")
                                <span class="right badge badge-warning" style="font-size: 16px">Diantarkan</span>
                            @else
                                <span class="right badge badge-success" style="font-size: 16px">Ambil Sendiri</span>
                            @endif
                        </div>
                        <div class="timeline-body row">
                        <div class="col-8">
                            <table class="table_pesanan">
                            <thead class="border_table">
                                <tr class="border_table">
                                <th class="border_table" scope="col">Produk</th>
                                <th class="border_table" scope="col">Jumlah</th>
                                <th class="border_table" scope="col">Harga satuan</th>
                                <th class="border_table" scope="col">total harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->pesanan as $pesanan)
                                <tr class="border_table">
                                    <td class="border_table">{{$pesanan->produk->nama}}</td>
                                    <td class="border_table">{{$pesanan->jumlah}}</td>
                                    <td class="border_table">{{$pesanan->harga_satuan}}</td>
                                    <td class="border_table">{{$pesanan->harga_satuan * $pesanan->jumlah}}</td>
                                </tr>
                                @endforeach
                                <tr style="font-weight: 700">
                                </tr>
                            </tbody>
                            </table>
                            <p style="padding-top: 20px; padding-left: 20px; padding-right: 20px"><b>*Note: </b> {{$data->catatan}}</p>
                        </div>
                        <div class="col-4">
                            <p style="font-weight: 700; margin-left: 10px; color: red">Waktu Konfirmasi : 13.00 Wita</p>
                            <table style="width: 100%" class="table">
                                <tr>
                                    <td style="width: 22%">Pemesan</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{$data->user->biodata->nama}}</td>
                                </tr>
                                <tr>
                                    <td>Penerima</td>
                                    <td>:</td>
                                    <td>{{$data->penerima}}</td>
                                </tr>
                                <tr>
                                    <td>alamat</td>
                                    <td>:</td>
                                    <td>{{$data->alamat.", ".$data->kota.", Kec.".$data->kecamatan.", Kel. ".$data->kelurahan." "}} <b>(Rp.{{$data->ongkos_kirim}})</b></td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                        </div>
                        <div class="timeline-footer">
                            <div class="text-right">
                                <h3 style="color: #ec1f25">Total Pesanan : Rp. {{$data->total_harga + $data->ongkos_kirim}}</h3>
                                <a href="/admin/pesanan-selesai/{{$data->id}}" class="btn btn-primary btn-sm" style="color: white">Pesanan Selesai</a>
                                <a class="btn btn-success btn-sm" style="color: white">Hubungi Pembeli</a>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach
            </div>
      </div><!-- /.container-fluid -->
    </div>
  </div>
    </div>
</div>

@endsection