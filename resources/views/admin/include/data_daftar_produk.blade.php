@foreach ($list_produk as $data)
    <tr>
    <td>
        <div style="display:flex;">
        <img src="<?=url('/')?>/img/produk/thumbnail/300x300/{{$data['foto']}}" style="width: 100px;">
        <div style="display: flex; flex-direction: column; margin-left: 0.5em;">
            <div id="nama_{{$data['id']}}">{{$data['nama']}}</div>
            <div>
                <small id="harga_{{$data['id']}}">
                @if ($data['diskon'] > 0)
                <s>Rp {{number_format($data['harga'], 0, '.','.')}}</s>
                @else
                Rp {{number_format($data['harga'], 0, '.','.')}}
                @endif
                </small>
                <span>
                @if ($data['diskon'] > 0)
                @php 
                $harga_diskon = round($data['harga']*$data['diskon']/100, 0);
                @endphp
                Rp. {{number_format($data['harga']-$harga_diskon, 0, '.','.')}}
                @endif
                </span><br>

                @if ($data['diskon'] > 0) 
                <badge class="badge badge-primary" href="#">{{$data['diskon']}}%
                </badge>
                @endif
                @if ($data['diskon_mulai'] != null)                    
                @php $sisa_diskon = strtotime($data['diskon_akhir']) - strtotime(date('Y-m-d')); @endphp
                Berakhir {{round($sisa_diskon / (60 * 60 * 24))}} Hari lagi</small>
                @endif
            </div>
        </div>
    </div>
    </td>
    <td id="stok_{{$data['id']}}">
    <a href="#" onclick="show_input_stok('{{$data['id']}}', '{{$data['stok']}}')">{{$data['stok']}}</a>
    </td>
    <td id="satuan_{{$data['id']}}">{{$data['satuan']}}</td>
    <td id="kategori_{{$data['id']}}">{{$data['kategori']}}</td>
    <td id="sub_kategori_{{$data['id']}}">{{$data['sub_kategori']}}</td>
    <td>
    <button class="btn btn-info" onclick="modal_detail_produk('{{$data['id']}}')">
        <ion-icon name="pencil-outline"></ion-icon>
    </button>
    <button class="btn btn-danger">
        <ion-icon name="trash-outline"></ion-icon>
    </button>
    <button class="btn btn-success">
        <ion-icon name="eye-outline"></ion-icon>
    </button>
    </td>
</tr>

@endforeach