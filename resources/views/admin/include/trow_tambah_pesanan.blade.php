<tr id="row_{{$pesanan->id}}">
    <td>{{$count}}</td>
    <td>
      <div style="width: 100%; display: flex; margin-bottom: 0em;">
        <div style="width: 10%;">
          <img class="img-fluid" src="<?=url('/')?>/img/produk/thumbnail/300x300/{{$pesanan->produk->foto}}" style="width: 100%; border-radius: 0.2em; -webkit-box-shadow: 2px 10px 10px rgb(0 0 0 / 30%); box-shadow: 2px 2px 8px rgb(0 0 0 / 30%);">
        </div>
        <div style="width: 85%; margin-left: 1em; display: flex; align-items: center;">
          {{$pesanan->produk->nama}}
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
    <td>
      <button class="btn btn-danger" onclick="hapus_pesanan('{{$pesanan->id}}', '{{$nota->id}}')">
        <i class="fa fa-trash"></i>
      </button>
    </td>
</tr>