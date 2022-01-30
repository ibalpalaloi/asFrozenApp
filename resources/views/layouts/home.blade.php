<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>AsFrozen</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?=url('/')?>/public/katalog_assets/assets/img/favicon.png" rel="icon">
	<link href="<?=url('/')?>/public/katalog_assets/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
	<!-- Vendor CSS Files -->
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/venobox/venobox.css" rel="stylesheet">
	<link href="<?=url('/')?>/public/katalog_assets/assets/vendor/aos/aos.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/katalog_assets/assets/vendor/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/katalog_assets/assets/vendor/slick/slick-theme.css"/>
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

		.loader-container{
			width: 100%;
			height: 100vh;
			position: fixed;
			display: flex;
			align-items: center;
			justify-content: center;
		}  

	</style>

	@yield('header')
</head>
<body>
	<div class="modal fade" id="modal_loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding: 1.5em; padding: 0px;">
		<div class="modal-dialog modal-dialog-centered" role="document" style="padding: 0px; position: relative;">
			<div class="modal-content st0" style="border-radius: 1.2em; display: flex; justify-content: center; align-items: center; margin: 8em 1em 0em 1em; color: white; border: #353535;">
				<div class="loader-container">
					<div class="spinner-border text-danger" role="status">
						<span class="sr-only">Loading...</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<header id="header" class="fixed-top" style="background: #CF0303">
		<div class="container" style="display: flex; justify-content: space-between;">
			<div style="width: 88%; display: flex;">
				<h1 class="logo" style="margin-right: 1em;">
					<a href="<?=url('/')?>">
						<img src="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_palu_white.png">
					</a>
				</h1>

				<div class="shopee-searchbar shopee-searchbar--focus" style="width: 100%;">
					<form action="pencarian" class="shopee-searchbar-input" autocomplete="off" id="form_pencarian">
						<div class="shopee-searchbar__main" style="position: relative;">
							<input id="pencarian" aria-label="Jiniso Diskon s/d 80%" class="shopee-searchbar-input__input" maxlength="128" placeholder="Temukan kebutuhanmu disini" autocomplete="off" value="">
						</div>
						<button type="submit" class="btn btn-solid-primary btn--s btn--inline">
							<span class="iconify" data-icon="mdi:magnify" style="color: white; font-size: 2em;"></span>
						</button>
					</form>
				</div>
			</div>
			<div style="display: flex; flex-direction: row; justify-content: space-between; align-content: center; width: 8%;padding-top: 0.2em;">
				<a href="<?=url('/')?>/keranjang" style="position: relative;">
					<span class="iconify" data-icon="mdi:cart" style="font-size: 2em; color: white;"></span>
					<div style="background: red; width: 1em; height: 1em; color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 0.7em; padding: 0.7em; position: absolute; bottom: 2px; right: 0px; border: 1px solid white;" id="jumlah_keranjang"></div>
				</a>
				<a href="<?=url('/')?>/biodata">
					<span class="iconify" data-icon="mdi:user" style="font-size: 2em; color: white;"></span>
				</a>
			</div>
		</div>
	</header>	


	@yield('body')


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

	<a href="#" class="back-to-top"><i class="ri-arrow-up-line" style="background: #ec1f25;"></i></a>
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

	<!-- Template Main JS File -->
	<script src="<?=url('/')?>/public/katalog_assets/assets/js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
	<script src="<?=url('/')?>/public/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
		function show_loader(){
			console.log('show');
			$("#modal_loader").modal("show");
			setTimeout(hide_loader, 5000);

		};		
		function hide_loader(){
			console.log('hide');
			$("#modal_loader").modal("hide");
		};

		$('#form_pencarian').submit(function(event){
			event.preventDefault();
			pencarian();
		})

		function pencarian(){
			
			var keyword = $("#pencarian").val();
			if(keyword != ''){
				var this_url = window.location.origin;
				window.location.href = "<?=url('/')?>/"+"pencarian?keyword="+keyword;
			}
		}

		$(document).ready(function(){
			get_jumlah_keranjang();

		})

		function get_jumlah_keranjang(){
			$.ajax({
				url: "<?=url('/')?>/get_jumlah_keranjang/",
				type:"get",
				success:function(data){
					jumlah_keranjang = data.jumlah_keranjang
					$('#jumlah_keranjang').html(jumlah_keranjang);
				}
			})
		}



		function tambah_keranjang(id){
			show_loader();
			setTimeout(hide_loader, 1000);
			$.ajax({
				url: "<?=url('/')?>/tambah_keranjang/"+id,
				type:"get",
				success:function(data){
					
					get_jumlah_keranjang();
					console.log(data);
				},
				error:function(data){
					if(data.status > 400){
						window.location.href = "<?=url('/')?>/user_login";
					}
				}
			})
		}
	</script>
	@yield('footer')
</body>
</html>