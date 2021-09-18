<div style="padding-left: 10px; padding-right: 10px; padding-top: 20px">
    <table class="table_pesanan">
        <thead class="border_table">
            <tr class="border_table">
            <th class="border_table" scope="col">Produk</th>
            <th class="border_table" scope="col">Jumlah</th>
            <th class="border_table" scope="col">Harga satuan</th>
            <th class="border_table" scope="col">total harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesanan as $data)
                <tr class="border_table">
                    <td class="border_table">{{$data->produk}}</td>
                    <td class="border_table">{{$data->jumlah}}</td>
                    <td class="border_table">{{$data->harga_satuan}}</td>
                    <td class="border_table">{{$data->jumlah * $data->harga_satuan}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding: 40px">
        <div class="row">
            <div class="col">
                <table>
                    <tr>
                        <td>Pemesan </td>
                        <td>: </td>
                        <td>{{$nota->nama_pemesan}}</td>
                    </tr>
                    <tr>
                        <td>Penerima </td>
                        <td>: </td>
                        <td>{{$nota->nama_penerima}}</td>
                    </tr>
                    <tr>
                        <td>No. Penerima </td>
                        <td>: </td>
                        <td>{{$nota->nomor_penerima}}</td>
                    </tr>
                    <tr>
                        <td>Ongkir </td>
                        <td>: </td>
                        <td>{{$nota->ongkos_kirim}}</td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table>
                    <tr>
                        <td>Alamat </td>
                        <td>: </td>
                        <td>{{$nota->alamat}}, {{$nota->kelurahan}}, {{$nota->kecamatan}}, {{$nota->kota}}</td>
                    </tr>
                    <tr>
                        <td>Waktu Pesanan </td>
                        <td>: </td>
                        <td>{{$nota->waktu_pemesanan}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>