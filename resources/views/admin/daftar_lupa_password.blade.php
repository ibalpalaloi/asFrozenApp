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
                              <th>No Hp</th>
                              <th>Waktu</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($user as $data)
                              <tr>
                                  <td>{{$data->user->biodata->nama}}</td>
                                  <td>{{$data->user->no_telp}}</td>
                                  <td>{{$data->created_at}}</td>
                                  <td>
                                    <button type="button" onclick="" class="btn btn-primary">Kirim password</button>
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

</script>
@endsection