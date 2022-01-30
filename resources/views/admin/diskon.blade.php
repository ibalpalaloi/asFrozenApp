@extends('layouts.admin')

@section('body')
<?php
// fungsi untuk konversi tanggal ke indonesia
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
<div class="modal fade" id="modal_diskon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Diskon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?=url('/')?>/update-diskon" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="input_id_produk" hidden>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" class="form-control" id="input_nama" aria-describedby="emailHelp" placeholder="Nama Produk" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga</label>
                                <input type="text" class="form-control" id="input_harga" aria-describedby="emailHelp" placeholder="Harga" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diskon</label>
                                <input type="text" class="form-control" id="input_diskon" onkeyup="harga_diskon('input_harga', 'input_diskon', 'input_harga_diskon')" placeholder="Diskon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga Setelah Diskon</label>
                                <input type="text" class="form-control" id="input_harga_diskon" placeholder="Diskon">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai:</label>
                                <div class="input-group date" id="tgl_mulai_modal" data-target-input="nearest">
                                    <input type="date" id="input_tgl_mulai" class="form-control datetimepicker-input" data-target="#tgl_mulai"/>
                                    <div class="input-group-append" data-target="#tgl_mulai_modal" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Akhir:</label>
                                <div class="input-group date" id="tgl_akhir_modal" data-target-input="nearest">
                                    <input type="date" id="input_tgl_akhir" class="form-control datetimepicker-input" data-target="#tgl_akhir"/>
                                    <div class="input-group-append" data-target="#tgl_akhir_modal" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" onclick="ubah_diskon()">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_tambah_diskon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Diskon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?=url('/')?>/update-diskon" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="input_id_produk" hidden>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kategori</label>
                                <select type="text" class="form-control"  id="kategori" onchange="pilih_kategori()" aria-describedby="emailHelp" placeholder="Harga">
                                    <option>--- Silahkan Pilih Kategori ---</option>
                                    @foreach ($kategori as $row)
                                    <option value="{{$row->id}}">{{$row->kategori}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Kategori</label>
                                <select type="text" class="form-control"  id="sub_kategori" onchange="pilih_sub_kategori()" aria-describedby="emailHelp" placeholder="Harga">
                                    <option>--- Silahkan Pilih Kategori Terlebih Dahulu ---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <select type="text" class="form-control"  id="tambah_produk" onchange="pilih_produk()" aria-describedby="emailHelp" placeholder="Harga">
                                    <option>--- Silahkan Pilih Sub Kategori Terlebih Dahulu ---</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga</label>
                                <input type="text" class="form-control"  id="tambah_harga" aria-describedby="emailHelp" placeholder="Harga" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diskon</label>
                                <input type="number" class="form-control" id="tambah_diskon"  onkeyup="harga_diskon('tambah_harga', 'tambah_diskon', 'tambah_harga_diskon')" placeholder="Diskon" value="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga Setelah Diskon</label>
                                <input type="text" class="form-control" id="tambah_harga_diskon"  placeholder="Harga Diskon" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai:</label>
                                <div class="input-group date" id="tgl_mulai_modal" data-target-input="nearest">
                                    <input type="date" id="tambah_tgl_mulai" class="form-control datetimepicker-input" data-target="#tgl_mulai"/>
                                    <div class="input-group-append" data-target="#tgl_mulai_modal" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Akhir:</label>
                                <div class="input-group date" id="tgl_akhir_modal" data-target-input="nearest">
                                    <input type="date" id="tambah_tgl_akhir" class="form-control datetimepicker-input" data-target="#tgl_akhir"/>
                                    <div class="input-group-append" data-target="#tgl_akhir_modal" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" onclick="ubah_diskon()">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3" style="display: flex; align-items: center;">
                        <h4>List Diskon</h4>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-9">
                        <div class="row" style="display: flex; justify-content: flex-end;">
                            <div>
                                <div style="display: flex;">
                                    <label style="white-space: nowrap; display: flex; align-items: center;">Tanggal Awal:&nbsp;</label>
                                    <div class="input-group date" id="tgl_mulai" data-target-input="nearest">
                                        <input type="text" id="input_tgl_mulai" class="form-control datetimepicker-input" data-target="#tgl_mulai"/>
                                        <div class="input-group-append" data-target="#tgl_mulai" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-left: 1em;">
                                <div style="display: flex;">
                                    <label style="white-space: nowrap; display: flex; align-items: center;">Tanggal Akhir:&nbsp;</label>
                                    <div class="input-group date" id="tgl_akhir" data-target-input="nearest" style=" margin-bottom: 0px;">
                                        <input type="text" id="input_tgl_akhir" class="form-control datetimepicker-input" data-target="#tgl_akhir"/>
                                        <div class="input-group-append" data-target="#tgl_akhir" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-left: 1em;">
                                <div class="form-group" style="display: flex; flex-direction: column; justify-content: flex-start; align-items: flex-start; margin-bottom: 0px;">
                                    <div class="btn btn-primary" onclick="diskonBetween()">
                                        <i class="fa fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button id="btn_now" onclick="waktu_diskon('now')" style="width: 100%" type="button" class="btn btn-success">{{tgl_indo(date('Y-m-d', strtotime(date('Y-m-d'))))}}</button>
                    </div>
                    <div class="col">
                        <button id="btn_tomorrow" onclick="waktu_diskon('tomorrow')" style="width: 100%" type="button" class="btn btn-info">{{tgl_indo(date('Y-m-d', strtotime("+1 day", strtotime(date('Y-m-d')))))}}</button>
                    </div>
                    <div class="col">
                        <button id="btn_lainnya" onclick="waktu_diskon('lainnya')" style="width: 100%" type="button" class="btn btn-info">Lainnya</button>
                    </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                    <div class="col-md-12">
                        <div id="div_table" style="width: 100%;">
                            @include('admin.include.table_diskon')
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
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


<script>

    function pilih_kategori(){
        var kategori_id = $("#kategori").val();
        $.ajax({
            type: "GET",
            url: '<?=url('/')?>/admin/get/sub-kategori/'+kategori_id,
            dataType: 'json',
            success:function(data){
                var option = "<option disabled selected>--- Tidak ada Sub Kategori ---</option>";
                if (data.length > 0){
                    option = "<option disabled selected>--- Silahkan Pilih Sub Kategori ---</option>";
                    $.each(data, function(i, item){
                        option += "<option value='"+item.id+"'>"+item.sub_kategori+"</option>";
                    });
                }
                $("#sub_kategori").html(option);
            }
        })     
    }

    var harga_produk = [];

    function pilih_sub_kategori(){
        var sub_kategori_id = $("#sub_kategori").val();
        $.ajax({
            type: "GET",
            url: '<?=url('/')?>/admin/get/produk/'+sub_kategori_id,
            dataType: 'json',
            success:function(data){
                var option = "<option disabled selected>--- Tidak ada Produk ---</option>";
                if (data.length > 0){
                    option = "<option disabled selected>--- Silahkan Pilih Produk ---</option>";
                    harga_produk = [];
                    $.each(data, function(i, item){
                        option += "<option value='"+item.id+"'>"+item.nama+"</option>";
                        harga_produk[item.id] = item.harga;
                    });
                }
                $("#tambah_produk").html(option);
            }
        })     
    }

    function pilih_produk(){
        var produk_id = $("#tambah_produk").val();
        // alert(produk_id);
        var diskon = $("#tambah_diskon").val();
        var potongan_harga = parseInt(harga_produk[produk_id]*diskon/100);
        var harga_diskon = harga_produk[produk_id]-potongan_harga;
        $("#tambah_harga_diskon").val(harga_diskon.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
        $('#tambah_harga').val(harga_produk[produk_id].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));

    }

    function modal_diskon(id){
        $.ajax({
            type: "GET",
            url: '<?=url('/')?>/get-produk/'+id,
            dataType: 'json',
            success:function(data){
                // alert(data.diskon_mulai);
                var potongan_harga = data.harga-data.potongan_harga;
                $("#input_harga_diskon").val(potongan_harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
                $("#input_nama").val(data.produk);
                $("#input_harga").val(data.harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
                $("#input_diskon").val(data.diskon);
                $("#input_tgl_mulai").val(data.diskon_mulai);
                $("#input_tgl_akhir").val(data.diskon_akhir);
                $("#modal_diskon").modal('show');

            }
        })     

    }

    function tambah_diskon(){
        $('#modal_tambah_diskon').modal('show');
    }




    function harga_diskon(input_harga, input_diskon, input_harga_diskon){
        var harga = $("#"+input_harga).val().replace('.', "");;
        var diskon = $("#"+input_diskon).val();
        var potongan_harga = parseInt(harga*diskon/100);
        var harga_diskon = harga-potongan_harga;
        $("#"+input_harga_diskon).val(harga_diskon.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
    }

    function waktu_diskon(waktu){
        show_loader();
        // alert(waktu);
        $("#btn_now").removeClass('btn-success');
        $("#btn_tomorrow").removeClass('btn-success');
        $("#btn_lainnya").removeClass('btn-success');
        $("#btn_now").addClass('btn-info');
        $("#btn_tomorrow").addClass('btn-info');
        $("#btn_lainnya").addClass('btn-info');        
        if (waktu == 'now'){
            $("#btn_now").removeClass('btn-info');
            $("#btn_now").addClass('btn-success');
        }
        else if (waktu == 'tomorrow'){
            $("#btn_tomorrow").removeClass('btn-info');
            $("#btn_tomorrow").addClass('btn-success');
        }
        else {
            $("#btn_lainnya").removeClass('btn-info');
            $("#btn_lainnya").addClass('btn-success');
        }
        $.ajax({
            type: "GET",
            url: '?waktu='+waktu,
            success:function(data){
                setTimeout(hide_loader, 500);
                $('#div_table').html(data.html);
            }
        })
    }

    function diskonBetween(){
        var tgl_mulai = $('#input_tgl_mulai').val();
        var tgl_akhir = $('#input_tgl_akhir').val();

        if (tgl_mulai > tgl_akhir){
            $("#pesan-error-notif").html("Tanggal mulai tidak bisa lebih dari tanggal akhir");
            $("#header").html("Tanggal tidak valid");
            $("#icon").addClass("fas fa-times-circle");
            $("#header").css("color", "#dc3545");
            $("#icon").css("color", "#dc3545");
            $('#modal-footer-notif').css("background", "#dc3545");
            $('#modal-notif').modal('show');    
        }
        else {
            show_loader();
            $.ajax({
                type: "GET",
                url: '?waktu=between&tgl_mulai='+tgl_mulai+"&tgl_akhir="+tgl_akhir,
                success:function(data){
                    setTimeout(hide_loader, 500);
                    $("#btn_now").removeClass('btn-success');
                    $("#btn_tomorrow").removeClass('btn-success');
                    $("#btn_lainnya").removeClass('btn-success');
                    $("#btn_now").addClass('btn-info');
                    $("#btn_tomorrow").addClass('btn-info');
                    $("#btn_lainnya").addClass('btn-info');        
                    $('#div_table').html(data.html);
                }
            })            
        }
    }
</script>
@endsection