<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>@yield('title-header') - AsFrozen</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
    <link rel="icon" type="image/png" sizes="60x60" href="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_admin_logo.png">
	<link href="<?=url('/')?>/public/katalog_assets/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/venobox/venobox.css" rel="stylesheet">
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/aos/aos.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick-theme.css"/>
	<link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/v3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Template Main CSS File -->
	<link href="<?=url('/')?>/public/katalog_assets/assets/css/style.css" rel="stylesheet">
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

		.btn-outline-danger > div:hover {
			color: white;
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

		body {
			font-family: 'Lato', sans-serif;
			/*font-family: 'Roboto', sans-serif;*/
		}


		a {
			color: #47b2e4;
		}

		a:hover {
			color: #73c5eb;
			text-decoration: none;
		}
	</style>
	@yield('header')

  <!-- =======================================================
  * Template Name: OnePage - v2.2.2
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
	{{-- modal --}}
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
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleFormControlInput1">Nama Penerima</label>
									<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nama Penerima" value="Fathul">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleFormControlInput1">Nomor Handphone</label>
									<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nama Pemesan" value="085156289855">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea1">Alamat</label>
							<textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Alamat">Jl. Swadaya Lorong Balitbangda No. 9 Palu</textarea>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="exampleFormControlSelect1">Kota</label>
									<select class="form-control" id="exampleFormControlSelect1">
										<option>Palu</option>
									</select>
								</div>

							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="exampleFormControlSelect1">Kecamatan</label>
									<select class="form-control" id="exampleFormControlSelect1">
										<option>Palu Barat</option>
										<option>Palu Timur</option>
										<option>Palu Selatan</option>
										<option>Palu Utara</option>
									</select>
								</div>

							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="exampleFormControlSelect1">Keluarahan</label>
									<select class="form-control" id="select_kelurahan" onchange="ongkos_kirim()">
										<option>Kabonena</option>
										<option>Tipo</option>
										<option>Donggala Kodi</option>
										<option>Silae</option>
									</select>
								</div>
							</div>

						</div>
					</form>
					<div class="row" style="font-weight: 700">
						<div class="col">Total pesanan</div>
						<div class="col text-right">Rp. 50.000</div>
					</div>
					<div class="row" style="font-weight: 700">
						<div class="col">Ongkos Kirim</div>
						<div class="col text-right" id="ongkos_kirim">Rp. 7.000</div>
					</div>
				</div>
				<br>
				<div class="modal-footer justify-content-between" style="font-weight: 700">
					<div style="font-size: 28px" id="total_pesanan">
						Total : Rp. 67.000
					</div>
					<div>
						<a href="<?=url('/')?>/pesanan" type="button" class="btn btn-danger">Pesan</a>
					</div>

				</div>
			</div>
		</div>
	</div>
	{{-- end modal --}}

	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top" style="background: linear-gradient(0deg, hsla(20, 70%, 52%, 1) 0%, hsla(358, 84%, 52%, 1) 100%); border-bottom: none; box-shadow:0 1px 1px rgb(0 0 0 / 20%); border-bottom: none; box-shadow:0 1px 1px rgb(0 0 0 / 20%); padding: 1em;">
		<div class="container">
			<div class="d-flex">
				<h1 class="logo mr-auto">
					<a href="<?=url('/')?>">
						<img src="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_palu_white.png">
					</a>
				</h1>
				<div style="width: 100%; padding-left: 1%; margin-left: 2.5%; margin-right: 5%; border-left: 2px solid white;display: flex; align-items: center;">
					<div style="color: white; vertical-align: center; padding-bottom: 0px; line-height: 1em; font-size: 1.4em;">@yield('title-header')
					</div>
				</div>
				<div>
					<a href="<?=url('/')?>/keranjang">
						<span class="iconify" data-icon="mdi:cart" style="font-size: 2em; color: white;"></span>
					</a>
				</div>

			</div>
		</div>
	</header><!-- End Header -->

	<section id="hero" class="d-flex align-items-center" style="background: none; ">
		<div class="container" style="padding-top: 1em;">
			<div class="row">
				<div class="col-3">
					<div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;">
						<div class="row" style="padding: 0.5em 1em;">
							<div style="width: 30%; border-radius: 50%;">
								<img src="<?=url('/')?>/public/img/default.png" style="width: 100%; border-radius: 50%;">
							</div>
							<div style="width: 70%; padding-left: 0.8em; display: flex; justify-content: center; flex-direction: column;">
								<div>{{Auth()->user()->biodata->nama}}</div>
								<small>Member</small>
							</div>
						</div>
					</div>
					<div class="card shadow p-3 bg-white rounded" style="border: none;">
						<div class="row" style="padding: 0em 1em;">
							<ul class="list-unstyled components" style="margin-bottom: 0px;">
								<li>
									<a href="<?=url('/')?>/biodata">Biodata</a>
								</li>
								<li style="margin-top: 0.5em;">
									<a href="<?=url('/')?>/pesanan/menunggu konfirmasi">Pesanan</a>
								</li>
								<li style="margin-top: 0.5em;">
									<a href="<?=url('/')?>/riwayat-pesanan">Riwayat Pesanan</a>
								</li>
								<li style="margin-top: 0.5em;">
									<a href="<?=url('/')?>/testimoni">Testimoni</a>
								</li>
								<li style="margin-top: 0.5em;">
									<a href="<?=url('/')?>/ubah-password">Ubah Password</a>
								</li>
								<li style="margin-top: 0.5em;">
									<a href="<?=url('/')?>/logout">Logout</a>
								</li>
							</ul>

						</div>
					</div>
				</div>
				<div class="col-9">
					@yield('content')
				</div>
			</div>

		</div>
	</section>

	<!-- ======= Footer ======= -->
	<!-- ======= Footer ======= -->
	<footer id="footer">

		<div class="footer-top">
			<div class="container">
				<div class="row">

					<div class="col-lg-4 col-md-6 footer-contact">
						<div style="display: flex;align-items: center;">
							<h2>as</h2>&nbsp;&nbsp;&nbsp;
							<h3 style="margin-top: 0.2em;">Frozen Palu</h3>
						</div>
						<p>
							Jl. Mandala No. 1 <br>
							Kel. Birobuli Utara, Kec. Palu Selatan<br>
							Kota Palu <br><br>
							<strong>Phone:</strong> +1 5589 55488 55<br>
							<strong>Email:</strong> info@example.com<br>
						</p>
					</div>

					<div class="col-lg-4 col-md-6 footer-links">
						<h4>Metode Pembayaran</h4>
						<div>
							<img src="<?=url('/')?>/public/bank_footer.png">
						</div>
					</div>

					<div class="col-lg-4 col-md-6 footer-newsletter">
						<div style="display: flex;">
							<img src="<?=url('/')?>/public/mui_halal.png" style="width: 30%;">
						</div>
						<h4 style="margin-top: 0.5em; text-align: left;">Ikuti Kami Di</h4>
						<div class="social-links text-center text-md-left pt-3 pt-md-0">
							<a href="#" class="twitter" style="background: #ec1f25;"><i class="bx bxl-twitter"></i></a>
							<a href="#" class="facebook" style="background: #ec1f25;"><i class="bx bxl-facebook"></i></a>
							<a href="#" class="instagram" style="background: #ec1f25;"><i class="bx bxl-instagram"></i></a>
							<a href="#" class="google-plus" style="background: #ec1f25;"><i class="bx bxl-skype"></i></a>
							<a href="#" class="linkedin" style="background: #ec1f25;"><i class="bx bxl-linkedin"></i></a>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="container d-md-flex py-4">

			<div class="mr-md-auto text-center text-md-left">
				<div class="copyright">
					{{date('Y')}}&nbsp;&copy; Copyright <strong><span style="font-size: 1.2em;">as</span><span> Frozen Palu</span></strong>.
				</div>
				<div class="credits">
					All Rights Reserved
				</div>
			</div>

		</div>
	</footer><!-- End Footer -->

	<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
	<div id="preloader" style=""></div>

	<!-- Vendor JS Files -->
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
	<script type="text/javascript" src="<?=url('/')?>/public/katalog_assets/assets/vendor/slick/slick.min.js"></script>
	<script type="text/javascript">
	</script>
	<!-- Template Main JS File -->
	<script src="<?=url('/')?>/public/katalog_assets/assets/js/main.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
	@yield('footer')
</body>

</html>