<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>OnePage Bootstrap Template - Index</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?=url('/')?>/katalog_assets/assets/img/favicon.png" rel="icon">
	<link href="<?=url('/')?>/katalog_assets/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?=url('/')?>/katalog_assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=url('/')?>/katalog_assets/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link href="<?=url('/')?>/katalog_assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?=url('/')?>/katalog_assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?=url('/')?>/katalog_assets/assets/vendor/venobox/venobox.css" rel="stylesheet">
	<link href="<?=url('/')?>/katalog_assets/assets/vendor/aos/aos.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick-theme.css"/>
	<!-- Template Main CSS File -->
	<link href="<?=url('/')?>/katalog_assets/assets/css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
	<style type="text/css">
		.nav-menu a{
			color: white;
		}

		a {
			color: #212529;
		}


		.slick-slide  {
			/*width: 0 !importantl*/
		}

		.slick-prev:before {
			color: black;
		}
		.slick-next:before {
			color: black;
		}
		a:hover {
			text-decoration: none;			
		}

		.shopee-searchbar {
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-align-items: stretch;
			-moz-box-align: stretch;
			-ms-flex-align: stretch;
			align-items: stretch;
			-webkit-justify-content: space-between;
			-moz-box-pack: justify;
			-ms-flex-pack: justify;
			justify-content: space-between;
			height: 2.5rem;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: .1875rem;
			border-radius: 2px;
			background: #fff;
		}

		.shopee-searchbar-input, .shopee-searchbar__main {
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-flex: 1;
			-moz-box-flex: 1;
			-ms-flex: 1;
			flex: 1;
		}
		.header-with-search-wrapper .shopee-searchbar-input {
			background-color: #fff;
			border-color: #fff;
		}
		.shopee-searchbar-input {
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding-left: .625rem;
		}
		.shopee-searchbar-input, .shopee-searchbar__main {
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-flex: 1;
			-moz-box-flex: 1;
			-ms-flex: 1;
			flex: 1;
		}
		.shopee-searchbar-input__input {
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-flex: 1;
			-moz-box-flex: 1;
			-ms-flex: 1;
			flex: 1;
			-webkit-align-items: center;
			-moz-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			outline: none;
			border: 0;
			padding: 0;
			margin: 0;
		}
		input {
			line-height: normal;
			font-family: "Open Sans", sans-serif;
		}

		.header-with-search-wrapper .shopee-searchbar>.btn-solid-primary {
			background: #ec1f25;
		}

		.btn-solid-primary {
			color: #fff;
			background: #ec1f25;
		}
		.btn--s {
			height: 34px;
			padding: 0 15px;
			min-width: 60px;
			max-width: 190px;
		}
		.btn--inline {
			display: -webkit-inline-flex;
			display: -moz-inline-box;
			display: -ms-inline-flexbox;
			display: inline-flex;
		}
		.btn {
			overflow: hidden;
			display: -webkit-box;
			text-overflow: ellipsis;
			-webkit-line-clamp: 1;
			-webkit-flex-direction: column;
			-moz-box-orient: vertical;
			-moz-box-direction: normal;
			-ms-flex-direction: column;
			flex-direction: column;
			font-size: 14px;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			box-shadow: 0 1px 1px 0 rgb(0 0 0 / 9%);
			border-radius: 2px;
			border: 0;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-align-items: center;
			-moz-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			-webkit-justify-content: center;
			-moz-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			text-transform: capitalize;
			outline: 0;
			cursor: pointer;
		}		

		# Team
		--------------------------------------------------------------*/
		.team .member {
			margin-bottom: 20px;
			overflow: hidden;
			text-align: center;
			border-radius: 4px;
			background: #fff;
			box-shadow: 0px 2px 15px rgba(18, 66, 101, 0.08);
		}

		.team .member .member-img {
			position: relative;
			overflow: hidden;
		}

		.team .member .social {
			position: absolute;
			left: 0;
			bottom: 0;
			right: 0;
			height: 40px;
			opacity: 0;
			transition: ease-in-out 0.3s;
			text-align: center;
			background: rgba(255, 255, 255, 0.85);
		}

		.team .member .social a {
			transition: color 0.3s;
			color: #124265;
			margin: 0 10px;
			padding-top: 8px;
			display: inline-block;
		}

		.team .member .social a:hover {
			color: #2487ce;
		}

		.team .member .social i {
			font-size: 18px;
			margin: 0 2px;
		}

		.team .member .member-info {
			padding: 25px 15px;
		}

		.team .member .member-info h4 {
			font-weight: 700;
			margin-bottom: 5px;
			font-size: 18px;
			color: #124265;
		}

		.team .member .member-info span {
			display: block;
			font-size: 13px;
			font-weight: 400;
			color: #aaaaaa;
		}

		.team .member .member-info p {
			font-style: italic;
			font-size: 14px;
			line-height: 26px;
			color: #777777;
		}

		.team .member:hover .social {
			opacity: 1;
		}		

		/*brambang*/
		#ck-wrapperWhyBrambang {
			overflow: hidden;
			text-align: center;
			width: 100%;
			height: auto;
			background-color: #f4f4f4;
			box-shadow: none;
			margin-bottom: -22px;
			margin-top: 0;
		}
		#WhyBrambangContainer {
			display: block;
			width: 940px;
			text-align: justify;
			margin: auto auto 4px;
			overflow: hidden;
			background: #fff;
			border-radius: 10px;
			box-shadow: 0 6px 14px 0 rgb(0 0 0 / 12%);
			z-index: 1;
			padding: 30px 0 0 10px;
		}
		#WhyBrambangContainer, #ck-cardContainer, .card-area, .productcat, .swiperdesc, a.anchor {
			position: relative;
		}

		.wrapperWhyBrambangCard {
			display: inline-block;
			margin: auto auto 30px;
			float: none !important;
			overflow: hidden;
			width: 225px;
			padding: 14px 0;
			vertical-align: top;
		}
		.clear {
			display: block;
			clear: both;
		}

		#ck-wrapper {
			overflow: hidden;
			text-align: center;
			width: 100%;
			padding-top: 225px;
			background-color: #fff;
			background-image: radial-gradient(circle at 50% 50%,#ffdc66,#ffc400);
			box-shadow: 0 -2px 4px 0 rgb(0 0 0 / 8%);
			height: 55%;
			margin-top: -155px;
			z-index: -1;
		}


		div.WhyBrambangTitle {
			font-size: 18px;
			line-height: 1;
			letter-spacing: .5px;
			text-align: center;
			color: #000;
			margin-top: 0;
			vertical-align: middle;
		}
		.ck-wrapperWhyBrambang-image {
			width: 53.9px;
			height: 58.5px;
			margin: auto auto 20px;
		}

		div.WhyBrambangTitle {
			font-size: 18px;
			line-height: 1;
			letter-spacing: .5px;
			text-align: center;
			color: #000;
			margin-top: 0;
			vertical-align: middle;
		}

		div.WhyBrambangSubTitle {
			margin-top: 10px;
			font-family: Nunito;
			font-size: 14px;
			line-height: 1.29;
			letter-spacing: .5px;
			text-align: center;
			color: #000;
		}

		div.WhyBrambangTitle, div.ck-title {
			font-family: MyriadPro;
			font-weight: 600;
			font-style: normal;
			font-stretch: normal;
		}		

		div.title-index {
			font-size: 24px;
			color: #000;
			margin-top: 30px;
			margin-bottom: 15px;
		}

		.btnAllProduct, div.title-index {
			font-style: normal;
			font-stretch: normal;
			line-height: normal;
			letter-spacing: .5px;
			text-align: center;
			font-family: MyriadPro;
			font-weight: 700;
		}		
	</style>
  <!-- =======================================================
  * Template Name: OnePage - v2.2.2
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top" style="background: linear-gradient(0deg, hsla(20, 70%, 52%, 1) 0%, hsla(358, 84%, 52%, 1) 100%); border-bottom: none; box-shadow:0 1px 1px rgb(0 0 0 / 20%);">
		<div class="container d-flex align-items-center">
			<h1 class="logo mr-auto">
				<div style="">
					<img src="<?=url('/')?>/katalog_assets/assets/img/logo/frozen_palu_white.png" style="width: 120%;">
				</div>
			</h1>
			<div style="width: 100%; margin-left: 5%; margin-right: 5%;">
				<div class="shopee-searchbar shopee-searchbar--focus" style="width: 100%;">
					<div class="shopee-searchbar__main" style="position: relative;">
						<form role="search" class="shopee-searchbar-input" autocomplete="off">
							<input aria-label="Jiniso Diskon s/d 80%" class="shopee-searchbar-input__input" maxlength="128" placeholder="Temukan kebutuhanmu disini" autocomplete="off" value="">
						</form>
					</div>
					<button type="button" class="btn btn-solid-primary btn--s btn--inline">
						<span class="iconify" data-icon="mdi:magnify" style="color: white; font-size: 2em;"></span>
					</button>
				</div>
			</div>
			<a href="<?=url('/')?>/keranjang" class=""><span class="iconify" data-icon="mdi:cart" style="font-size: 2em; color: white;"></span></a>
		</div>
	</header><!-- End Header -->

	<!-- ======= Hero Section ======= -->
	<section id="hero" class="d-flex align-items-center" style="background: none; ">
		<div class="container position-relative" data-aos="fade-up" data-aos-delay="100" style="padding-top: 0em;">
			<div class="row">
				<div class="col-md-12" style="padding: 0px;">
					<div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
						<div class="icon-boxes" style="margin-top: 0em; display: flex; justify-content: space-between;"> 		
							
							@foreach($kategori as $data)
							<a href="<?=url('/')?>/kategori/{{$data->kategori}}" data-aos="zoom-in" data-aos-delay="200" style="width: 8%; display: flex; flex-direction: column;justify-content: center; align-items: center;">
								<div class="icon-box" style="padding: 0px; background: none; box-shadow: none; width: 100%; display: flex;justify-content: center; flex-direction: column; align-items: center;">
									@php
									$url = url('/')."/icon_kategori/$data->logo";
									@endphp
									<div style="display: flex; justify-content: center; width: 100%; background-image: url('{{$url}}'); height: 70px; width: 70px; background-size: cover; border-radius: 50%; box-shadow:0 2px 5px rgb(0 0 0 / 40%); border: 2px solid #ec1f25;" >
									</div>
									<div style="text-align: center; font-size: 0.8em;">{{$data->kategori}}</div>
								</div>
							</a>
							@endforeach
						</div>
						<br>

						<div class="icon-boxes" style="margin-top: 0em; display: flex; justify-content: space-between; display: none;"> 		
							@php
							$nama = array('Bakso', 'Buah Sayur', 'Bumbu', 'Daging', 'Ikan', 'Kecap Saus', 'Kue', 'Lainnya', 'Roti', 'Sosis','Kecap Saus', 'Kue', 'Lainnya', 'Roti', 'Sosis');
							$file = array('bakso.jpg', 'buah_sayur.jpg', 'bumbu.jpg', 'daging.jpg', 'ikan.jpg', 'kecap_saus.jpg', 'kue.jpg', 'lainnya.jpg', 'roti.jpg', 'sossis.jpg','kecap_saus.jpg', 'kue.jpg', 'lainnya.jpg', 'roti.jpg', 'sossis.jpg');
							@endphp
							@for ($i = 0; $i < count($file); $i++)
							<a href="#" data-aos="zoom-in" data-aos-delay="200" style="width: 8%; display: flex; flex-direction: column;justify-content: center; align-items: center;">
								<div class="icon-box" style="padding: 0px; background: none; box-shadow: none; width: 100%; display: flex;justify-content: center; flex-direction: column; align-items: center;">
									@php
									$url = url('/')."/katalog_assets/assets/img/kategori_icon/$file[$i]";
									@endphp
									<div style="display: flex; justify-content: center; width: 100%; background-image: url('{{$url}}'); height: 70px; width: 70px; background-size: cover; border-radius: 50%; box-shadow:0 2px 5px rgb(0 0 0 / 40%); border: 2px solid white;" >
									</div>
									<div style="text-align: center; font-size: 0.8em;">{{$nama[$i]}}</div>
								</div>
							</a>
							@endfor
						</div>
			
					</div>
				</div>
			</div>
			<div class="row justify-content-center" style="margin-top: 1em; margin-bottom: 0px;">
				<div class="col-lg-8 text-center" style="padding: 0;">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="<?=url('/')?>/katalog_assets/assets/img/banner/banner1.jpg" class="d-block w-100" alt="...">
							</div>
							<div class="carousel-item">
								<img src="<?=url('/')?>/katalog_assets/assets/img/banner/banner2.jpg" class="d-block w-100" alt="...">
							</div>
							<div class="carousel-item">
								<img src="<?=url('/')?>/katalog_assets/assets/img/banner/banner3.jpg" class="d-block w-100" alt="...">
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
				<div class="col-lg-4" style="padding: 0px; padding-left: 0.2em;">
					<img src="<?=url('/')?>/katalog_assets/assets/img/banner/banner1.jpg" class="d-block w-100" alt="...">
					<img src="<?=url('/')?>/katalog_assets/assets/img/banner/banner3.jpg" class="d-block w-100" alt="..." style="margin-top: 0.2em;">
				</div>
			</div>
			
			<div class="row" style="margin-top: 1em;">
				<div class="col-md-12" style="padding: 0px;">
					<div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
						<div class="row" style="padding-left: 1em; padding-right: 1em; display: flex; justify-content: space-between; align-items: center;">
							<div>
								<img src="<?=url('/')?>/katalog_assets/assets/img/flash-sale2.png" style="width: 10em;">
							</div>
							<a href="<?=url('/')?>/flash-sale" style="color: #ec1f25;">Selengkapnya</a>
						</div>
						<hr>
						<div class="row team" style="padding: 1em;">
							<div class="flash_sale" style="width: 100%;">
								@php
								$produk = array('1.jpg','2.jpg','3.jpg','4.jpg','1.jpg','2.jpg','3.jpg','4.jpg');
								@endphp
								@for ($i = 0; $i < count($produk); $i++)
								<div class="d-flex align-items-stretch" style="margin-right: 1em;">
									<div class="member" style="position: relative;">
										<div class="member-img">
											<img src="<?=url('/')?>/katalog_assets/assets/img/produk/{{$produk[$i]}}" class="img-fluid" alt="">
										</div>
										<div class="member-info" style="padding-top: 0.4em; padding-bottom: 0.8em;">
											<small style="font-family: 'Segoe UI',Roboto;"><s>Rp. 50.000</s>
												<badge class="badge badge-warning">-50%</badge> 
											</small>
											<h4 style="font-family: 'Segoe UI',Roboto;">Rp. 25.000</h4>
											<span>Fiesta Chicken Nugget</span>
											<a href="<?=url('/')?>/login" class="btn btn-danger" style="margin-top: 0.4em; display: flex; justify-content: center; flex-direction: row;">
												<div>
													<span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; color: white;"></span>&nbsp;&nbsp;
												</div>
												<div>Beli</div>
											</a>
										</div>
									</div>
								</div>
								@endfor
							</div>
						</div>
					</div>
				</div>
			</div>
			<div style="margin-bottom: 10px">
				<div class="row" style="margin-top: 20px; padding-left: 0px; padding-right: 0px;  display: flex; justify-content: space-between;">
					<div style="width: 32%;">
						<iframe width="100%" height="220"  src="https://www.youtube.com/embed/qNa5vUG4W08" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 0.5em;"></iframe>
					</div>
					<div style="width: 32%;">
						<iframe width="100%" height="220"  src="https://www.youtube.com/embed/T5nSwojhgTo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 0.5em;"></iframe>
					</div>
					<div style="width: 32%;">
						<iframe width="100%" height="220"  src="https://www.youtube.com/embed/Qqyi1nI1yP0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 0.5em;"></iframe>
					</div>
				</div>
			</div>
			@foreach ($kategori_show as $data)
				<div class="row" style="margin-top: 1em;">
					<div class="col-md-12" style="padding: 0px;">
						<div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
							<div class="row" style="padding-left: 1em; padding-right: 1em; display: flex; justify-content: space-between; align-items: center;">
								<div style="width: 10em;">
									<img src="<?=url('/')?>/katalog_assets/assets/img/menu_bakso.png" style="width: 100%">
									{{$data->kategori}}
								</div>
								<a href="<?=url('/')?>/kategori/daging" style="color: #ec1f25;">Selengkapnya</a>
							</div>
							<hr>
							<div class="row team" style="padding: 1em;">
								<div class="flash_sale" style="width: 100%;">
									@foreach ($data->produk as $produk)
									<div class="d-flex align-items-stretch" style="margin-right: 1em;">
										<div class="member" style="position: relative;">
											<div class="member-img">
												<img src="<?=url('/')?>/img/produk/{{$produk->foto}}" class="img-fluid" alt="">
											</div>
											<div class="member-info" style="padding-top: 0.4em; padding-bottom: 0.8em;">
												@if ($produk->diskon != null)
													@php
														$harga = $produk->harga;
														$diskon = $produk->diskon->diskon;
														$harga_diskon = $harga - ($diskon/100 * $harga)
													@endphp
													<small style="font-family: 'Segoe UI',Roboto;"><s>Rp. {{$produk->harga}}</s>
														<badge class="badge badge-warning">{{$diskon}}%</badge> 
													</small>
													<h4 style="font-family: 'Segoe UI',Roboto;">Rp. {{$harga_diskon}}</h4>
												@else
													<h4 style="font-family: 'Segoe UI',Roboto;">Rp. {{$produk->harga}}</h4>
												@endif
												
												<span>{{$produk->nama}}</span>
												<div onclick="tambah_keranjang('{{$produk->id}}')" class="btn btn-danger" style="margin-top: 0.4em; display: flex; justify-content: center; flex-direction: row;">
													<div>
														<span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; color: white;"></span>&nbsp;&nbsp;
													</div>
													<div>Beli</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			@endforeach

			
			

			

			<hr>
			<div class="btn btn-danger" style="padding: 0.8em;">Lihat Selengkapnya</div>

		</div>

	</section><!-- End Hero -->

	<div id="ck-wrapperWhyBrambang" class="ng-scope" style="background: rgba(255, 255, 255, 0.8);">
		<div class="mobileOnly" style="margin-top:50px;"></div>
		<div class="title-index">Keutungan Beli dari AsFrozen</div>
		<div id="WhyBrambangContainer" style="padding-left: 0px;">
			<div style="display: flex; justify-content: space-around;width: 100%;">
				<div class="wrapperWhyBrambangCard" style=" width: 23%;">
					<div class="ck-wrapperWhyBrambang-image" style="">
						<img src="https://dtq2i388ejbah.cloudfront.net/images/home/abus-02.svg" alt="Gratis Ongkir" class="img-responsive center-block">
					</div>
					<div class="ck-wrapperWhyBrambang-content sub-ck-wrap">
						<div class="WhyBrambangTitle WhyBrambangTitle-o">Gratis Ongkir</div>
						<div class="WhyBrambangSubTitle WhyBrambangSubTitle-o">Dapatkan gratis ongkir dengan minimal pembelian Rp
						98.000.</div>
					</div>
				</div>
				<div class="wrapperWhyBrambangCard" style=" width: 23%;">
					<div class="ck-wrapperWhyBrambang-image" style="">
						<img src="https://dtq2i388ejbah.cloudfront.net/images/home/abus-01.svg" alt="Mutu Terjamin" class="img-responsive center-block">
					</div>
					<div class="ck-wrapperWhyBrambang-content sub-ck-wrap">
						<div class="WhyBrambangTitle WhyBrambangTitle-o">Mutu Terjamin</div>
						<div class="WhyBrambangSubTitle WhyBrambangSubTitle-o">Kami melakukan kontrol mutu agar produk yang diterima selalu sesuai deskripsi dan foto di AsFrozen.com.</div>
					</div>
				</div>
				<div class="wrapperWhyBrambangCard" style=" width: 23%;">
					<div class="ck-wrapperWhyBrambang-image" style="">
						<img src="https://dtq2i388ejbah.cloudfront.net/images/home/abus-06.svg" alt="Tinggal Klik" class="img-responsive center-block">
					</div>
					<div class="ck-wrapperWhyBrambang-content sub-ck-wrap">
						<div class="WhyBrambangTitle"> Tinggal Klik</div>
						<div class="WhyBrambangSubTitle"> Tidak perlu repot ke toko. Tidak macet, hemat waktu dan tenaga. Pesan lewat hp atau komputer lalu klik produk yang kamu inginkan.</div>
					</div>
				</div>
				<div class="wrapperWhyBrambangCard" style=" width: 23%;">
					<div class="ck-wrapperWhyBrambang-image" style="">
						<img src="https://dtq2i388ejbah.cloudfront.net/images/home/abus-05.svg" alt="Pesan Hari Ini Esok Sampai" class="img-responsive center-block">
					</div>
					<div class="ck-wrapperWhyBrambang-content sub-ck-wrap">
						<div class="WhyBrambangTitle">Pesan Hari Ini <span>dan Esok Sampai</span></div>
						<div class="WhyBrambangSubTitle">Tinggal tunggu barang tiba.</div>
					</div>
				</div>


			</div>
		</div>

		<div class="clear"></div>

		<div id="ck-wrapper" style="background: #ec1f25;">
		</div>

		<div class="clear"></div>

		<div class="btn-delivery-price" ng-click="vm.openDeliveryTable()" style="display: none" role="button" tabindex="0">
			<a href="">Lihat Ongkos Kirim</a>
		</div>

	</div>
	<section id="clients" class="clients section-bg">
		<div class="container">

			<div class="row">
				<div class="list_brand" style="width: 100%;">
					@php
					$brand = array('client-6.png', 'client-1.png', 'client-2.png', 'client-3.png', 'client-4.png', 'client-5.png', 'client-7.png')
					@endphp
					@for ($i = 0; $i < count($brand); $i++)
					<div data-aos="zoom-in" style="width: 18%;">
						<img src="<?=url('/')?>/katalog_assets/assets/img/brand/{{$brand[$i]}}" class="img-fluid" alt="" style='width: 100%; filter: none;'>
					</div>
					@endfor
				</div>
			</div>

		</div>
	</section><!-- End Clients Section -->



	<!-- ======= Footer ======= -->
	<footer id="footer">

		<div class="footer-top">
			<div class="container">
				<div class="row">

					<div class="col-lg-3 col-md-6 footer-contact">
						<h3>OnePage</h3>
						<p>
							A108 Adam Street <br>
							New York, NY 535022<br>
							United States <br><br>
							<strong>Phone:</strong> +1 5589 55488 55<br>
							<strong>Email:</strong> info@example.com<br>
						</p>
					</div>

					<div class="col-lg-2 col-md-6 footer-links">
						<h4>Useful Links</h4>
						<ul>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
						</ul>
					</div>

					<div class="col-lg-3 col-md-6 footer-links">
						<h4>Our Services</h4>
						<ul>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
						</ul>
					</div>

					<div class="col-lg-4 col-md-6 footer-newsletter">
						<h4>Join Our Newsletter</h4>
						<p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
						<form action="" method="post">
							<input type="email" name="email"><input type="submit" value="Subscribe">
						</form>
					</div>

				</div>
			</div>
		</div>

		<div class="container d-md-flex py-4">

			<div class="mr-md-auto text-center text-md-left">
				<div class="copyright">
					&copy; Copyright <strong><span>OnePage</span></strong>. All Rights Reserved
				</div>
				<div class="credits">
					<!-- All the links in the footer should remain intact. -->
					<!-- You can delete the links only if you purchased the pro version. -->
					<!-- Licensing information: https://bootstrapmade.com/license/ -->
					<!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/ -->
					Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
				</div>
			</div>
			<div class="social-links text-center text-md-right pt-3 pt-md-0">
				<a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
				<a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
				<a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
				<a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
				<a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
			</div>
		</div>
	</footer><!-- End Footer -->

	<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
	<div id="preloader"></div>

	<!-- Vendor JS Files -->
	<script src="<?=url('/')?>/katalog_assets/assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?=url('/')?>/katalog_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?=url('/')?>/katalog_assets/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
	<script src="<?=url('/')?>/katalog_assets/assets/vendor/php-email-form/validate.js"></script>
	<script src="<?=url('/')?>/katalog_assets/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
	<script src="<?=url('/')?>/katalog_assets/assets/vendor/counterup/counterup.min.js"></script>
	<script src="<?=url('/')?>/katalog_assets/assets/vendor/venobox/venobox.min.js"></script>
	<script src="<?=url('/')?>/katalog_assets/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
	<script src="<?=url('/')?>/katalog_assets/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="<?=url('/')?>/katalog_assets/assets/vendor/aos/aos.js"></script>
	<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
	<script type="text/javascript" src="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick.min.js"></script>
	<script type="text/javascript">
		$('.flash_sale').slick({
			dots: false,
			infinite: false,
			speed: 300,
			slidesToShow: 5,
			slidesToScroll: 5,
			responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			]
		});	
		$('.list_brand').slick({
			dots: false,
			infinite: false,
			speed: 300,
			slidesToShow: 5,
			slidesToScroll: 5,
			responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			]
		});	
	</script>
	<!-- Template Main JS File -->
	<script src="<?=url('/')?>/katalog_assets/assets/js/main.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
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
</body>

</html>