@extends('layouts.admin')

@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        @if (\Session::has('success'))
          <div class="alert alert-primary" role="alert">
              {!!\Session::get('success')!!}
          </div>
        @endif
        @if (\Session::has('error'))
          <div class="alert alert-danger" role="alert">
              {!!\Session::get('error')!!}
          </div>
        @endif
        <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Tambah Produk Baru</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="POST" action="/admin-post-produk-baru" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Kategori</label>
                      <select name="kategori" id="kategori" class="form-control">
                          <option value="">---</option>
                          @foreach ($kategori as $data)
                              <option value="{{$data->id}}">{{$data->kategori}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>Sub Kategori</label>
                        <select name="sub_kategori" id="sub_kategori" class="form-control">
                            <option value="">---</option>
                        </select>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="col-form-label" for="inputWarning"> Nama Produk</label>
                      <input name="nama_produk" type="text" class="form-control is-warning" id="inputWarning" placeholder="Nama Produk">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="col-form-label" for="inputWarning">Foto Produk</label>
                      <input name="foto_produk" type="file" class="form-control">
                    </div>
                  </div>
                </div>
                

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" class="form-control" name="satuan">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="text" class="form-control" name="harga">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Diskon (%)</label>
                            <input type="text" class="form-control" name="diskon">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="inputWarning"> Deskripsi Produk</label>
                  <textarea name="deskripsi" id="" cols="10" rows="2" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
      </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
      $('#kategori').on('change', function(){
        var id = this.value;
        get_sub_kategori(id);
      });

      function get_sub_kategori(id){
        $.ajax({
          type: "GET",
          url: "/get_list_sub_kategori/"+id,
          success:function(data){
            sub_kategori = data.sub_kategori;
            console.log(sub_kategori.length);
            var html = "<option value=''>---</option>"
            for(let i = 0; i < sub_kategori.length; i++){
              html += "<option value='"+sub_kategori[i]['id']+"'>"+sub_kategori[i]['sub_kategori']+"</option>"

            }
            $('#sub_kategori').empty();
            $('#sub_kategori').append(html);
          }
        })
      }
    </script>
@endsection