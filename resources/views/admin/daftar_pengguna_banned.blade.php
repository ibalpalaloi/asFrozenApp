@extends('layouts.admin')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection

@section('body')

{{-- modal ubah pengguna --}}
<!-- Modal -->
<div class="modal fade" id="modal_ubah_pengguna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="<?=url('/')?>/admin-daftar-pengguna/post-ubah-pengguna" method="post">
                @csrf
                <input type="text" name="id_user" id="ubah_id_user" hidden>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input name="nama" readonly type="text" class="form-control" id="ubah_nama" aria-describedby="emailHelp">
                    
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No Telp</label>
                    <input autocomplete="off" type="text" name="no_telp" class="form-control" id="ubah_no_telp" aria-describedby="emailHelp">
                    
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input autocomplete="off" type="email" name="email" class="form-control" id="ubah_email" aria-describedby="emailHelp">
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password Baru</label>
                  <input autocomplete="off" type="text" name="password" class="form-control" id="ubah_password" placeholder="Password">
                </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
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
                  <br><br>
                    <table id="example1" class="table">
                      <thead>
                          <tr>
                              <th>Nama</th>
                              <th>No Telp</th>
                              <th>Email</th>
                              <th>Alamat</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($data_user as $data)
                              <tr id="tr_data_pengguna{{$data['id_user']}}">
                                  <td>{{$data['nama']}}</td>
                                  <td>{{$data['no_telp']}}</td>
                                  <td>{{$data['email']}}</td>
                                  <td>{{$data['alamat']}}</td>
                                  <td>
                                    <button onclick="banned_pengguna('{{$data['id_user']}}')" type="button" class="btn btn-warning btn-sm">Hapus Banned</button>
                                    <button onclick="hapus_pengguna('{{$data['id_user']}}')" type="button" class="btn btn-danger btn-sm">Hapus</button>
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function banned_pengguna(id_user){
        swal("Yakin Ingin Hapus Banned Pengguna ini??.")
        .then((value) => {
            ajax_banned_pengguna(id_user);
        });
    }

    function ajax_banned_pengguna(id_user){
        $.ajax({
            type: "GET",
            url: "<?=url('/')?>/admin-daftar-pengguna/banned/"+id_user,
            success:function(data){
                $('#tr_data_pengguna'+id_user).remove();
            }
        })
    }

    function hapus_pengguna(id_user){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                ajax_hapus_pengguna(id_user);
            } else {
                swal.close()
            }
        });
    }

    function ajax_hapus_pengguna(id_user){
        $.ajax({
            type: "GET",
            url: "<?=url('/')?>/admin-daftar-pengguna/hapus/"+id_user,
            success:function(data){
                $('#tr_data_pengguna'+id_user).remove();
            }
        })
    }
</script>
@endsection