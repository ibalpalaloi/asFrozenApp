
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/vali-template/css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Login - Vali Admin</title>
</head>
<body>
  <section class="material-half-bg">
    <div class="cover" style="background: #ec1f25;"></div>
  </section>
  <section class="login-content">
    <div class="login-box" style="min-height: 330px;">
      @php $url = url('/')."/public/katalog_assets/assets/img/logo.png"; @endphp
      <div style="width: 8em; border-radius: 50%; height: 8em; position: absolute; top: -4em; background-image: url('<?=$url?>'); border: 5px solid white; left: 35%; background-size: cover;">
        
      </div>
      <form class="login-form" action="<?=url('/')?>/post-lupa-password" method="post" style="margin-top: 1.5em;">
        @csrf
        <div class="form-group">
          <label class="control-label">NOMOR HANDPHONE</label>
          <input class="form-control" type="text" placeholder="Nomor Handphone" name="no_telp" autofocus>
        </div>
        <div class="form-group btn-container">
          <button class="btn btn-primary btn-block" style="background:#ec1f25; border: 2px solid  #ec1f25;"><i class="fa fa-sign-in fa-lg fa-fw"></i>Lupa Password</button>
          <div class="form-group">
            <div class="utility">
              <p class="semibold-text mb-2"><a href="<?=url('/')?>/registrasi" style='color:  #ec1f25;'>Kembali ke Login </a></p>
            </div>
          </div>
        </div>
      </form>
      
    </div>
  </section>
  <!-- Essential javascripts for application to work-->
  <script src="<?=url('/')?>/public/vali-template/js/jquery-3.3.1.min.js"></script>
  <script src="<?=url('/')?>/public/vali-template/js/popper.min.js"></script>
  <script src="<?=url('/')?>/public/vali-template/js/bootstrap.min.js"></script>
  <script src="<?=url('/')?>/public/vali-template/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });

      $(document).ready(function(){
        @if (session('error'))
          swal("Akun Tidak Tersedia");
        @endif
        
      })
    </script>
  </body>
  </html>