@extends("layouts.user_data")

@section('title-header')
Keranjang Belanja
@endsection

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="<?=url('/')?>/public/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

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
@if ($riwayat->count() > 0)
<div id="testimonials" class="testimonials"  style="margin-bottom: 0px; padding-bottom: 0px; padding: 0px;">


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

<div class="card shadow p-3 mb-5 bg-white rounded">
    <div tabindex="0" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide11">
        <div style="padding: 20px">
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
<div class="card shadow p-3 mb-5 bg-white rounded">
    <div tabindex="0" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide11">
        <div style="padding: 20px">
            <div style="display: flex; justify-content: center; align-items: center; flex-direction: column; padding: 2em 5em; width: 100%;">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20"  style="font-size: 5em; color:#dc3545;"><path d="M19.511 17.98L10.604 1.348a.697.697 0 0 0-1.208 0L.49 17.98a.675.675 0 0 0 .005.68c.125.211.352.34.598.34h17.814a.694.694 0 0 0 .598-.34a.677.677 0 0 0 .006-.68zM11 17H9v-2h2v2zm0-3.5H9V7h2v6.5z" fill="currentColor"/></svg>&nbsp;&nbsp;
                </div>
                <h5 style="text-align: center; margin-top: 0.5em;">
                    Testimoni dapat dilakukan ketika anda telah melakukan transaksi melalui website as Frozen Palu
                </h5>
                <a href="{{url('/')}}" class="btn btn-danger">Belanja Sekarang</a>

            </div>  
        </div>
    </div>
</div>




@endif

@endsection

@section('footer')
<script src="<?=url('/')?>/public/AdminLTE/plugins/datatables/jquery.dataTables.min.js}"></script>
<script src="<?=url('/')?>/public/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=url('/')?>/public/katalog_assets/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
  });
});

  function hapus_testimoni(id){
    $("#hapus_id").val(id);
    $("#modal_hapus").modal('show');
}

function tutup_modal(){
    $("#modal_hapus").modal('hide');
}

  // Testimonials carousel (uses the Owl Carousel library)
  $(".testimonials-carousel").owlCarousel({
    autoplay: false,
    dots: false,
    loop: false,
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 1
        },
        900: {
            items: 1
        }
    }
});

</script>
@endsection
