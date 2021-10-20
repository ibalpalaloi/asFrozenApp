@extends('layouts.admin')

@section('body')
{{-- modal --}}
<div class="modal fade" id="modal_ubah_diskon" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Diskon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Produk</label>
            <input readonly type="text" class="form-control" id="modal_nama_produk" aria-describedby="emailHelp" placeholder="">
          </div>
          <div class="row">
            <div class="col-2">
              <div class="form-group">
                  <label>Diskon</label>
                  <div class="input-group date" id="" >
                      <input type="text" id="input_diskon" class="form-control"/>
                  </div>
              </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label>Tanggal Mulai:</label>
                    <div class="input-group date" id="input_tgl_mulai" data-target-input="nearest">
                        <input type="text" id="input_tgl_mulai_" class="form-control datetimepicker-input" data-target="#input_tgl_mulai"/>
                        <div class="input-group-append" data-target="#input_tgl_mulai" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label>Tanggal Akhir:</label>
                    <div class="input-group date" id="input_tgl_akhir" data-target-input="nearest">
                        <input type="text" id="input_tgl_akhir_" class="form-control datetimepicker-input" data-target="#input_tgl_akhir"/>
                        <div class="input-group-append" data-target="#input_tgl_akhir" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="post_ubah_diskon()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
{{--  --}}

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Manajemen Diskon</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <input type="text" class="form-control" style="width: 400px" id="cari_produk" onchange="cari_produk()">
            <br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nama Produk</th>
                  <th>Diskon</th>
                  <th>harga</th>
                  <th>harga Diskon</th>
                  <th>Waktu Diskon</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tbody_daftar_produk">
                @include('admin.include.data_manajemen_diskon')
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
   $('#input_tgl_mulai').datetimepicker({
        format: 'L',
        format: 'YYYY-MM-DD'
    });

    $('#input_tgl_akhir').datetimepicker({
        format: 'L',
        format: 'YYYY-MM-DD'
    });
</script>
<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  var id_produk;

  function modal_ubah_diskon(id){
    $.ajax({
      type: "get",
      url: "/get-data-diskon/"+id,
      success:function(data){
        var diskon = data.data_diskon;
        console.log(diskon);
        $('#modal_nama_produk').val(diskon['nama_produk']);
        $('#input_tgl_mulai_').val(diskon['diskon_mulai']);
        $('#input_tgl_akhir_').val(diskon['diskon_akhir']);
        $('#input_diskon').val(diskon['diskon']);
        id_produk = diskon['id'];
        $('#modal_ubah_diskon').modal('show');
      }
    })
  }

  function post_ubah_diskon(){
    console.log('post_ubah_diskon');
    var diskon = $('#input_diskon').val();
    var tgl_mulai = $('#input_tgl_mulai_').val();
    var tgl_akhir = $('#input_tgl_akhir_').val();

    $.ajax({
      type: "post",
      url: "/admin/post_ubah_diskon",
      data: {'diskon': diskon, 'tgl_mulai': tgl_mulai, 'tgl_akhir': tgl_akhir, 'id_produk': id_produk},
      success:function(data){
        console.log(data);
        ubah_data_tabel_diskon(data.data_diskon, id_produk);
        $('#modal_ubah_diskon').modal('hide');
      }
    })
  }

  function ubah_data_tabel_diskon(data, id_produk){
    $('#harga_data_'+id_produk).html("Rp. "+data['harga']);
    $('#harga_diskon_data_'+id_produk).html("Rp. "+data['harga_diskon']);
    $('#diskon_data_'+id_produk).html(data['diskon']+"%");
    $('#waktu_diskon_data_'+id_produk).html(data['diskon_mulai']+" - "+data['diskon_akhir']);
  }

  function cari_produk(){
    var keyword = $('#cari_produk').val();
      $.ajax({
        type: "GET",
        url: "?keyword="+keyword,
        success:function(data){
          $('#tbody_daftar_produk').html(data.view);
        }
      })
  }

  function konfirmasi_hapus_diskon(id){
    swal("Yakin Ingin Hapus Diskon ?")
    .then((value) => {
      hapus_diskon(id);
    });
  }

  function hapus_diskon(id){
    $.ajax({
      type: "get",
      url: "/admin/hapus_diskon/"+id,
      success:function(data){
        var data_diskon = data.data_diskon;
        console.log(data_diskon);
        ubah_data_tabel_diskon(data_diskon, data_diskon['id_produk']);
      }

    })
  }
</script>
@endsection