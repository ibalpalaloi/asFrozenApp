<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="HandheldFriendly" content="true"/>
    <title>@yield('title')Yoomam</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="icon" type="image/png" sizes="60x60" href="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_admin_logo.png">
    <link rel="stylesheet" type="text/css" href="<?=url('/')?>/template_mobile/admin/dist/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?=url('/')?>/template_mobile/css/kitapura.css">
    <style type="text/css">
        body {
            font-family: 'Roboto', sans-serif;
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
    @yield('header-scripts')
</head>

<body style="background: #f5f5f5 !important;">
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
    @yield("content")
    <div class="footer">
        <div class="container-mall footer-mall-menu" style="display: flex; justify-content: space-around;">
            @php
            $menu_color = array('beranda_color.svg', 'pencarian_color.svg', 'toko_color.svg', 'emergency_color.svg', 'akun_color.svg');
            $menu = array('ant-design:home-outlined', 'clarity:history-line', 'ant-design:shopping-cart-outlined', 'icon-park-outline:transaction-order', 'ant-design:user-outlined');
            $nama_menu = array('Beranda', 'Pencarian', 'Toko', 'Emergency', 'Akun');
            $link_menu = array('', 'riwayat-pesanan', 'keranjang', 'pesanan', 'biodata');
            $link_now = Request::segment(1);
            @endphp 
            @for ($i = 0; $i < count($menu); $i++)  
            <div style="display: flex; justify-content: center; flex-direction: column; align-items: center; margin: 0em 0.1em 0em 0.1em;">
                <div style="height: 5em; width: 3em; display: flex; flex-direction: column; align-items: center; margin: 0.4em 0em 0.4em 0em; justify-content: center;">
                    <a style="@if ($link_menu[$i] == $link_now) background: #ec1f25; color: white; @else background: white; border: 2px solid #ec1f25; color: #ec1f25; @endif width: 3em; height: 3em; border-radius: 1.5em; margin-bottom: 0.3em; display: flex;justify-content: center; align-items: center;" href="<?=url('/')?>/{{$link_menu[$i]}}">
                        <span class="iconify" data-icon="{{$menu[$i]}}" style="font-size: 1.8em;"></span>
                        @if ($i == 2)
                        @auth
                        <div style="width: 1.3em;height: 1.3em; border-radius: 50%; background:#ec1f25; position: absolute; right: -0.2em; top: -0.3em; color: white;" id="jumlah_keranjang">0</div>
                        @endif
                        @endif
                    </a>
                </div>
            </div> 
            @endfor
        </div>
    </div>
</body>    
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                // alert(jumlah_keranjang);
            }
        })
    }

</script>
@yield('footer-scripts')


</html>
