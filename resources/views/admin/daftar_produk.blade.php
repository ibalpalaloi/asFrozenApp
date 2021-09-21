@extends('layouts.admin')
@section('header')
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<style>
    ion-icon {
        font-size: 17px;
    }
</style>
@endsection
@section('body')

{{-- modal --}}

<div class="modal fade" id="modal_diskon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" id="input_id_produk" hidden>
          <div class="form-group">
            <label for="exampleInputEmail1">Diskon</label>
            <input type="text" class="form-control" id="input_diskon" aria-describedby="emailHelp" placeholder="Diskon">
          </div>
          <div class="form-group">
            <label>Date:</label>
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input type="text" id="input_batas_tanggal" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="ubah_diskon()">simpan</button>
        </div>
      </div>
    </div>
  </div>


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
                        <th width="30%">Nama Produk</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                        <th width="10%">stok</th>
                        <th>Diskon</th>
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_produk as $data)
                        <tr>
                            <td id="nama_{{$data['id']}}">{{$data['nama']}}</td>
                            <td id="harga_{{$data['id']}}">{{$data['harga']}}</td>
                            <td id="satuan_{{$data['id']}}">{{$data['satuan']}}</td>
                            <td id="stok_{{$data['id']}}">
                              <a href="#" onclick="show_input_stok('{{$data['id']}}', '{{$data['stok']}}')">{{$data['stok']}}</a>
                            </td>
                            <td >
                              <a id="diskon_{{$data['id']}}" href="#" onclick="show_input_diskon('{{$data['id']}}', '{{$data['diskon']}}')">{{$data['diskon']}}</a>
                            </td>
                            <td id="kategori_{{$data['id']}}">{{$data['kategori']}}</td>
                            <td id="sub_kategori_{{$data['id']}}">{{$data['sub_kategori']}}</td>
                            <td>
                                <button onclick="modal_detail_produk('{{$data['id']}}')"><ion-icon name="pencil-outline"></ion-icon></button>
                                <button><ion-icon name="trash-outline"></ion-icon></button>
                                <button><ion-icon name="eye-outline"></ion-icon></button>
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

    $('#reservationdate').datetimepicker({
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
          $('#detail_produk_foto_').attr("src", "<?=url('/')?>/img/produk/"+produk['foto']);

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

  function show_input_diskon(id, value){
    $('#input_id_produk').val(id);
    $('#input_batas_tanggal').val("");
    $('#input_diskon').val(value);
    $('#modal_diskon').modal('show');
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
    var batas_tanggal = $('#input_batas_tanggal').val();
    if(id != "" && diskon != ""){
      $.ajax({
        type: "post",
        url: "<?=url('/')?>/admin/post-ubah-diskon",
        data:{'id':id, 'diskon':diskon, 'batas_tanggal':batas_tanggal},
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