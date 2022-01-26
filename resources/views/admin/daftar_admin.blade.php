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


<!-- Modal tambah admin-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="<?=url('/')?>/post-admin-baru" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No Telp</label>
                    <input type="text" name="no_telp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Role</label>
                    <select name="role" class="form-control" id="exampleFormControlSelect1">
                      <option value="admin">Admin</option>
                      <option value="super admin">Super Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
            
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- Modal ubah admin-->
<div class="modal fade" id="modal_ubah_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="<?=url('/')?>/post-ubah-admin" method="post">
                @csrf
                <input type="text" name="id_user" id="ubah_id_user" hidden>
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" class="form-control" id="ubah_username" aria-describedby="emailHelp" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" name="email" class="form-control" id="ubah_email" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No Telp</label>
                    <input type="text" name="no_telp" class="form-control" id="ubah_no_telp" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
            
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="card">
          @if (\Session::has('success'))
            <div class="alert alert-success" role="alert">
                {!! \Session::get('success') !!}
            </div>
          @endif

          @if (\Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {!! \Session::get('error') !!}
            </div>
          @endif
        
        <div class="card-header">
          <h3 class="card-title">Daftar Admin</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Admin
            </button>
            <br><br>
          <br>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Username</th>
                <th>Role</th>
                <th>email</th>
                <th>No_hp</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="tbody_daftar_produk">
                @foreach ($user as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->role}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->no_telp}}</td>
                        <td>
                            <button onclick="modal_ubah_admin('{{$data->id}}')" class="btn btn-warning">Edit</button>
                            <a href="<?=url('/')?>/admin-hapus-admin/{{$data->id}}" class="btn btn-danger">hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
<script>
    function modal_ubah_admin(id){
        $.ajax({
            type: "get",
            url: "<?=url('/')?>/admin-get-data-admin/"+id,
            success:function(data){
                var user = data.user;
                $('#ubah_id_user').val(user['id']);
                $('#ubah_username').val(user['name']);
                $('#ubah_email').val(user['email']);
                $('#ubah_no_telp').val(user['no_telp']);

                $('#modal_ubah_user').modal('show');
                console.log(data);
            }
        })
    }
</script>
@endsection