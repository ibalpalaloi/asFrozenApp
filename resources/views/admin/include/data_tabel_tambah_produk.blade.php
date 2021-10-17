@foreach ($list_produk as $data)
    <tr onclick="pilih_produk('{{$data['id']}}', '{{$data['nama']}}', '{{$data['harga']}}')">
        <td>{{$data['nama']}}</td>
        <td>{{$data['stok']}}</td>
        <td>{{$data['diskon']}}</td>
        <td>{{$data['harga']}}</td>
    </tr>
@endforeach