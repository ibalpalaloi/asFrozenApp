@extends('layouts.admin')
@section('header')
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<style>
  ion-icon {
    font-size: 17px;
  }
</style>

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

@endsection
@section('body')

{{-- modal --}}


{{--  modal detail produk--}}
<div class="modal fade bd-example-modal-lg" id="modal_detail_produk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div style="width: 100%;" class="modal-dialog modal-lg">
    <div class="modal-content">
      @include('admin.include.modal_detail_produk')
    </div>
  </div>
</div>
{{-- end modal detail produk --}}


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">DataTable with default features</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Produk</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($list_produk as $data)
              <tr>
                <td>
                  <div style="display:flex;">
                    <img src="<?=url('/')?>/img/produk/thumbnail/300x300/{{$data['foto']}}" style="width: 100px;">
                    <div style="display: flex; flex-direction: column; margin-left: 0.5em;">
                      <div id="nama_{{$data['id']}}">{{$data['nama']}}</div>
                      <div>
                       <small id="harga_{{$data['id']}}">
                        @if ($data['diskon'] > 0)
                        <s>Rp {{number_format($data['harga'], 0, '.','.')}}</s>
                        @else
                        Rp {{number_format($data['harga'], 0, '.','.')}}
                        @endif
                      </small>
                      <span>
                        @if ($data['diskon'] > 0)
                        @php 
                        $harga_diskon = round($data['harga']*$data['diskon']/100, 0);
                        @endphp
                        Rp. {{number_format($data['harga']-$harga_diskon, 0, '.','.')}}
                        @endif
                      </span><br>

                      @if ($data['diskon'] > 0) 
                      <badge class="badge badge-primary" href="#">{{$data['diskon']}}%
                      </badge>
                      @endif
                      @if ($data['diskon_mulai'] != null)                    
                        @php $sisa_diskon = strtotime($data['diskon_akhir']) - strtotime(date('Y-m-d')); @endphp
                     Berakhir {{round($sisa_diskon / (60 * 60 * 24))}} Hari lagi</small>
                      @endif
                    </div>
                  </div>
                </div>
              </td>
              <td id="stok_{{$data['id']}}">
                <a href="#" onclick="show_input_stok('{{$data['id']}}', '{{$data['stok']}}')">{{$data['stok']}}</a>
              </td>
              <td id="satuan_{{$data['id']}}">{{$data['satuan']}}</td>
              <td id="kategori_{{$data['id']}}">{{$data['kategori']}}</td>
              <td id="sub_kategori_{{$data['id']}}">{{$data['sub_kategori']}}</td>
              <td>
                <button class="btn btn-info" onclick="modal_detail_produk('{{$data['id']}}')">
                  <ion-icon name="pencil-outline"></ion-icon>
                </button>
                <button class="btn btn-danger">
                  <ion-icon name="trash-outline"></ion-icon>
                </button>
                <button class="btn btn-success">
                  <ion-icon name="eye-outline"></ion-icon>
                </button>
              </td>
            </tr>

            @endforeach
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
<script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#tgl_mulai').datetimepicker({
    format: 'L',
    format: 'YYYY-MM-DD'
  });

  $('#tgl_akhir').datetimepicker({
    format: 'L',
    format: 'YYYY-MM-DD'
  });

  var kategori;

  $('#post-update-produk').submit(function(e){
    e.preventDefault();
    let formData = new FormData(this);
    console.log(formData);

    $.ajax({
      type:'POST',
      url: `/post-update-produk`,
      data: formData,
      contentType: false,
      processData: false,
      success: (response) => {
       if (response) {
         console.log(response.produk);
         var produk = response.produk;
         var id = produk['id'];
         $('#nama_'+id).html(produk['nama']);
         $('#harga_'+id).html(produk['harga']);
         $('#satuan_'+id).html(produk['satuan']);
         $('#kategori'+id).html(produk['kategori']);
         $('#sub_kategori_'+id).html(produk['sub_kategori']);
       }
     },
     error: function(response){
      console.log(response);
      console.log(response);
    }
  });

    $('#modal_detail_produk').modal('hide');

  })

  $(function(){
    $.ajax({
      type: "GET",
      url: "<?=url('/')?>/get-kategori",
      success:function(data){
        kategori = data.kategori;
      }
    })
  })

  function change_sub_kategori(){
    var id_kategori = $('#detail_produk_kategori').val();
    $.ajax({
      type: "GET",
      url: "/get_list_sub_kategori/"+id_kategori,
      success:function(data){
        var sub_kategori = data.sub_kategori;
        sub_kategori_lenght = Object.keys(sub_kategori).length;
        var sub_kategori_html = "";
        for(let i = 0; i< sub_kategori_lenght; i++){
          sub_kategori_html += "<option value='"+sub_kategori[i]['id']+"' selected>"+sub_kategori[i]['sub_kategori']+"</option>"
        }

        $('#detail_produk_sub_kategori').html(sub_kategori_html);
      }
    })


  }

  function modal_detail_produk(id){
    $.ajax({
      type: "get",
      url: "<?=url('/')?>/get-detail-produk/"+id,
      success:function(data){
        var produk = data.produk;
        var sub_kategori = data.sub_kategori;
        $('#detail_produk_id').val(produk['id']);
        $('#detail_produk_nama').val(produk['nama']);
        $('#detail_produk_harga').val(produk['harga']);
        $('#detail_produk_satuan').val(produk['satuan']);
        $('#detail_produk_foto').val("");
        $('#detail_produk_foto_').attr("src", "<?=url('/')?>/img/produk/thumbnail/300x300/"+produk['foto']);

        var kategori_html = "";
        kategori_lenght = Object.keys(kategori).length;
        sub_kategori_lenght = Object.keys(sub_kategori).length;
        console.log(sub_kategori);
        for(let i = 0; i<kategori_lenght; i++){
          if(kategori[i]['kategori'] === produk['kategori']){
            kategori_html += "<option value='"+kategori[i]['id']+"' selected>"+kategori[i]['kategori']+"</option>"
          }
          else{
            kategori_html += "<option value='"+kategori[i]['id']+"'>"+kategori[i]['kategori']+"</option>"
          }

        }

        var sub_kategori_html = "";
        for(let i=0; i<sub_kategori_lenght; i++){
          if(sub_kategori[i]['sub_kategori'] === produk['sub_kategori']){
            sub_kategori_html += "<option value='"+sub_kategori[i]['id']+"' selected>"+sub_kategori[i]['sub_kategori']+"</option>"
          }
          else{
            sub_kategori_html += "<option value='"+sub_kategori[i]['id']+"'>"+sub_kategori[i]['sub_kategori']+"</option>"
          }

        }

        $('#detail_produk_kategori').html(kategori_html);
        $('#detail_produk_sub_kategori').html(sub_kategori_html);

        $('#modal_detail_produk').modal('show');
      }
    })

  }



  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  function show_input_stok(id, value){
    html = "<input style='width:  60px' onkeydown='ubah_stok("+id+")' id='input_stok_"+id+"' type='text' value='"+value+"'>";
    $('#stok_'+id).html(html);
  }

  function show_update_diskon(id){
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

  function ubah_stok(id){
    var stok = $('#input_stok_'+id).val();
    if(event.key === 'Enter' && stok != ""){
      $.ajax({
        type: "post",
        url: "<?=url('/')?>/admin/post-ubah-stok",
        data:{'id':id, 'stok':stok},
        success:function(data){
          console.log(data.status);
          if(data.status == "Success"){
            var html = "<a href='#' onclick='show_input("+id+", "+stok+")'>"+stok+"</a>";
            $('#stok_'+id).html(html);
          }
        }
      })
    }
    
  }

  function ubah_diskon(){
    var id = $('#input_id_produk').val();
    var diskon = $('#input_diskon').val();
    var tgl_mulai = $('#input_tgl_mulai').val();
    var tgl_akhir = $('#input_tgl_akhir').val();
    if(id != "" && diskon != ""){
      $.ajax({
        type: "post",
        url: "<?=url('/')?>/admin/post-ubah-diskon",
        data:{'id':id, 'diskon':diskon, 'tgl_mulai':tgl_mulai, 'tgl_akhir': tgl_akhir},
        success:function(data){
          console.log(data.status);
          if(data.status == "Success"){
            $('#modal_diskon').modal('hide');
          }

          $('#diskon_'+id).html(diskon);
        }
      })
    }
    
  }
</script>

@endsection