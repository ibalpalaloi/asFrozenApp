
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?=url('/')?>/vali-template/css/main.css">
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
      @php $url = url('/')."/katalog_assets/assets/img/logo.png"; @endphp
      <div style="width: 8em; border-radius: 50%; height: 8em; position: absolute; top: -4em; background-image: url('<?=$url?>'); border: 5px solid white; left: 35%; background-size: cover;">
        
      </div>
      <form class="login-form" action="/post_login" method="post" style="margin-top: 1.5em;">
        @csrf
        <div class="form-group">
          <label class="control-label">NOMOR HANDPHONE</label>
          <input class="form-control" type="text" placeholder="Nomor Handphone" name="no_telp" autofocus>
        </div>
        <div class="form-group">
          <label class="control-label">PASSWORD</label>
          <input class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group btn-container">
          <button class="btn btn-primary btn-block" style="background:#ec1f25; border: 2px solid  #ec1f25;"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          <div class="form-group">
            <div class="utility">
              <p class="semibold-text mb-2"><a href="<?=url('/')?>/registrasi" style='color:  #ec1f25;'>Belum ada akun? Daftar </a></p>
            </div>
          </div>
        </div>
      </form>
      <form class="forget-form" action="index.html" style="margin-top: 1.5em;">
        <div class="form-group">
          <label class="control-label">NAMA</label>
          <input class="form-control" type="text" placeholder="Nama" autofocus>
        </div>
        <div class="form-group">
          <label class="control-label">NOMOR HANDPHONE</label>
          <input class="form-control" type="text" placeholder="Nomor Handphone" autofocus>
        </div>
        <div class="form-group">
          <label class="control-label">ALAMAT</label>
          <input class="form-control" type="text" placeholder="Alamat">
        </div>
        <div class="form-group">
          <label class="control-label">PASSWORD</label>
          <input class="form-control" type="password" placeholder="Password">
        </div>
        <div class="form-group btn-container">
          <button class="btn btn-primary btn-block">Daftar</button>
        </div>
        <div class="form-group mt-3">
          <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
        </div>
      </form>
    </div>
  </section>
  <!-- Essential javascripts for application to work-->
  <script src="<?=url('/')?>/vali-template/js/jquery-3.3.1.min.js"></script>
  <script src="<?=url('/')?>/vali-template/js/popper.min.js"></script>
  <script src="<?=url('/')?>/vali-template/js/bootstrap.min.js"></script>
  <script src="<?=url('/')?>/vali-template/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="<?=url('/')?>/vali-template/js/plugins/pace.min.js"></script>
  <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
  </html>