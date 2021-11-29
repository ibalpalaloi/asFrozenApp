@extends('layouts.admin')

@section('header')
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/katalog_assets/assets/vendor/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?=url('/')?>/public/katalog_assets/assets/vendor/slick/slick-theme.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=url('/')?>/public/AdminLTE/plugins/retro-plugins/css/flip-clock.css" />
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
<div class="modal fade" id="modal_filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filter Analisa Produk
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 1em; position: absolute;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Rentan Waktu</label>
            <select class="form-control" name="rentan_waktu" id="rentan_waktu" onchange="select_rentan_waktu()">
              <?php
              $hari = array('Hari ini', '3 hari terakhir', '7 hari terakhir', '30 hari terakhir', '90 hari terakhir', 'Pilih Tanggal');

              if (isset($_GET['rentan_waktu'])){
                $select_rentan_waktu = $_GET['rentan_waktu'];
              }
              else {
                $select_rentan_waktu = '7 hari terakhir';
              }
              ?>
              @foreach ($hari as $row)
              <option value="{{$row}}" @if ($row == $select_rentan_waktu) selected @endif>{{$row}}</option>
              @endforeach
            </select>
          </div>
          <div class="row" id="div_pilih_tanggal" hidden>
            <div class="col-md-6">
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
            <div class="col-md-6">
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
          </div> 
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" onclick="cari_filter()">Cari</button>
        </div>

      </div>
    </div>
  </div>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header" style="position: relative;">
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                  <text x="293" text-anchor="middle" class="highcharts-title" data-z-index="4" style="color:#333333;font-size:18px;fill:#333333;" y="24">Pelanggan Dengan Jumlah Transaksi Terbanyak</text>
                  <text>{{$text_rentan_waktu}}</text>
                </div>
                <div class="btn btn-danger" onclick="modal_filter()" style="position: absolute; right: 1em; top: 1em;">
                  Filter
                </div>
              </div>
              <div class="card-body">
                @if (count($top_transaksi['jumlah']) > 0)
                <div class="row">
                  <div class="col-md-9">
                    <div id="diagram"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
                      <div class="flash_sale" style="width: 100%;">
                        @foreach ($top_transaksi['jumlah'] as $data)
                        <div class="d-flex" style="margin-left: 0.5em; margin-right: 0.5em; padding-bottom: 0px;  -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%); margin-bottom: 1em; margin-top: 1em;">
                          <div class="member" style="position: relative; margin-bottom: 0px;">
                            <div class="member-img">
                              <img src="<?=url('/')?>/public/img/default.png" class="img-fluid" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
                            </div>
                            <div class="member-info" style=" padding: 0em 0.7em 0.8em;">
                              <div style="margin-top: 0.5em; text-align: left; color: black;">
                                {{$data['nama']}}
                              </div>
                              <div style="padding-top: 0px; position: relative; display: flex; flex-direction: column; justify-content: flex-start; margin-top: 0em;">
                                <small>{{$data['jenis_kelamin']}} - {{$data['no_telp']}}</small>
                                <small>{{$data['jumlah_transaksi']}} Transaksi - Rp. {{number_format($data['total_transaksi'], 0, '.', '.')}}</small>
                              </div>
                              <a onclick="tambah_keranjang()" class="btn btn-danger" style="display: flex; justify-content: center; flex-direction: column; color: white; align-items: center; margin-top: 0.4em;">
                                <div>Top {{$loop->iteration}}</div>
                              </a>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                @else
                <div style="text-align: center; padding: 3em;">
                  <h1>Tidak ada transaksi</h1>
                </div>
                @endif
              </div>
              <div class="card-header" style="position: relative;">
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                  <text x="293" text-anchor="middle" class="highcharts-title" data-z-index="4" style="color:#333333;font-size:18px;fill:#333333;" y="24">Pelanggan Dengan Total Transaksi Terbanyak</text>
                  <text>{{$text_rentan_waktu}}</text>
                </div>
              </div>
              <div class="card-body">
                @if (count($top_transaksi['total']) > 0)
                <div class="row">
                  <div class="col-md-9">
                    <div id="diagram5"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
                      <div class="flash_sale" style="width: 100%;">
                        @foreach ($top_transaksi['total'] as $data)
                        <div class="d-flex" style="margin-left: 0.5em; margin-right: 0.5em; padding-bottom: 0px;  -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%); margin-bottom: 1em; margin-top: 1em;">
                          <div class="member" style="position: relative; margin-bottom: 0px;">
                            <div class="member-img">
                              <img src="<?=url('/')?>/public/img/default.png" class="img-fluid" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
                            </div>
                            <div class="member-info" style=" padding: 0em 0.7em 0.8em;">
                              <div style="margin-top: 0.5em; text-align: left; color: black;">
                                {{$data['nama']}}
                              </div>
                              <div style="padding-top: 0px; position: relative; display: flex; flex-direction: column; justify-content: flex-start; margin-top: 0em;">
                                <small>{{$data['jenis_kelamin']}} - {{$data['no_telp']}}</small>
                                <small>Rp. {{number_format($data['total_transaksi'], 0, '.', '.')}} - {{$data['jumlah_transaksi']}} Transaksi</small>
                              </div>
                              <a onclick="tambah_keranjang()" class="btn btn-danger" style="display: flex; justify-content: center; flex-direction: column; color: white; align-items: center; margin-top: 0.4em;">
                                <div>Top {{$loop->iteration}}</div>
                              </a>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                @else
                <div style="text-align: center; padding: 3em;">
                  <h1>Tidak ada transaksi</h1>
                </div>
                @endif
              </div>
              <div class="card-header" style="position: relative;">
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                  <text x="293" text-anchor="middle" class="highcharts-title" data-z-index="4" style="color:#333333;font-size:18px;fill:#333333;" y="24">Rekap Transaksi Berdasarkan Jenis Kelamin</text>
                  <text>{{$text_rentan_waktu}}</text>
                </div>
              </div>
              <div class="card-body">
                @if ($jenis_kelamin->count() > 0)
                <div class="row">
                  <div class="col-md-3" style="display: flex; flex-direction: column; justify-content: center; align-items: flex-end;"> 
                    <?php
                    $total = $jenkel['jumlah'][0]+$jenkel['jumlah'][1];
                    ?>
                    <h1>Perempuan</h1>
                    <h4>{{$jenkel['jumlah'][1]}} Transaksi</h4>
                    <h3>{{round($jenkel['jumlah'][1]/$total*100, 0)}}%</h3>
                  </div>
                  <div class="col-md-6">
                    <div id="diagram3"></div>
                  </div>
                  <div class="col-md-3" style="display: flex; flex-direction: column; justify-content: center; align-items: flex-start;">                    
                    <h1>Laki - Laki</h1>
                    <h4>{{$jenkel['jumlah'][0]}} Transaksi</h4>
                    <h3>{{round($jenkel['jumlah'][0]/$total*100, 0)}}%</h3>
                  </div>
                </div>
                @else
                <div style="text-align: center; padding: 3em;">
                  <h1>Tidak ada transaksi</h1>
                </div>
                @endif
              </div>



            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @section('footer')
  <script type="text/javascript" src="<?=url('/')?>/public/katalog_assets/assets/vendor/slick/slick.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>

  <script>
    function cari_filter(){
      var rentan_waktu = $("#rentan_waktu").val();
      var kategori = $("#kategori").val();
      var input_tgl_mulai = $("#input_tgl_mulai").val();
      var input_tgl_akhir = $("#input_tgl_akhir").val();
      location.href="{{url()->current()}}?rentan_waktu="+rentan_waktu+"&tgl_mulai="+input_tgl_mulai+"&tgl_akhir="+input_tgl_akhir;
    }

    function modal_filter(){
      $("#modal_filter").modal('show');
    }

    function select_rentan_waktu(){
      var rentan = $("#rentan_waktu").val();
      if (rentan == 'Pilih Tanggal'){
        $("#div_pilih_tanggal").prop('hidden', false);
      }
      else {
        $("#div_pilih_tanggal").prop('hidden', true);
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
        categories: {!! json_encode($jumlah['nama_pelanggan']) !!},
        title: {
          text: null
        }
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Jumlah Terjual',
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
        enabled: false,
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
        colorByPoint: true,
        data: {!! json_encode($jumlah['transaksi']) !!}
      }]
    });

    Highcharts.chart('diagram5', {
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
        categories: {!! json_encode($total['nama_pelanggan']) !!},
        title: {
          text: null
        }
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Jumlah Terjual',
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
        enabled: false,
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
        colorByPoint: true,
        data: {!! json_encode($total['transaksi']) !!}
      }]
    });


    Highcharts.chart('diagram3', {
      chart: {
        type: 'pie'
      },
      title: {
        text: ''
      },
      subtitle: {
        text: ''
      },
      xAxis: {
        categories: {!! json_encode($jenkel['jenis']) !!},
        title: {
          text: null
        }
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Jumlah Terjual',
          align: 'high'
        },
        labels: {
          overflow: 'justify'
        }
      },
      tooltip: {
        valueSuffix: ' Transaksi'
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
        enabled: false,
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
        name: 'Jenis Kelamin',
        data: {!! json_encode($jenkel['jumlah']) !!}
      }],
      colors: ['#34aeff', '#ff4f81']
    });

  </script>

  @endsection