<?php
function tgl_indo($tanggal){
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


@foreach ($data_nota as $data)
<tr>
    <td scope="row">
        <a href="{{url()->current()}}/{{$data['id_pesanan']}}" style="color: black;">
            {{$data['id_pesanan']}}
        </a>
    </td>
    <td>{{tgl_indo(date('Y-m-d', strtotime($data['waktu_pemesanan'])))}} [{{date('H:i', strtotime($data['waktu_pemesanan']))}}]</td>
    <td>Rp. {{number_format($data['total_pemesanan'],0,',','.')}}</td>
    <td>
        @if ($data['pembayaran'] == "COD")
        <button type="button" class="btn btn-warning btn-sm">COD</button>
        @else
        <button type="button" class="btn btn-success btn-sm">Transfer</button>
        @endif

        @if ($data['pengantaran'] == "Diantarkan")
        <button type="button" class="btn btn-warning btn-sm">Diantarkan</button>
        @else
        <button type="button" class="btn btn-success btn-sm">Ambil Sendiri</button>
        @endif
    </td>
</tr>
@endforeach