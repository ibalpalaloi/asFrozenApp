<div class="flash_sale" style="width: 100%; display: flex; justify-content: flex-start; flex-wrap: wrap; margin-top: 30px">

    @foreach($produk as $data)
    <div class="d-flex align-items-stretch" style="margin-right: 1em; width: 18%;">
        <div class="member" style="position: relative;">
            <div class="member-img">
                <img src="<?=url('/')?>/img/produk/{{$data->foto}}" class="img-fluid" alt="">
            </div>
            <div class="member-info" style="padding-top: 0.4em; padding-bottom: 0.8em;">
                <small style="font-family: 'Segoe UI',Roboto;"><s>Rp. 50.000</s>
                    <badge class="badge badge-warning">-50%</badge> 
                </small>
                <h4 style="font-family: 'Segoe UI',Roboto;">Rp. 25.000</h4>
                <span>{{$data->nama}}</span>
                <div class="btn btn-danger" style="margin-top: 0.4em; display: flex; justify-content: center; flex-direction: row;">
                    <div>
                        <span class="iconify" data-icon="mdi:cart" style="font-size: 1.3em; color: white;"></span>&nbsp;&nbsp;
                    </div>
                    <div>Beli</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>