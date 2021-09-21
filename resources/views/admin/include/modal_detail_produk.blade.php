<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
      <form method="post" id="post-update-produk" enctype="multipart/form-data">
          @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <img src="{{asset('/img/produk/produk-10.jpg')}}" id="detail_produk_foto_" alt="" width="140px" height="140px">
                    <br> <br>
                    <input type="file" name="foto" id="detail_produk_foto">
                </div>
                <div class="col-9 text-left" style="padding-left: 20px">
                    <input type="text" name="id" id="detail_produk_id" hidden>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Produk</label>
                        <input type="text" name="nama" class="form-control" id="detail_produk_nama" aria-describedby="emailHelp" placeholder="Nama">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kategori</label>
                                <select name="kategori" onchange="change_sub_kategori()" id="detail_produk_kategori" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Kategori</label>
                                <select name="sub_kategori" id="detail_produk_sub_kategori" class="form-control">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga</label>
                                <input name="harga" type="text" id="detail_produk_harga" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Satuan</label>
                                <input name="satuan" type="text" id="detail_produk_satuan" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Deskripsi</label>
                <textarea name="deskripsi" id="detail_produk_deskripsi" cols="3" rows="2" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>