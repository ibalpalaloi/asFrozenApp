@extends('layouts.admin')

@section('body')

{{-- modal tambah kota --}}
<div class="modal fade" id="modal_ubah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=url('/')?>/admin-post-ubah-data-toko" method="post">
            @csrf
            <input type="text" id="ubah_id" name="id" hidden>
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Keterangan</label>
                  <input type="text" class="form-control" id="ubah_keterangan" placeholder="Nama Kota" name="keterangan" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nilai</label>
                    <input type="text" class="form-control" id="ubah_nilai" placeholder="Nama Kota" name="nilai">
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
                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_kota">Data Toko</button> --}}
                <br><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="50%">Keterangan</th>
                            <th>Nilai</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($data as $data_toko)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data_toko->keterangan}}</td>
                                <td>{{$data_toko->nilai}}</td>
                                <td>
                                    <button onclick="modal_ubah('{{$data_toko->id}}', '{{$data_toko->keterangan}}', '{{$data_toko->nilai}}')" type="button" class="btn btn-warning btn-sm">Ubah</button>
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
            $('#ubah_keterangan').val(keterangan)
            $('#ubah_nilai').val(nilai)
            $('#modal_ubah_data').modal('show');
        }
    </script>
@endsection