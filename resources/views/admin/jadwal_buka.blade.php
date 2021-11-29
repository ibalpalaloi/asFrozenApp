@extends('layouts.admin')

@section('header')
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/katalog_assets/assets/vendor/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/katalog_assets/assets/vendor/slick/slick-theme.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=url('/')?>/public/AdminLTE/plugins/retro-plugins/css/flip-clock.css" />
<style type="text/css">
  .slick-track {
    float: left;
  }

  .foo { padding-left: 0; }
  .foo li {
    float: left;
    display: inline-block;
    width: 25%;
  }   

  .slick-slide  {
  }
  .slick-prev:before {
    color: black;
  }
  .slick-next:before {
    color: black;
  }
  a:hover {
    text-decoration: none;      
  }

</style>
@endsection

@section('body')

{{-- modal --}}

<div id="modal_ubah_jadwal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
            <form action="<?=url('/')?>/admin-ubah-jadwal" method="post">
                @csrf
                <div class="form-group">
                  <input type="text" name="hari" class="form-control" id="hari" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Jam Buka</label>
                    <input type="text" name="jam_buka" class="form-control" id="jam_buka" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Jam Tutup</label>
                    <input type="text" name="jam_tutup" class="form-control" id="jam_tutup" placeholder="">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Keterangan</label>
                  <select name="keterangan" class="form-control" id="keterangan">
                    <option value="buka">Buka</option>
                    <option value="tutup">Tutup</option>
                  </select>
                </div>
                <br><button class="btn btn-primary">Simpan</button>
            </form>

        </div>
      </div>
    </div>
  </div>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam Buka</th>
                                <th>Jam Tutup</th>
                                <th>Ket</th>
                                <th></th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $data)
                                <tr>
                                    <td>{{$data->hari}}</td>
                                    <td>{{$data->waktu_buka}}</td>
                                    <td>{{$data->waktu_tutup}}</td>
                                    <td>{{$data->keterangan}}</td>
                                    <td>
                                        <button onclick="modal_ubah_jadwal('{{$data->id}}')" class="btn btn-primary">ubah</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @section('footer')
  <script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
  <link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
  <script>

      function modal_ubah_jadwal(id){
          
          $.ajax({
              type: "get",
              url: '<?=url('/')?>/admin-get-jadwal-buka/'+id,
              success:function(data){
                  console.log(data);
                  var jadwal = data.jadwal;
                  $('#hari').val(jadwal['hari']);
                  $('#jam_buka').val(jadwal['waktu_buka']);
                  $('#jam_tutup').val(jadwal['waktu_tutup']);
                  $('#modal_ubah_jadwal').modal('show');
              }
          })
      }
  </script>

  @endsection