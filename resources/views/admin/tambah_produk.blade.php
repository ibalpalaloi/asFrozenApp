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
          <form method="POST" action="<?=url('/')?>/admin-post-produk-baru" enctype="multipart/form-data">
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
                <div class="form-group" hidden>
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
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Satuan</label>
                  <input type="text" class="form-control" name="satuan">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Harga (Rp)</label>
                  <input type="text" class="form-control" id="harga" name="harga">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Stok</label>
                  <input type="number" class="form-control" name="stok">
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
      url: "<?=url('/')?>/get_list_sub_kategori/"+id,
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


  $("#harga").on("keydown", function(e) {
    var keycode = (event.which) ? event.which : event.keyCode;
    if (e.shiftKey == true || e.ctrlKey == true) return false;
    if ([8, 110, 39, 37, 46].indexOf(keycode) >= 0 || (keycode == 190 && this.value.indexOf('.') === -1) || (keycode == 110 && this.value.indexOf('.') === -1) || (keycode >= 48 && keycode <= 57) || (keycode >= 96 && keycode <= 105)) {
      var parts = this.value.split('.');
      if (parts.length > 1 && parts[1].length >= 2 && ((keycode >= 48 && keycode <= 57) || (keycode >= 96 && keycode <= 105))) {
        return false;
      } 
      else {
        if (keycode == 110) {
          this.value += ".";
          return false;
        }
        return true;
      }
    } 
    else {
      return false;
    }
  }).on("keyup", function() {
    var parts = this.value.split('.');
    parts[0] = parts[0].replace(/,/g, '').replace(/^0+/g, '');
    if (parts[0] == "") parts[0] = "0";
    var calculated = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    if (parts.length >= 2) calculated += "." + parts[1].substring(0, 2);
    this.value = calculated;
    if (this.value == "NaN" || this.value == "") this.value = 0;
  });

</script>
@endsection