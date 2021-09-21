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
	// Add the new slick-theme.css if you want the default styling
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
	<header id="header" class="fixed-top" style="background: #ec1f25; border-bottom: none; box-shadow:0 1px 1px rgb(0 0 0 / 20%);">
		<div class="container d-flex align-items-center">
			<h1 class="logo mr-auto">
				<div style="">
					<img src="<?=url('/')?>/katalog_assets/assets/img/logo/logo2.png" style="width: 120%;background:#ec1f25;">
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
			<a href="/keranjang" class=""><span class="iconify" data-icon="mdi:cart" style="font-size: 2em; color: white;"></span></a>
		</div>
	</header><!-- End Header -->

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
									<div style="text-align: center; font-size: 0.8em;">{{$kategori_current->kategori}}</div>
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
									<div style="text-align: center; font-size: 0.8em;">{{$data->kategori}}</div>
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
							@include('user.sub_kategori_semua')
						</div>
					</div>
				</div>
			</div>
		</div>

	</section><!-- End Hero -->


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
	<div id="preloader" style=""></div>

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
	</script>
	<!-- Template Main JS File -->
	<script src="<?=url('/')?>/katalog_assets/assets/js/main.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
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