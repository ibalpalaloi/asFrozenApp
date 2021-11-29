@extends('layouts.home_mobile')

@section('title')

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

.slider {
	display: flex; 
	overflow-y: visible; 
	margin: 0px; 			
	overflow-x: scroll;
	scrollbar-width: none; /* Firefox */
	-ms-overflow-style: none;  /* Internet Explorer 10+ */
}
.slider::-webkit-scrollbar { /* WebKit */
	width: 0;
	height: 0;
}

.slider-toko {
	display: flex; 
	justify-content: center; 
	flex-direction: column; 
	align-items: center; 
	margin: 0em 0em 0em 0.5em; 
	width: 9.5em;		
}

.slider-toko img {
	width:9.5em;
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

.homepage {
	padding-bottom: 1px; 
	min-height: auto;
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
	<div class="row" style="margin-top: 5em; margin-bottom: 0px; padding-bottom: 0em;">
		<div class="col-md-12" style="padding: 0px; margin-bottom: 0px;">
			<div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%); margin-bottom: 0.5em;">
				<div class="row" style="padding: 0.5em 1em;">
					<?php
					$index = 0;
					$total_harga = 0;
					if ($keranjang->count() < 1){
						?>
						<div style="display: flex; justify-content: center; align-items: center; flex-direction: column; padding: 2em 5em; width: 100%;">
							<div>
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" data-icon="mdi:cart" style="font-size: 10em; color:#dc3545;"><path d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25c0-.05.01-.09.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2z" fill="currentColor"></path></svg>&nbsp;&nbsp;
							</div>
							<h4 style="text-align: center;">
								Belum ada produk yang dimasukan ke dalam keranjang
							</h4>
						</div>	
						<?php
					}
					else {
						foreach ($keranjang as $data){
							$diskon = "0";
							if($data->produk->diskon != null){
								$diskon = $data->produk->diskon->diskon;
							}
							$harga = $data->produk->harga;
							if($diskon != "0"){
								$harga = $harga - (($diskon / 100) * $harga);
							}
							?>
							<div style="display: flex;justify-content: center; align-items: center; margin-bottom: 1em; width: 10%;">
								<div class="icheck-danger d-inline">
									<input type="checkbox" id="checkboxPrimary{{$index}}" onchange="checkbox_cek('{{$data->id}}', '{{$index}}')" checked="false">
									<label for="checkboxPrimary{{$index}}">
									</label>
								</div>
							</div>
							<div style="width: 30%;">
								<img class="img-fluid" src="<?=url('/')?>/public/img/produk/thumbnail/300x300/{{$data->produk->foto}}" style="width: 100%; border-radius: 0.2em; margin-bottom: 0.5em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
							</div>
							<div style="width: 60%; padding-left: 0.5em;">
								<div style="display: flex;">
									<div>{{$data->produk->nama}}</div>	&nbsp;							
									@if ($diskon != "0")
									<badge class="badge badge-success" style="display: flex; justify-content: center; align-items: center;">
										{{$diskon}} %
									</badge>	
									@endif
								</div>
								<div class="text-muted" style="display: flex;">
									@if ($diskon != "0")
									<span style="display: flex; margin-top: 0.2em;">
										<small><s>{{number_format($harga,0,'.','.')}}</s>&nbsp;</small>
									</span>
									@php 
									$potongan_harga = round($harga*$diskon/100,0); 
									$harga_diskon = $harga-$potongan_harga;
									@endphp
									<span>{{number_format($harga_diskon,0,'.','.')}}</span>
									@else
									@php 
									$harga_diskon = $harga;
									@endphp
									<span>{{number_format($harga,0,'.','.')}}&nbsp;</span>
									@endif
								</div>
								<div style="padding: 0px; display: flex; align-items: center;">
									<div style="display: flex; align-items: flex-start; padding: 0px; justify-content: flex-start; margin-top: 0.2em;">
										<div onclick="kurang_pesanan('{{$index}}', '{{$harga_diskon}}')" class="btn btn-danger" style="color: black; color: white; height: 1.5em; width: 25%; border-radius: 0px; display: flex; align-items: center; justify-content: center;"> - </div>
										<div style="width: 50%; border-radius: 0px; display: flex; align-items: center; justify-content: center; border:1px solid #dfdfdf; height: 1.5em;" class="btn" id="jumlah_pesanan{{$index}}">{{$data->jumlah}}</div>
										<div onclick="tambah_pesanan('{{$index}}', '{{$harga_diskon}}')" class="btn btn-danger" style="color: black; color: white; height: 1.5em; width: 25%; border-radius: 0px; display: flex; align-items: center; justify-content: center;"> + </div>
									</div>
								</div>
								<div style="display: flex; align-items: center; justify-content: flex-start; padding-right: 0px; margin-top: 0.7em;">
									@php
									$jumlah = $data->jumlah;
									$jumlah_harga = round($jumlah * $harga_diskon,0);
									$total_harga += $jumlah_harga;
									@endphp	
									<span >Rp.</span> <span id="sub_total{{$index}}">{{number_format($jumlah_harga, 0, '.', '.')}}</span>
								</div>

							</div>
							<?php
							$index++;
						}
					}?>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12">
			@if ($keranjang->count() > 0)
			<div class="card shadow mb-2 bg-white rounded" style="border: none;">
				<div style="padding: 0em; display: flex; justify-content: flex-end;">
					<div style="padding: 0.5em; display: flex; justify-content: flex-end; flex-direction: column; align-items: flex-end;">
						<small>Sub Total</small>
						<div><b>Rp.&nbsp;<span id="harga_total">{{number_format($total_harga, 0, '.', '.')}}</span></b></div>
					</div>
					<a href="<?=url('/')?>/keranjang/checkout" class="btn btn-danger" style="border-radius: 0px; padding: 0.8em; font-size: 1em; margin: 0px; display: flex; align-items: center;">Checkout</a>
				</div>
			</div>
			@else
			<a href="<?=url('/')?>" class="btn btn-danger" style="padding: 0.7em; font-size: 1.1em;">Belanja Sekarang</a>
			@endif
		</div>
	</div>

</main>

<div class="wrapper" style="background: linear-gradient(0deg, hsla(20, 70%, 52%, 1) 0%, hsla(358, 84%, 52%, 1) 100%); position: relative; z-index: -1">
	<div class="container-mall" style="padding-bottom: 7.5em;">
		<div style="padding-top: 2em; text-align: center; color: white;">
			<p style="font-weight: 700;">Alamat</p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Semper vitae proin fames vulputate integer nulla amet. Donec turpis.
		</div>
		<div style="padding-top: 2em; text-align: center; color: white;">
			<p style="font-weight: 700;">Connect with us on social media</p>
			<div class="sosmed">
				<img src="<?=url('/')?>/public/img/home/about/facebook.svg" style="width: 2.2em;">
				<img src="<?=url('/')?>/public/img/home/about/youtube.svg" style="width: 2.2em;">
				<img src="<?=url('/')?>/public/img/home/about/instagram.svg" style="width: 2.2em;">
				<img src="<?=url('/')?>/public/img/home/about/twitter.svg" style="width: 2.2em;">
			</div><br>
			<div>
				Copyright&nbsp;&copy;&nbsp;<script>document.write(new Date().getFullYear());</script>&nbsp;AsFrozen Palu
			</div>
		</div>
	</div>
</div>
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

<!-- Template Main JS File -->
<script src="<?=url('/')?>/public/katalog_assets/assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="<?=url('/')?>/public/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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

	var list_keranjang = {!! json_encode($data_keranjang) !!}
	var total_harga = parseInt("{{$total_harga}}");
	// alert(total_harga);
	function checkbox_cek(id,index){
		var checked = $('#checkboxPrimary'+index).is(":checked");
		list_keranjang[index]['checked'] = checked.toString();
		get_harga_total();

		$.ajax({
			type:"post",
			url: "<?=url('/')?>/keranjang/ubah_checked",
			data:{"id": id, "checked":checked.toString(), "_token" : "{{ csrf_token() }}"},
			success:function(data){
				console.log("sukses")
			}
		})

	}

	function kurang_pesanan(index, harga_diskon){
		total_harga -= parseInt(harga_diskon);
		var jumlah_pesanan = parseInt($('#jumlah_pesanan'+index).html());
		if(jumlah_pesanan > 1){
			jumlah_pesanan -= 1;
		}
		list_keranjang[index]['jumlah'] = jumlah_pesanan;
		var sub_total = parseInt(jumlah_pesanan * harga_diskon);
		$('#jumlah_pesanan'+index).html(jumlah_pesanan);
		$('#sub_total'+index).html(sub_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
		$("#harga_total").html(total_harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
		ubah_jumlah_ajax(list_keranjang[index]['id'], jumlah_pesanan);
	}

	function tambah_pesanan(index, harga_diskon){
		total_harga += parseInt(harga_diskon);
		var jumlah_pesanan = parseInt($('#jumlah_pesanan'+index).html());
		jumlah_pesanan += 1;
		list_keranjang[index]['jumlah'] = jumlah_pesanan;
		var sub_total = parseInt(jumlah_pesanan * harga_diskon);
		$('#jumlah_pesanan'+index).html(jumlah_pesanan);
		$('#sub_total'+index).html(sub_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
		$("#harga_total").html(total_harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
		ubah_jumlah_ajax(list_keranjang[index]['id'], jumlah_pesanan);
	}

	function ubah_jumlah_ajax(id, jumlah){
		$.ajax({
			type:"post",
			url: "<?=url('/')?>/keranjang/ubah_jumlah",
			data:{"id": id, "jumlah":jumlah, "_token" : "{{ csrf_token() }}"},
			success:function(data){
				console.log("sukses")
			}
		})
	}


</script>	
@endsection
