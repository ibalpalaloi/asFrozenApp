@extends('layouts.admin')

@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <label>Tanggal Mulai:</label>
                              <div class="input-group date" id="tgl_mulai" data-target-input="nearest">
                                  <input type="text" id="input_tgl_mulai" class="form-control datetimepicker-input" data-target="#tgl_mulai"/>
                                  <div class="input-group-append" data-target="#tgl_mulai" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Tanggal Akhir:</label>
                              <div class="input-group date" id="tgl_akhir" data-target-input="nearest">
                                  <input type="text" id="input_tgl_akhir" class="form-control datetimepicker-input" data-target="#tgl_akhir"/>
                                  <div class="input-group-append" data-target="#tgl_akhir" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                        </div>
                    </div>
                    <div class="col-8 text-left">
                        <div class="input-group-append" data-target="" data-toggle="datetimepicker">
                            <div class="input-group-text" onclick="diskonBetween('between')"><i class="fa fa-search"></i></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button onclick="waktu_diskon('now')" style="width: 100%" type="button" class="btn btn-light">Sedang Diskon</button>
                    </div>
                    <div class="col">
                        <button onclick="waktu_diskon('future')" style="width: 100%" type="button" class="btn btn-light">Akan Datang</button>
                    </div>
                    <div class="col">
                        <button onclick="waktu_diskon('past')" style="width: 100%" type="button" class="btn btn-light">Sudah Lewat</button>
                    </div>
                </div>
                <br>
                <div id="div_table">
                    @include('admin.include.table_diskon')
                </div>
                
            </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
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
        function waktu_diskon(waktu){
            $.ajax({
                type: "GET",
                url: '?waktu='+waktu,
                success:function(data){
                    $('#div_table').html(data.html);
                }
            })
        }

        function diskonBetween(){
            var tgl_mulai = $('#input_tgl_mulai').val();
            var tgl_akhir = $('#input_tgl_akhir').val();

            if(tgl_mulai != "" && tgl_akhir != ""){
                $.ajax({
                type: "GET",
                url: '?waktu=between&tgl_mulai='+tgl_mulai+"&tgl_akhir="+tgl_akhir,
                success:function(data){
                    $('#div_table').html(data.html);
                }
            })
            }
        }
    </script>
@endsection