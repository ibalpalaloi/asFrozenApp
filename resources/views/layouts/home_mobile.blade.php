<!DOCTYPE html>
<html dir="ltr" lang="en" style="height: 100%;">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="HandheldFriendly" content="true"/>
    <title>@yield('title') | as Frozen Palu</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="icon" type="image/png" sizes="60x60" href="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_admin_logo.png">
    <link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/template_mobile/admin/dist/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/template_mobile/css/kitapura.css">

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

<body style="background: #f5f5f5 !important; position: relative; min-height: 100%; padding-bottom: 0em;">

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
    <header class="style__Container-sc-3fiysr-0 header" style="background: linear-gradient(0deg, hsla(20, 70%, 52%, 1) 0%, hsla(358, 84%, 52%, 1) 100%); border-bottom: none; box-shadow:0 1px 1px rgb(0 0 0 / 20%);">
        <div class="style__Wrapper-sc-3fiysr-2 hBSxmh" style="display: flex; justify-content: center;">
            <a id="defaultheader_logo" title="Kitabisa" style="margin-left: 20px; height:33px;margin-right:20px; display: flex; justify-content: center; align-items: center;" href="<?=url('/')?>">
                <img src="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_palu_white.png" style="width: 2.5em">
            </a>
            <div id="defaultheader_search" class="style__SearchInput-sc-3fiysr-3 sUjAJ">
                <span style="width: 90%;">
                    <form action="{{url('/')}}/pencarian" class="shopee-searchbar-input" autocomplete="off" id="form_pencarian">
                        <div class="shopee-searchbar__main" style="position: relative;">
                            <input id="pencarian" aria-label="Jiniso Diskon s/d 80%" class="shopee-searchbar-input__input" maxlength="128" placeholder="Temukan kebutuhanmu disini" autocomplete="off" value="" style="border:none; width: 100%;">
                        </div>
                        <button type="submit" id="btn-search-mobile" class="btn btn-solid-primary btn--s btn--inline" hidden>
                            <span class="iconify" data-icon="mdi:magnify" style="color: white; font-size: 2em;"></span>
                        </button>
                    </form>
                </span>
                <svg aria-hidden="true" onclick="btn_search_mobile()" focusable="false" data-prefix="fas" data-icon="search" class="svg-inline--fa fa-search fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="color: #dedede;">
                    <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                </svg>
            </div>
        </div>
    </header>

    @yield("content")

    <div class="footer">
        <div class="container-mall footer-mall-menu" style="display: flex; justify-content: space-around;">
            @php
            $menu_color = array('beranda_color.svg', 'pencarian_color.svg', 'toko_color.svg', 'emergency_color.svg', 'akun_color.svg');
            $menu = array('ant-design:home-outlined', 'clarity:history-line', 'ant-design:shopping-cart-outlined', 'icon-park-outline:transaction-order', 'ant-design:user-outlined');
            $nama_menu = array('Beranda', 'Pencarian', 'Toko', 'Emergency', 'Akun');
            $link_menu = array('', 'riwayat-pesanan', 'keranjang', 'pesanan/menunggu konfirmasi', 'biodata');
            $link_now = Request::segment(1);
            @endphp 
            @for ($i = 0; $i < count($menu); $i++)  
            <div style="display: flex; justify-content: center; flex-direction: column; align-items: center; margin: 0em 0.1em 0em 0.1em;">
                <div style="height: 5em; width: 3em; display: flex; flex-direction: column; align-items: center; margin: 0.4em 0em 0.4em 0em; justify-content: center;">
                    <a style="@if ($link_menu[$i] == $link_now) background: #ec1f25; color: white; @else background: white; border: 2px solid #ec1f25; color: #ec1f25; @endif width: 3em; height: 3em; border-radius: 1.5em; margin-bottom: 0.3em; display: flex;justify-content: center; align-items: center; position: relative; z-index: 1000000;" href="<?=url('/')?>/{{$link_menu[$i]}}" onclick="show_loader()">
                        <span class="iconify" data-icon="{{$menu[$i]}}" style="font-size: 1.8em;"></span>
                        @auth
                        @if ($i == 2)

                        <div style="width: 1.3em;height: 1.3em; border-radius: 50%; background:#ec1f25; position: absolute; right: -0.2em; top: -0.3em; color: white; z-index: 1000000;" id="jumlah_keranjang">0</div>
                        @elseif ($i == 3)
                        <div style="width: 1.3em;height: 1.3em; border-radius: 50%; background:#ec1f25; position: absolute; right: -0.2em; top: -0.3em; color: white; z-index: 1000000;" id="jumlah_pesanan">{{$jumlah_nota}}</div>                        
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


    function btn_search_mobile(){
        $("#btn-search-mobile").click();
    }

</script>
@yield('footer-scripts')


</html>
