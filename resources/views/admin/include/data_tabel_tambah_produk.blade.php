@foreach ($list_produk as $data)
    <tr @if ($data["stok"] != 0) onclick="pilih_produk('{{$data['id']}}', '{{$data['nama']}}', '{{$data['harga']}}') @endif ">
        <td>{{$data['nama']}}</td>
        <td>{{$data['stok']}}</td>
        <td>{{$data['diskon']}}%</td>
        <td>{{$data['harga']}}</td>
    </tr>
@endforeach