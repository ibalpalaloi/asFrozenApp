@extends("layouts.user_payment")

@section('title-header')
Pesanan
@endsection

@section('body')
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
<section id="" class="d-flex align-items-center" style="background: none; ">
	<div class="container" style="padding-top: 40px;" >
		@foreach ($notas as $nota)
		<div class="card shadow p-3 mb-5 bg-white rounded">
			@if ($nota->status == "menunggu konfirmasi")
			<div class="alert alert-primary" style="font-size: 17px" role="alert">
				Menunggu Konfirmasi Pesanan
				<div style="float: right">
					<img src="<?=url('/')?>/katalog_assets/img/icons/chronometer.png" alt="" width="30px">
				</div>
			</div>
			@elseif ($nota->status == "packaging")
			<div class="alert alert-warning"  role="alert">
				Pesanan Sementara Packaging
				<div style="float: right">
					<img src="<?=url('/')?>/katalog_assets/img/icons/packaging.png" alt="" width="35px">
				</div>
			</div>
			@else
			<div class="alert alert-success"  role="alert">
				Pesanan Telah Diantarkan
				<div style="float: right">
					<img src="<?=url('/')?>/katalog_assets/img/icons/delivery.png" alt="" width="35px">
				</div>
			</div>
			@endif
			<table class="table" >
				<thead>
					<th style=""></th>
					<th style="text-align: center;">Harga Satuan</th>
					<th style="text-align: center;">Jumlah</th>
					<th style="text-align: center;">Subtotal</th>
				</thead>
				<tbody>
					@foreach ($nota->pesanan as $pesanan)
					<tr>
						<td>
							<div style="width: 100%; display: flex; margin-bottom: 0em;">
								<div style="width: 10%;">
									<img class="img-fluid" src="<?=url('/')?>/img/produk/thumbnail/300x300/{{$pesanan->produk->foto}}" style="width: 100%; border-radius: 0.2em; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
								</div>
								<div style="width: 85%; margin-left: 1em; display: flex; align-items: center;">
									{{$pesanan->produk->nama}}
								</div>
							</div>
						</td>
						<td>
							<div style="display: flex; justify-content: space-between;">
								<div>Rp.</div> <div>{{number_format($pesanan->harga_satuan, 0, '.', '.')}}</div>
							</div>
						</td>
						<td style="text-align: center;">x{{$pesanan->jumlah}}</td>
						<td>
							<div style="display: flex; justify-content: space-between;">
								<div>Rp.</div> <div>{{number_format($pesanan->jumlah * $pesanan->harga_satuan, 0, '.', '.')}}</div>
							</div>									
						</td>
					</tr>
					@endforeach
				</tbody>							
			</table>
			<div class="row" style="margin-left: 0.5em;margin-right: 0.5em;">
				<div class="col-md-4">
					<b>Diantarkan ke alamat</b><br>
					{{$nota->penerima}} | {{$nota->no_telp_penerima}}<br>
					{{$nota->alamat}}<br>
					{{$nota->kelurahan}}, {{$nota->kecamatan}}, {{$nota->kota}} <br>
				</div>
				<div class="col-md-4">
					<b>Transfer melalui</b><br>
					<div class="checkout-bank-transfer-item__card" style="display: flex;">
						<div class="checkout-bank-transfer-item__icon-container">
							<img src="https://mall.shopee.co.id/static/images/img_bankid_bni.png" class="checkout-bank-transfer-item__icon" style="width: 2em; margin-right: 1em; width: 4em;">
						</div>
						<div>
							<div class="checkout-bank-transfer-item__main" style="line-height: 0.8em;">
								Bank BNI
							</div>
							<div class="checkout-bank-transfer-item__description">
								<small>Perlu upload bukti transfer</small>
							</div>
							<div>(Dicek Manual)</div>
						</div>
					</div>
				</div>
				<div class="col-md-4" style="display: flex;">
					<img src="<?=url('/')?>/katalog_assets/assets/qrcode.png" style="width: 6em; height: 6em;">
					<div style="margin-top: 0.2em;width: 100%;">
						<div class="row">
							<div class="col-md-6">		
								Subtotal
							</div>
							<div class="col-md-6" style="display: flex; justify-content: space-between;">		
								<div>: Rp.</div>
								<div>{{number_format($nota->total_harga, 0, '.', '.')}}</div>
							</div>

						</div>
						<div class="row">
							<div class="col-md-6">		
								Ongkir
							</div>
							<div class="col-md-6" style="display: flex; justify-content: space-between;">		
								<div>: Rp.</div>
								<div>{{number_format($nota->ongkos_kirim, 0, '.', '.')}}</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">		
								<b>Total</b>
							</div>
							<div class="col-md-6" style="display: flex; justify-content: space-between;">		
								<div>: Rp.</div>
								<div><b>{{number_format($nota->ongkos_kirim + $nota->total_harga, 0, '.', '.')}}</b></div>
							</div>

						</div>

					</div>
				</div>
			</div>
			<hr>
			<div class="template-demo" style="display: flex;">
				@if ($status_pesanan != "telah diantarakan")
				<a href="/batalkan-pesanan/{{$nota->id}}" type="button" class="btn btn-danger btn-lg" style="margin: 10px">Batalkan</a>

				@endif
				<button onclick="hubungi_penjual()" type="button" class="btn btn-success" style="margin: 10px">Hubungi Penjual</button>
			</div>
		</div>
		@endforeach
	</div>
</section>

@endsection


@section('footer')
<script>
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