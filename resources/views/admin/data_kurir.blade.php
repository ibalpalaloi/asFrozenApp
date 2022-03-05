@extends('layouts.admin')

@section('body')

{{-- modal tamba --}}
<div class="modal fade" id="modal_tambah_kurir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kurir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=url('/')?>/admin-post-kurir" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama</label>
                  <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">No Telp</label>
                    <input type="text" class="form-control" placeholder="No Telp" name="no_telp" required>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
{{-- end --}}

{{-- modal Ubah --}}
<div class="modal fade" id="modal_ubah_kurir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Kurir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=url('/')?>/admin-post-ubah-kurir" method="post">
            @csrf
            <input type="text" id="ubah_id" name="id" hidden>
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama</label>
                  <input type="text" class="form-control" id="ubah_nama" placeholder="Nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">No Telp</label>
                    <input type="text" class="form-control" id="ubah_no_telp" placeholder="No Telp" name="no_telp" required>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
{{-- end --}}


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_kurir">Data Kurir</button>
                <br><br>
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="50%">Nama</th>
                            <th>No Telp</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($kurir as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->no_telp}}</td>
                                <td>
                                    <button onclick="modal_ubah('{{$data->id}}', '{{$data->nama}}', '{{$data->no_telp}}')" type="button" class="btn btn-warning btn-sm">Ubah</button>
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
    <script>
        function modal_ubah(id, keterangan, nilai){
            $('#ubah_id').val(id)
            $('#ubah_nama').val(keterangan)
            $('#ubah_no_telp').val(nilai)
            $('#modal_ubah_kurir').modal('show');
        }
    </script>
@endsection