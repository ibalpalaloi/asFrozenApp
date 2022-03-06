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
      <a href="{{url('/')}}/biodata" style="position: absolute; right: 1em; top: 1em;">
        Biodata
    </a>
</div>
<div class="card shadow p-3 mb-5 bg-white rounded">
    <div tabindex="0" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide11">
        <div style="padding: 20px">
            <form action="<?=url('/')?>/post-ubah-password" method="post">
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Password Baru</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="staticEmail" name="password" required>
                  </div>
              </div>
              <br><br>
              <div class="d-flex justify-content-center">
                <button class="btn btn-danger">SIMPAN</button>
            </div>

        </form>
    </div>
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
@endsection




