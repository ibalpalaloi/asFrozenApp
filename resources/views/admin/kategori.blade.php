@extends("layouts.admin")

@section('header')

@endsection
@section("body")
{{-- modal tambah kategori --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah kategori baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="admin-post-kategori-baru" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="form-group">
            <label for="exampleInputEmail1">Nama kategori</label>
            <input type="text" name="kategori" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Logo</label>
            <input name="logo" type="file" class="form-control" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- end modal tambah kategori --}}
{{-- modal tambah sub kategori --}}
<div class="modal fade" id="modal_tambah_sub_kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah kategori baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="admin-post-sub-kategori-baru" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="form-group">
            <label for="exampleInputEmail1">Kategori</label>
            <select name="kategori_id" id="" class="form-control" required>
              <option value=""></option>
              @foreach ($kategori as $data)
              <option value="{{$data->id}}">{{$data->kategori}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Sub Kategori</label>
            <input name="sub_kategori" type="text" class="form-control" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- end modal tambah sub kategori --}}
{{-- modal ubah kategori --}}
<div class="modal fade" id="modal_ubah_kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="admin-post-update-kategori" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input hidden name="kategori_id" id="kategori_id_ubah_kategori" type="text" class="form-control" required>
          <div class="form-group">
            <label for="exampleInputEmail1">Kategori</label>
            <input name="kategori" id="kategori_ubah_kategori" type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Logo</label>
            <input name="logo" type="file" class="form-control" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- end modal ubah kategori --}}

{{-- modal ubah sub kategori --}}
<div class="modal fade" id="modal_ubah_sub_kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Sub Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="admin-post-update-sub-kategori" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input hidden name="sub_kategori_id" id="kategori_id_ubah_sub_kategori" type="text" class="form-control" required>
          <div class="form-group">
            <label for="exampleInputEmail1">Kategori</label>
            <input name="sub_kategori" id="kategori_ubah_sub_kategori" type="text" class="form-control" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="{{url('/')}}/admin-delete-kategori" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div style="text-align: center;">
            <input type="text" name="id" id="hapus_id" hidden>
            <i class="fa fa-trash" style="font-size: 5em; color: #dc3545;"></i>
            <h4 style="margin-top: 0.5em;">Apakah anda yakin ingin menghapus data?</h4>
            <div style="margin-top: 0.5em;"></div>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary">Hapus</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" style=" background: #dc3545; border: 1px solid #dc3545;">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- end modal ubah sub kategori --}}

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <br>
      @if (\Session::has('error'))
      <div class="alert alert-danger" role="alert">
        {!!\Session::get('error')!!}
      </div>
      @endif
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Kategori</button>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_sub_kategori">Tambah Sub Kategori</button>
      <br><br>
      <div class="card">

        <div class="row" style="padding: 10px">
          <div class="col">
            <ul class="list-group">
              @foreach ($kategori as $data)
              <li class="list-group-item" style="display: flex; justify-content: space-between;">
                <div style="display: flex;">
                  <div style="width: 50px; margin-right: 1em;">
                    <img src="<?=url('/')?>/icon_kategori/thumbnail/75x75/{{$data->logo}}" style="width: 100%;">
                  </div>
                  <div style="color: black;text-align: left; cursor: pointer;" onclick="get_sub_kategori('{{$data->id}}')">{{$data->kategori}}<br><small>Sub Kategori : {{$data->sub_kategori->count()}}</small>
                  </div>
                </div>
                <span>
                  <button class="btn btn-info" onclick="modal_ubah_kategori('{{$data->id}}', '{{$data->kategori}}')">Ubah</button>
                  <button class="btn btn-danger" onclick="modal_hapus_kategori('{{$data->id}}')">Hapus</button>
                </span>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="col">
            <ul class="list-group" id="list_sub_kategori">
            </ul>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  var sub_kategori;
  function get_sub_kategori(id_kategori){
    $.ajax({
      type: "GET",
      url: "/get_list_sub_kategori/"+id_kategori,
      success:function(data){
        sub_kategori = data.sub_kategori;
        console.log(sub_kategori.length);
        var html = ""
        for(let i = 0; i < sub_kategori.length; i++){
          html += "<li class='list-group-item d-flex justify-content-between align-items-center'>" + sub_kategori[i]['sub_kategori'] +"<span><button class='btn btn-info' onclick='modal_ubah_sub_kategori("+i+")' style='margin-right: 5px;'>Ubah</button><button class='btn btn-danger'>Hapus</button></span>" +"</li>";

        }
        $('#list_sub_kategori').empty();
        $('#list_sub_kategori').append(html);
      }
    })
  }

  function modal_ubah_kategori(id, kategori){
    $('#kategori_id_ubah_kategori').val(id);
    $('#kategori_ubah_kategori').val(kategori);
    $('#modal_ubah_kategori').modal('show');
  }

  function modal_ubah_sub_kategori(index){
    $('#kategori_id_ubah_sub_kategori').val(sub_kategori[index]['id']);
    $('#kategori_ubah_sub_kategori').val(sub_kategori[index]['sub_kategori']);
    $('#modal_ubah_sub_kategori').modal('show');
  }

  function modal_hapus_kategori(id){
    $("#hapus_id").val(id);
    $("#modal_hapus").modal('show');
  }
</script>
@endsection