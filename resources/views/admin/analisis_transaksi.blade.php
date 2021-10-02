@extends('layouts.admin')

@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="row" style="padding: 10px">
                          <div class="col">
                            <div class="form-group">
                                <label>Tanggal Mulai:</label>
                                  <div class="input-group date" id="tgl_mulai" data-target-input="nearest">
                                      <input value="{{$startDate}}" type="text" id="input_tgl_mulai" class="form-control datetimepicker-input" data-target="#tgl_mulai"/>
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
                                      <input value="{{$endDate}}" type="text" id="input_tgl_akhir" class="form-control datetimepicker-input" data-target="#tgl_akhir"/>
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
                      <div id="diagram_jumlah_transaksi"></div>
                      <br><br>
                      <div id="diagram_total_transaksi"></div>
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
                window.location.href = this_url+"/admin-analisis/transaksi/?tgl_mulai="+tgl_mulai+"&tgl_akhir="+tgl_akhir;
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
        var tgl_mulai = $('#input_tgl_mulai').val();
        var tgl_akhir = $('#input_tgl_akhir').val();
        Highcharts.chart('diagram_jumlah_transaksi', {

            title: {
                text: 'Jumlah Transaksi tanggal, '+ tgl_mulai + ' - ' + tgl_akhir
            },

            subtitle: {
                text: 'Source: thesolarfoundation.com'
            },

            yAxis: {
                title: {
                    text: 'Number of Employees'
                }
            },

            xAxis: {
                categories: {!! json_encode($dateRange) !!},
                title: {
                    text: null
                }
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },

            series: [{
                name: 'Jumlah Transaksi',
                data: {!! json_encode($jumlah_transaksi) !!}
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

            });
    </script>

<script>
    var tgl_mulai = $('#input_tgl_mulai').val();
    var tgl_akhir = $('#input_tgl_akhir').val();
    Highcharts.chart('diagram_total_transaksi', {

        title: {
            text: 'Jumlah Total Transaksi tanggal, '+ tgl_mulai + ' - ' + tgl_akhir
        },

        subtitle: {
            text: 'Source: thesolarfoundation.com'
        },

        yAxis: {
            title: {
                text: 'Number of Employees'
            }
        },

        xAxis: {
            categories: {!! json_encode($dateRange) !!},
            title: {
                text: null
            }
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },

        series: [{
            name: 'Jumlah Total Transaksi',
            data: {!! json_encode($total_transaksi) !!}
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

        });
</script>
@endsection