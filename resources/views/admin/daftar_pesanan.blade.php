
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
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" style="display: flex; align-items: center; justify-content: space-between; width: 100%;;">
              <h3>Pesanan Hari ini</h3>
              <h4>{{tgl_indo(date('Y-m-d'))}}</h4>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No. </th>
                    <th>Penerima</th>
                    <th>Pesanan</th>
                    <th>Total Harga</th>
                    <th>Waktu Pesanan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="tbody_daftar_produk">
                  <script type="text/javascript">
                    var menit = [];
                    var detik = [];
                    var timeoutHandle = [];
                    var counter = [];
                    var id_pesanan = [];

                  </script>
                  @foreach ($nota as $data)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$data->penerima}} <small>({{$data->user->biodata->no_telp}})</small><br><small>ID Pesanan : {{$data->id_pesanan}}</small></td>
                    <td>{{$data->pesanan->sum('jumlah')}} Produk<br><small>{{$data->pengantaran}}</small></td>
                    <td>Rp. {{number_format($data->pesanan->sum('harga_satuan'), 0, ".", ".")}}<br>
                      <small>
                        @if ($data->pembayaran == 'COD')
                        {{$data->pembayaran}}
                        @else
                        Transfer {{$data->bank->nama_bank ?? ""}}
                        @endif
                      </small>
                    </td>
                    <td> 
                      <div style="display: flex;justify-content: space-between;">
                        <div>
                          <i class="fa fa-clock"></i>&nbsp;{{date('H:i', strtotime($data->created_at))}}  
                        </div>
                        <div style="display: flex; align-items: center;">
                          <?php
                          if ($data->time_status == 'run'){

                            $time_left = "";
                            $date_now = date('Y-m-d');
                            $time_date = date('Y-m-d', strtotime($data->time_date));
                            if (strtotime($date_now) > strtotime($time_date)){ ?>
                              <badge class="badge badge-danger">Expired</badge>
                            <?php }
                            else {
                              $time_now = date('H:i:s');
                              $time_expired = date('H:i:s', strtotime($data->time_expired));
                              if (strtotime($time_now) > strtotime($time_expired)){?>
                                <badge class="badge badge-danger">Expired</badge>
                              <?php }
                              else {
                                $text_a = $time_date." ".$time_expired;
                                $text_b = $date_now." ".$time_now;

                                $date_a = new DateTime($text_a);
                                $date_b = new DateTime($text_b);

                                $interval = date_diff($date_a,$date_b);

                                $str_time_left = (strtotime($time_expired)-strtotime($time_now)) / 60;
                                $time_left = $interval->format('%i:%s'); ?>
                                <h4  id="countdown_{{$data->id}}" style="color: red">{{$time_left}}</h4>
                                <h4  id="pause_countdown_{{$data->id}}" style="color: red" hidden>{{$time_left}}</h4>
                                <div class="badge badge-warning" id="btn_pause_{{$data->id}}" onclick='control_time("{{$data->id}}", "pause")' style="margin-left: 0.5em; margin-bottom: 0.5em;">
                                  <i class="fas fa-pause" style="font-size: 0.8em;"></i>&nbsp;&nbsp;Pause
                                </div>
                                <div class="badge badge-success" id="btn_play_{{$data->id}}" onclick='control_time("{{$data->id}}", "start")' style="margin-left: 0.5em; margin-bottom: 0.5em;" hidden>
                                  <i class="fas fa-play" style="font-size: 0.8em;"></i>&nbsp;&nbsp;Start
                                </div>
                                <script type="text/javascript">
                                  <?php
                                  $time = explode(":", $time_left);
                                  ?>
                                  menit[{{$loop->iteration}}] = "{{$time[0]}}";
                                  detik[{{$loop->iteration}}] = "{{$time[1]}}";
                                  id_pesanan[{{$loop->iteration}}] = "{{$data->id}}";
                                  countdown(menit[{{$loop->iteration}}], detik[{{$loop->iteration}}], "{{$loop->iteration}}");

                                  function countdown(minutes, seconds, loop) {
                                    function tick(){
                                      counter[loop] = document.getElementById("countdown_"+id_pesanan[loop]);
                                      counter[loop].innerHTML = minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
                                      seconds--;
                                      if (seconds >= 0) {
                                        timeoutHandle[loop] = setTimeout(tick, 1000);

                                      } 
                                      else {
                                        if (minutes >= 1) {
                                          setTimeout(function () {countdown(minutes - 1, 59, loop);}, 1000);
                                        }
                                      }
                                    }
                                    tick();
                                  }
                                </script>
                              <?php }
                            }
                          }
                          else {
                            ?>

                            <h4  id="countdown_{{$data->id}}" style="color: red"></h4>
                            <h4  id="pause_countdown_{{$data->id}}" style="color: red">{{date('i:s', strtotime($data->time_left))}}</h4>
                            <div class="badge badge-warning" id="btn_pause_{{$data->id}}" onclick='control_time("{{$data->id}}", "pause")' style="margin-left: 0.5em; margin-bottom: 0.5em;" hidden>
                              <i class="fas fa-pause" style="font-size: 0.8em;"></i>&nbsp;&nbsp;Pause
                            </div>
                            <div class="badge badge-success" id="btn_play_{{$data->id}}" onclick='control_time("{{$data->id}}", "start")' style="margin-left: 0.5em; margin-bottom: 0.5em;">
                              <i class="fas fa-play" style="font-size: 0.8em;"></i>&nbsp;&nbsp;Start
                            </div>
                          <?php } ?>
                        </div>
                      </div>                    
                    </td>
                    <td>
                      <a href="<?=url('/')?>/admin/daftar-pesanan/{{$data->id}}" class="btn btn-primary">
                        Cek Pesanan
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
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
<script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

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
</script>
@include('script.daftar_pesanan_script')
@endsection