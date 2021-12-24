@extends('layouts.admin')
@section('header')
<link rel="stylesheet" href="<?=url('/')?>/public/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
  ion-icon {
    font-size: 17px;
  }
</style>


@endsection
@section('body')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Pesanan Expired</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <br>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama Pemesan</th>
                <th>Alamat</th>
                <th>Pembayaran</th>
                <th>Pengantaran</th>
                <th>Time Expired</th>
                <th>Date Expired</th>
              </tr>
            </thead>
            <tbody id="tbody_daftar_pesanan_expired">
                @foreach ($data_nota as $data)
                    <tr>
                        <td>{{$data['nama_pemesan']}}</td>
                        <td>{{$data['alamat']}}</td>
                        <td>{{$data['pembayaran']}}</td>
                        <td>{{$data['pengantaran']}}</td>
                        <td>{{$data['time_expired']}}</td>
                        <td>{{$data['date_expired']}}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
          <br>
          <div class="d-flex justify-content-center">
              <button onclick="get_pesanan_expired()" class="w3-button w3-xlarge w3-circle w3-red">+</button>
          </div>
          
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer')
<script type="text/javascript">
    var page = 2;
    function get_pesanan_expired(){
        $.ajax({
            type: "get",
            url: "?page="+page,
            success:function(data){
                $('#tbody_daftar_pesanan_expired').append(data.view);
            }
        })
    }
</script>
@endsection