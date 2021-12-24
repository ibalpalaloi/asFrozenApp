@foreach ($data_nota as $data)
    <tr>
        <td>{{$data['nama_pemesan']}}</td>
        <td>{{$data['alamat']}}</td>
        <td>{{$data['pembayaran']}}</td>
        <td>{{$data['pengantaran']}}</td>
        <td>{{$data['time_expired']}}</td>
        <td>{{$data['date_expired']}}</td>
    </tr>
@endforeach