@extends("layouts.home_mobile")

@section('title')
Biodata
@endsection

@section('content')
<section id="hero" class="d-flex align-items-center" style="background: none; margin-bottom: 8em;">
	<div class="container" style="padding-top: 80px; padding-bottom: 25em;" >
		@foreach ($notas as $nota)
		<div class="card shadow p-3 bg-white rounded">
			@if ($nota->status == "menunggu konfirmasi")
			<div class="alert alert-primary" style="font-size: 17px" role="alert">
				Menunggu Konfirmasi Pesanan
				<div style="float: right">
					<img src="<?=url('/')?>/public/katalog_assets/img/icons/chronometer.png" alt="" width="30px">
				</div>
			</div>
			@elseif ($nota->status == "packaging")
			<div class="alert alert-warning"  role="alert">
				Pesanan Sementara Packaging
				<div style="float: right">
					<img src="<?=url('/')?>/public/katalog_assets/img/icons/packaging.png" alt="" width="35px">
				</div>
			</div>
			@else
			<div class="alert alert-success"  role="alert">
				Pesanan Telah Diantarkan
				<div style="float: right">
					<img src="<?=url('/')?>/public/katalog_assets/img/icons/delivery.png" alt="" width="35px">
				</div>
			</div>
			@endif

			@php
			$total_harga_pesanan = 0;
			@endphp
			@foreach ($nota->pesanan as $pesanan)
			<div style="width: 100%; display: flex; margin-bottom: 0.5em;">
				<div style="width: 30%;">
					<img class="img-fluid" src="<?=url('/')?>./public/img/produk/thumbnail/300x300/{{$pesanan->produk->foto}}" style="width: 100%; border-radius: 0.2em; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
				</div>
				<div style="width: 70%; margin-left: 1em; display: flex; align-items: flex-start; flex-direction: column; justify-content: space-between;">
					<div>
						<div>{{$pesanan->produk->nama}}</div>						
						<div style="display: flex; justify-content: flex-start;">

							@php 
							$harga_diskon = $pesanan->harga_satuan;
							@endphp
							<div>Rp.</div> <div>{{number_format($harga_diskon, 0, '.', '.')}}</div>
							&nbsp;x&nbsp;{{$pesanan->jumlah}}
						</div>
					</div>
					<div>
						<b>
							@php

							$sub_total = $harga_diskon * $pesanan->jumlah;
							$total_harga_pesanan += $sub_total;

							@endphp
							<div style="display: flex; justify-content: space-between;">
								<div>Rp.&nbsp;</div> <div>{{number_format($sub_total, 0, '.', '.')}}</div>
							</div>	
						</b>								
					</div>
				</div>
			</div>
			<hr>
			@php
			$total_harga_pesanan += $pesanan->jumlah * $pesanan->harga_satuan;
			@endphp
			@endforeach

			<div class="row" style="margin-left: 0.5em;margin-right: 0.5em;">
				<div style="width: 100%;">
					<div style="width: 100%;">
						@if ($nota->pengantaran == 'Diantarkan')
						<b>Diantarkan ke alamat</b><br>
						{{$nota->penerima}} | {{$nota->no_telp_penerima}}<br>
						{{$nota->alamat}}<br>
						{{$nota->kelurahan}}, {{$nota->kecamatan}}, {{$nota->kota}}
						@else
						<b>Ambil ditempat</b><br>
						{{$nota->penerima}} | {{$nota->no_telp_penerima}}<br>
						Toko AsFrozen, Jl. Mandala No. 1<br>
						Birobuli Utara, Palu Selatan, Kota Palu					
						@endif
					</div>
					<hr>
				</div>
				<div style="display: flex; width: 100%;">
					<div style="width: 42%;">
						@if ($nota->pembayaran == 'COD')
						<b>Cash On Delivery</b><br>
						<div class="checkout-bank-transfer-item__card" style="display: flex; margin-top: 0.5em;">
							<div class="checkout-bank-transfer-item__icon-container">
								<img src="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_palu_red.png" class="checkout-bank-transfer-item__icon" style="width: 2em; margin-right: 1em; width: 3em;">
							</div>
						</div>
						@else
						<b>Transfer melalui</b><br>
						<div class="checkout-bank-transfer-item__card" style="display: flex; margin-top: 0.5em;">
							<div class="checkout-bank-transfer-item__icon-container">
								<img src="<?=url('/')?>/public/bank/{{$nota->bank->img}}" class="checkout-bank-transfer-item__icon" style="margin-right: 0.5em; width: 3em;">
							</div>
							<div>
								<div class="checkout-bank-transfer-item__main" style="line-height: 1.2em; font-size: 0.95em; margin-top: 0.5em;">
									{{$nota->bank->nama_bank}}
								</div>
								<div style="display: flex;"><small>Cek Manual</small></div>

							</div>
						</div>
						@endif
					</div>
					<div style="width: 58%; display: flex; padding-top: 1em;">
						<img src="<?=url('/')?>/public/katalog_assets/assets/qrcode.png" style="width: 4.5em; height: 4.5em;">
						<div style="margin-top: 0.2em;width: 100%;">
							<div style="display: flex; justify-content: space-between;">
								<div style="font-size: 0.95em;">		
									Sub
								</div>
								<div style="display: flex; justify-content: space-between; font-size: 0.95em;">		
									<div>Rp.</div>
									<div>{{number_format($total_harga_pesanan, 0, '.', '.')}}</div>
								</div>

							</div>
							<div style="display: flex; justify-content: space-between; font-size: 0.95em;">
								<div>		
									Ongkir
								</div>
								<div style="display: flex; justify-content: space-between;">		
									<div>Rp.</div>
									<div>{{number_format($nota->ongkos_kirim, 0, '.', '.')}}</div>
								</div>
							</div>
							<div style="display: flex; justify-content: space-between;font-size: 0.95em;">
								<div>		
									<b>Total</b>
								</div>
								<div style="display: flex; justify-content: space-between;">		
									<div>Rp.</div>
									<div><b>{{number_format($nota->ongkos_kirim + $total_harga_pesanan, 0, '.', '.')}}</b></div>
								</div>

							</div>

						</div>
					</div>
					<hr>
				</div>
			</div>
			<hr>
			<div class="template-demo" style="display: flex;">
				@if ($nota->status == "menunggu konfirmasi")
				<a href="<?=url('/')?>/batalkan-pesanan/{{$nota->id}}" type="button" class="btn btn-danger btn-lg" style="margin: 10px">Batalkan</a>

				@endif
				<button onclick="hubungi_penjual()" type="button" class="btn btn-success" style="margin: 10px">Hubungi Penjual</button>
			</div>
		</div>
		@endforeach
	</div>
</section>

@endsection

@section('footer-scripts')
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
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