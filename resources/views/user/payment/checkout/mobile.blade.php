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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Penerima</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleFormControlInput1">Nama Penerima</label>
								<input type="text" class="form-control" id="nama_penerima" placeholder="Nama Penerima" value="{{Auth()->user()->biodata->nama}}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleFormControlInput1">Nomor Handphone</label>
								<input type="text" class="form-control" id="nomor_handphone" placeholder="Nama Pemesan" value="{{Auth()->user()->biodata->no_telp}}">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="exampleFormControlTextarea1">Alamat</label>
						<textarea class="form-control" id="alamat" rows="2" placeholder="Alamat">{{Auth()->user()->biodata->alamat}}</textarea>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleFormControlSelect1">Kota</label>
								@php
								$kota_id = Auth()->user()->biodata->kelurahan->kecamatan->kota->id;
								$kecamatan_id = Auth()->user()->biodata->kelurahan->kecamatan->id;
								$kelurahan_id = Auth()->user()->biodata->kelurahan->id;
								@endphp
								<select onchange="get_kecamatan()" class="form-control" id="selectKota">
									@foreach($kota as $data)
									<option value="{{$data->id}}" @if($kota_id == $data->id) selected @endif>{{$data->kota}}</option>
									@endforeach

								</select>
							</div>

						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleFormControlSelect1">Kecamatan</label>
								<select class="form-control" id="selectKecamatan" onchange="get_kelurahan()">
									@foreach ($kecamatan as $data)
									<option value="{{$data->id}}" @if($kecamatan_id == $data->id) selected @endif >{{$data->kecamatan}}</option>
									@endforeach
								</select>
							</div>

						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleFormControlSelect1">Kelurahan</label>
								<select class="form-control" id="selectKelurahan" onchange="get_ongkir()">
									@foreach ($kelurahan as $data)
									<option value="{{$data->id}}" @if($kelurahan_id == $data->id) selected @endif >{{$data->kelurahan}}</option>
									@endforeach
								</select>
							</div>
						</div>

					</div>
				</form>
			</div>
			<br>
			<div class="modal-footer justify-content-between" style="font-weight: 700">
				<div data-dismiss="modal" class="btn btn-danger" onclick="ubah_penerima()">
					Simpan
				</div>
			</div>
		</div>
	</div>
</div>


@php
$ongkos_kirim = Auth()->user()->biodata->kelurahan->ongkos_kirim->ongkos_kirim;
@endphp


<section id="hero" class="d-flex align-items-center" style="background: none; ">
	<div class="container" style="padding-top: 0em;">
		<div class="row" style="display: flex; justify-content: center;">
			<div class="col-12">
				<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;">
					@foreach ($data_produk_checkout as $data)

					<?php
					$diskon = "0";
					if($data['diskon'] != null){
						$diskon = $data['diskon'];
					}
					$harga = $data['harga_diskon'];
					if($diskon != "0"){
						$harga = $harga - (($diskon / 100) * $harga);
					}
					?>
					<div class="row mb-2">
						<div style="display: flex;justify-content: center; align-items: center; margin-bottom: 1em; width: 10%;">
							<div class="icheck-danger d-inline">
								@php $data_id = $data["id"]; @endphp
								<input type="checkbox" id="checkboxPrimary{{$data_id}}" onchange="checkbox_cek('$data_id')" checked="false">
								<label for="checkboxPrimary{{$data_id}}">
								</label>
							</div>
						</div>
						<div style="width: 22%;">
							<img class="img-fluid" src="<?=url('/')?>/public/img/produk/thumbnail/300x300/{{$data['foto']}}" style="width: 100%; border-radius: 0.2em; margin-bottom: 0.5em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
						</div>
						<div style="width: 60%; padding-left: 0.8em;">
							<div style="display: flex;">
								<div>{{$data['nama_produk']}}</div>	&nbsp;							
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
							<div style="display: flex; align-items: center; justify-content: flex-start; padding-right: 0px; margin-top: 0.7em;">
								@php
								$jumlah = $data['jumlah'];
								$jumlah_harga = round($jumlah * $harga_diskon,0);
								@endphp	
								<span >Rp.</span> <span id="sub_total{{$data_id}}">{{number_format($data['harga_diskon'], 0, '.', '.')}}</span>
							</div>

						</div>
					</div>
					@endforeach

				</div>
				<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;">
					<div>Metode Pengantaran</div>
					<div style="display: flex; margin-top: 0.5em;">
						<div class="btn btn-outline-danger" id="btn_ambil_sendiri" style="border: 1px solid #dc3545;" onclick="metode_pengantaran('ambil')">Ambil Sendiri</div>
						<div class="btn btn-outline-danger" id="btn_diantarkan" style="border: 1px solid #dc3545; margin-left: 0.5em;" onclick="metode_pengantaran('diantarkan')">Diantarakan</div>
					</div>
				</div>
				<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;" hidden id="toko_as_frozen">
					<div style="display: flex;">
						<svg height="18" viewBox="0 0 12 16" width="18" class="shopee-svg-icon icon-location-marker" style="margin-top: 0.3em;"><path d="M6 3.2c1.506 0 2.727 1.195 2.727 2.667 0 1.473-1.22 2.666-2.727 2.666S3.273 7.34 3.273 5.867C3.273 4.395 4.493 3.2 6 3.2zM0 6c0-3.315 2.686-6 6-6s6 2.685 6 6c0 2.498-1.964 5.742-6 9.933C1.613 11.743 0 8.498 0 6z" fill-rule="evenodd"></path>
						</svg>
						<div style="margin-left: 1em;">
							<b>Toko Asfrozen</b><br>
							Jl. Mandala No. 1, Birobuli Utara, Kec, Palu Selatan<br>
							Kota Palu, Sulawesi Tengah, 94111<br>
							<a href="https://www.google.com/maps/place/AS+FROZEN+PALU/@-0.9144415,119.8997595,16.92z/data=!4m5!3m4!1s0x2d8bef83f63e3983:0x39f3cc45d0d5d04!8m2!3d-0.9141016!4d119.8988105">Lihat maps</a>
						</div>
					</div>
				</div>
				<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;" id="alamat_penerima" hidden>
					<div style="display: flex;">
						<svg height="18" viewBox="0 0 12 16" width="18" class="shopee-svg-icon icon-location-marker" style="margin-top: 0.3em;"><path d="M6 3.2c1.506 0 2.727 1.195 2.727 2.667 0 1.473-1.22 2.666-2.727 2.666S3.273 7.34 3.273 5.867C3.273 4.395 4.493 3.2 6 3.2zM0 6c0-3.315 2.686-6 6-6s6 2.685 6 6c0 2.498-1.964 5.742-6 9.933C1.613 11.743 0 8.498 0 6z" fill-rule="evenodd"></path>
						</svg>
						<div style="margin-left: 1em;" id="div_alamat_penerima">
							<b>Alamat Penerima&nbsp;(Ongkir : Rp. {{$ongkos_kirim}})</b><br>
							<span>{{Auth()->user()->biodata->nama}} | ({{Auth()->user()->biodata->no_telp}})</span><br>
							<span>{{Auth()->user()->biodata->alamat}}</span><br>
							<span>{{Auth()->user()->biodata->kelurahan->kelurahan}}, {{Auth()->user()->biodata->kelurahan->kecamatan->kecamatan}}, {{Auth()->user()->biodata->kelurahan->kecamatan->kota->kota}}</span> <br>
						</div>
						<div data-toggle="modal" onclick="ubah_data()" style="position: absolute; right: 2em; top: 40%;">Ubah data</div>
					</div>
				</div>

				<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;">
					<div>Metode Pembayaran</div>
					<div style="display: flex; margin-top: 0.5em;">
						<div id="btn_cod" onclick="metode_pembayaran('cod')" class="btn btn-outline-danger" style="border: 1px solid #dc3545;">COD</div>
						<div id="btn_transfer" onclick="metode_pembayaran('transfer')" class="btn btn-outline-danger" style="margin-left: 0.5em; border: 1px solid #dc3545;">Transfer</div>
					</div>
					<div id="list_bank" hidden>
						@foreach ($bank as $row)
						<div class="stardust-radio__content" style="display: flex; margin-top: 1em;">
							<div class="form-group clearfix" style="margin-right: 1em;">
								<div class="icheck-primary d-inline">
									<input type="radio" id="radioPrimary_{{$row->id}}" onclick='radio_bank("{{$row->id}}")' name="id_bank" checked>
									<label for="radioPrimary_{{$row->id}}"></label>
								</div>
							</div>
							<div class="checkout-bank-transfer-item__card" style="display: flex;">
								<div class="checkout-bank-transfer-item__icon-container">
									<img src="<?=url('/')?>/public/bank/{{$row->img}}" class="checkout-bank-transfer-item__icon" style="width: 2em; margin-right: 1em;">
								</div>
								<div>
									<div class="checkout-bank-transfer-item__main" style="line-height: 0.8em;">
										{{$row->nama_bank}} (Dicek Manual)
									</div>
									<div class="checkout-bank-transfer-item__description">
										<small>Perlu upload bukti transfer</small>
									</div>
								</div>
							</div>
						</div>
						@endforeach


						<div class="bank-transfer-category__body">
						</div>				
					</div>
				</div>	
				<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;">
					<div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Catatan Untuk Pesanan Ini</label>
							<textarea class="form-control" id="catatan_pesanan" rows="3"></textarea>
						</div>
					</div>
				</div>
				<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;">
					<div class="row">
						<div class="col-6">
							Subtotal Produk
						</div>
						<div class="col-6" style="display: flex; justify-content: flex-end;">
							<div></div><div>{{number_format($total_harga_produk,0,'.','.')}}</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							Ongkos Kirim
						</div>
						<div class="col-6" style="display: flex; justify-content: flex-end;">
							<div></div><div id="nilai_ongkir">0</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							Total
						</div>
						<div class="col-6" style="display: flex; justify-content: flex-end;">
							<h3 id="nilai_total">Rp.&nbsp;{{number_format($total_harga_produk, 0, '.', '.')}}</h3>
						</div>
					</div>

					<div class="row">
						<div class="col-md-8">
						</div>
						<div class="col-md-4">
							<a href="#" onclick="buat_pesanan()" class="btn btn-danger">Buat Pesanan</a>
						</div>
					</div>


				</div>	
				<form action="<?=url('/')?>/keranjang/post_checkout" method="post" id="form_data_pesanan">
					@csrf
					<input hidden type="text" name="nama_penerima" id="input_nama_penerima" value="{{Auth()->user()->biodata->nama}}" required>
					<input hidden type="text" name="no_telp_penerima", id="input_no_telp_penerima" value="{{Auth()->user()->biodata->no_telp}}">
					<input hidden type="text" name="ongkos_kirim" id="input_ongkos_kirim" value="{{$ongkos_kirim}}" required>
					<input hidden type="text" name="total_harga_produk" id="input_total_harga_produk" value="{{$total_harga_produk}}" required>
					<input hidden type="text" name="alamat" id="input_alamat" value="{{Auth()->user()->biodata->alamat}}" required>
					<input hidden type="text" name="kota" id="input_kota" value="{{Auth()->user()->biodata->kelurahan->kecamatan->kota->kota}}" required>
					<input hidden type="text" name="kecamatan" id="input_kecamatan" value="{{Auth()->user()->biodata->kelurahan->kecamatan->kecamatan}}" required> 
					<input hidden type="text" name="kelurahan" id="input_kelurahan" value="{{Auth()->user()->biodata->kelurahan->kelurahan}}" required>
					<input hidden type="text" name="pembayaran" id="input_pembayaran" value="" required>
					<input hidden type="text" name="pengantaran" id="input_pengantaran" value="" required>
					<textarea hidden name="catatan_pesanan" id="input_catatan_pesanan" cols="30" rows="10"></textarea>

				</form>
			</div>
		</div>

	</div>
</section><!-- End Hero -->


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
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
<script>
	var ongkos_kirim = {!! json_encode(Auth()->user()->biodata->kelurahan->ongkos_kirim->ongkos_kirim) !!};
	var ongkos_kirim_get = 0;
	var total_harga_produk = {!! json_encode($total_harga_produk) !!}
	function get_kecamatan(){
		var kota_id = $('#selectKota').val();
		var option = "<option value=''>Pilih Kecamatan</option>";
		$.ajax({
			type: "get",
			url: "<?=url('/')?>/get_kecamatan/"+kota_id,
			success:function(data){
				var kecamatan = data.kecamatan;
				var kecamatan_lenght = Object.keys(kecamatan).length;
				for(let i = 0; i< kecamatan_lenght; i++){
					option += "<option value='"+kecamatan[i]['id']+"'>"+kecamatan[i]['kecamatan']+"</option>"
				}
				$("#selectKecamatan").html(option);
			}
		})
	}

	function get_kelurahan(){
		var kecamatan_id = $('#selectKecamatan').val();
		var option = "<option value=''>Pilih Kelurahan</option>";
		$.ajax({
			type: "get",
			url: "<?=url('/')?>/get_kelurahan/"+kecamatan_id,
			success:function(data){
				var kelurahan = data.kelurahan;
				var kelurahan_lenght = Object.keys(kelurahan).length;
				for(let i = 0; i< kelurahan_lenght; i++){
					option += "<option value='"+kelurahan[i]['id']+"'>"+kelurahan[i]['kelurahan']+"</option>"
				}
				$("#selectKelurahan").html(option);
			}
		})
	}

	function radio_bank(id){
		$('#input_pembayaran').val(id);		
	}

	function get_ongkir(){
		var kelurahan_id = $('#selectKelurahan').val();
		$.ajax({
			type: "get",
			url: "<?=url('/')?>/get_ongkir/"+kelurahan_id,
			success:function(data){
				ongkos_kirim_get = data.ongkos_kirim;
			}
		})

	}

	function ubah_penerima(){
		var nama_penerima = $("#nama_penerima").val();
		var nomor_handphone = $('#nomor_handphone').val();
		var alamat = $('#alamat').val();
		var kota = $('#selectKota option:selected').text();
		var kecamatan = $('#selectKecamatan option:selected').text();
		var kelurahan = $('#selectKelurahan option:selected').text();
		$("#input_nama_penerima").val(nama_penerima);
		$('#input_no_telp_penerima').val(nomor_handphone);
		ongkos_kirim = ongkos_kirim_get;
		var html = "";
		html += "<b>Alamat Penerima&nbsp; (Ongkir : RP. "+ongkos_kirim+")</b><br>";
		html += "<span>"+nama_penerima+" | "+nomor_handphone+"</span><br>";
		html += "<span>"+alamat+"</span><br>";
		html += "<span>"+kelurahan+", "+kecamatan+", "+kota+"</span>";
		console.log(html);

		$("#div_alamat_penerima").html(html);
	}

	function buat_pesanan(){
		$('#input_catatan_pesanan').val($('#catatan_pesanan').val());
		$("#form_data_pesanan").submit();
	}

	function modal_pesan(){
		$('#exampleModal').modal('show');
	}

	function ubah_data(){
		$('#exampleModal').modal('show');
	}

	function metode_pengantaran(value){
		if (value == 'ambil'){
			$("#toko_as_frozen").prop('hidden', false);
			$("#alamat_penerima").prop('hidden', true);
			$("#btn_ambil_sendiri").css('background', '#dc3545');				
			$("#btn_ambil_sendiri").css('color', 'white');				
			$("#btn_diantarkan").css('background', 'white');				
			$("#btn_diantarkan").css('color', '#dc3545');	
			$("#total_biaya").html("Rp. 90.000");
			$("#nilai_ongkir").html("0");
			$("#input_pengantaran").val('Ambil Sendiri');
			$('#input_ongkos_kirim').val("0")	
		}
		else {
			$("#toko_as_frozen").prop('hidden', true);
			$("#alamat_penerima").prop('hidden', false);				
			$("#btn_diantarkan").css('background', '#dc3545');				
			$("#btn_diantarkan").css('color', 'white');				
			$("#btn_ambil_sendiri").css('background', 'white');				
			$("#btn_ambil_sendiri").css('color', '#dc3545');				
			$("#total_biaya").html("Rp. 97.000");
			$("#nilai_ongkir").html(ongkos_kirim);	
			$("#input_pengantaran").val('Diantarkan');
			$('#input_ongkos_kirim').val(ongkos_kirim);	


		}
	}

	function metode_pembayaran(value){
		if (value == 'cod'){
			$("#btn_cod").css('background', '#dc3545');				
			$("#btn_cod").css('color', 'white');				
			$("#btn_transfer").css('background', 'white');				
			$("#btn_transfer").css('color', '#dc3545');	
			$("#list_bank").prop('hidden', true);
			$('#input_pembayaran').val('COD');		
		}
		else {
			$("#btn_transfer").css('background', '#dc3545');				
			$("#btn_transfer").css('color', 'white');				
			$("#btn_cod").css('background', 'white');				
			$("#btn_cod").css('color', '#dc3545');								
			$("#list_bank").prop('hidden', false);	
			$('#input_pembayaran').val('Tranfer');			
		}
	}

	function ongkos_kirim(){
		var kelurahan = $("#select_kelurahan").val();
		var ongkos_kirim = 0;
		var total_pesanan = 0;
		if(kelurahan == "Tipo"){
			ongkos_kirim = "20.000"
			total_pesanan = "70.000"
		}
		else if(kelurahan == "Kabonena"){
			ongkos_kirim = "18.000"
			total_pesanan = "68.000"
		}
		else if(kelurahan == "Donggala Kodi"){
			ongkos_kirim = "18.000"
			total_pesanan = "68.000"
		}
		else if(kelurahan == "Silae"){
			ongkos_kirim = "29.000"
			total_pesanan = "79.000"
		}
		else{
			ongkos_kirim = "0"
		}

		$("#ongkos_kirim").empty()
		$("#total_pesanan").empty()
		$("#total_pesanan").append("Total : Rp. "+total_pesanan)
		$("#ongkos_kirim").append("Rp. "+ongkos_kirim)
	}
</script>
</body>

</html>
@endsection
