@extends('layouts.admin')

@section('header')
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick-theme.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=url('/')?>/AdminLTE/plugins/retro-plugins/css/flip-clock.css" />
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Tanggal Tutup</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/post-tambah-tgl-tutup" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputPassword1">tgl Tutup</label>
                <div class="input-group date" id="tgl_mulai" data-target-input="nearest">
                    <input type="text" id="input_tgl_mulai" name="tgl_tutup" class="form-control datetimepicker-input" data-target="#tgl_mulai"/>
                    <div class="input-group-append" data-target="#tgl_mulai" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Keterangan Tutup</label>
                <textarea name="keterangan" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <br>
            <button class="btn btn-primary">Simpan</button>
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Tanggal Tutup</button>
                    <br>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tgl tutup</th>
                                <th>Keterangan</th>
                                <th></th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            @foreach ($data_jadwal as $data)
                                <tr>
                                    <td>{{$data['tgl']}}</td>
                                    <td>{{$data['ket']}}</td>
                                    <td>
                                        <a href="/admin-hapus-jadwal-tutup/{{$data['id']}}" class="btn btn-danger">Hapus</a>
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
  <script>
        $('#tgl_mulai').datetimepicker({
            format: 'L',
            format: 'YYYY-MM-DD'
        });
  </script>

  @endsection