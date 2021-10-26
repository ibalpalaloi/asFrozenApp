@extends('layouts.admin')

@section('header')
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick-theme.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=url('/')?>/AdminLTE/plugins/retro-plugins/css/flip-clock.css" />
<style type="text/css">
  .slick-track {
    float: left;
  }

  .foo { padding-left: 0; }
  .foo li {
    float: left;
    display: inline-block;
    width: 25%;
  }   

  .slick-slide  {
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

</style>
@endsection

@section('body')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" style="position: relative;">
              <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <text x="293" text-anchor="middle" class="highcharts-title" data-z-index="4" style="color:#333333;font-size:18px;fill:#333333;" y="24">Produk Paling Banyak Dibeli</text>
                <text>Semua Kategori - 7 Hari Terakhir</text>
              </div>
              <div class="btn btn-danger" style="position: absolute; right: 1em; top: 1em;">
                Filter
              </div>
              <div class="row" hidden>
                <div class="col">
                  <div class="form-group">
                    <label>Tanggal Mulai:</label>
                    <div class="input-group date" id="tgl_mulai" data-target-input="nearest">
                      <input value="@if (isset($tgl_mulai)) {{$tgl_mulai}} @endif" type="text" id="input_tgl_mulai" class="form-control datetimepicker-input" data-target="#tgl_mulai"/>
                      <div class="input-group-append" data-target="#tgl_mulai" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Tanggal Akhir:</label>
                    <div class="input-group date" id="tgl_akhir" data-target-input="nearest">
                      <input value="@if (isset($tgl_akhir)) {{$tgl_akhir}} @endif" type="text" id="input_tgl_akhir" class="form-control datetimepicker-input" data-target="#tgl_akhir"/>
                      <div class="input-group-append" data-target="#tgl_akhir" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div style="padding: 30px">
                    <button onclick="cari()">Cari</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-9">
                  <div id="diagram"></div>
                </div>
                <div class="col-md-3">
                  @foreach ($kategori_show as $data)
                  <div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
                    <div class="flash_sale" style="width: 100%;">
                      @foreach ($data->produk as $produk)
                      <div class="d-flex" style="margin-left: 0.5em; margin-right: 0.5em; padding-bottom: 0px;  -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%); margin-bottom: 1em; margin-top: 1em;">
                        <div class="member" style="position: relative; margin-bottom: 0px;">
                          <div class="member-img">
                            <img src="<?=url('/')?>/img/produk/thumbnail/500x500/{{$produk->foto}}" class="img-fluid" alt="">
                          </div>
                          <div class="member-info" style=" padding: 0em 0.7em 0.8em;">
                            @if ($produk->diskon != null)
                            @php
                            $harga = $produk->harga;
                            $diskon = $produk->diskon->diskon;
                            $harga_diskon = $harga - ($diskon/100 * $harga)
                            @endphp
                            <div style="margin-top: 0.5em; text-align: left; color: black;">
                              @if (strlen($produk->nama) > 15) {{substr($produk->nama, 0, 15)}}... @else {{$produk->nama}} @endif<badge class="badge badge-warning">{{$diskon}}%</badge> 
                            </div>
                            <div style="padding-top: 0px; position: relative; display: flex; flex-direction: row; justify-content: flex-start; margin-top: 0.3em;">
                              <small><s>Rp {{number_format($produk->harga, 0, '.', '.')}}</s></small>&nbsp;&nbsp;
                              <h6>Rp {{number_format($harga_diskon, 0, '.', '.')}}</h6>
                            </div>
                            @else
                            <div style="margin-top: 0.5em; text-align: left; color: black;">
                              @if (strlen($produk->nama) > 20) {{substr($produk->nama, 0, 20)}}... @else {{$produk->nama}} @endif</div>
                              <div style="padding-top: 0px; position: relative; display: flex; flex-direction: row; justify-content: flex-start; margin-top: 0.3em;">
                                <h6>Rp {{number_format($produk->harga, 0, '.', '.')}}</h6>
                              </div>
                              @endif
                              <a onclick="tambah_keranjang('{{$produk->id}}')" class="btn btn-danger" style="display: flex; justify-content: center; flex-direction: row;">
                                <div>
                                  <span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; color: white;"></span>&nbsp;&nbsp;
                                </div>
                                <div>Beli</div>
                              </a>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @section('footer')
  <script type="text/javascript" src="<?=url('/')?>/katalog_assets/assets/vendor/slick/slick.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>

  <script>
    function cari(){
      var tgl_mulai = $('#input_tgl_mulai').val();
      var tgl_akhir = $('#input_tgl_akhir').val();

      if(tgl_mulai != "" && tgl_akhir != ""){
        var this_url = window.location.origin;
        window.location.href = this_url+"/admin-analisis/produk/?tgl_mulai="+tgl_mulai+"&tgl_akhir="+tgl_akhir;
      }
    }

    $('#tgl_mulai').datetimepicker({
      format: 'L',
      format: 'YYYY-MM-DD'
    });

    $('#tgl_akhir').datetimepicker({
      format: 'L',
      format: 'YYYY-MM-DD'
    });
  </script>
  <script>

    $('.flash_sale').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
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

    Highcharts.chart('diagram', {
      chart: {
        type: 'bar'
      },
      title: {
        text: ''
      },
      subtitle: {
        text: ''
      },
      xAxis: {
        categories: {!! json_encode($nama_produk) !!},
        title: {
          text: null
        }
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Population (millions)',
          align: 'high'
        },
        labels: {
          overflow: 'justify'
        }
      },
      tooltip: {
        valueSuffix: ' millions'
      },
      plotOptions: {
        bar: {
          dataLabels: {
            enabled: true
          }
        }
      },
      legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
      },
      credits: {
        enabled: false
      },
      series: [{
        name: 'Produk',
        data: {!! json_encode($jumlah_produk) !!}
      }]
    });
  </script>
  @endsection