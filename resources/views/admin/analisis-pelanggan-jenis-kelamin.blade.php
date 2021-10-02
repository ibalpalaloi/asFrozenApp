@extends('layouts.admin')

@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="row">
              <div class="col-3">
                  <div class="card">
                      <div style="padding: 10px">
                         @include('admin.include.menu-analisis-pelanggan')
                      </div>
                  </div>
              </div>
              <div class="col-9">
                  <div class="card">
                      <div class="row" style="padding: 10px">
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
                      <div id="diagram"></div>
                      <div id="tabel" style="margin: 10px; padding: 10px">
                          
                      </div>
                  </div>
                 
              </div>
          </div>
      </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        function cari(){
            var tgl_mulai = $('#input_tgl_mulai').val();
            var tgl_akhir = $('#input_tgl_akhir').val();

            if(tgl_mulai != "" && tgl_akhir != ""){
                var this_url = window.location.origin;
                window.location.href = this_url+"/admin-analisis/pelanggan/jenis-kelamin?tgl_mulai="+tgl_mulai+"&tgl_akhir="+tgl_akhir;
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
        Highcharts.chart('diagram', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Browser market shares in January, 2018'
            },

            colors: ['#3D71EA','#FE5C5C'],

            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Pria('+{!! json_encode($jumlah_pria) !!}+')',
                    y: {!! json_encode($presentase_pria) !!},
                }, {
                    name: 'Wanita('+{!! json_encode($jumlah_wanita) !!}+')',
                    y: {!! json_encode($presentase_wanita) !!}
                }]
            }]
        });
    </script>
    
@endsection