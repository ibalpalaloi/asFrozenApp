<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=url('/')?>/public/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?=url('/')?>/public/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=url('/')?>/public/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?=url('/')?>/public/AdminLTE/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=url('/')?>/public/AdminLTE/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=url('/')?>/public/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->

  <!-- summernote -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  
  @yield('header')
</head>
<style>
  .border_table {
    border: 1px solid black;
    text-align: center;
  }

  .table_pesanan {
    width: 100%;
    border-collapse: collapse;
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


<body class="hold-transition sidebar-mini layout-fixed">
  <audio id="myAudio">
    <source src="{{asset('/public/audio/mixkit-doorbell-single-press-333.mp3')}}" type="audio/mpeg">
  </audio>

  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?=url('/')?>" class="brand-link">
        <img src="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_admin_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-2" style="opacity: .8">
        <span class="brand-text font-weight-light">Manajemen Toko</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?=url('/')?>/public/img/default.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Admin</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        @php
        $menu_ = "";
        $sub_menu_ ="";
        if(isset($menu)){
        $menu_ = $menu;
      }

      if(isset($sub_menu)){
      $sub_menu_ = $sub_menu;
    }
    @endphp
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           @if (Auth()->user()->role == "super admin")
           <li class="nav-item has-treeview @if($menu_ == 'data dukung') menu-open @endif">
            <a href="#" class="nav-link @if($menu_ == 'data dukung') active @endif">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Data Dukung
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-banner" class="nav-link @if($sub_menu_ == 'banner') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Banner</p>
                </a>
              </li>
              <li class="nav-item" hidden>
                <a href="<?=url('/')?>/admin-video" class="nav-link @if($sub_menu_ == 'video') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Video</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-kategori" class="nav-link @if($sub_menu_ == 'kategori') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-kota" class="nav-link @if($sub_menu_ == 'kota') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-kelurahan" class="nav-link @if($sub_menu_ == 'kelurahan') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelurahan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin/ongkos-kirim" class="nav-link @if($sub_menu_ == 'ongkos kirim') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ongkos Kirim</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-jadwal-buka" class="nav-link @if($sub_menu_ == 'jadwal_buka') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Buka</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-jadwal-tutup" class="nav-link @if($sub_menu_ == 'jadwal_tutup') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Tutup</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=url('/')?>/admin-testimoni" class="nav-link @if($sub_menu_ == 'testimoni') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Testimoni</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-data-toko" class="nav-link @if($sub_menu_ == 'data toko') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Toko</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-data-kurir" class="nav-link @if($sub_menu_ == 'kurir') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kurir</p>
                </a>
              </li>

            </ul>
          </li> 
          @endif

          @if (Auth()->user()->role == "super admin")
          <li class="nav-item has-treeview">
            <a href="##" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-daftar-pengguna" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-daftar-pengguna-banned" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengguna Banned</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-daftar-admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-lupa-password" class="nav-link @if($menu_ == 'lupa password') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lupa Password</p>
                  <span id="jumlah_lupa_password" class="right badge badge-danger">0</span>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if (Auth()->user()->role == "super admin" or Auth()->user()->role == "admin produk")
          <li class="nav-item has-treeview @if($menu_ == 'produk') menu-open @endif">
            <a href="<?=url('/')?>/admin-daftar-produk" class="nav-link @if($menu_ == 'produk') active @endif">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                Produk
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-daftar-produk" class="nav-link @if($menu_ == 'daftar produk') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-daftar-produk-kosong" class="nav-link @if($menu_ == 'daftar produk kosong') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Produk Kosong</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-tambah-produk" class="nav-link @if($menu_ == 'tambah produk') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Produk</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if($menu_ == 'diskon') menu-open @endif">
            <a href="<?=url('/')?>/admin-daftar-produk" class="nav-link @if($menu_ == 'diskon') active @endif">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Diskon
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-diskon-produk" class="nav-link @if($menu_ == 'daftar produk') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat Diskon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-manajemen-diskon" class="nav-link @if($menu_ == 'tambah produk') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manajemen Diskon</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if (Auth()->user()->role == "super admin")
          <li class="nav-item">
            <a href="<?=url('/')?>/admin/bank" class="nav-link @if($menu_ == 'bank') active @endif">
              <i class="fas fa-money-check-alt nav-icon"></i>
              <p>Bank</p>
            </a>
          </li>
          @endif

          @if (Auth()->user()->role == "super admin" or Auth()->user()->role == "admin pesanan")
          <li class="nav-item has-treeview @if($menu_ == 'pesanan') menu-open @endif">
            <a href="<?=url('/')?>/admin-daftar-produk" class="nav-link @if($menu_ == 'pesanan') active @endif">
              <i class="nav-icon fas fa-truck"></i>

              <p>
                Pesanan
                <i class="fas fa-angle-left right"></i>
              </p>
              <span id="jumlah_semua_pesanan" class="right badge badge-danger"></span>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=url('/')?>/admin/daftar-pesanan" class="nav-link @if($sub_menu_ == 'daftar pesanan') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Pesanan</p>
                  <span id="jumlah_menunggu_konfirmasi" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin/pesanan-packaging" class="nav-link @if($sub_menu_ == 'packaging') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Packing</p>
                  <span id="jumlah_packaging" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin/pesanan-dalam-pengantaran" class="nav-link @if($sub_menu_ == 'dalam pengantaran') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dalam Pengantaran</p>
                  <span id="jumlah_pengantaran" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin/pesanan-siap-diambil" class="nav-link @if($sub_menu_ == 'siap diambil') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siap Diambil</p>
                  <span id="jumlah_siap_diambil" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin/daftar-pesanan-expired" class="nav-link @if($sub_menu_ == 'pesanan expired') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pesanan Expired</p>
                  <span id="jumlah_pesanan_expired" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin/riwayat-pesanan" class="nav-link @if($sub_menu_ == 'riwayat pesanan') riwayat @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if (Auth()->user()->role == "super admin")
          <li class="nav-item has-treeview @if($menu_ == 'analisis') menu-open @endif">
            <a href="<?=url('/')?>/admin-daftar-produk" class="nav-link @if($menu_ == 'analisis') active @endif">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Analisis
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-analisis/produk" class="nav-link @if(Request::segment(2) == 'produk') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Analisis Produk</p>
                  <span id="jumlah_menunggu_konfirmasi" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-analisis/transaksi" class="nav-link @if(Request::segment(2) == 'transaksi') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Analisis Transaksi</p>
                  <span id="jumlah_menunggu_konfirmasi" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=url('/')?>/admin-analisis/pelanggan" class="nav-link @if(Request::segment(2) == 'pelanggan') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Analisis Pelanggan</p>
                  <span id="jumlah_pengantaran" class="right badge badge-danger"></span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?=url('/')?>/admin-ubah-password" class="nav-link @if($menu_ == 'lupa password') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Ubah Password</p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="<?=url('/')?>/logout" class="nav-link @if($menu_ == 'bank') active @endif">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Keluar</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="modal fade" id="modal-notif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          {{ csrf_field() }}
          <div style="text-align: center;">
            <i class="" id="icon" style="font-size: 5em;"></i>
            <h4 style="margin-top: 0.5em;" id="header"></h4>
            <div style="margin-top: 0.5em;" id="pesan-error-notif"></div>
          </div>  
        </div>
        <div class="modal-footer" id="modal-footer-notif" data-dismiss="modal" style="color: white; display: flex; justify-content: center;">
          Tutup
        </div>
      </div>
    </div>
  </div>
  <!-- Content Wrapper. Contains page content -->
  @yield("body")
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-pre
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=url('/')?>/public/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=url('/')?>/public/AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=url('/')?>/public/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?=url('/')?>/public/AdminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?=url('/')?>/public/AdminLTE/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?=url('/')?>/public/AdminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=url('/')?>/public/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=url('/')?>/public/AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=url('/')?>/public/AdminLTE/plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=url('/')?>/public/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?=url('/')?>/public/AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=url('/')?>/public/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=url('/')?>/public/AdminLTE/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=url('/')?>/public/AdminLTE/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=url('/')?>/public/AdminLTE/dist/js/demo.js"></script>
<script>
  @if(Session::get('kode-notif'))
  $("#pesan-error-notif").html("{{Session::get('message')}}");
  $("#header").html("{{Session::get('header')}}");
  $("#icon").addClass("{{Session::get('icon')}}");
  $("#header").css("color", "{{Session::get('color')}}");
  $("#icon").css("color", "{{Session::get('color')}}");
  $('#modal-footer-notif').css("background", "{{Session::get('color')}}");
  $('#modal-notif').modal('show');    
  @endif

  function get_jumlah_pesanan(){
    $.ajax({
      type: "GET",
      url: "<?=url('/')?>/get-jumlah-pesanan",
      success:function(data){
        var jumlah = data.jumlah;
        if(jumlah['menunggu_konfirmasi']+jumlah['packaging']+jumlah['dalam_pengantaran'] > 0){
          $('#jumlah_semua_pesanan').html("!!");
        }
        else{
          $('#jumlah_semua_pesanan').empty();
        }
        
        $('#jumlah_menunggu_konfirmasi').html(jumlah['menunggu_konfirmasi']);
        $('#jumlah_packaging').html(jumlah['packaging']);
        $('#jumlah_pengantaran').html(jumlah['dalam_pengantaran']);
        $('#jumlah_pesanan_expired').html(jumlah['pesanan_expired']);
        $('#jumlah_siap_diambil').html(jumlah['siap_diambil']);
        if(data.notifikasi_pesanan_baru){

          $("#myAudio").trigger('load');
          $("#myAudio").trigger('play');
        }
        
      }
    })
  }

  function cek_pesanan_expired(){
    $.ajax({
      type: "GET",
      url: "<?=url('/')?>/cek_pesanan_expired",
      success:function(data){
        var list_id_pesanan_expired = data.list_id_pesanan_expired;
        
        for(let i = 0; i<list_id_pesanan_expired.length; i++){
          $('#tr_pesanan_id'+list_id_pesanan_expired[i]).remove();
          console.log(list_id_pesanan_expired[i]);
        }
      }
    })
  }

  function get_lupa_password(){
    $.ajax({
      type: "get",
      url: "<?=url('/')?>/cek_lupa_password",
      success:function(data){
        console.log(data);
        $('#jumlah_lupa_password').html(data.jumlah_lupa_password);
      }
    })
  }

  $(document).ready ( function(){
    
    get_jumlah_pesanan();
    timer = setInterval(function() {
      get_jumlah_pesanan();
      cek_pesanan_expired();
      get_lupa_password();
    }, 10000);
  })


  function show_loader(){
    console.log('show');
    $("#modal_loader").modal("show");
    setTimeout(hide_loader, 5000);

  };

  function hide_loader(){
    console.log('hide');
    $("#modal_loader").modal("hide");
  };


</script>


@yield('footer')
</body>
</html>
