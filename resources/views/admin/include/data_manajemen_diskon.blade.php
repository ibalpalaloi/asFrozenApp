@foreach ($list_produk as $data)
    <tr>
        <td>{{$data['nama_produk']}}</td>
        <td id="diskon_data_{{$data['id']}}">{{$data['diskon']}}%</td>
        <td id="harga_data_{{$data['id']}}">Rp. {{$data['harga']}}</td>
        <td id="harga_diskon_data_{{$data['id']}}">Rp. {{$data['harga_diskon']}}</td>
        <td id="waktu_diskon_data_{{$data['id']}}">{{$data['diskon_mulai']}} - {{ $data['diskon_akhir']}}</td>
        <td>
            <button class="btn btn-info" onclick="modal_ubah_diskon('{{$data['id']}}')">
                <ion-icon name="pencil-outline"></ion-icon>
            </button>
            <button class="btn btn-danger" onclick="konfirmasi_hapus_diskon('{{$data['id']}}')">
                <ion-icon name="trash-outline"></ion-icon>
            </button>
        </td>
    </tr>  
@endforeach
