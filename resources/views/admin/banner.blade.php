@extends('layouts.admin')

@section('header')
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<style>
  th, td {
    padding: 15px;
  }
</style>
@endsection

@section('body')
<div class="modal fade" id="modal_ubah_side" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="admin-banner-side-update" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Banner</label>
            <input name="banner" type="file" class="form-control" id="inputEmail3" placeholder="Masukan judul video" required>
            <input type="text" name="id" id="side_id" hidden>
          </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade" id="modal_tambah_banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="admin-banner-side-tambah" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Banner</label>
            <input name="banner" type="file" class="form-control" id="inputEmail3" placeholder="Masukan judul video" required>
          </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="{{url('/')}}/admin-banner-hapus" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div style="text-align: center;">
            <input type="text" name="id" id="hapus_id" hidden>
            <i class="fa fa-trash" style="font-size: 5em; color: #dc3545;"></i>
            <h4 style="margin-top: 0.5em;">Apakah anda yakin ingin menghapus data?</h4>
            <div style="margin-top: 0.5em;"></div>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary">Hapus</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" style=" background: #dc3545; border: 1px solid #dc3545;">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center" style="padding: 0;">
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  @php $i=0; @endphp
                  @foreach ($banner_main as $data)
                  <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" @if ($i == 0) class="active" @endif></li>
                  @php $i++; @endphp
                  @endforeach
                </ol>
                <div class="carousel-inner">
                  @php $i=0; @endphp
                  @foreach ($banner_main as $data)
                  <div class="carousel-item @if ($i == 0) active @endif">
                    <img src="<?=url('/')?>/banner/thumbnail/488x150/{{$data->foto}}" class="d-block w-100">
                  </div>
                  @php $i++; @endphp
                  @endforeach 
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
            <div class="col-lg-4" style="padding: 0px; padding-left: 0.2em;">
              @foreach ($banner_not_main as $data)
              <img src="<?=url('/')?>/banner/thumbnail/488x150/{{$data->foto}}" class="d-block w-100" alt="..." @if ($data->posisi == 'kanan-bawah') style="margin-top: 0.2em;" @endif>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><b>Banner</b></h3>
          <div class="card-tools">
            <div class="input-group input-group-sm">
              <div class="btn btn-success" onclick="tambah_banner()">Tambah Banner</div>
            </div>
          </div>          
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Program</th>
                <th>Posisi</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($banner_not_main as $data)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                  <img style="width: 300px;" src="<?=url('/')?>/banner/thumbnail/488x150/{{$data->foto}}" alt="...">
                </td>
                <td>{{$data->posisi}}</td>
                <td>
                  <button class="btn btn-info" onclick="ubah_banner_side('{{$data->id}}', '{{$data->posisi}}')">
                    <i class="fa fa-edit"></i>
                  </button>
                </td>
              </tr>
              @endforeach
              @foreach ($banner_main as $data)
              <tr>
                <td>{{$loop->iteration+2}}</td>
                <td>
                  <img style="width: 300px;" src="<?=url('/')?>/banner/thumbnail/488x150/{{$data->foto}}" alt="...">
                </td>
                <td>{{$data->posisi}}</td>
                <td>
                  <button class="btn btn-info" onclick="ubah_banner_side('{{$data->id}}')">
                    <i class="fa fa-edit"></i>
                  </button>
                  <button class="btn btn-danger" onclick="hapus_banner('{{$data->id}}')">
                    <i class="fa fa-trash"></i>
                  </button>
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
@endsection

@section('footer')
<script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

  function tambah_banner(){
    $("#modal_tambah_banner").modal('show');
  }

  function ubah_banner_side(id, posisi){
    $("#side_id").val(id);
    $("#modal_ubah_side").modal('show');
  }

  function hapus_banner(id){
    $("#hapus_id").val(id);
    $("#modal_hapus").modal('show');
  }

  function ubah_banner_main(id){
    $("#main_id").val(id);
    $("#modal_ubah_main").modal('show');
  }

</script>
@endsection