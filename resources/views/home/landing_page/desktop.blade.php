@extends("layouts.home")

@section('title-header')
Keranjang Belanja
@endsection

@section('header')
<style type="text/css">
.slick-track {
	float: left;
}

.foo { padding-left: 0; }
.foo li {
	float: left;
	display: inline-block;
	width: 25%;
}		
/*--------------------------------------------------------------
# Testimonials
--------------------------------------------------------------*/
.testimonials .testimonial-item {
	box-sizing: content-box;
	text-align: center;
	min-height: 320px;
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
<link href="<?=url('/')?>/katalog_assets/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen" href="<?=url('/')?>/AdminLTE/plugins/retro-plugins/css/flip-clock.css" />
@endsection

@section('body')
<section id="hero" class="d-flex align-items-center" style="background: none; ">
<div class="container position-relative" data-aos="fade-up" data-aos-delay="100" style="padding-top: 0em;">
	<div class="row">
		<div class="col-md-12" style="padding: 0px;">
			<div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
				<div class="icon-boxes" style="margin-top: 0em; display: flex; justify-content: space-between;"> 

					@for ($i = 0; $i < 11; $i++)
					<a href="<?=url('/')?>/kategori/{{$kategori[$i]->kategori}}" data-aos="zoom-in" data-aos-delay="200" style="width: 8%; display: flex; flex-direction: column;justify-content: center; align-items: center;">
						<div class="icon-box" style="padding: 0px; background: none; box-shadow: none; width: 100%; display: flex;justify-content: center; flex-direction: column; align-items: center;">
							@php
							$url = url('/')."/icon_kategori/thumbnail/150x150/".$kategori[$i]->logo;
							@endphp
							<div style="display: flex; justify-content: center; width: 100%; background-image: url('{{$url}}'); height: 70px; width: 70px; background-size: cover; border-radius: 50%; box-shadow:0 2px 5px rgb(0 0 0 / 40%); border: 2px solid #ec1f25;" >
							</div>
							<div style="font-size: 1em; height: 2em; line-height: 1em; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; vertical-align: center;"><b>{{$kategori[$i]->kategori}}</b></div>
						</div>
					</a>
					@endfor
				</div>
				<div class="icon-boxes" style="margin-top: 1em; display: flex; justify-content: space-between;"> 
					@for ($i = 11; $i < 22; $i++)
					<a href="<?=url('/')?>/kategori/{{$kategori[$i]->kategori}}" data-aos="zoom-in" data-aos-delay="200" style="width: 8%; display: flex; flex-direction: column;justify-content: center; align-items: center;">
						<div class="icon-box" style="padding: 0px; background: none; box-shadow: none; width: 100%; display: flex;justify-content: center; flex-direction: column; align-items: center;">
							@php
							$url = url('/')."/icon_kategori/thumbnail/150x150/".$kategori[$i]->logo;
							@endphp
							<div style="display: flex; justify-content: center; width: 100%; background-image: url('{{$url}}'); height: 70px; width: 70px; background-size: cover; border-radius: 50%; box-shadow:0 2px 5px rgb(0 0 0 / 40%); border: 2px solid #ec1f25;" >
							</div>
							<div style="font-size: 1em; height: 2em; line-height: 1em; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; vertical-align: center;"><b>{{$kategori[$i]->kategori}}</b></div>
						</div>
					</a>
					@endfor
				</div>

				<br>

				<div class="icon-boxes" style="margin-top: 0em; display: flex; justify-content: space-between; display: none;"> 		
					@php
					$nama = array('Bakso', 'Buah Sayur', 'Bumbu', 'Daging', 'Ikan', 'Kecap Saus', 'Kue', 'Lainnya', 'Roti', 'Sosis','Kecap Saus', 'Kue', 'Lainnya', 'Roti', 'Sosis');
					$file = array('bakso.jpg', 'buah_sayur.jpg', 'bumbu.jpg', 'daging.jpg', 'ikan.jpg', 'kecap_saus.jpg', 'kue.jpg', 'lainnya.jpg', 'roti.jpg', 'sossis.jpg','kecap_saus.jpg', 'kue.jpg', 'lainnya.jpg', 'roti.jpg', 'sossis.jpg');
					@endphp
					@for ($i = 0; $i < count($file); $i++)
					<a href="#" data-aos="zoom-in" data-aos-delay="200" style="width: 8%; display: flex; flex-direction: column;justify-content: center; align-items: center;">
						<div class="icon-box" style="padding: 0px; background: none; box-shadow: none; width: 100%; display: flex;justify-content: center; flex-direction: column; align-items: center;">
							@php
							$url = url('/')."/katalog_assets/assets/img/kategori_icon/$file[$i]";
							@endphp
							<div style="display: flex; justify-content: center; width: 100%; background-image: url('{{$url}}'); height: 70px; width: 70px; background-size: cover; border-radius: 50%; box-shadow:0 2px 5px rgb(0 0 0 / 40%); border: 2px solid white;" >
							</div>
							<div style="text-align: center; font-size: 0.8em;">{{$nama[$i]}}</div>
						</div>
					</a>
					@endfor
				</div>

			</div>
		</div>
	</div>
	<div class="row justify-content-center" style="margin-top: 1em; margin-bottom: 0px;">
		<div class="col-lg-8 text-center" style="padding: 0;">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					@php $i=0; @endphp
					@foreach ($banner_main as $data)
					<div class="carousel-item @if ($i == 0) active @endif">
						<img src="<?=url('/')?>/banner/thumbnail/488x150/{{$data->foto}}" class="d-block w-100">
					</div>
					@php $i++; @endphp
					@endforeach 
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<div class="col-lg-4" style="padding: 0px; padding-left: 0.2em;">
			@foreach ($banner_not_main as $data)
			<img src="<?=url('/')?>/banner/thumbnail/488x150/{{$data->foto}}" class="d-block w-100" alt="..." @if ($data->posisi == 'kanan-bawah') style="margin-top: 0.2em;" @endif>
			@endforeach
		</div>
	</div>

	@include('user.include.flash_sale')

	<div style="margin-bottom: 10px">
		<div class="row" style="margin-top: 20px; padding-left: 0px; padding-right: 0px;  display: flex; justify-content: space-between;" hidden>
			<div style="width: 32%;">
				<iframe width="100%" height="220"  src="https://www.youtube.com/embed/qNa5vUG4W08" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 0.5em;"></iframe>
			</div>
			<div style="width: 32%;">
				<iframe width="100%" height="220"  src="https://www.youtube.com/embed/T5nSwojhgTo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 0.5em;"></iframe>
			</div>
			<div style="width: 32%;">
				<iframe width="100%" height="220"  src="https://www.youtube.com/embed/Qqyi1nI1yP0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 0.5em;"></iframe>
			</div>
		</div>
	</div>

	@foreach ($kategori_show as $data)
	<div class="row" style="margin-top: 1em;">
		<div class="col-md-12" style="padding: 0px;">
			<div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
				<div class="row" style="padding-left: 1em; padding-right: 1em; display: flex; justify-content: space-between; align-items: center;">
					<div>
						<img src="<?=url('/')?>/icon_kategori/thumbnail/75x75/{{$data->logo}}" style="width: 2.5em; border-radius: 50%; border: 2px solid #ec1f25;">
						<span style="margin-left: -0.4em; padding-left: 0.7em; padding-right: 0.5em; box-shadow: 0 4px 2px -2px gray; padding-bottom: 0.2em;"><b>{{$data->kategori}}</b></span>
					</div>
					<a href="<?=url('/')?>/kategori/daging" style="color: #ec1f25;">Selengkapnya</a>
				</div>
				<hr>
				<div class="row team" style="padding: 0em 1em;">
					<div class="flash_sale" style="width: 100%;">
						@foreach ($data->produk as $produk)
						<div class="d-flex" style="margin-right: 1em; padding-bottom: 0px;  -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%); margin-bottom: 1em; margin-top: 1em;">
							<div class="member" style="position: relative; margin-bottom: 0px;">
								<div class="member-img">
									<img src="<?=url('/')?>/img/produk/thumbnail/500x500/{{$produk->foto}}" class="img-fluid" alt="">
								</div>
								<div class="member-info" style=" padding: 0em 0.7em 0.8em;">
									@if ($produk->diskon != null)
									@php
									$harga = $produk->harga;
									$diskon = $produk->diskon->diskon;
									$harga_diskon = $harga - ($diskon/100 * $harga)
									@endphp
									<div style="margin-top: 0.5em; text-align: left; color: black;">
										@if (strlen($produk->nama) > 15) {{substr($produk->nama, 0, 15)}}... @else {{$produk->nama}} @endif<badge class="badge badge-warning">{{$diskon}}%</badge> 
									</div>
									<div style="padding-top: 0px; position: relative; display: flex; flex-direction: row; justify-content: flex-start; margin-top: 0.3em;">
										<small><s>Rp {{number_format($produk->harga, 0, '.', '.')}}</s></small>&nbsp;&nbsp;
										<h6>Rp {{number_format($harga_diskon, 0, '.', '.')}}</h6>
									</div>
									@else
									<div style="margin-top: 0.5em; text-align: left; color: black;">
										@if (strlen($produk->nama) > 20) {{substr($produk->nama, 0, 20)}}... @else {{$produk->nama}} @endif</div>
										<div style="padding-top: 0px; position: relative; display: flex; flex-direction: row; justify-content: flex-start; margin-top: 0.3em;">
											<h6>Rp {{number_format($produk->harga, 0, '.', '.')}}</h6>
										</div>
										@endif
										@if ($produk->stok_produk->stok != 0)
											<a onclick="tambah_keranjang('{{$produk->id}}')" class="btn btn-danger" style="display: flex; justify-content: center; flex-direction: row;">
												<div>
													<span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; color: white;"></span>&nbsp;&nbsp;
												</div>
												<div>Beli</div>
											</a>
										@else
											<a class="btn btn-secondary" style="display: flex; justify-content: center; flex-direction: row;">
												<div>Stok Habis</div>
											</a>
										@endif
										
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		<hr>
		<div class="btn btn-danger" style="padding: 0.8em;">Lihat Selengkapnya</div>

	</div>

</section><!-- End Hero -->

<div id="ck-wrapperWhyBrambang" class="ng-scope" style="background: rgba(255, 255, 255, 0.8);">
	<div class="mobileOnly" style="margin-top:50px;"></div>
	<div class="title-index">Keutungan Beli dari AsFrozen</div>
	<div id="WhyBrambangContainer" style="padding-left: 0px;">
		<div style="display: flex; justify-content: space-around;width: 100%;">
			<div class="wrapperWhyBrambangCard" style=" width: 23%;">
				<div class="ck-wrapperWhyBrambang-image" style="">
					<img src="https://dtq2i388ejbah.cloudfront.net/images/home/abus-02.svg" alt="Gratis Ongkir" class="img-responsive center-block">
				</div>
				<div class="ck-wrapperWhyBrambang-content sub-ck-wrap">
					<div class="WhyBrambangTitle WhyBrambangTitle-o">Gratis Ongkir</div>
					<div class="WhyBrambangSubTitle WhyBrambangSubTitle-o">Dapatkan gratis ongkir dengan minimal pembelian Rp
					98.000.</div>
				</div>
			</div>
			<div class="wrapperWhyBrambangCard" style=" width: 23%;">
				<div class="ck-wrapperWhyBrambang-image" style="">
					<img src="https://dtq2i388ejbah.cloudfront.net/images/home/abus-01.svg" alt="Mutu Terjamin" class="img-responsive center-block">
				</div>
				<div class="ck-wrapperWhyBrambang-content sub-ck-wrap">
					<div class="WhyBrambangTitle WhyBrambangTitle-o">Mutu Terjamin</div>
					<div class="WhyBrambangSubTitle WhyBrambangSubTitle-o">Kami melakukan kontrol mutu agar produk yang diterima selalu sesuai deskripsi dan foto di AsFrozen.com.</div>
				</div>
			</div>
			<div class="wrapperWhyBrambangCard" style=" width: 23%;">
				<div class="ck-wrapperWhyBrambang-image" style="">
					<img src="https://dtq2i388ejbah.cloudfront.net/images/home/abus-06.svg" alt="Tinggal Klik" class="img-responsive center-block">
				</div>
				<div class="ck-wrapperWhyBrambang-content sub-ck-wrap">
					<div class="WhyBrambangTitle"> Tinggal Klik</div>
					<div class="WhyBrambangSubTitle"> Tidak perlu repot ke toko. Tidak macet, hemat waktu dan tenaga. Pesan lewat hp atau komputer lalu klik produk yang kamu inginkan.</div>
				</div>
			</div>
			<div class="wrapperWhyBrambangCard" style=" width: 23%;">
				<div class="ck-wrapperWhyBrambang-image" style="">
					<img src="https://dtq2i388ejbah.cloudfront.net/images/home/abus-05.svg" alt="Pesan Hari Ini Esok Sampai" class="img-responsive center-block">
				</div>
				<div class="ck-wrapperWhyBrambang-content sub-ck-wrap">
					<div class="WhyBrambangTitle">Pesan Hari Ini <span>dan Esok Sampai</span></div>
					<div class="WhyBrambangSubTitle">Tinggal tunggu barang tiba.</div>
				</div>
			</div>


		</div>
	</div>

	<div class="clear"></div>

	<div id="ck-wrapper" style="background: #ec1f25;">
	</div>

	<div class="clear"></div>

	<div class="btn-delivery-price" ng-click="vm.openDeliveryTable()" style="display: none" role="button" tabindex="0">
		<a href="">Lihat Ongkos Kirim</a>
	</div>

</div>
<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials">
	<div class="container" data-aos="fade-up">

		<div class="section-title">
			<h2>Testimonials</h2>
		</div>

		<div class="owl-carousel testimonials-carousel">
			@foreach ($testimoni as $row)
			<div class="testimonial-item">
				<p style="height: 150px; display: flex; align-items: center;">
					<span>
						<i class="bx bxs-quote-alt-left quote-icon-left"></i>
						@if (strlen($row->text) > 130) {{substr($row->text, 0, 130)}}... @else {{$row->text}} @endif
						<i class="bx bxs-quote-alt-right quote-icon-right"></i>
					</span>
				</p>
				<h3>{{$row->tester}}</h3>
				<h4>Pelanggan</h4>
			</div>
			@endforeach

		</div>

	</div>
</section><!-- End Testimonials Section -->
<section id="clients" class="clients section-bg">
	<div class="container">

		<div class="row">
			<div class="list_brand" style="width: 100%;">
				@php
				$brand = array('client-6.png', 'client-1.png', 'client-2.png', 'client-3.png', 'client-4.png', 'client-5.png', 'client-7.png')
				@endphp
				@for ($i = 0; $i < count($brand); $i++)
				<div data-aos="zoom-in" style="width: 18%;">
					<img src="<?=url('/')?>/katalog_assets/assets/img/brand/{{$brand[$i]}}" class="img-fluid" alt="" style='width: 100%; filter: none;'>
				</div>
				@endfor
			</div>
		</div>

	</div>
</section><!-- End Clients Section -->
@endsection

@section('footer')
<script src="katalog_assets/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick.min.js"></script>
<script type="text/javascript">
	<?php  $date_tomorrow = date("m/d/Y", strtotime("+1 day", strtotime(date("Y-m-d")))); ?>
	var end = new Date("{{$date_tomorrow}} 0:00 AM");

	var _second = 1000;
	var _minute = _second * 60;
	var _hour = _minute * 60;
	var _day = _hour * 24;
	var timer;

	function showRemaining() {
		var now = new Date();
		var distance = end - now;
		if (distance < 0) {

			clearInterval(timer);
			document.getElementById('countdown').innerHTML = 'EXPIRED!';

			return;
		}
		var days = Math.floor(distance / _day);
		var hours = Math.floor((distance % _day) / _hour);
		var minutes = Math.floor((distance % _hour) / _minute);
		var seconds = Math.floor((distance % _minute) / _second);

		document.getElementById('countdown_jam').innerHTML = hours;
		document.getElementById('countdown_menit').innerHTML = minutes;
		document.getElementById('countdown_detik').innerHTML = seconds;
	}

	timer = setInterval(showRemaining, 1000);
</script>

<script>
	function tambah_keranjang(id){
		show_loader();
		$.ajax({
			url: "<?=url('/')?>/tambah_keranjang/"+id,
			type:"get",
			success:function(data){
				setTimeout(hide_loader, 500);
				console.log(data);
			}
		})
	}

	$(document).ready(function() {
		$('#age-select-1').popover({
			content: "<ul class='foo'><li>18</li><li>19</li><li>20</li><li>21</li><li>22</li><li>23</li><li>24</li><li>25</li></ul>",
			html: true,
			trigger: "click",
			placement: "bottom"
		});
	});
</script>
<script type="text/javascript">
	$('.flash_sale').slick({
		dots: false,
		infinite: false,
		speed: 300,
		slidesToShow: 5,
		slidesToScroll: 5,
		responsive: [
		{
			breakpoint: 1024,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 3,
				infinite: true,
				dots: true
			}
		},
		{
			breakpoint: 600,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			}
		},
		{
			breakpoint: 480,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		}
		]
	});	
	$('.list_brand').slick({
		dots: false,
		infinite: false,
		speed: 300,
		slidesToShow: 5,
		slidesToScroll: 5,
		responsive: [
		{
			breakpoint: 1024,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 3,
				infinite: true,
				dots: true
			}
		},
		{
			breakpoint: 600,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			}
		},
		{
			breakpoint: 480,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		}
		]
	});	
</script>
<script>
	$(".testimonials-carousel").owlCarousel({
		autoplay: true,
		dots: true,
		loop: true,
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			900: {
				items: 3
			}
		}
	});
  </script>
@include('script.home_script')
@endsection
