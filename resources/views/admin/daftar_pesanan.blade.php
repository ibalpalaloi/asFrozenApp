
@extends("layouts.admin")

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<style>
  ion-icon {
    font-size: 17px;
  }
</style>
@endsection

@section("body")

{{-- modal --}}
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
{{--  --}}


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pesanan Hari ini</h1>
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
            {{--  --}}
            @foreach ($nota as $data)

            <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                      <span class="time" style="font-size: 15px">ID: {{$data->id_pesanan}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-clock"></i> 12:05</span>
      
                      <p></p>
                      <div class="timeline-header">
                          <h3  id="countdown" style="font-size: 30px; color: red">10.00</h3>
                      
                      </div>
                      <div class="timeline-body row">
                          <div class="col-8">
                            <button onclick="show_modal_tambah_pesanan('{{$data->id}}');" class="btn btn-warning">tambah pesanan</button>
                            <br><br>
                              <table class="table_pesanan">
                              <thead class="border_table">
                                  <tr class="border_table">
                                  <th class="border_table" scope="col">Produk</th>
                                  <th class="border_table" scope="col">Jumlah</th>
                                  <th class="border_table" scope="col">Harga satuan</th>
                                  <th class="border_table" scope="col">total harga</th>
                                  <th class="border_table" scope="col"></th>
                                  </tr>
                              </thead>
                              <tbody id="tbody_daftar_pesanan_{{$data->id}}">
                                  @foreach ($data->pesanan as $pesanan)
                                      <tr class="border_table" id="row_{{$pesanan->id}}">
                                          <td class="border_table">{{$pesanan->produk->nama}}</td>
                                          <td class="border_table">{{$pesanan->jumlah}}</td>
                                          <td class="border_table">{{$pesanan->harga_satuan}}</td>
                                          <td class="border_table">{{$pesanan->harga_satuan * $pesanan->jumlah}}</td>
                                          <td class="border_table">
                                            <button onclick="hapus_pesanan('{{$pesanan->id}}')" class="btn btn-danger"></button>
                                          </td>
                                      </tr>
                                  @endforeach
                                  <tr style="font-weight: 700">
                                  </tr>
                              </tbody>
                              </table>
                              <p style="padding-top: 20px; padding-left: 20px; padding-right: 20px"><b>*Note: </b> {{$data->catatan}}</p>
                          </div>
                          <div class="col-4">
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
                                <td>Kontak</td>
                                <td>:</td>
                                <td><b>{{$data->user->biodata->no_telp}}</b></td>
                              </tr>
                              <tr>
                                  <td>alamat</td>
                                  <td>:</td>
                                  <td>{{$data->alamat.", ".$data->kota.", Kec.".$data->kecamatan.", Kel. ".$data->kelurahan." "}} <b>(Rp.{{$data->ongkos_kirim}})</b></td>
                              </tr>
                              <tr>
                                  <td>Pembayaran</td>
                                  <td>:</td>
                                  <td>
                                      @if ($data->pembayaran == "COD")
                                          <span class="right badge badge-warning" style="font-size: 16px">COD</span>
                                      @else
                                          <span class="right badge badge-success" style="font-size: 16px">Tranfer</span>
                                      @endif
                                  
                                  </td>
                              </tr>
                              <tr>
                                  <td>Pengantaran</td>
                                  <td>:</td>
                                  <td>
                                      @if ($data->pengantarn == "Diantarkan")
                                          <span class="right badge badge-warning" style="font-size: 16px">Diantarkan</span> 
                                      @else
                                          <span class="right badge badge-success" style="font-size: 16px">Ambil Sendiri</span> 
                                      @endif
                                  
                                  </td>
                              </tr>
                              </table>
                              <hr>
                          </div>
                      </div>
                      <div class="timeline-footer">
                      <h3 style="color: #ec1f25" id="total_pesanan_{{$data->id}}">Total Pesanan : Rp. {{$data->pesanan->sum('harga_satuan')+ $data->ongkos_kirim}}</h3>
                      <a href="/admin/ubah_status_pesanan/{{$data->id}}/packaging" class="btn btn-primary btn-sm">Terima Pesanan</a>
                      <a class="btn btn-success btn-sm" >Hubungi Pembeli</a>
                      <a class="btn btn-danger btn-sm" >Batalkan Pesanan</a>
                      </div>
                </div>
              </div>
                
            @endforeach
            
            {{--  --}}
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection

@section('footer')
  @include('script.daftar_pesanan_script')
@endsection