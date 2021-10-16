@extends("layouts.home")

@section('title-header')
Keranjang Belanja
@endsection

@section('header')

@endsection

@section('body')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center" style="background: none; ">
	<div class="container position-relative" data-aos="fade-up" data-aos-delay="100" style="padding-top: 0em;">
		<div class="row">
			<div class="col-md-12" style="padding: 0px;">
				<div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
					<div class="icon-boxes" style="margin-top: 0em; display: flex; justify-content: space-between;"> 		
						@php
						$nama = array('Bakso', 'Buah Sayur', 'Bumbu', 'Daging', 'Ikan', 'Kecap Saus', 'Kue', 'Lainnya', 'Roti', 'Sosis','Kecap Saus', 'Kue', 'Lainnya', 'Roti', 'Sosis');
						$file = array('baso_1.jpg', 'buah_sayur.jpg', 'bumbu.jpg', 'daging.jpg', 'ikan.jpg', 'kecap_saus.jpg', 'kue.jpg', 'lainnya.jpg', 'roti.jpg', 'sossis.jpg','kecap_saus.jpg', 'kue.jpg', 'lainnya.jpg', 'roti.jpg', 'sossis.jpg');
						@endphp
						<a href="#" data-aos="zoom-in" data-aos-delay="200" style="width: 8%; display: flex; flex-direction: column;justify-content: center; align-items: center;">
							<div class="icon-box" style="padding: 0px; background: none; box-shadow: none; width: 100%; display: flex;justify-content: center; flex-direction: column; align-items: center;">
								@php
								$url = url('/')."/icon_kategori/$kategori_current->logo";
								@endphp
								<div style="display: flex; justify-content: center; width: 100%; background-image: url('{{$url}}'); height: 70px; width: 70px; background-size: cover; border-radius: 50%; box-shadow:0 2px 5px rgb(0 0 0 / 40%); border: 2px solid #ec1f25;" >
								</div>
								<div style="text-align: center; font-size: 1em;"><b>{{$kategori_current->kategori}}</b></div>
							</div>
						</a>
						@foreach ($list_kategori as $data)
						<a href="/kategori/{{$data->kategori}}" data-aos="zoom-in" data-aos-delay="200" style="width: 8%; display: flex; flex-direction: column;justify-content: center; align-items: center;">
							<div class="icon-box" style="padding: 0px; background: none; box-shadow: none; width: 100%; display: flex;justify-content: center; flex-direction: column; align-items: center;">
								@php
								$url = url('/')."/icon_kategori/$data->logo";
								@endphp
								<div style="display: flex; justify-content: center; width: 100%; background-image: url('{{$url}}'); height: 70px; width: 70px; background-size: cover; border-radius: 50%; box-shadow:0 2px 5px rgb(0 0 0 / 40%); border: 2px solid #ec1f25;" >
								</div>
								<div style="text-align: center; font-size: 1em;"><b>{{$data->kategori}}</b></div>
							</div>
						</a>
						@endforeach
					</div>
					<div class="icon-boxes" style="margin-top: 0em; display: flex; justify-content: space-between; display: none;"> 		

					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 1em;">
			<div class="col-md-12" style="padding: 0px;">
				<div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
					<div class="row team" style="margin-top: 20px; margin-left: 20px">
						<button onclick="sub_kategori('semua')" id="sub_kategori_semua" type="button" class="btn btn-danger d-flex align-items-stretch" style="margin: 5px; border-radius: 10px; border: 1px solid red">Semua</button>
						@php
						$index_sub_kategori = 0;
						@endphp
						@foreach ($kategori_current->sub_kategori as $sub_kategori)

						<button onclick="sub_kategori('{{$index_sub_kategori}}')" id="sub_kategori_{{$index_sub_kategori}}" type="button" class="btn btn-outline-danger d-flex align-items-stretch" style="margin: 5px; border-radius: 10px; border: 1px solid red">{{$sub_kategori->sub_kategori}}</button>
						@php
						$index_sub_kategori++;
						@endphp
						@endforeach
					</div>
					<hr>
					<div class="row team" style="padding: 1em;" id="div_data_sub_kategori">
						@include('home.kategori.sub_kategori.desktop')
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section('footer')
<script>
	var index_sub_kategori = {!! json_encode($index_sub_kategori) !!};
	var kategori = {!! json_encode($kategori_current) !!}
	var list_sub_kategori = <?php echo json_encode($kategori_current->sub_kategori); ?>

	function sub_kategori(sub_kategori){
		$("#sub_kategori_semua").removeClass("btn-danger")
		for(let i = 0; i<index_sub_kategori; i++){
			$("#sub_kategori_"+i).removeClass("btn-danger")
		}

		$("#sub_kategori_semua").removeClass("btn-outline-danger")
		for(let i = 0; i<list_sub_kategori.lenght; i++){
			$("#sub_kategori_"+i).removeClass("btn-outline-danger")
		}

		$('#sub_kategori_'+sub_kategori).removeClass('btn-outline-danger').addClass("btn-danger")
		if(sub_kategori == "semua"){
			ajax_produk(kategori['kategori'], 'semua');
		}else{
			ajax_produk(list_sub_kategori[sub_kategori]['id'], 'sub_kategori');
		}

	}

	function ajax_produk(sub_kategori, keterangan){
		console.log(sub_kategori);
		$.ajax({
			url: "<?=url('/')?>/get_produk_sub_kategori?sub_kategori="+sub_kategori+"&jenis="+keterangan,
			type: "get",
			success:function(data){
					// console.log(data);
					$('#div_data_sub_kategori').empty();
					$('#div_data_sub_kategori').append(data.html);
				}
			});
	}

	
</script>

@endsection

<!-- ======= Header ======= -->



