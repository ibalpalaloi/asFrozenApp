{{-- @if (count($kategori_current->sub_kategori) >0)
    @foreach ($kategori_current->sub_kategori as $sub_kategori)
    <div class="row" style="padding-left: 1em; padding-right: 1em; display: flex; justify-content: space-between; align-items: center; ">
        <div>
            <br>
            <h2>{{$sub_kategori->sub_kategori}}</h2>
        </div>
    </div>
    <div class="flash_sale" style="width: 100%; display: flex; justify-content: flex-start; flex-wrap: wrap; margin-top: 30px">
        @php
        $produk = array('1.jpg','2.jpg','3.jpg','1.jpg','2.jpg');
        @endphp
        @foreach($sub_kategori->produk as $produk)
        <div style="width: 20%; padding: 0em 0.5em; margin-top: 15px">
            <div class="d-flex" style="padding-bottom: 0px;  -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
                <div class="member" style="position: relative; margin-bottom: 0px;">
                    <div class="member-img">
                        <img src="<?=url('/')?>/public/img/produk/thumbnail/500x500/{{$produk->foto}}" class="img-fluid" alt="">
                    </div>
                    <div class="member-info" style=" padding: 0em 0.7em 0.8em;">
                        @if ($produk->diskon != null)
                        @php
                        $harga = $produk->harga;
                        $diskon = $produk->diskon->diskon;
                        $harga_diskon = $harga - ($diskon/100 * $harga)
                        @endphp
                        <div style="margin-top: 0.5em; text-align: left; color: black;">@if (strlen($produk->nama) > 15) {{substr($produk->nama, 0, 15)}}... @else {{$produk->nama}} @endif <badge class="badge badge-warning">{{$diskon}}%</badge> 
                        </div>
                        <div style="padding-top: 0px; position: relative; display: flex; flex-direction: row; justify-content: flex-start; margin-top: 0.3em;">
                            <small><s>Rp {{number_format($produk->harga, 0, '.', '.')}}</s></small>&nbsp;&nbsp;
                            <h6>Rp {{number_format($harga_diskon, 0, '.', '.')}}</h6>
                        </div>
                        @else
                        <div style="margin-top: 0.5em; text-align: left; color: black;">@if (strlen($produk->nama) > 15) {{substr($produk->nama, 0, 15)}}... @else {{$produk->nama}} @endif</div>
                        <div style="padding-top: 0px; position: relative; display: flex; flex-direction: row; justify-content: flex-start; margin-top: 0.3em;">
                            <h6>Rp {{number_format($produk->harga, 0, '.', '.')}}</h6>
                        </div>
                        @endif
                        <a onclick="tambah_keranjang('{{$produk->id}}')" class="btn btn-danger" style="display: flex; justify-content: center; flex-direction: row;">
                            <div>
                                <span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; color: white;"></span>&nbsp;&nbsp;
                            </div>
                            <div style="color: white;">Beli</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach 
@else
    @foreach($kategori_current->produk as $produk)
    <div style="width: 20%; padding: 0em 0.5em; margin-top: 15px">
        <div class="d-flex" style="padding-bottom: 0px;  -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
            <div class="member" style="position: relative; margin-bottom: 0px;">
                <div class="member-img">
                    <img src="<?=url('/')?>/public/img/produk/thumbnail/500x500/{{$produk->foto}}" class="img-fluid" alt="">
                </div>
                <div class="member-info" style=" padding: 0em 0.7em 0.8em;">
                    @if ($produk->diskon != null)
                    @php
                    $harga = $produk->harga;
                    $diskon = $produk->diskon->diskon;
                    $harga_diskon = $harga - ($diskon/100 * $harga)
                    @endphp
                    <div style="margin-top: 0.5em; text-align: left; color: black;">@if (strlen($produk->nama) > 15) {{substr($produk->nama, 0, 15)}}... @else {{$produk->nama}} @endif <badge class="badge badge-warning">{{$diskon}}%</badge> 
                    </div>
                    <div style="padding-top: 0px; position: relative; display: flex; flex-direction: row; justify-content: flex-start; margin-top: 0.3em;">
                        <small><s>Rp {{number_format($produk->harga, 0, '.', '.')}}</s></small>&nbsp;&nbsp;
                        <h6>Rp {{number_format($harga_diskon, 0, '.', '.')}}</h6>
                    </div>
                    @else
                    <div style="margin-top: 0.5em; text-align: left; color: black;">@if (strlen($produk->nama) > 15) {{substr($produk->nama, 0, 15)}}... @else {{$produk->nama}} @endif</div>
                    <div style="padding-top: 0px; position: relative; display: flex; flex-direction: row; justify-content: flex-start; margin-top: 0.3em;">
                        <h6>Rp {{number_format($produk->harga, 0, '.', '.')}}</h6>
                    </div>
                    @endif
                    <a onclick="tambah_keranjang('{{$produk->id}}')" class="btn btn-danger" style="display: flex; justify-content: center; flex-direction: row;">
                        <div>
                            <span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; color: white;"></span>&nbsp;&nbsp;
                        </div>
                        <div style="color: white;">Beli</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif

 --}}
