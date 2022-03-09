
@extends("layouts.admin")

@section("body")
{{-- modal --}}
<div id="ubah_ongkir" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby=" yLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=url('/')?>/admin/pesanan/ubah_ongkir" method="post">
        @csrf
        <div class="modal-header">
           Ubah Ongkir
       </div>
       <div class="modal-body">
        <label for="form-control">Ongkir</label>
        <input type="text" name="id" id="id_ongkir" hidden>
        <input type="text" class="form-control" name="ongkir" id="ongkir">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>
</div>
</div>
</div>

<div class="modal fade" id="modal_kurir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Kurir</label>
            <select class="form-control" id="pilih_kurir">
              <option>---Pilih---</option>
              @foreach ($kurir as $data)
              <option value="{{$data->id}}">{{$data->nama}}</option>
              @endforeach
          </select>
      </div>
      <form action="<?=url('/')?>/post-kurir-packaging" method="post">
          @csrf
          <input type="text" name="id_pesanan" id="id_pesanan" hidden>
          <div class="form-group">
            <label for="exampleInputPassword1">Nama</label>
            <input type="text" class="form-control" id="nama_kurir" placeholder="Nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">No Telp</label>
            <input type="text" class="form-control" id="no_telp_kurir" placeholder="No Telp" name="no_telp">
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

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <a href="<?=url('/')?>/admin/pesanan-packaging" style="width: 100%" type="button" @if($list == 'list') class="btn btn-primary" @else class="btn btn-light" @endif >List</a>
                </div>
                <div class="col">
                    <a href="<?=url('/')?>/admin/pesanan-packaging-semua" style="width: 100%" type="button" @if ($list == "semua") class="btn btn-primary" @else class="btn btn-light" @endif class="btn btn-light">Semua</a>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Pesanan Yang Siap di Packing</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item active">31/8/2021</li> --}}
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="timeline">
                        @foreach ($nota as $data)
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                            <div class="timeline-item">
                                <div class="timeline-body row">
                                    <div class="col-12">
                                        <div style="display: flex; align-items: center; float: right;">
                                            <span class="time" style="font-size: 15px"> <b>ID: {{$data->id_pesanan}}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </span>
                                          </div>
                                        <table class="table" >
                                            <thead>
                                                <th>No.</th>
                                                <th style="">Produk</th>
                                                <th style="text-align: center;">Harga Satuan</th>
                                                <th style="text-align: center;">Jumlah</th>
                                                <th style="text-align: center;">Subtotal</th>
                                            </thead>
                                            <tbody id="tbody_daftar_pesanan">
                                                @php
                                                $total_pesanan = 0;
                                                @endphp
                                                @foreach ($data->pesanan as $pesanan)
                                                <tr id="row_{{$pesanan->id}}">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>
                                                        <div style="width: 100%; display: flex; margin-bottom: 0em;">
                                                            <div style="width: 10%;">
                                                                <img class="img-fluid" src="<?=url('/')?>/public/img/produk/thumbnail/300x300/{{$pesanan->produk->foto}}" style="width: 100%; border-radius: 0.2em; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
                                                            </div>
                                                            <div style="width: 85%; margin-left: 1em; display: flex; align-items: center;">{{$pesanan->produk->nama}}</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-between;">
                                                            <div>Rp.</div> <div>{{number_format($pesanan->harga_satuan, 0, '.', '.')}}</div>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;">x{{$pesanan->jumlah}}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-between;">
                                                            <?php $total_pesanan += $pesanan->jumlah * $pesanan->harga_satuan; ?>
                                                            <div>Rp.</div> <div>{{number_format($pesanan->jumlah * $pesanan->harga_satuan, 0, '.', '.')}}</div>

                                                        </div>                  
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>              
                                        </table>
                                        <hr>
                                        <div class="row" style="margin-left: 0.5em;margin-right: 0.5em;">
                                            <div class="col-md-4">
                                                @if ($data->pengantaran == 'Diantarkan')
                                                <b>Diantarkan ke alamat</b><br>
                                                {{$data->penerima}} | {{$data->no_telp_penerima}}<br>
                                                {{$data->alamat}}<br>
                                                {{$data->kelurahan}}, {{$data->kecamatan}}, {{$data->kota}}
                                                @else
                                                <b>Ambil ditempat</b><br>
                                                {{$data->penerima}} | {{$data->no_telp_penerima}}<br>
                                                Toko AsFrozen, Jl. Mandala No. 1<br>
                                                Birobuli Utara, Palu Selatan, Kota Palu         
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                @if ($data->pembayaran == 'COD')
                                                <b>Cash On Delivery (COD)</b><br>
                                                <div class="checkout-bank-transfer-item__card" style="display: flex; margin-top: 0.5em;">
                                                    <div class="checkout-bank-transfer-item__icon-container">
                                                        <img src="<?=url('/')?>/public/katalog_assets/assets/img/logo/frozen_palu_red.png" class="checkout-bank-transfer-item__icon" style="width: 2em; margin-right: 1em; width: 4em;">
                                                    </div>
                                                </div>
                                                @else
                                                <b>Transfer melalui</b><br>
                                                <div class="checkout-bank-transfer-item__card" style="display: flex; margin-top: 0.3em;">
                                                    <div class="checkout-bank-transfer-item__icon-container">
                                                        <img src="<?=url('/')?>/public/bank/{{$data->bank->img}}" class="checkout-bank-transfer-item__icon" style="width: 2em; margin-right: 1em; width: 4em;">
                                                    </div>
                                                    <div>
                                                        <div class="checkout-bank-transfer-item__main" style="line-height: 0.8em;">
                                                            {{$data->bank->nama_bank}}
                                                        </div>
                                                        <div class="checkout-bank-transfer-item__description">
                                                            <small>Perlu upload bukti transfer</small>
                                                        </div>
                                                        <div>{{$data->bank->nomor_rekening}}</div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4" style="display: flex;">
                                                <div style="margin-right: 1em; margin-top: 0.5em;" hidden>{{$qrcode->size(80)->generate($data->id_pesanan)}}</div>
                                                <div style="margin-top: 0.2em;width: 100%;">
                                                    <div class="row">
                                                        <div class="col-md-6">Subtotal</div>
                                                        <div class="col-md-6" style="display: flex; justify-content: space-between;">   
                                                            <div>: Rp. </div>
                                                            <div id="sub_total_pesanan">{{number_format($total_pesanan, 0, ".", ".")}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">Ongkir&nbsp;<badge class="badge badge-warning" onclick="ubah_ongkir('{{$data->id}}','{{number_format($data->ongkos_kirim)}}')">Ubah</badge></div>
                                                        <div class="col-md-6" style="display: flex; justify-content: space-between;">   
                                                            <div>: Rp.</div>
                                                            <div>{{number_format($data->ongkos_kirim, 0, '.', '.')}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">    
                                                            <b>Total</b>
                                                        </div>
                                                        <div class="col-md-6" style="display: flex; justify-content: space-between;">   
                                                            <div>: Rp.</div>
                                                            <div><b id="total_pesanan">{{number_format($data->ongkos_kirim+$total_pesanan, 0, ".", ".")}}</b></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-4">
                                        <p style="font-weight: 700; margin-left: 10px; color: red">Waktu Konfirmasi : {{date('H:i', strtotime($data->updated_at))}} Wita</p>
                                        @if ($data->admin_penerima)
                                        <p style="font-weight: 700; margin-left: 10px; color: black">Admin : {{$data->admin_penerima->name}}</p>
                                        @else
                                        <p style="font-weight: 700; margin-left: 10px; color: black">Admin : -</p>
                                        @endif
                                        <p style="font-weight: 700; margin-left: 10px; color: black"></p>
                                    </div>
                                    <hr>
                                    <div class="template-demo" style="display: flex; padding-bottom: 1em; padding-left: 1em;">
                                        <div class="text-right">
                                            @if ($data->pengantaran == "Diantarkan")
                                            <a href="#" onclick="modal_kurir('{{$data->id}}')" class="btn btn-primary btn-sm" style="color: white">Antar Pesanan</a>
                                            @else
                                            <a href="<?=url('/')?>/admin/ubah_status_pesanan/{{$data->id}}/dalam pengantaran" class="btn btn-primary btn-sm" style="color: white">Pesanan Siap</a>
                                            @endif
                                            <a class="btn btn-success btn-sm" style="color: white">Hubungi Pembeli</a>
                                            <a class="btn btn-danger btn-sm" onclick="batalkan_pesanan('{{$data->id}}')" style="margin-right: 0.5em; color: white;">Batalkan Pesanan</a>

                                            <a href="{{url('/')}}/cetak-nota/pesanan/{{$data->id_pesanan}}" class="btn btn-warning" style="padding: 0em 0.5em; margin-right:1em;">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="timeline">

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
</div>


@endsection

@section('footer')
<script>
  function ubah_ongkir(id, ongkir){
    $("#id_ongkir").val(id);
    $("#ongkir").val(ongkir);
    $('#ubah_ongkir').modal('show');
}

$("#ongkir").on("keydown", function(e) {
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

var data_kurir = {!! json_encode($kurir) !!}
function modal_kurir(id){
    $('#id_pesanan').val(id);
    $('#nama_kurir').val('');
    $('#no_telp_kurir').val('')
    $('#modal_kurir').modal('show');
}

$('#pilih_kurir').change(function(){
    var id_kurir = $('#pilih_kurir').val();
    console.log(data_kurir);
    for(let i = 0; i<data_kurir.length; i++){
        if(data_kurir[i]['id'] == id_kurir){
            $('#nama_kurir').val(data_kurir[i]['nama']);
            $('#no_telp_kurir').val(data_kurir[i]['no_telp'])
            break;
        }
    }
})
</script>
@include('script.daftar_pesanan_script')
@endsection
