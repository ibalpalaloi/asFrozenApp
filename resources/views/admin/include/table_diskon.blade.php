<table class="table">
    <thead class="thead-light">
        <tr>
            <th>Produk</th>
            <th>Diskon</th>
            <th>Tgl Awal</th>
            <th>Tgl Akhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($diskon as $data)
            <tr>
                <td>{{$data->produk->nama}}</td>
                <td>{{$data->diskon}}%</td>
                <td>{{$data->diskon_mulai}}</td>
                <td>{{$data->diskon_akhir}}</td>
            </tr>
        @endforeach
    </tbody>
</table>