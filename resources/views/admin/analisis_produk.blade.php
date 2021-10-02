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
                        <li><a href="/admin-analisis/produk">Produk</a></li>
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
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>Nama Produk</th>
                                      <th>Total Penjualan</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($produk as $data)
                                      <tr>
                                          <td>{{$data->produk}}</td>
                                          <td>{{$data->jumlah}}</td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
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
        Highcharts.chart('diagram', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Historic World Population by Region'
            },
            subtitle: {
                text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
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