@extends('layouts.admin')

@section('body')
<style type="text/css">
    <?php
    function tgl_indo($tanggal){
      $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

      $pecahkan = explode('-', $tanggal);     
      return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  }
  ?>

</style>
<div class="modal fade" id="modal_filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter Analisa Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 1em; position: absolute;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Rentan Waktu</label>
                    <select class="form-control" name="rentan_waktu" id="rentan_waktu" onchange="select_rentan_waktu()">
                        <?php
                        $hari = array('7 hari terakhir', '30 hari terakhir', '60 hari terakhir', '90 hari terakhir', 'Pilih Tanggal');

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
                                <input value="" type="text" id="input_tgl_mulai" class="form-control datetimepicker-input" data-target="#tgl_mulai"/>
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
                                <input value="" type="text" id="input_tgl_akhir" class="form-control datetimepicker-input" data-target="#tgl_akhir"/>
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
                                <text x="293" text-anchor="middle" class="highcharts-title" data-z-index="4" style="color:#333333;font-size:18px;fill:#333333;" y="24">
                                    Transaksi Pembelian AsFrozen
                                </text>
                                <text>{{$text_rentan_waktu}}</text>
                                <text></text>
                            </div>
                            <div class="btn btn-danger" onclick="modal_filter()" style="position: absolute; right: 1em; top: 1em;">
                                Filter
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div id="diagram_jumlah_transaksi"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
                                        <h6 style="text-align: center;">Top 5 Jumlah Transaksi</h6>
                                        <hr style="margin-top: 0px;">
                                        @for ($i = 0; $i < 5; $i++)
                                        <div>
                                            <small>{{$i+1}}. Minggu, {{tgl_indo(date('Y-m-d', strtotime($top_transaksi['jumlah'][$i]['tanggal'])))}}</small>
                                            <div style="margin-left: 0.7em;">{{$top_transaksi['jumlah'][$i]['jumlah_transaksi']}} Transaksi</div>
                                        </div>
                                        @endfor
                                        <hr>
                                        <h6 style="text-align: center;">Lihat Selengkapnya</h6>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="margin-top: 2em;">
                                <div class="col-md-9">
                                    <div id="diagram_total_transaksi"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
                                        <h6 style="text-align: center;">Top 5 Transaksi Terbesar</h6>
                                        <hr style="margin-top: 0px;">
                                        @for ($i = 0; $i < 5; $i++)
                                        <div>
                                            <small>{{$i+1}}. Minggu, {{tgl_indo(date('Y-m-d', strtotime($top_transaksi['total'][$i]['tanggal'])))}}</small>
                                            <div style="margin-left: 0.7em;">Rp. {{number_format($top_transaksi['total'][$i]['total_transaksi'], 0, '.', '.')}}</div>
                                        </div>
                                        @endfor
                                        <hr>
                                        <h6 style="text-align: center;">Lihat Selengkapnya</h6>
                                    </div>
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

    function cari_filter(){
        var rentan_waktu = $("#rentan_waktu").val();
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
</script>
<script>
    var tgl_mulai = $('#input_tgl_mulai').val();
    var tgl_akhir = $('#input_tgl_akhir').val();
    Highcharts.chart('diagram_jumlah_transaksi', {

        title: {
            text: ''
        },

        subtitle: {
            text: ''
        },

        yAxis: {
            title: {
                text: 'Jumlah Transaksi'
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
            enabled: false,
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
            text: ''
        },

        subtitle: {
            text: ''
        },

        yAxis: {
            title: {
                text: 'Total Transaksi'
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
            enabled: false,
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