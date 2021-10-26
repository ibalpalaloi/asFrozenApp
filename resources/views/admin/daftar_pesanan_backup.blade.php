
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
            <script type="text/javascript">
              var menit = [];
              var detik = [];
              var timeoutHandle = [];
              
            </script>
            @foreach ($nota as $data)

            <div id="div_card{{$data->id}}">
              <i class="fas fa-envelope bg-blue"></i>
              <div class="timeline-item">
                <div class="timeline-header" style="display: flex; justify-content: space-between;">
                  <div style="display: flex; align-items: flex-start;">
                    @php
                    $time_left = "";
                    $date_now = date('Y-m-d');
                    $time_date = date('Y-m-d', strtotime($data->time_date));
                    @endphp
                    @if (strtotime($date_now) > strtotime($time_date))
                    Expired
                    @else
                    @php
                    $time_now = date('H:i:s');
                    $time_expired = date('H:i:s', strtotime($data->time_expired));
                    @endphp
                    @if (strtotime($time_now) > strtotime($time_expired))
                    Expired
                    @else
                    @php
                    $text_a = $time_date." ".$time_expired;
                    $text_b = $date_now." ".$time_now;

                    $date_a = new DateTime($text_a);
                    $date_b = new DateTime($text_b);

                    $interval = date_diff($date_a,$date_b);

                    $str_time_left = (strtotime($time_expired)-strtotime($time_now)) / 60;
                    $time_left = $interval->format('%i:%s');
                    @endphp
                    <h4  id="countdown_{{$data->id_pesanan}}" style="color: red">{{$time_left}}</h4>
                    <div class="btn btn-primary" style="padding: 0px 10px 3px 10px; margin-left: 0.5em;">Pause</div>
                    <script type="text/javascript">
                      <?php
                      $time = explode(":", $time_left);
                      ?>
                      menit[{{$loop->iteration}}] = "{{$time[0]}}";
                      detik[{{$loop->iteration}}] = "{{$time[1]}}";
                      // countdown(menit, detik);

                      timeoutHandle[{{$loop->iteration}}];
                      function tick() {
                        var counter = document.getElementById("countdown_{{$data->id_pesanan}}");
                        counter.innerHTML = menit[{{$loop->iteration}}].toString() + ":" + (detik[{{$loop->iteration}}] < 10 ? "0" : "") + String(detik[{{$loop->iteration}}]);
                        detik[{{$loop->iteration}}]--;
                        if (detik[{{$loop->iteration}}] >= 0) {
                          timeoutHandle[{{$loop->iteration}}] = setTimeout(tick, 1000);
                        } else {
                          if (menit[{{$loop->iteration}}] >= 1) {
                            setTimeout(function () {
                              countdown(detik[{{$loop->iteration}}] - 1, 59);
                            }, 1000);
                          }
                        }
                      }
                      tick();
                    </script>
                    @endif
                    @endif
                  </div>
                  <div style="display: flex; align-items: center;">
                    <span class="time" style="font-size: 15px">ID: {{$data->id_pesanan}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <i class="fas fa-clock"></i> 12:05</span>

                    </div>

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
                          @php
                          $total_harga = 0;
                          @endphp
                          @foreach ($data->pesanan as $pesanan)
                          @php
                          $total_harga += $pesanan->jumlah * $pesanan->harga_satuan;
                          @endphp
                          <tr class="border_table" id="row_{{$pesanan->id}}">
                            <td class="border_table">{{$pesanan->produk->nama}}</td>
                            <td class="border_table">{{$pesanan->jumlah}}</td>
                            <td class="border_table">{{$pesanan->harga_satuan}}</td>
                            <td class="border_table">{{$pesanan->harga_satuan * $pesanan->jumlah}}</td>
                            <td class="border_table">
                              <button onclick="hapus_pesanan('{{$pesanan->id}}', '{{$data->id}}')" class="btn btn-danger"></button>
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
                    <h3 style="color: #ec1f25" id="total_pesanan_{{$data->id}}">Total Pesanan : Rp. {{$total_harga + $data->ongkos_kirim}}</h3>
                    <a href="/admin/ubah_status_pesanan/{{$data->id}}/packaging" class="btn btn-primary btn-sm">Terima Pesanan</a>
                    <a class="btn btn-success btn-sm" onclick="hubungi_pesanan('{{$data->id_pesanan}}')">Hubungi Pembeli</a>
                    <a class="btn btn-danger btn-sm" onclick="batalkan_pesanan('{{$data->id}}')" >Batalkan Pesanan</a>
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