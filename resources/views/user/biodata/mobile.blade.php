@extends("layouts.home_mobile")

@section('title-header')
Keranjang Belanja
@endsection

@section('content')
<section id="hero" class="d-flex align-items-center" style="background: none; margin-bottom: 8em;">
  <div class="container" style="margin-top: 5.5em;">
    <div class="row">
      <div class="col-12">
        <div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;">
          <div style="padding: 0.5em 1em; width: 100%; align-items: center; display: flex; flex-direction: column; justify-content: center;">
            <div style="width: 30%; border-radius: 50%;">
              <img src="img/default.png" style="width: 100%; border-radius: 50%;">
            </div>
            <div style="width: 100%; display: flex; justify-content: center; flex-direction: column; align-items: center; margin-top: 1em;">
              <h4>Iqbal Ramadhan</h4>
              <h5>Member</h5>
            </div>
          </div>
        </div>
        <div class="card shadow p-3 mb-2 bg-white rounded" style="border: none;">
          <div class="col-12">
            <form action="">
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticEmail" value="Iqbal">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">No Telp</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticEmail" value="08226622666">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-3" style="margin-left: 20px">
                  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                  <label class="form-check-label" for="exampleRadios1">
                    Laki-laki
                  </label>
                </div>
                <div class="col-3">
                  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                  <label class="form-check-label" for="exampleRadios1">
                    Perempuan
                  </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticEmail" value="Iqbal@gmail.com">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                  Jln. Puenjidi Lrg. 2, No.3 <br>
                  Kel. Kabonena, Kec. Ulujadi, Kota Palu
                </div>
              </div>
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
@endsection