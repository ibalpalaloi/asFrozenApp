@extends('layouts.admin')

@section('body')

{{-- modal tambah kota --}}
<div class="modal fade" id="modal_tambah_kecamatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=url('/')?>/admin-post-kecamatan" method="post">
            @csrf
            <input type="text" name="kota_id" hidden value="{{$kota->id}}">
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Kota</label>
                  <input readonly type="text" class="form-control" id="kota" placeholder="Nama Kota" name="kota" value="{{$kota->kota}}">
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Kecamatan</label>
                  <input type="text" class="form-control" id="kota" placeholder="Nama Kecamatan" name="kecamatan">
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_kecamatan">Tambah Kecamatan</button>
                  <br><br>
                    <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Kota</th>
                              <th>Kecamatan</th>
                              <th>kelurahan</th>
                          </tr>
                      </thead>
                      <tbody>
                          @php
                              $no=1;
                          @endphp
                          @foreach ($kecamatan as $data)
                              <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$data->kota->kota}}</td>
                                  <td>{{$data->kecamatan}}</td>
                                  <td>{{count($data->kelurahan)}}</td>
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