@extends('layouts.home_mobile')

@section('title')
{{Request::segment(2)}}
@endsection

@section('header-scripts')
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
<!-- Vendor CSS Files -->
<link href="<?=url('/')?>/katalog_assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=url('/')?>/katalog_assets/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
<link href="<?=url('/')?>/katalog_assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="<?=url('/')?>/katalog_assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="<?=url('/')?>/katalog_assets/assets/vendor/venobox/venobox.css" rel="stylesheet">
<link href="<?=url('/')?>/katalog_assets/assets/vendor/aos/aos.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick-theme.css"/>
<!-- Template Main CSS File -->
<link href="<?=url('/')?>/katalog_assets/assets/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
<style type="text/css">
	.banner {
		max-width: 480px;
		width: 100%;
		margin: 0px auto;
		padding: 4em 0em 4em 0em;
	}

	.header {
		background: #ff006e;
		position: fixed;
		width: 100%;
		top: 0px;
		left: 0px;
		right: 0px;
		z-index: 11;				
	}

	.card-mall {
		background: white;
		box-shadow: rgba(152, 152, 152, 0.5) 0px 2px 8px 1px;
		border-radius: 1.5em;	
		margin-bottom: 1em;
	}

	.row-mall {
		background: white;
		margin-bottom: 1em;
		width: 100%;	
	}

	.kategori {
		padding: 0.8em 0em 1em 0em;
		display: flex; 
		position: relative; 
		top: -6em; 
		margin-bottom: -2em;
		z-index: 2;   
		overflow-y: visible; 
		margin: 0px; 			
		overflow-x: scroll;
		scrollbar-width: none; /* Firefox */
		-ms-overflow-style: none;  /* Internet Explorer 10+ */
	}


}
.kategori::-webkit-scrollbar { /* WebKit */
	width: 0;
	height: 0;
}



.product {
	overflow-y: visible; 
	overflow-x: auto; 		
}

.nama-kategori {
	padding: 0.5em 0.5em 0.5em 0.5em;
	display: flex; 				
	justify-content: space-around;
}

.sosmed > img {
	margin: 0px 0.6em 0px 0.6em !important;
}

.footer {
	position: fixed;
	left: 0;
	bottom: 0;
	width: 100%;
	color: white;
	text-align: center;
	padding-bottom: 0px;
	background-color: transparent;
}

.footer-mall-menu {
	background: white;
	border-radius: 3em;         
	margin-bottom: 0.5em;  
}



.homepage {
	padding: 0px;
}


.slider-toko {
	display: flex; 
	justify-content: center; 
	flex-direction: column; 
	align-items: center; 
	margin: 0em 2.5% 1.2em 2.5%; 
	width: 45%;	
}

.slider-toko img {
	width: 100%;
	height: 9.5em;
	object-fit: cover;
	border-top-left-radius: 1em;
	border-top-right-radius: 1em;
}

.slider-toko > div {
	height: 5.8em;
	border-bottom-left-radius: 1em;
	border-bottom-right-radius: 1em;
}

.star-rating {
	color: #efff3b;
}

.star-no-rating {
	color: #c1c3be;
}

.kategori-tabs > a {
	margin: 0em 0.6em 0em 0.6em;
	font-size: 0.8em;
}

.kategori-active-mall {
	font-weight: 600;
	border-bottom: 1px solid #42b25d;
}	
.slider-sub {
	display: flex; 
	overflow-y: visible; 
	margin: 0px; 			
	overflow-x: scroll;
	scrollbar-width: none; /* Firefox */
	-ms-overflow-style: none;  /* Internet Explorer 10+ */
}

.slider-sub::-webkit-scrollbar { /* WebKit */
	width: 0;
	height: 0;
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
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' '. $pecahkan[0];
}

function hari_indo($hari){
	if ($hari == 'Thursday'){
		$hari = "Kamis";
	}
	else if ($hari == 'Friday'){
		$hari = "Jumat";
	}
	else if ($hari == 'Saturday'){
		$hari = "Sabtu";
	}
	else if ($hari == 'Sunday'){
		$hari = "Minggu";
	}
	else if ($hari == 'Monday'){
		$hari = "Senin";
	}
	else if ($hari == 'Tuesday'){
		$hari = "Selasa";
	}
	else if ($hari == 'Wednesday'){
		$hari = "Rabu";
	}
	return $hari;
}
?>

<header class="style__Container-sc-3fiysr-0 header" style="background: linear-gradient(0deg, hsla(20, 70%, 52%, 1) 0%, hsla(358, 84%, 52%, 1) 100%); border-bottom: none; box-shadow:0 1px 1px rgb(0 0 0 / 20%);">
	<div class="style__Wrapper-sc-3fiysr-2 hBSxmh" style="display: flex; justify-content: center;">
		<a id="defaultheader_logo" title="Kitabisa" style="margin-left: 20px; height:33px;margin-right:20px; display: flex; justify-content: center; align-items: center;" href="/">
			<img src="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_palu_white.png" style="width: 2.5em">
		</a>
		<div id="defaultheader_search" class="style__SearchInput-sc-3fiysr-3 sUjAJ">
			<span></span>
			<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="svg-inline--fa fa-search fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="color: #dedede;">
				<path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
			</svg>
		</div>
	</div>
</header>


<main id="homepage" class="homepage" style="background: #f5f5f5;">
	<div class="row-mall" style="padding: 5.7em 0em 0.7em 0em; background: white;">
		<div style="margin-left: 0.6em;">

			<div style="display: flex; flex-flow: row wrap;">
				@foreach($list_kategori as $data)
				<a href="<?=url('/')?>/kategori/{{$data->kategori}}" data-aos="zoom-in" data-aos-delay="200" style="width: 16.6%; display: flex; flex-direction: column;justify-content: center; align-items: center; margin-bottom: 0.5em;">
					<div class="icon-box" style="padding: 0px; background: none; box-shadow: none; width: 100%; display: flex;justify-content: center; flex-direction: column; align-items: center;">
						@php
						$url = url('/')."/public/icon_kategori/thumbnail/150x150/$data->logo";
						@endphp
						<div style="display: flex; justify-content: center; width: 100%; background-image: url('{{$url}}'); height: 50px; width: 50px; background-size: cover; border-radius: 50%; box-shadow:0 2px 5px rgb(0 0 0 / 40%); border: 2px solid #ec1f25;" >
						</div>
						<div style="text-align: center; font-size: 0.75em; color: black; line-height: 1em; height: 2em;"><b>{{$data->kategori}}</b></div>
					</div>
				</a>
				@endforeach
			</div>
		</div>
	</div>

	<div class="row-mall" style="padding: 0.7em 0em 0.7em 0em; background: white;">
		<div style="margin-left: 0.6em; padding-bottom: 0.3em;">
			<h3>{{Request::segment(2)}}</h3>
		</div>
		<div class="slider" style="padding-bottom: 1em; margin-top: 0.5em;">
			<div style="display: flex; align-items: center; flex-wrap: wrap; justify-content: space-around;">

				@php $jumlah_digital = count($dummy); @endphp
				@foreach ($dummy as $produk)
				<div class="slider-toko" style="@if ($loop->iteration == 0) margin-left: 1em;@endif box-shadow: 0 0 5px #ccc; border-radius: 0.5em !important;">
					<?php $svg = "public/img/home/bg-slider-toko.svg"; ?>
					<img src="<?=url('/')?>/public/img/produk/thumbnail/500x500/{{$produk->foto}}" style="border-top-left-radius: 0.5em; border-top-right-radius: 0.5em;">
					<div style='text-align: left; font-size: 1em; padding: 0.5em 0.7em 0em 0.7em; width: 100%; background: white border:1px solid #ccc; color: #70767a; background-size: cover; position: relative; border-radius: 0.5em; word-wrap: break-word; line-height: 1.1em;'> 
						@if ($produk->diskon != null)
						@php
						$diskon = $produk->diskon->diskon;
						$potongan_harga = ($diskon/100 * $produk->harga);
						$harga_diskon = $produk->harga - $potongan_harga;
						@endphp
						<div style="font-weight: 600; margin-bottom: 0.2em;">
							@if (strlen($produk->nama) > 9) {{substr($produk->nama, 0, 9)}}.. @else {{$produk->nama}} @endif
							<badge class="badge badge-warning">{{$diskon}}%</badge> 
						</div>
						<div style="color: #db6148;">
							<s style="font-size: 0.7em;">{{number_format($produk->harga, 0, '.', '.')}}</s>
							<span style="font-size: 0.85em;">{{number_format($harga_diskon, 0, '.', '.')}}</span>
						</div>
						@else
						<div style="font-weight: 600; margin-bottom: 0.2em;">
							@if (strlen($produk->nama) > 10) {{substr($produk->nama, 0, 10)}}... @else {{$produk->nama}} @endif
						</div>
						<div style="color: #db6148;">
							<span style="font-size: 0.85em;">{{number_format($produk->harga, 0, '.', '.')}}</span>
						</div>
						@endif

						<div class="btn-danger" onclick="tambah_keranjang('{{$produk->id}}')" style="position: absolute; bottom: 0.5em; z-index: 0; width: 90%; height: 2em; border-radius: 0.2em; right: 0.45em; display: flex; justify-content: center; align-items: center; color: white;">
							<span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; "></span>&nbsp;&nbsp;Beli

						</div>					
					</div>
				</div> 
				@if ($loop->iteration == $jumlah_digital)
				<div class="slider-toko" style="@if ($loop->iteration == 0) margin-left: 1em;@endif box-shadow: 0 0 5px #ccc; border-radius: 0.5em !important;">
				</div>
				@endif
				@endforeach
			</div>
		</div>
	</div>


</main>

@endsection

@section('footer-scripts')
<script src="<?=url('/')?>/katalog_assets/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?=url('/')?>/katalog_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=url('/')?>/katalog_assets/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?=url('/')?>/katalog_assets/assets/vendor/php-email-form/validate.js"></script>
<script src="<?=url('/')?>/katalog_assets/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?=url('/')?>/katalog_assets/assets/vendor/counterup/counterup.min.js"></script>
<script src="<?=url('/')?>/katalog_assets/assets/vendor/venobox/venobox.min.js"></script>
<script src="<?=url('/')?>/katalog_assets/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?=url('/')?>/katalog_assets/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?=url('/')?>/katalog_assets/assets/vendor/aos/aos.js"></script>
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>

<!-- Template Main JS File -->
<script src="<?=url('/')?>/katalog_assets/assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
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

</script>	
@endsection
