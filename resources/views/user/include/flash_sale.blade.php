<div class="row" style="margin-top: 1em;">
    <div class="col-md-12" style="padding: 0px;">
        <div class="card" style="width: 100%; padding: 1em; border:none; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
            <div class="row" style="padding-left: 1em; padding-right: 1em; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center;">
                    <img src="<?=url('/')?>/katalog_assets/assets/img/flash-sale2.png" style="width: 10em;">
                    <div id="countdown" class="btn-dark" style="display: flex; margin-left: 1em; border-radius: 0.2em;">
                        <div id="countdown_jam" style="padding:0.5em 0em 0.5em 1em; font-size: 1em; font-weight: 600;"></div>
                        <div style="padding:0.5em 1em; font-size: 1em; font-weight: 600;">:</div>
                        <div id="countdown_menit" style="padding:0.5em 0em; font-size: 1em; font-weight: 600;"></div>
                        <div style="padding:0.5em 1em; font-size: 1em; font-weight: 600;">:</div>
                        <div id="countdown_detik" style="padding: 0.5em 1em 0.5em 0em; font-size: 1em; font-weight: 600;"></div>
                    </div>
                </div>
                <a href="<?=url('/')?>/flash-sale" style="color: #ec1f25;">Selengkapnya</a>
            </div>
            <hr>
            <div class="row team" style="padding: 1em;">
                <div class="flash_sale" style="width: 100%;">
                    @foreach ($flash_sale as $data)
                    <div class="d-flex" style="margin-right: 1em; padding-bottom: 0px;  -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%); margin-bottom: 1em; margin-top: 1em;">
                        <div class="member" style="position: relative; margin-bottom: 0px;">
                            <div class="member-img">
                                <img src="<?=url('/')?>/img/produk/thumbnail/500x500/{{$data->produk->foto}}" class="img-fluid" alt="">
                            </div>
                            <div class="member-info" style=" padding: 0em 0.7em 0.8em;">
                                @php
                                $harga = $data->produk->harga;
                                $diskon = $data->diskon;
                                $harga_diskon = $harga - ($diskon/100 * $harga)
                                @endphp
                                <div style="margin-top: 0.5em; text-align: left; color: black;">
                                    @if (strlen($data->produk->nama) > 15) {{substr($data->produk->nama, 0, 15)}}... @else {{$data->produk->nama}} @endif <badge class="badge badge-warning">{{$diskon}}%</badge> 
                                </div>
                                <div style="padding-top: 0px; position: relative; display: flex; flex-direction: row; justify-content: flex-start; margin-top: 0.3em;">
                                    <small><s>Rp {{number_format($data->produk->harga, 0, '.', '.')}}</s></small>&nbsp;&nbsp;
                                    <h6>Rp {{number_format($harga_diskon, 0, '.', '.')}}</h6>
                                </div>
                                <a class="btn btn-danger" style="display: flex; justify-content: center; flex-direction: row;">
                                    <div>
                                        <span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; color: white;"></span>&nbsp;&nbsp;
                                    </div>
                                    <div>Beli</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>