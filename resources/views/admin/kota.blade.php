@extends('layouts.admin')

@section('body')

{{-- modal tambah kota --}}
<div class="modal fade" id="modal_tambah_kota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=url('/')?>/admin-post-kota" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Kota</label>
                  <input type="text" class="form-control" id="kota" placeholder="Nama Kota" name="kota">
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
{{-- end --}}


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_kota">Tambah Kota</button>
                <br><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="50%">Kota</th>
                            <th>Jumlah Kecamatan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($kota as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->kota}}</td>
                                <td>{{count($data->kecamatan)}}</td>
                                <td>
                                    <a href="<?=url('/')?>/admin-kecamatan/{{$data->id}}" class="btn btn-primary btn-sm">Kecamatan</a>
                                    <a href="" class="btn btn-warning btn-sm">Ubah</a>
                                    <a href="" class="btn btn-danger btn-sm">Hapus</a>
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