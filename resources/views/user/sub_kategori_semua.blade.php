@foreach ($kategori->sub_kategori as $sub_kategori)
    <div class="row" style="padding-left: 1em; padding-right: 1em; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2>{{$sub_kategori->sub_kategori}}</h2>
        </div>
    </div>
    <div class="flash_sale" style="width: 100%; display: flex; justify-content: flex-start; flex-wrap: wrap; margin-top: 30px">
        @php
        $produk = array('1.jpg','2.jpg','3.jpg','1.jpg','2.jpg');
        @endphp
        @foreach($sub_kategori->produk as $produk)
        <div class="d-flex align-items-stretch" style="margin-right: 1em; width: 18%;">
            <div class="member" style="position: relative;">
                <div class="member-img">
                    <img src="<?=url('/')?>/img/produk/{{$produk->foto}}" class="img-fluid" alt="">
                </div>
                <div class="member-info" style="padding-top: 0.4em; padding-bottom: 0.8em;">
                    @if ($produk->diskon != null)
                        @php
                            $diskon = $produk->diskon->diskon;
                            $harga = $produk->harga;
                            $hasil_diskon = $harga-(($diskon/100)*$harga);
                        @endphp
                        <small style="font-family: 'Segoe UI',Roboto;"><s>Rp. {{$produk->harga}}</s>
                            <badge class="badge badge-warning">{{$produk->diskon->diskon}}%</badge> 
                        </small>
                        <h4 style="font-family: 'Segoe UI',Roboto;">Rp. {{$hasil_diskon}}</h4>
                    @else
                        <h4 style="font-family: 'Segoe UI',Roboto;">Rp. {{$produk->harga}}</h4>
                    @endif
                    
                    <span>{{$produk->nama}}</span>
                    <div onclick="tambah_keranjang('{{$produk->id}}')" class="btn btn-danger" style="margin-top: 0.4em; display: flex; justify-content: center; flex-direction: row;">
                        <div>
                            <span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; color: white;"></span>&nbsp;&nbsp;
                        </div>
                        <div>Beli</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endforeach

