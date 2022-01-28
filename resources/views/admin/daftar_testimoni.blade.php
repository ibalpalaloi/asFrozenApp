@extends('layouts.admin')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection

@section('body')
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
                              <th>Testimoni</th>
                              <th>Waktu</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($data_testimoni as $data)
                              <tr>
                                  <td>{{$data['nama_user']}}</td>
                                  <td>{{$data['testimoni']}}</td>
                                  <td>{{$data['waktu']}}</td>
                                  <td>
                                    <button type="button" onclick="hapus_testimoni('{{$data['id_testimoni']}}')" class="btn btn-danger">Hapus</button>
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
    $(document).ready(function() {
        $('#example1').DataTable();
    } );

    function hapus_testimoni(id){
        swal({
            title: "Are you sure?",
            text: "Ingin menghapus testimoni ini",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location.href = "<?=url('/')?>/admin-testimoni-delete/"+id;
            }
        });
    }
</script>
@endsection