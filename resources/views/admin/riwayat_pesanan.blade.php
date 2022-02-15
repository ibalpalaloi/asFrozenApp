@extends('layouts.admin')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<style>
    .btn-default {
        font-family: Raleway-SemiBold;
        font-size: 13px;
        color: rgba(108, 88, 179, 0.75);
        letter-spacing: 1px;
        line-height: 15px;
        border: 2px solid rgba(108, 89, 179, 0.75);
        border-radius: 40px;
        background: transparent;
        transition: all 0.3s ease 0s;
        }
</style>
@endsection

@section('body')
<?php
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

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="card">
              <div class="card-header">
                <div class="col-sm-6"><h1>Riwayat Pesanan</h1></div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered" >
                    <thead>
                        <tr>
                            <th scope="col">ID Pesanan</th>
                            <th scope="col">Tanggal Pesanan</th>
                            <th scope="col">Total Pesanan</th>
                            <th scope="col">Transaksi</th>
                            <th scope="col">Admin</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_riwayat_pesanan">
                        @foreach ($data_nota as $data)
                        <tr>
                            <td scope="row">
                                <a href="{{url()->current()}}/{{$data['id_pesanan']}}" style="color: black;">
                                    {{$data['id_pesanan']}}
                                </a>
                            </td>
                            <td>{{tgl_indo(date('Y-m-d', strtotime($data['waktu_pemesanan'])))}} [{{date('H:i', strtotime($data['waktu_pemesanan']))}}]</td>
                            <td>Rp. {{number_format($data['total_pemesanan'],0,',','.')}}</td>
                            <td>
                                @if ($data['pembayaran'] == "COD")
                                <button type="button" class="btn btn-warning btn-sm">COD</button>
                                @else
                                <button type="button" class="btn btn-success btn-sm">Transfer</button>
                                @endif

                                @if ($data['pengantaran'] == "Diantarkan")
                                <button type="button" class="btn btn-warning btn-sm">Diantarkan</button>
                                @else
                                <button type="button" class="btn btn-success btn-sm">Ambil Sendiri</button>
                                @endif
                            </td>
                            <td>{{$data['admin']}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <br>
                <div class="d-flex justify-content-center">
                    <button onclick="load_more()" type="button" class="btn btn-default">Load More</button>
                </div>
                
            </div>

        </div>

    </div>
</div>
</div>
@endsection

@section('footer')
<script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
  });
});
    var page =2;

    function detail_pesanan(id_pesanan){
        alert(id_pesanan);
        $.ajax({
            type: "get",
            url: "<?=url('/')?>/admin/get_riwayat_pesanan/"+id_pesanan,
            success:function(data){
                console.log(data);
                $("#content_modal_detail").html(data.html);
                $('#modal_detail_pesanan').modal('show');
            }
        })
    }

    function load_more(){
        $.ajax({
            type: "GET",
            url: "?page="+page,
            success:function(data){
                $('#tbody_riwayat_pesanan').append(data.html);
                page++;
            }
        })
    }
</script>
@endsection