@extends("layouts.home_mobile")

@section('title')
Pesanan
@endsection

@section('content')
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

$status_pesanan = "packaging";
// status_pesanan = ['menunggu konfirmasi', 'packaging', 'telah diantarakan']
@endphp
<section id="" class="d-flex align-items-center" style="background: none; ">
</section>

@endsection


@section('footer-scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

	$(document).ready(function(){
		@if (session('error'))
		swal({
			title: "Pesanan Tidak Dapat Dibatalkan!",
			text: "Pesanan telah dikonfirmasi",
			icon: "error",
			button: "Oke",
		});
		@endif
		
	});

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