@extends("layouts.user_data")

@section('title-header')
Keranjang Belanja
@endsection

@section('content')
    <div style="padding: 20px">
        @foreach ($riwayat_nota as $nota)
            <table class="table">
                <thead>
                    <th style=""></th>
                    <th style="text-align: center;">Harga Satuan</th>
                    <th style="text-align: center;">Jumlah</th>
                    <th style="text-align: center;">Subtotal</th>
                </thead>
                <tbody>
                    @foreach ($nota->riwayat_pesanan as $pesanan)
                    <tr>
                        <td>
                            <div style="width: 100%; display: flex; margin-bottom: 0em;">
                                <div style="width: 10%;">
                                    <img class="img-fluid" src="<?=url('/')?>/img/produk/thumbnail/300x300/{{$pesanan->data_produk->foto}}" style="width: 100%; border-radius: 0.2em; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
                                </div>
                                <div style="width:%; margin-left: 1em; display: flex; align-items: center;">
                                    {{$pesanan->produk}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; justify-content: space-between;">
                                <div>Rp.</div> <div>{{number_format($pesanan->harga_satuan, 0, '.', '.')}}</div>
                            </div>
                        </td>
                        <td style="text-align: center;">x{{$pesanan->jumlah}}</td>
                        <td>
                            <div style="display: flex; justify-content: space-between;">
                                <div>Rp.</div> <div>{{number_format($pesanan->jumlah * $pesanan->harga_satuan, 0, '.', '.')}}</div>
                            </div>									
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <button style="float: right; font-size: 20px" type="button" class="btn btn-danger btn-lg">Rp {{$nota->total_harga}}</button>
            <br><br><br><br><br><br>
        @endforeach
        
        
    
    </div>
@endsection