@extends("layouts.home_mobile")

@section('title')
Biodata
@endsection

@section('content')
<section id="hero" class="d-flex align-items-center" style="background: none; padding-bottom: 5em;">
  <div class="container" style="margin-top: 5.5em;">
    <div class="row">
      <div class="col-12">
        <div class="card shadow p-3 mb-2 bg-white rounded" style="border: none; position: relative;">
          <div style="padding: 0.5em 1em; width: 100%; align-items: center; display: flex; flex-direction: column; justify-content: center;">
            <div style="width: 30%; border-radius: 50%;">
              <img src="<?=url('/')?>/public/img/default.png" style="width: 100%; border-radius: 50%;">
            </div>
            <div style="width: 100%; display: flex; justify-content: center; flex-direction: column; align-items: center; margin-top: 1em;">
              <h4>{{$user->nama}}</h4>
              <h5>Member</h5>
              <a href="{{url('/')}}/logout" class="btn btn-danger"><i class="fa fa-power-off"></i>&nbsp;Logout</a>
            </div>
          </div>
          <a href="{{url('/')}}/ubah-password" style="position: absolute; right: 1em; top: 1em;">
            Ubah Password
          </a>
        </div>
        <div class="card shadow p-3 bg-white rounded" style="border: none;">
          <div class="col-12">
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
                <div class="col-3" style="margin-left: 20px">
                  <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios1" value="Laki-Laki" @if ($user->jenis_kelamin == 'Laki-Laki') checked @endif>
                  <label class="form-check-label" for="exampleRadios1">
                    Laki-Laki
                  </label>
                </div>
                <div class="col-3">
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
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                  <input type="text" name="alamat" class="form-control" value="{{$user->alamat}}">
                </div>
              </div>

              <div class="form-group row">
              </div>
              <?php
              $from = "";
              if (isset($_GET['from'])){
                $from = $_GET['from'];
              }
              ?>
              <div class="form-group row">
                <input type="text" name="from" value="{{$from}}" hidden>
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
    </div>
  </div>
</section>

@endsection

@section('footer-scripts')
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
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