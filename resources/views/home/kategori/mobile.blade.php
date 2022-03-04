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
<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/venobox/venobox.css" rel="stylesheet">
<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/aos/aos.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/katalog_assets/assets/vendor/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/katalog_assets/assets/vendor/slick/slick-theme.css"/>
<!-- Template Main CSS File -->
<link href="<?=url('/')?>/public/katalog_assets/assets/css/style.css" rel="stylesheet">
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

.page-item.active .page-link {
	z-index: 0 !important;
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



<main id="homepage" class="homepage" style="background: #f5f5f5;">
	<div class="row-mall" style="padding: 5.7em 0em 0.7em 0em; background: white;">
		<div style="margin-left: 0.6em;">

			<div style="display: flex; flex-flow: row wrap;">
				@foreach($list_kategori as $data)
				<a href="<?=url('/')?>/kategori/{{$data->kategori}}" data-aos="zoom-in" data-aos-delay="10" style="width: 16.6%; display: flex; flex-direction: column;justify-content: center; align-items: center; margin-bottom: 0.5em;">
					<div class="icon-box" style="padding: 0px; background: none; box-shadow: none; width: 100%; display: flex;justify-content: center; flex-direction: column; align-items: center;" id="icon_box_{{$data->id}}">
						<div id="kategori_{{$data->id}}"style="display: flex; justify-content: center; width: 100%; height: 50px; width: 50px; background-size: cover; border-radius: 50%;  box-shadow:0 2px 5px rgb(0 0 0 / 40%); border: 2px solid #ec1f25;" >
						</div>
						<div style="text-align: center; font-size: 0.75em; color: black; line-height: 1em; height: 2em;"><b>{{$data->kategori}}</b></div>
					</div>
				</a>
				@endforeach
			</div>
		</div>
	</div>

	<div class="row-mall" style="padding: 0.7em 0em 0.7em 0em; background: white; padding-bottom: 6em;">
		<div style="margin-left: 0.6em; padding-bottom: 0.3em;">
			<h3>{{Request::segment(2)}}</h3>
		</div>
		<div class="slider" style="padding-bottom: 1em; margin-top: 0.5em;">
			<div style="display: flex; align-items: center; flex-wrap: wrap; justify-content: space-around;">

				@php $jumlah_digital = count($produk_kategori); @endphp
				@foreach ($produk_kategori as $produk)
				<div class="slider-toko" style="@if ($loop->iteration == 0) margin-left: 1em;@endif box-shadow: 0 0 5px #ccc; border-radius: 0.5em !important;">
					<img id="produk_img_{{$produk->id}}" src="<?=url('/')?>/public/empty.svg" style="border-top-left-radius: 0.5em; border-top-right-radius: 0.5em;">
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

						@if ($produk->stok_produk)
						@if ($produk->stok_produk->stok != 0)
						<div class="btn-danger" onclick="tambah_keranjang('{{$produk->id}}')" style="position: absolute; bottom: 0.5em; z-index: 0; width: 90%; height: 2em; border-radius: 0.2em; right: 0.45em; display: flex; justify-content: center; align-items: center; color: white;">
							<span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; "></span>&nbsp;&nbsp;Beli

						</div>					
						@else
						<div class="btn-secondary" style="position: absolute; bottom: 0.5em; z-index: 0; width: 90%; height: 2em; border-radius: 0.2em; right: 0.45em; display: flex; justify-content: center; align-items: center; color: white;">
							Stok Habis
						</div>
						@endif
						@else
						<div class="btn-secondary" style="position: absolute; bottom: 0.5em; z-index: 0; width: 90%; height: 2em; border-radius: 0.2em; right: 0.45em; display: flex; justify-content: center; align-items: center; color: white;">
							Stok Habis
						</div>
						@endif				
					</div>
				</div> 
				@if ($loop->iteration == $jumlah_digital)
				<div class="slider-toko" style="@if ($loop->iteration == 0) margin-left: 1em;@endif box-shadow: 0 0 5px #ccc; border-radius: 0.5em !important;">
				</div>
				@endif
				@endforeach
				<div style="display: flex; justify-content: center; width: 100%; margin-top: 0em;">
					{{ $produk_kategori->links('pagination::bootstrap-4') }}
				</div>
			</div>
		</div>
	</div>


</main>

@endsection

@section('footer-scripts')
<script src="<?=url('/')?>/public/katalog_assets/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?=url('/')?>/public/katalog_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=url('/')?>/public/katalog_assets/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?=url('/')?>/public/katalog_assets/assets/vendor/php-email-form/validate.js"></script>
<script src="<?=url('/')?>/public/katalog_assets/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?=url('/')?>/public/katalog_assets/assets/vendor/counterup/counterup.min.js"></script>
<script src="<?=url('/')?>/public/katalog_assets/assets/vendor/venobox/venobox.min.js"></script>
<script src="<?=url('/')?>/public/katalog_assets/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?=url('/')?>/public/katalog_assets/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?=url('/')?>/public/katalog_assets/assets/vendor/aos/aos.js"></script>
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
<script src="<?=url('/')?>/public/katalog_assets/assets/js/main.js"></script>

<script type="text/javascript">


	$(document).ready(function() {
		load_img_kategori();
		load_img_produk();

	});

	function load_img_produk(){
		@foreach($produk_kategori as $data)
		@php
		$url = url('/')."/public/img/produk/thumbnail/500x500/".$data->foto;
		@endphp
		var id = "{{$data->id}}";
		var url = "{{$url}}";
		// $("#div_produk_img_"+id).html('')
		var img = $("#produk_img_"+id);
		img.attr("src", img.attr("src").replace("<?=url('/')?>/public/empty.svg", url));
		@endforeach
	}

	function load_img_kategori(){
		@foreach($list_kategori as $data)
		@php $url = url('/')."/public/icon_kategori/thumbnail/150x150/$data->logo"; @endphp
		var id = "{{$data->id}}";
		var url = "{{$url}}";

		$("#kategori_"+id).html("<img src='"+url+"' style='width: 100%; border-radius: 50%;'>");
		// alert("{{$url}}");
		@endforeach
	}


</script>	
@endsection
\