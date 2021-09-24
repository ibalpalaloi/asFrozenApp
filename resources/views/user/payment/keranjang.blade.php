@extends("layouts.user_payment")

@section('title-header')
Biodata
@endsection

@section('body')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center" style="background: none; ">
	<div class="container" style="padding-top: 1em;">
		<div class="row">
			<div class="col-8">
				<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;">
					<div class="row" style="padding: 0.5em 1em;">
						@php
						$index = 0;
						$total_harga = 0;
						@endphp
						@foreach ($keranjang as $data)
						<div class="col-md-1" style="display: flex;justify-content: center; align-items: center;">
							<div class="icheck-danger d-inline">
								<input type="checkbox" id="checkboxPrimary{{$index}}" onchange="checkbox_cek('{{$data->id}}', '{{$index}}')" checked="false">
								<label for="checkboxPrimary{{$index}}">
								</label>
							</div>
						</div>
						<div class="col-2">
							<img class="img-fluid" src="<?=url('/')?>/img/produk/thumbnail/300x300/{{$data->produk->foto}}" style="width: 100%; border-radius: 0.2em; margin-bottom: 0.5em;">
						</div>
						<div class="col-5">
							<div class="row">{{$data->produk->nama}}</div>
							<div class="row text-muted">{{$data->produk->harga}}</div>
						</div>
						<div class="col-2" style="padding: 0px; display: flex; align-items: center;">
							<div style="display: flex; align-items: flex-start; padding: 0px; justify-content: flex-start; width: 100%;">
								<div onclick="kurang_pesanan('{{$index}}')" class="btn btn-danger" style="color: black; color: white; width: 25%; border-radius: 0px;"> - </div>
								<div style="width: 50%; border-radius: 0px;" class="btn" id="jumlah_pesanan{{$index}}">{{$data->jumlah}}</div>
								<div onclick="tambah_pesanan('{{$index}}')" class="btn btn-danger" style="color: black; color: white; width: 25%; border-radius: 0px;"> + </div>
							</div>
						</div>
						<div class="col-2" style="display: flex; align-items: center; justify-content: space-between; padding-right: 0px;">
							@php
							$jumlah = $data->jumlah;
							$harga = $data->produk->harga;
							$jumlah_harga = $jumlah * $harga;
							$total_harga += $jumlah_harga;
							@endphp	
							<span >Rp.</span> <span id="sub_total{{$index}}">{{$jumlah_harga}}</span>
						</div>
						@php
						$index++;
						@endphp
						@endforeach
					</div>
				</div>
				<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;">
					<div class="row" style="padding: 0em 1em;">
						<div class="col-8"></div>
						<div class="col-2">Sub Total</div>
						<div class="col-2" style="display: flex; justify-content: space-between; padding-right: 0px;">
							<div>Rp.</div> <div id="harga_total">{{$total_harga}}</div>
						</div>
					</div>
				</div>
				<a href="/keranjang/checkout" class="btn btn-danger" style="padding: 0.8em; font-size: 0.8em;">Proses Pembayaran</a>
			</div>
			<div class="col-4">
				<div class="card shadow p-3 mb-5 bg-white rounded">
					<div class="d-flex align-items-stretch slick-slide slick-active" style="margin-right: 1em; width: 213px;width: 100%; display: flex; flex-wrap: wrap;" tabindex="0" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide11">
						@for ($i = 0; $i < 4; $i++)
						<div class="member" style="position: relative; width: 50%; padding: 0.5em;">
							<div class="member-img">
								<img src="http://localhost/as_frozen/katalog_assets/assets/img/produk/2.jpg" class="img-fluid" alt="">
							</div>
							<div class="member-info" style="padding-top: 0.4em;">
								<small style="font-family: 'Segoe UI',Roboto; font-size: 0.7em;"><s>Rp. 50.000</s>
									<badge class="badge badge-warning" style="font-size: 0.9em;">-50%</badge> 
								</small>
								<h6 style="font-family: 'Segoe UI',Roboto; line-height: 0.7em; font-size: 0.9em;">Rp. 25.000</h6>
								<span style="font-size: 0.8em; line-height: 0.5em;"> {{substr("Fiesta Chicken Nugget", 0, 18) }} ....</span>
								<div class="btn btn-outline-danger" style="margin-top: 0.4em; display: flex; justify-content: center; flex-direction: row; border: 1px solid #dc3545;">
									<div>
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" data-icon="mdi:cart" style="font-size: 1.3em; color:#dc3545;"><path d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25c0-.05.01-.09.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2z" fill="currentColor"></path></svg>&nbsp;&nbsp;
									</div>
									<div>Beli</div>
								</div>
							</div>
						</div>
						@endfor
					</div>

				</div>
			</div>
		</div>

	</div>
</section><!-- End Hero -->
@endsection

@section('footer')
<script type="text/javascript">

	var list_keranjang = {!! json_encode($data_keranjang) !!}

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

	function kurang_pesanan(index){
		var jumlah_pesanan = list_keranjang[index]['jumlah'];
		if(jumlah_pesanan > 1){
			jumlah_pesanan -= 1;
		}
		list_keranjang[index]['jumlah'] = jumlah_pesanan;
		var sub_total = jumlah_pesanan * list_keranjang[index]['harga'];
		$('#jumlah_pesanan'+index).html(jumlah_pesanan);
		$('#sub_total'+index).html(sub_total);
		get_harga_total();
		ubah_jumlah_ajax(list_keranjang[index]['id'], jumlah_pesanan);
	}

	function tambah_pesanan(index){
		var jumlah_pesanan = list_keranjang[index]['jumlah'];
		jumlah_pesanan += 1;
		list_keranjang[index]['jumlah'] = jumlah_pesanan;
		var sub_total = jumlah_pesanan * list_keranjang[index]['harga'];
		$('#jumlah_pesanan'+index).html(jumlah_pesanan);
		$('#sub_total'+index).html(sub_total);
		get_harga_total();
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

	function get_harga_total(){
		var count = Object.keys(list_keranjang).length;
		var harga_total =0;
		for(let i = 0; i<count; i++){
			if(list_keranjang[i]['checked'] == "true"){
				var sub_total = list_keranjang[i]['harga'] * list_keranjang[i]['jumlah'];
				harga_total += sub_total;
			}
		}
		console.log(harga_total);
		$("#harga_total").html(harga_total);
	}

	function modal_pesan(){
		$('#exampleModal').modal('show');
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
@endsection