
@extends("layouts.admin")

@section("body")
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <a @if ($sub_menu == "dalam pengantaran")
                    href="<?=url('/')?>/admin/pesanan-dalam-pengantaran"
                    @else
                    href="<?=url('/')?>/admin/pesanan-siap-diambil"
                    @endif style="width: 100%" type="button" @if ($list == "list")
                    class="btn btn-primary"
                    @else
                    class="btn btn-light"
                    @endif >List</a>
                </div>
                <div class="col">
                    <a @if ($sub_menu == "dalam pengantaran")
                    href="<?=url('/')?>/admin/pesanan-dalam-pengantaran-semua"
                    @else
                    href="<?=url('/')?>/admin/pesanan-siap-diambil-semua"
                    @endif  style="width: 100%" type="button" @if ($list == "semua")
                    class="btn btn-primary"
                    @else
                    class="btn btn-light"
                    @endif class="btn btn-light">Semua</a>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Pesanan {{$sub_menu}}</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">31/8/2021</li>
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
                                                        <div class="col-md-6">Ongkir</div>
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
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row" style="margin-left: 10px">
                                    <div class="col-4">
                                        <p style="font-weight: 700; margin-left: 10px; color: red">Waktu Konfirmasi : {{date('H:i', strtotime($data->updated_at))}} Wita</p>
                                        @if ($data->admin_penerima)
                                            <p style="font-weight: 700; margin-left: 10px; color: black">Admin : {{$data->admin_penerima->name}}</p>
                                        @else
                                            <p style="font-weight: 700; margin-left: 10px; color: black">Admin : -</p>
                                        @endif
                                        <p style="font-weight: 700; margin-left: 10px; color: black"></p>
                                    </div>

                                    <div class="col-4">
                                        <p style=" margin-left: 10px; color: black">Kurir : {{$data->nama_kurir}}</p>
                                        <p style=" margin-left: 10px; color: black">No Telp Kurir : {{$data->no_telp_kurir}}</p>
                                    </div>
                                </div>
                                
                                <hr>
                                <div class="template-demo" style="display: flex;  justify-content: space-between; padding-bottom: 1em; padding-left: 1em;">
                                    <div class="text-right">
                                        <a href="<?=url('/')?>/admin/pesanan-selesai/{{$data->id}}" class="btn btn-primary btn-sm" style="color: white">Pesanan Selesai</a>
                                        <a class="btn btn-success btn-sm" style="color: white">Hubungi Pembeli</a>
                                    </div>
                                    <a href="{{url('/')}}/cetak-nota/pesanan/{{$data->id_pesanan}}" class="btn btn-warning" style="padding: 0em 0.5em; margin-right:1em;">
                                      <i class="fa fa-print"></i>
                                  </a>
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