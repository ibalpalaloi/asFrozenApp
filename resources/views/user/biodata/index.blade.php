@extends("layouts.user_data")

@section('title-header')
Keranjang Belanja
@endsection

@section('content')
<div style="padding: 30px">
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
            <div class="col-sm-3" style="margin-left: 20px">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                <label class="form-check-label" for="exampleRadios1">
                  Laki-laki
                </label>
            </div>
            <div class="col-sm-3">
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
@endsection

@section('footer')
@endsection