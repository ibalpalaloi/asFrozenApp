<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->

  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/summernote/summernote-bs4.min.css')}}">
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
</style>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('AdminLTE/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('AdminLTE/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('AdminLTE/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
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
                    <a href="/admin-banner" class="nav-link @if($sub_menu_ == 'banner') active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Banner</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin-video" class="nav-link @if($sub_menu_ == 'video') active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Video</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin-kategori" class="nav-link @if($sub_menu_ == 'banner') kategori @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kategori</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin-kota" class="nav-link @if($sub_menu_ == 'banner') kota @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kota</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin-kecamatan" class="nav-link @if($sub_menu_ == 'banner') kecamatan @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kecamatan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin-kelurahan" class="nav-link @if($sub_menu_ == 'banner') kelurahan @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kelurahan</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
          <li class="nav-item has-treeview @if($menu_ == 'produk') menu-open @endif">
            <a href="/admin-daftar-produk" class="nav-link @if($menu_ == 'produk') active @endif">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Produk
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin-daftar-produk" class="nav-link @if($menu_ == 'daftar produk') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin-tambah-produk" class="nav-link @if($menu_ == 'tambah produk') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin--diskon-produk" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Diskon</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview @if($menu_ == 'pesanan') menu-open @endif">
            <a href="/admin-daftar-produk" class="nav-link @if($menu_ == 'pesanan') active @endif">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Pesanan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/daftar-pesanan" class="nav-link @if($menu_ == 'daftar pesanan') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Pesanan</p>
                  <span id="jumlah_menunggu_konfirmasi" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/pesanan-packaging" class="nav-link @if($menu_ == 'packaging') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Packing</p>
                  <span id="jumlah_packaging" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/pesanan-dalam-pengantaran" class="nav-link @if($menu_ == 'dalam pengantaran') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dalam Pengantaran</p>
                  <span id="jumlah_pengantaran" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/riwayat-pesanan" class="nav-link @if($menu_ == 'daftar pesanan') riwayat @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if($menu_ == 'analisis') menu-open @endif">
            <a href="/admin-daftar-produk" class="nav-link @if($menu_ == 'analisis') active @endif">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Analisis
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin-analisis/produk" class="nav-link @if($menu_ == 'analisis produk') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Analisis Produk</p>
                  <span id="jumlah_menunggu_konfirmasi" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin-analisis/transaksi" class="nav-link @if($menu_ == 'analisis transaksi') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Analisis Transaksi</p>
                  <span id="jumlah_menunggu_konfirmasi" class="right badge badge-danger"></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin-analisis/pelanggan" class="nav-link @if($menu_ == 'analisis Pelangan') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Analisis Pelanggan</p>
                  <span id="jumlah_pengantaran" class="right badge badge-danger"></span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @if(Session::get('kode-notif'))
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
  @endif
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
<script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('AdminLTE/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('AdminLTE/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('AdminLTE/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('AdminLTE/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('AdminLTE/plugins/moment/moment.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('AdminLTE/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('AdminLTE/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('AdminLTE/dist/js/demo.js')}}"></script>
<script>
  const startingMinutes = 10;
  let time = startingMinutes * 60;

  setInterval(updateCountDown, 1000);

  function updateCountDown(){
    const minutes = Math.floor(time / 60);
    let seconds = time % 60;

    seconds = seconds < 10 ? '0' + seconds : seconds;
    $("#countdown").empty();
    $("#countdown").append(minutes + ":" + seconds);
    time--;
  }
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
      url: "/get-jumlah-pesanan",
      success:function(data){
        var jumlah = data.jumlah;
        $('#jumlah_menunggu_konfirmasi').html(jumlah['menunggu_konfirmasi']);
        $('#jumlah_packaging').html(jumlah['packaging']);
        $('#jumlah_pengantaran').html(jumlah['dalam_pengantaran'])
      }
    })
  }

  $(document).ready ( function(){
    get_jumlah_pesanan();
  })


</script>


@yield('footer')
</body>
</html>
