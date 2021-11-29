<?php
// fungsi untuk konversi tanggal ke indonesia
function tgl_indo2($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
);
  $pecahkan = explode('-', $tanggal);     
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Tanggal Diskon</th>
            <th>Lama Diskon</th>
            <th>Sisa Diskon</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($date_arr as $row => $value)
        <tr style="border-top: none;">
            <td colspan="6" style="border-top: none;"><small><b>{{tgl_indo2(date('Y-m-d', strtotime($row)))}}</b></small></td>
        </tr>
        @if (count($value) > 0)
        @foreach ($value as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>
                <div style="display: flex;">
                    <div>
                        <img src="<?=url('/')?>/public/img/produk/thumbnail/300x300/{{$data->produk->foto}}" style="width: 50px;">
                    </div>
                    <div style="margin-left: 0.5em;">
                        <div style="line-height: 1em;">{{$data->produk->nama}}
                            <badge class="badge badge-danger">{{$data->diskon}}%</badge>
                        </div>
                        @php $potongan_harga = round($data->produk->harga*$data->diskon/100, 0); @endphp
                        <small>
                            {{number_format($data->produk->harga, 0, '.', '.')}} - <span style="color: red;">{{number_format($potongan_harga, 0, '.','.')}}</span> = 
                        </small>
                        <small><b>{{number_format($data->produk->harga-$potongan_harga, 0, '.', '.')}}</b></small>

                    </div>

                </div>
            </td>
            <td>{{tgl_indo2(date('Y-m-d', strtotime($data->diskon_mulai)))}} - {{tgl_indo2(date('Y-m-d', strtotime($data->diskon_akhir)))}}</td>
            @php $lama_diskon = strtotime($data->diskon_akhir) - strtotime($data->diskon_mulai); @endphp
            @php $sisa_diskon = strtotime($data->diskon_akhir) - strtotime(date('Y-m-d')); @endphp
            <td>{{round($lama_diskon / (60 * 60 * 24)+1)}} Hari</td>
            <td>{{round($sisa_diskon / (60 * 60 * 24))}} Hari</td>
            <td>
                <button class="btn btn-info" onclick="modal_diskon('{{$data->id}}')">
                    <ion-icon name="pencil-outline"></ion-icon>
                </button>
                <button class="btn btn-danger">
                    <ion-icon name="trash-outline"></ion-icon>
                </button>
            </td>            
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6">Tidak ada diskon</td>
        </tr>        
        @endif
        <tr>
            <td colspan="6"></td>
        </tr>
        @endforeach
    </tbody>
</table>