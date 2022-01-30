@extends("layouts.user_data")

@section('title-header')
Keranjang Belanja
@endsection

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link href="<?=url('/')?>/katalog_assets/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

<style type="text/css">
    td {
        font-size: 0.8em !important;
    }

    .testimonials .testimonial-item {
        box-sizing: content-box;
        text-align: center;
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

<div class="card shadow p-3 mb-5 bg-white rounded">
    <div tabindex="0" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide11">
        <div style="padding: 20px">
            <form action="<?=url('/')?>/post-ubah-password" method="post">
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Password Baru</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="staticEmail" name="password" required>
                    </div>
                </div>
                <br><br>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-danger">SIMPAN</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('katalog_assets/assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
  });
});

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
