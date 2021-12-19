@extends("layouts.home")

@section('title-header')
Keranjang Belanja
@endsection

@section('header')
<style>
	.pagination_button{
		font-size: 20px;
		font-weight: 700;
		margin: 5px;
		width: 40px;
		height: 40px;
		border: none;
		background-color: transparent;
	}
	.pagination_button_active{
		font-size: 20px;
		font-weight: 700;
		margin: 5px;
		width: 40px;
		height: 40px;
		border: none;
		background-color: red;
	}
</style>
@endsection

@section('body')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center" style="background: none; ">
	<div class="container position-relative" data-aos="fade-up" data-aos-delay="100" style="padding-top: 0em;">
		<div class="row">
			<div class="col-md-12" style="padding: 0px;">
				<div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
					<div class="icon-boxes" style="margin-top: 0em; display: flex; justify-content: space-between;"> 

						@for ($i = 0; $i < 12; $i++)
						<a href="<?=url('/')?>/kategori/{{$kategori[$i]->kategori}}" data-aos="zoom-in" data-aos-delay="200" style="width: 8%; display: flex; flex-direction: column;justify-content: center; align-items: center;">
							<div class="icon-box" style="padding: 0px; background: none; box-shadow: none; width: 100%; display: flex;justify-content: center; flex-direction: column; align-items: center;">
								@php
								$url = url('/')."/public/icon_kategori/thumbnail/150x150/".$kategori[$i]->logo;
								@endphp
								<div style="display: flex; justify-content: center; width: 100%; background-image: url('{{$url}}'); height: 70px; width: 70px; background-size: cover; border-radius: 50%; box-shadow:0 2px 5px rgb(0 0 0 / 40%); border: 2px solid #ec1f25;" >
								</div>
								<div style="font-size: 1em; height: 2em; line-height: 1em; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; vertical-align: center;"><b>{{$kategori[$i]->kategori}}</b></div>
							</div>
						</a>
						@endfor
					</div>
					<div class="icon-boxes" style="margin-top: 1em; display: flex; justify-content: space-between;"> 
						@for ($i = 12; $i < 24; $i++)
						<a href="<?=url('/')?>/kategori/{{$kategori[$i]->kategori}}" data-aos="zoom-in" data-aos-delay="200" style="width: 8%; display: flex; flex-direction: column;justify-content: center; align-items: center;">
							<div class="icon-box" style="padding: 0px; background: none; box-shadow: none; width: 100%; display: flex;justify-content: center; flex-direction: column; align-items: center;">
								@php
								$url = url('/')."/public/icon_kategori/thumbnail/150x150/".$kategori[$i]->logo;
								@endphp
								<div style="display: flex; justify-content: center; width: 100%; background-image: url('{{$url}}'); height: 70px; width: 70px; background-size: cover; border-radius: 50%; box-shadow:0 2px 5px rgb(0 0 0 / 40%); border: 2px solid #ec1f25;" >
								</div>
								<div style="font-size: 1em; height: 2em; line-height: 1em; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; vertical-align: center;"><b>{{$kategori[$i]->kategori}}</b></div>
							</div>
						</a>
						@endfor
					</div>
					<div class="icon-boxes" style="margin-top: 0em; display: flex; justify-content: space-between; display: none;"> 		

					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 1em;">
			<div class="col-md-12" style="padding: 0px;">
				<div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
					<div class="row team" style="padding: 1em;" id="data_produk">
						@include('user.pencarian.data_pencarian')
						<div>
							<button class="pagination_button"><</button>
							@foreach ($list_page as $data)
							@if ($page == $data)
							<a href="/pencarian?keyword={{$keyword}}&page={{$data}}">
								<button class="pagination_button_active">{{$data}}</button>
							</a>
							@else
							<a href="<?=url('/')?>/pencarian?keyword={{$keyword}}&page={{$data}}">
								<button class="pagination_button">{{$data}}</button>
							</a>
							@endif

							@endforeach
							<button class="pagination_button">></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section('footer')
<script>

	function tambah_keranjang(id){
		$.ajax({
			url: "<?=url('/')?>/tambah_keranjang/"+id,
			type:"get",
			success:function(data){
				console.log(data);
			}
		})
	}
</script>

@endsection

<!-- ======= Header ======= -->



