<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var token = $("meta[name='csrf-token']").attr("content");
   function hapus_pesanan(row, id_nota){
      swal("Yakin Ingin Menghapus Pesanan")
        .then((value) => {
          $('#row_'+row).remove();
          ajax_hapus_pesanan(row);
          get_total_pesanan(id_nota);
      });
   }

   function ajax_hapus_pesanan(id){
    
     $.ajax({
        type: "delete",
        url: '/admin/hapus_pesanan/'+id,
        data: {'id': id, '_token':token},
        success:function(data){

        }
     })
   }

   function show_modal_tambah_pesanan(id_nota){
        $('#input_id_nota').val(id_nota);
        $('#input_id_produk').val('');
        $('#input_nama_produk').val('');
        $('#input_jumlah').val('');
        $('#tambah_pesanan_modal').modal('show');
   }

   $('#cari_produk').change(function(){
       get_list_produk();
   })

   function get_list_produk(){
        var keyword = $('#cari_produk').val();
        $.ajax({
            type: "get",
            url: "/admin/get_list_produk/"+keyword,
            success:function(data){
                console.log(data);
                $('#tbody_tabel_tambah_produk').empty();
                $('#tbody_tabel_tambah_produk').append(data.view);
            }
        })
   }

   function pilih_produk(id, nama, harga_satuan){
        $('#input_id_produk').val(id);
        $('#input_nama_produk').val(nama);
        $('#input_jumlah').val('1');
        $('#input_harga_satuan').val(harga_satuan);
   }

   function simpan_pesanan_baru(){
        var id_nota = $('#input_id_nota').val();
        var id_produk = $('#input_id_produk').val();
        var nama_produk = $('#input_nama_produk').val();
        var jumlah = $('#input_jumlah').val();
        var harga_satuan = $('#input_harga_satuan').val();

        $.ajax({
            type: "POST",
            url: "/admin/input_pesanan_baru",
            data: {'id_nota': id_nota, 'id_produk':id_produk, 'jumlah':jumlah, 'harga_satuan':harga_satuan, '_token':token},
            success:function(data){
                console.log(data);
                var pesanan = data.pesanan;
                var new_tr = "";
                new_tr += "<tr class='border_table' id='row_"+pesanan['id']+"'>";
                new_tr += "<td class='border_table'>"+pesanan['nama']+"</td>";
                new_tr += "<td class='border_table'>"+pesanan['jumlah']+"</td>";
                new_tr += "<td class='border_table'>"+pesanan['harga_satuan']+"</td>";
                new_tr += "<td class='border_table'>"+pesanan['harga_total']+"</td>";
                new_tr += "<td class='border_table'>";
                new_tr += "<button onclick='hapus_pesanan("+pesanan['id']+")' class='btn btn-danger'></button><td><tr>"

                $('#tbody_daftar_pesanan_'+id_nota).append(new_tr);
                $('#tambah_pesanan_modal').modal('hide');
                get_total_pesanan(id_nota);

            }
        })
   }

   function get_total_pesanan(id_nota){
       $.ajax({
           type: "get",
           url: "/admin/get_total_pesanan/"+id_nota,
           success:function(data){
               console.log(data);
               $('#total_pesanan_'+id_nota).html("Total Pesanan : Rp. "+data.total_harga);
           }
       })
   }

   function hubungi_pesanan(id_pesanan){
       var no_hp = "628114588477";
       var pesan = "Hallo As Frozen saya telah memesan dengan kode pesanan *'"+id_pesanan+"'*";
       var walink = 'https://wa.me/'+ no_hp +'?text=' + encodeURI(pesan);
       window.open(walink);
   }

   function batalkan_pesanan(id_nota){
       $.ajax({
           type: "GET",
           url: "/admin/batalkan_pesanan/"+id_nota,
           success:function(data){
                $('#div_card'+id_nota).remove();
           }
       })
   }
</script>