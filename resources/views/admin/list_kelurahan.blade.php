@extends('layouts.admin')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection

@section('body')

<!-- Modal tambah kelurahan-->
<div class="modal fade" id="modal_tambah_kelurahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?=url('/')?>/admin-post-kelurahan" method="post">
            @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Kota</label>
                    <select name="kota" class="form-control" id="select_kota">
                        <option value="">Pilih Kota</option>
                        @foreach ($kota as $data)
                            <option value="{{$data->id}}">{{$data->kota}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Kecamatan</label>
                    <select name="kecamatan" class="form-control" id="select_kecamatan">
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Kelurahan</label>
                    <input type="text" class="form-control" id="" name="kelurahan" placeholder="Nama Kelurahan">
                </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
</div>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="card">
              <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_kelurahan">Tambah Kelurahan</button>
                  <br><br>
                    <table id="example1" class="table">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Kota</th>
                              <th>Kecamatan</th>
                              <th>Kelurahan</th>
                          </tr>
                      </thead>
                      <tbody>
                          @php
                              $no=1;
                          @endphp
                          @foreach ($data_kelurahan as $data)
                              <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$data['kota']}}</td>
                                  <td>{{$data['kecamatan']}}</td>
                                  <td>{{$data['kelurahan']}}</td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
    </div>
</div>
@endsection

@section('footer')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    } );

    $('#select_kota').change(function(){
        var id_kota = $('#select_kota').val();
        var option = "<option value=''>Pilih Kecamatan</option>";
        $.ajax({
            type: "get",
            url: "<?=url('/')?>/get_kecamatan/"+id_kota,
            success:function(data){
                var kecamatan = data.kecamatan;
				var kecamatan_lenght = Object.keys(kecamatan).length;
				for(let i = 0; i< kecamatan_lenght; i++){
					option += "<option value='"+kecamatan[i]['id']+"'>"+kecamatan[i]['kecamatan']+"</option>"
				}
				$("#select_kecamatan").html(option);
            }
        })
    })
</script>
@endsection