<script type="text/javascript">
	@if(\Session::has('error'))
		$(document).ready(function(){
			alert_tutup("{!! \Session::get('error') !!}");
		});
	@endif

	function alert_tutup(pesan){
		swal(pesan);
	}

	function checkbox_cek(id){
		var checked = $('#checkboxPrimary'+id).is(":checked");
        console.log(checked);

		$.ajax({
			type:"post",
			url: "<?=url('/')?>/keranjang/ubah_checked",
			data:{"id": id, "checked":checked.toString(), "_token" : "{{ csrf_token() }}"},
			success:function(data){
				console.log("sukses")
				get_harga_total();
			}
		})

	}

	function kurang_pesanan(id, harga_diskon){
		var jumlah_pesanan = parseInt($('#jumlah_pesanan'+id).html());
		if(jumlah_pesanan > 1){
			jumlah_pesanan -= 1;
			var sub_total = parseInt(jumlah_pesanan * harga_diskon);
			$('#jumlah_pesanan'+id).html(jumlah_pesanan);
			$('#sub_total'+id).html(sub_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
			ubah_jumlah_ajax(id, jumlah_pesanan);
			get_harga_total();
		}
		
	}

	function tambah_pesanan(id, harga_diskon){
		var jumlah_pesanan = parseInt($('#jumlah_pesanan'+id).html());
		jumlah_pesanan += 1;
		var sub_total = (jumlah_pesanan * harga_diskon);
		$('#jumlah_pesanan'+id).html(jumlah_pesanan);
		$('#sub_total'+id).html(sub_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
		ubah_jumlah_ajax(id, jumlah_pesanan, harga_diskon);
		get_harga_total();
	}

	function ubah_jumlah_ajax(id, jumlah, harga_diskon){
		$.ajax({
			type:"post",
			url: "<?=url('/')?>/keranjang/ubah_jumlah",
			data:{"id": id, "jumlah":jumlah, "_token" : "{{ csrf_token() }}"},
			success:function(data){
				if(data.status == 'gagal'){
					$('#jumlah_pesanan'+id).html(data.jumlah);
					var sub_total = data.jumlah * harga_diskon;
					$('#sub_total'+id).html(sub_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
				}
			}
		})
	}

	function get_harga_total(){
		$.ajax({
			type: "get",
			url: "<?=url('/')?>/keranjang/get-harga-total",
			success:function(data){
				$('#harga_total').html(data.harga_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
			}
		})
	}

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