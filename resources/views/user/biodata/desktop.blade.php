@extends("layouts.user_data")

@section('title-header')
Keranjang Belanja
@endsection

@section('content')
<div class="card shadow p-3 mb-5 bg-white rounded">
  <div tabindex="0" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide11">

    <div style="padding: 30px">
      <form action="{{url()->current()}}/update" method="post">
        @csrf
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-3 col-form-label">Nama</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="staticEmail" name="nama" value="{{$user->nama}}" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-3 col-form-label">No Telp</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="staticEmail" name="no_telp" value="{{$user->no_telp}}" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-3 col-form-label">Jenis Kelamin</label>
          <div class="col-sm-3" style="margin-left: 20px">
            <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios1" value="Laki-Laki" @if ($user->jenis_kelamin == 'Laki-Laki') checked @endif>
            <label class="form-check-label" for="exampleRadios1">
              Laki-Laki
            </label>
          </div>
          <div class="col-sm-3">
            <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios1" value="Perempuan" @if ($user->jenis_kelamin == 'Perempuan') checked @endif>
            <label class="form-check-label" for="exampleRadios1">
              Perempuan
            </label>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="staticEmail" name="email" value="{{$user->user->email}}" required>
          </div>
        </div>
        <?php
          $from = "";
          if (isset($_GET['from'])){
            $from = $_GET['from'];
          }
        ?>
        <div class="form-group row">
          <input type="text" name="from" value="{{$from}}" hidden>
          <label for="staticEmail" class="col-sm-3 col-form-label">Alamat</label>
          <div class="col-sm-9">
            <input type="text" name="alamat" class="form-control" value="{{$user->alamat}}" required @if ($from == 'keranjang') style="border:1px solid red;" @endif>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-3 col-form-label">Kota/Kabupaten</label>
          <div class="col-sm-9">
            <select name="kota" class="form-control" onchange="get_kecamatan()" id="selectKota" required @if ($from == 'keranjang') style="border:1px solid red;" @endif>
              <option value="" disabled selected>Pilih Kota/Kabupaten</option>
              <?php
              $kota_id = "";
              if ($user->kelurahan_id){
                $kota_id = Auth()->user()->biodata->kelurahan->kecamatan->kota->id;
                $kecamatan_id = Auth()->user()->biodata->kelurahan->kecamatan->id;
                $kelurahan_id = Auth()->user()->biodata->kelurahan->id;
              }
              ?>
              @foreach($kota as $data)
              <option value="{{$data->id}}" @if($kota_id == $data->id) selected @endif>{{$data->kota}}</option>
              @endforeach
            </select>
          </div>          
        </div>
        @if ($user->kelurahan_id)
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-3 col-form-label">Kecamatan</label>
          <div class="col-sm-9">
            <select class="form-control" id="selectKecamatan" onchange="get_kelurahan()" required @if ($from == 'keranjang') style="border:1px solid red;" @endif>
              @foreach($kecamatan as $data)
              <option value="{{$data->id}}" @if($kecamatan_id == $data->id) selected @endif>{{$data->kecamatan}}</option>
              @endforeach              
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-3 col-form-label">Kelurahan</label>
          <div class="col-sm-9">
            <select class="form-control" id="selectKelurahan" name="kelurahan" onchange="get_ongkir()" required @if ($from == 'keranjang') style="border:1px solid red;" @endif> 
              @foreach($kelurahan as $data)
              <option value="{{$data->id}}" @if($kelurahan_id == $data->id) selected @endif>{{$data->kelurahan}}</option>
              @endforeach              
            </select>
          </div>
        </div>
        @else
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-3 col-form-label">Kecamatan</label>
          <div class="col-sm-9">
            <select class="form-control" id="selectKecamatan" onchange="get_kelurahan()" required @if ($from == 'keranjang') style="border:1px solid red;" @endif>
              <option value disabled selected>Pilih Kecamatan</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-3 col-form-label">Kelurahan</label>
          <div class="col-sm-9">
            <select class="form-control" id="selectKelurahan" name="kelurahan" onchange="get_ongkir()" required @if ($from == 'keranjang') style="border:1px solid red;" @endif>
              <option value disabled selected>Pilih Kelurahan</option>
            </select>
          </div>
        </div>        
        @endif
        <br>
        <button class="btn btn-danger">SIMPAN</button>
      </form>
    </div>
  </div>
</div>
@endsection

@section('footer')  
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('user.payment.keranjang.keranjang_script')

<script type="text/javascript">

  function get_kecamatan(){
    var kota_id = $('#selectKota').val();
    var option = "<option value=''>Pilih Kecamatan</option>";
    $.ajax({
      type: "get",
      url: "<?=url('/')?>/get_kecamatan/"+kota_id,
      success:function(data){
        // alert(data)
        var kecamatan = data.kecamatan;
        var kecamatan_lenght = Object.keys(kecamatan).length;
        for(let i = 0; i< kecamatan_lenght; i++){
          option += "<option value='"+kecamatan[i]['id']+"'>"+kecamatan[i]['kecamatan']+"</option>"
        }
        $("#selectKecamatan").html(option);
      }
    })
  }

  function get_kelurahan(){
    var kecamatan_id = $('#selectKecamatan').val();
    var option = "<option value=''>Pilih Kelurahan</option>";
    $.ajax({
      type: "get",
      url: "<?=url('/')?>/get_kelurahan/"+kecamatan_id,
      success:function(data){
        var kelurahan = data.kelurahan;
        var kelurahan_lenght = Object.keys(kelurahan).length;
        for(let i = 0; i< kelurahan_lenght; i++){
          option += "<option value='"+kelurahan[i]['id']+"'>"+kelurahan[i]['kelurahan']+"</option>"
        }
        $("#selectKelurahan").html(option);
      }
    })
  }

</script>
@endsection