
<script type="text/javascript">

	var list_keranjang = {!! json_encode($data_keranjang) !!}
	var total_harga = parseInt("{{$total_harga}}");
	// alert(total_harga);
	function checkbox_cek(id,index){
		var checked = $('#checkboxPrimary'+index).is(":checked");
		list_keranjang[index]['checked'] = checked.toString();
		// get_harga_total();
		var sub_total = $('#sub_total'+index).html();
		sub_total = sub_total.replace('.', '');
		console.log("sukses")
		if(checked == true){
			total_harga += parseInt(sub_total);
			
		}
		else{
			total_harga -= parseInt(sub_total);
		}
		$("#harga_total").html(total_harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
		

		$.ajax({
			type:"post",
			url: "<?=url('/')?>/keranjang/ubah_checked",
			data:{"id": id, "checked":checked.toString(), "_token" : "{{ csrf_token() }}"},
			success:function(data){
				
			}
		})

	}

	function kurang_pesanan(index, harga_diskon){
		
		var jumlah_pesanan = parseInt($('#jumlah_pesanan'+index).html());
		if(jumlah_pesanan > 1){
			jumlah_pesanan -= 1;
			total_harga -= parseInt(harga_diskon);
			list_keranjang[index]['jumlah'] = jumlah_pesanan;
			var sub_total = parseInt(jumlah_pesanan * harga_diskon);
			$('#jumlah_pesanan'+index).html(jumlah_pesanan);
			$('#sub_total'+index).html(sub_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
			$("#harga_total").html(total_harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
			ubah_jumlah_ajax(list_keranjang[index]['id'], jumlah_pesanan);
		}
		
	}

	function tambah_pesanan(index, harga_diskon){
		total_harga += parseInt(harga_diskon);
		var jumlah_pesanan = parseInt($('#jumlah_pesanan'+index).html());
		jumlah_pesanan += 1;
		list_keranjang[index]['jumlah'] = jumlah_pesanan;
		var sub_total = parseInt(jumlah_pesanan * harga_diskon);
		$('#jumlah_pesanan'+index).html(jumlah_pesanan);
		$('#sub_total'+index).html(sub_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
		$("#harga_total").html(total_harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
		ubah_jumlah_ajax(list_keranjang[index]['id'], jumlah_pesanan);
	}

	function ubah_jumlah_ajax(id, jumlah){
		$.ajax({
			type:"post",
			url: "<?=url('/')?>/keranjang/ubah_jumlah",
			data:{"id": id, "jumlah":jumlah, "_token" : "{{ csrf_token() }}"},
			success:function(data){
				console.log("sukses")
			}
		})
	}

	// function get_harga_total(){
	// 	var count = Object.keys(list_keranjang).length;
	// 	var harga_total =0;
	// 	for(let i = 0; i<count; i++){
	// 		if(list_keranjang[i]['checked'] == "true"){
	// 			var sub_total = list_keranjang[i]['harga'] * list_keranjang[i]['jumlah'];
	// 			harga_total += sub_total;
	// 		}
	// 	}
	// 	console.log(harga_total);
	// 	$("#harga_total").html(harga_total);
	// }

	function modal_pesan(){
		$('#exampleModal').modal('show');
	}

	function ongkos_kirim(){
		var kelurahan = $("#select_kelurahan").val();
		var ongkos_kirim = 0;
		var total_pesanan = 0;
		if(kelurahan == "Tipo"){
			ongkos_kirim = "20.000"
			total_pesanan = "70.000"
		}
		else if(kelurahan == "Kabonena"){
			ongkos_kirim = "18.000"
			total_pesanan = "68.000"
		}
		else if(kelurahan == "Donggala Kodi"){
			ongkos_kirim = "18.000"
			total_pesanan = "68.000"
		}
		else if(kelurahan == "Silae"){
			ongkos_kirim = "29.000"
			total_pesanan = "79.000"
		}
		else{
			ongkos_kirim = "0"
		}

		$("#ongkos_kirim").empty()
		$("#total_pesanan").empty()
		$("#total_pesanan").append("Total : Rp. "+total_pesanan)
		$("#ongkos_kirim").append("Rp. "+ongkos_kirim)
	}
</script>