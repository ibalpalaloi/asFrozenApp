@extends('layouts.admin')
@section('header')
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
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

@endsection
@section('body')
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Bank
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 1em; position: absolute;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url()->current()}}/store" method="post" enctype='multipart/form-data'>
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Nama Bank</label>
            <input name="nama_bank" type="text" class="form-control" placeholder="Masukan nama bank" required>
          </div> 
          <div class="form-group">
            <label>Nomor Rekening</label>
            <input name="nomor_rekening" type="text" class="form-control" placeholder="Masukan nomor rekening" required>
          </div> 
          <div class="form-group">
            <label>Logo Bank</label>
            <input name="logo_bank" type="file" class="form-control" placeholder="Masukan logo bank" required>
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


<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Bank</h3>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <div class="btn btn-success" onclick="tambah()">Tambah Bank</div>
            </div>
          </div>
        </div>
        <div class="card-body p-3">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Bank</th>
                <th>Nomor Rekening</th>
                <th>Logo Bank</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($bank as $row)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row->nama_bank}}</td>
                <td>{{$row->nomor_rekening}}</td>
                <td>
                  <img src="<?=url('/')?>/public/bank/{{$row->img}}" style="width: 50px;"></td>
                <td></td>
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
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
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
</script>

@endsection