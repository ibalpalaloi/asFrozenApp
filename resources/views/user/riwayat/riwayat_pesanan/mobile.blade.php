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
<style type="text/css">
    <style type="text/css">
    td {
        font-size: 0.8em !important;
    }

    .testimonials .testimonial-item {
        box-sizing: content-box;
        text-align: center;
        min-height: 0em;
        margin-bottom: 2em;
    }

    .testimonials .testimonial-item .testimonial-img {
        width: 90px;
        border-radius: 50%;
        margin: 0 auto;
    }

    .testimonials .testimonial-item h3 {
        font-size: 18px;
        font-weight: bold;
        margin: 10px 0 5px 0;
        color: #111;
    }

    .testimonials .testimonial-item h4 {
        font-size: 14px;
        color: #999;
        margin: 0;
    }

    .testimonials .testimonial-item .quote-icon-left, .testimonials .testimonial-item .quote-icon-right {
        color: #c9e3f5;
        font-size: 26px;
    }

    .testimonials .testimonial-item .quote-icon-left {
        display: inline-block;
        left: -5px;
        position: relative;
    }

    .testimonials .testimonial-item .quote-icon-right {
        display: inline-block;
        right: -5px;
        position: relative;
        top: 10px;
    }

    .testimonials .testimonial-item p {
        font-style: italic;
        margin: 0 15px 15px 15px;
        padding: 20px;
        background: #f3f9fd;
        position: relative;
        margin-bottom: 35px;
        border-radius: 6px;
    }

    .testimonials .testimonial-item p::after {
        content: "";
        width: 0;
        height: 0;
        border-top: 20px solid #f3f9fd;
        border-right: 20px solid transparent;
        border-left: 20px solid transparent;
        position: absolute;
        bottom: -20px;
        left: calc(50% - 20px);
    }

    .testimonials .owl-nav, .testimonials .owl-dots {
        margin-top: 5px;
        text-align: center;
    }

    .testimonials .owl-dot {
        display: inline-block;
        margin: 0 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #ddd !important;
    }

    .testimonials .owl-dot.active {
        background-color: #2487ce !important;
    }

    @media (max-width: 767px) {
        .testimonials {
            margin: 30px 10px;
        }
    }
</style>

</style>
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
        @if ($riwayat->count() > 0)


        <div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{url('/')}}/testimoni/delete" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div style="text-align: center;">
                                <input type="text" name="id" id="hapus_id" hidden>
                                <i class="fa fa-trash" style="font-size: 5em; color: #dc3545;"></i>
                                <h4 style="margin-top: 0.5em;">Apakah anda yakin ingin menghapus data?</h4>
                                <div style="margin-top: 0.5em;"></div>
                            </div>  
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary">Hapus</button>
                            <button type="button" class="btn btn-primary" onclick="tutup_modal()" data-dismiss="modal" style=" background: #dc3545; border: 1px solid #dc3545;">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow p-3 mb-2 bg-white rounded">
            <div tabindex="0" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide11">
                <div style="padding: 10px">
                    <div id="testimonials" class="testimonials"  style="margin-bottom: 0px; padding-bottom: 2em; padding: 0px;">
                        <div class="owl-carousel testimonials-carousel" style="margin: 0px;">
                            <div class="testimonial-item">
                                <p>
                                    @if ($testimoni)
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    {{$testimoni->text}}
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    <span class="iconify" onclick='hapus_testimoni("{{$testimoni->id}}")' data-icon="clarity:times-circle-line" style="font-size: 1.5em; position: absolute; right: -0.4em; top: 0em;"></span>
                                    @else
                                    Belum ada testimoni
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <form action="<?=url('/')?>/testimoni/store" method="post">
                        @csrf
                        <textarea class="form-control" rows="3" name="text" placeholder="Masukan testimoni"></textarea>
                        <div style="display: flex; justify-content: flex-end;">
                            <input type="submit" name="" class="btn btn-success" value="Simpan" style="margin-top: 0.5em;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="card shadow p-3 mb-2 bg-white rounded">
            <div tabindex="0" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide11">
                <div style="padding: 20px">
                    <div style="display: flex; justify-content: center; align-items: center; flex-direction: column; padding: 2em 5em; width: 100%;">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20"  style="font-size: 5em; color:#dc3545;"><path d="M19.511 17.98L10.604 1.348a.697.697 0 0 0-1.208 0L.49 17.98a.675.675 0 0 0 .005.68c.125.211.352.34.598.34h17.814a.694.694 0 0 0 .598-.34a.677.677 0 0 0 .006-.68zM11 17H9v-2h2v2zm0-3.5H9V7h2v6.5z" fill="currentColor"/></svg>&nbsp;&nbsp;
                        </div>
                        <h5 style="text-align: center; margin-top: 0.5em;">
                            Testimoni dapat dilakukan ketika anda telah melakukan transaksi melalui website AsFrozen
                        </h5>
                        <a href="{{url('/')}}" class="btn btn-danger">Belanja Sekarang</a>

                    </div>  
                </div>
            </div>
        </div>
        @endif

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
                                    <a href="#" style="color: black;">
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

    function hapus_testimoni(id){
        $("#hapus_id").val(id);
        $("#modal_hapus").modal('show');
    }

</script>
@endsection