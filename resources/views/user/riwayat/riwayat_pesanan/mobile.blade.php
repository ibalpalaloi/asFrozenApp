@extends("layouts.home_mobile")

@section('title-header')
Pesanan
@endsection

@section('content')
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Pemesan</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nama Pemesan" value="Iqbal">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Penerima</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nama Penerima" value="Fathul">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kota</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Palu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kecamatan</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Palu Barat</option>
                            <option>Palu Timur</option>
                            <option>Palu Selatan</option>
                            <option>Palu Utara</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Keluarahan</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Kabonena</option>
                            <option>Tipo</option>
                            <option>Donggala Kodi</option>
                            <option>Silae</option>
                        </select>
                    </div>
                </form>
                <div class="row" style="font-weight: 700">
                    <div class="col">Total pesanan</div>
                    <div class="col text-right">Rp. 50.000</div>
                </div>
                <div class="row" style="font-weight: 700">
                    <div class="col">Ongkos Kirim</div>
                    <div class="col text-right">Rp. 7.000</div>
                </div>
            </div>
            <br>
            <div class="modal-footer justify-content-between" style="font-weight: 700">
                <div style="font-size: 28px">
                    Total : Rp. 67.000
                </div>
                <div>
                    <button type="button" class="btn btn-danger">Pesan</button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ======= Hero Section ======= -->
@php
$produk = ['Bakso Ikan', 'Fiesta chicken Nugget', 'Kulit Kebab'];
$harga = ['20.000', '30.000', '12.000'];
$jumlah = ['2', '3', '2'];
$total_harga = ['40.000', '90.000', '24.000'];
$status_pesanan = "packaging";
// status_pesanan = ['menunggu konfirmasi', 'packaging', 'telah diantarakan']
@endphp
<section id="" class="d-flex align-items-center" style="background: none; margin-top: 3em;">
    <div class="container" style="padding-top: 40px;" >
        <div class="card shadow p-3 mb-5 bg-white rounded">
            <div tabindex="0" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide11">
                <div style="padding: 20px">
                    <table id="example1" class="table table-bordered" >
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat_nota as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td scope="row">
                                    <a href="{{url()->current()}}/{{$data['id_pesanan']}}" style="color: black;">
                                        {{tgl_indo(date('Y-m-d', strtotime($data['waktu_pemesanan'])))}} &nbsp;
                                        {{date('H:i', strtotime($data['waktu_pemesanan']))}}</<br>
                                        <i>{{$data['id_pesanan']}}</i><br>
                                        <div style="margin-top: 0.5em;">
                                            Rp. {{number_format($data->total_harga,0,',','.')}} - <small>{{$data->bank->nama_bank ?? "COD"}} - {{$data->pengantaran}}</small>
                                            <br>{{$data->riwayat_pesanan->count()}} Produk
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('footer-scripts')
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
<script>
    function modal_pesan(){
        $('#exampleModal').modal('show');
    }

    function hubungi_penjual(){
        var message = "Hallo AsFrozen saya telah memesan produk dengan link ID_pesanan=1880148014";

        var walink = 'https://wa.me/'+ "+628114588477" +'?text=' + encodeURI(message);
        window.open(walink);
    }
</script>
@endsection