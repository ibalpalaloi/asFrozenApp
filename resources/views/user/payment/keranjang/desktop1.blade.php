@extends("layouts.user_payment")

@section('title-header')
Keranjang
@endsection

@section('body')
<style type="text/css">
	.btn-rekomended:hover {
		color: white !important;
	}
 </style>
<div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form action="{{url()->current()}}/delete" method="post">
				<div class="modal-body">
					{{ csrf_field() }}
					<div style="text-align: center;">
						<input type="text" name="id" id="hapus_id" hidden>
						<i class="fa fa-trash" style="font-size: 5em; color: #dc3545;"></i>
						<h4 style="margin-top: 0.5em;">Apakah anda yakin ingin menghapus produk dari keranjang ?</h4>
						<div style="margin-top: 0.5em;"></div>
					</div>  
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-secondary">Hapus</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" style=" background: #dc3545; border: 1px solid #dc3545;">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center" style="background: none; ">
	<div class="container" style="padding-top: 1em;">
		<div class="row" style="display: flex; justify-content: center;">
			<div class="col-12">
				<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none; display: flex;justify-content: center; align-items: center;">
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
							foreach ($data_keranjang as $data){
								?>
								<div class="col-md-1" style="display: flex;justify-content: center; align-items: center; margin-bottom: 1em;">
									<div class="icheck-danger d-inline">
										<input type="checkbox" id="checkboxPrimary{{$data['id']}}" onchange="checkbox_cek('{{$data['id']}}')" @if ($data['stok'] == 0)
										disabled
										@else
										checked
										@endif >
										<label for="checkboxPrimary{{$data['id']}}">
										</label>
									</div>
								</div>
								<div class="col-2">
									<img class="img-fluid" src="<?=url('/')?>/public/img/produk/thumbnail/300x300/{{$data['foto']}}" style="width: 60%; border-radius: 0.2em; margin-bottom: 0.5em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
								</div>
								<div class="col-5">
									<div class="row">
										{{$data['nama_produk']}} &nbsp;

									</div>
									<div class="row text-muted" style="display: flex; flex-direction: column;">
										@if ($data['diskon'] != "0")
										<div style="display: flex;">
											<div><s>Rp. {{number_format($data['harga'],0,'.','.')}}</s>&nbsp;</div>
											<badge class="badge badge-success" style="display: flex; justify-content: center; align-items: center;">{{$data['diskon']}} %</badge>	
										</div>
										<div>Rp. {{number_format($data['harga_diskon'],0,'.','.')}}</div>
										@else
										Rp. {{number_format($data['harga'],0,'.','.')}}&nbsp;
										@endif
										<div><span class="iconify" data-icon="bi:trash-fill" style="color:#dc3545;" onclick="hapus_keranjang('{{$data['id']}}')"></span></div>
									</div>
								</div>
								<div class="col-2" style="padding: 0px; display: flex; align-items: center; flex-direction: column;">
									<div style="display: flex; align-items: flex-start; padding: 0px; justify-content: flex-start; width: 100%; margin-top: 20px">
										<div onclick="kurang_pesanan('{{$data['id']}}', '{{$data['harga_diskon']}}')" class="btn btn-danger" style="color: black; color: white; width: 25%; border-radius: 0px;"> - </div>
										<div style="width: 50%; border-radius: 0px;" class="btn" id="jumlah_pesanan{{$data['id']}}">{{$data['jumlah']}}</div>
										<div onclick="tambah_pesanan('{{$data['id']}}', '{{$data['harga_diskon']}}')" class="btn btn-danger" style="color: black; color: white; width: 25%; border-radius: 0px;"> + </div>
									</div>
									<div style="font-size: 13px">stok : {{$data['stok']}}</div>
								</div>
								<div class="col-2" style="display: flex; align-items: center; justify-content: space-between; padding-right: 0px;">
									
									<span >Rp.</span> <span id="sub_total{{$data['id']}}">{{number_format($data['jumlah'] * $data['harga_diskon'], 0, '.', '.')}}</span>
								</div>
								<?php
							}
						}?>
					</div>
				</div>
				@if ($keranjang->count() > 0)
				<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;">
					<div class="row" style="padding: 0em 1em;">
						<div class="col-8"></div>
						<div class="col-2">Sub Total</div>
						<div class="col-2" style="display: flex; justify-content: space-between; padding-right: 0px;">
							<div>Rp.</div> <div id="harga_total">{{number_format($harga_total, 0, '.', '.')}}</div>
						</div>
					</div>
				</div>
				<a href="<?=url('/')?>/keranjang/checkout" class="btn btn-danger" style="padding: 0.8em; font-size: 0.8em;">Proses Pembayaran</a>
				@else
				<a href="<?=url('/')?>" class="btn btn-danger" style="padding: 0.7em; font-size: 1.1em;">Belanja Sekarang</a>
				@endif
			</div>
			<div class="col-4" hidden>
				<div class="card shadow p-3 mb-5 bg-white rounded">
					<div class="d-flex align-items-stretch slick-slide slick-active" style="margin-right: 1em; width: 213px;width: 100%; display: flex; flex-wrap: wrap;" tabindex="0" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide11">
						@foreach ($rekomendasi_produk as $data)
						<div class="member" style="position: relative; width: 50%; padding: 0.5em;">
							<div class="member-img">
								<img src="<?=url('/')?>/public/img/produk/thumbnail/300x300/{{$data->foto}}" class="img-fluid" alt="">
							</div>
							<div class="member-info" style="padding-top: 0.4em;">
								@if ($data->diskon)
								@php
								$potongan_diskon = ($data->diskon->diskon/100) * $data->harga;
								$harga_diskon = $data->harga - $potongan_diskon;
								@endphp
								@if ($data->diskon->diskon > 0)
								<small style="font-family: 'Segoe UI',Roboto; font-size: 0.7em;"><s>Rp. {{number_format($data->harga, 0, '.', '.')}}</s>
									<badge class="badge badge-warning" style="font-size: 0.9em;">-{{$data->diskon->diskon}}%</badge> 
								</small>
								<h6 style="font-family: 'Segoe UI',Roboto; line-height: 0.7em; font-size: 0.9em;">Rp. {{number_format($harga_diskon, 0, '.', '.')}}</h6>

								@else
								<h6 style="font-family: 'Segoe UI',Roboto; line-height: 0.7em; font-size: 0.9em;">Rp. {{number_format($harga_diskon, 0, '.', '.')}}</h6>
								@endif
								@else
								<h6 style="font-family: 'Segoe UI',Roboto; line-height: 0.7em; font-size: 0.9em;">Rp. {{number_format($data->harga, 0, '.', '.')}}</h6>
								@endif
								
								
								<span style="font-size: 0.8em; line-height: 0.5em;"> @if (strlen($data->nama) > 15) {{substr($data->nama, 0, 15)}}... @else {{$data->nama}} @endif</span>
								<a onclick="tambah_keranjang('{{$data->id}}')"  class="btn btn-rekomended" style="display: flex; justify-content: center; flex-direction: row; border: 1px solid #dc3545;">
									<div>
										<span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; color: #dc3545;"></span>&nbsp;&nbsp;
									</div>
									<div style="color: #dc3545;">Beli</div>
								</a>
							</div>
						</div>
						@endforeach
					</div>

				</div>
			</div>
		</div>

	</div>
</section><!-- End Hero -->
@endsection

@section('footer')
<script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('user.payment.keranjang.keranjang_script')
<script type="text/javascript">
	function hapus_keranjang(id){
		$("#hapus_id").val(id);
		// alert(id);
		$("#modal_hapus").modal('show');
	}


</script>
@endsection