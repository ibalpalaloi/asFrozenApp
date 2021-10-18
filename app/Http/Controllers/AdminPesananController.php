<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;
use App\Models\Riwayat_nota_pesanan;
use App\Models\Riwayat_pesanan;
use App\Models\User;
use App\Models\pesanan;
use App\Models\Produk;
use App\Models\Diskon;

class AdminPesananController extends Controller
{
    //
    public function daftar_pesanan(){
        $nota = Nota::where('status', 'menunggu konfirmasi')->get();
        $menu = "pesanan";
        $sub_menu = "daftar pesanan";
        return view('admin.daftar_pesanan', compact('nota', 'menu', 'sub_menu'));
    }

    public function packaging(){
        $nota = Nota::where('status', 'packaging')->get();
        return view('admin.pesanan_packaging', compact('nota'));
    }

    public function dalam_pengantaran(){
        $nota = Nota::where('status', 'dalam pengantaran')->get();
        return view('admin.pesanan_dalam_pengantaran', compact('nota'));
    }

    public function pesanan_selesai($id){
        $nota = Nota::find($id);
        $user = User::find($nota->user_id);

        $riwayat_nota = new Riwayat_nota_pesanan;
        $riwayat_nota->user_id = $nota->user->id;
        $riwayat_nota->id_pesanan = $nota->id_pesanan;
        $riwayat_nota->nama_pemesan = $nota->penerima;
        $riwayat_nota->nama_penerima = $nota->user->biodata->nama;
        $riwayat_nota->nomor_pemesan = $nota->user->biodata->no_telp;
        $riwayat_nota->nomor_penerima = $nota->no_telp_penerima;
        $riwayat_nota->ongkos_kirim = $nota->ongkos_kirim;
        $riwayat_nota->total_harga = $nota->total_harga;
        $riwayat_nota->alamat = $nota->alamat;
        $riwayat_nota->pengantaran = $nota->pengantaran;
        $riwayat_nota->pembayaran = $nota->pembayaran;
        $riwayat_nota->kota = $nota->kota;
        $riwayat_nota->kecamatan = $nota->kecamatan;
        $riwayat_nota->kelurahan = $nota->kelurahan;
        $riwayat_nota->waktu_pemesanan = $nota->created_at;
        $riwayat_nota->catatan = $nota->catatan;
        $riwayat_nota->save();

        foreach ($nota->pesanan as $pesanan){
            $riwayat_pesanan = new Riwayat_pesanan;
            $riwayat_pesanan->user_id = $nota->user->id;
            $riwayat_pesanan->riwayat_nota_pesanan_id = $riwayat_nota->id;
            $riwayat_pesanan->produk_id = $pesanan->produk_id;
            $riwayat_pesanan->produk = $pesanan->produk->nama;
            $riwayat_pesanan->satuan = $pesanan->produk->satuan;
            $riwayat_pesanan->jumlah = $pesanan->jumlah;
            $riwayat_pesanan->harga_satuan = $pesanan->harga_satuan;
            $riwayat_pesanan->save();
        }
        
        Pesanan::where('nota_id', $nota->id)->delete();
        $nota->delete();
        return back();
    }

    public function ubah_status_pesanan($id, $status){
        $nota = Nota::find($id);
        $nota->status = $status;
        $nota->save();
        return back();
    }

    public function hapus_pesanan($id){
        Pesanan::where('id', $id)->delete();
    }

    public function get_list_produk($produk){
        $list_produk = array();
        $produk = Produk::where("nama", "LIKE", "%".$produk."%")->get();
        $i=0;
        foreach($produk as $data){
            $list_produk[$i]['id'] = $data->id;
            $list_produk[$i]['nama'] = $data->nama;
            $list_produk[$i]['stok'] = $data->stok_produk->stok;
            $list_produk[$i]['harga'] = $this->get_harga($data->id);
            $list_produk[$i]['diskon'] = $this->get_diskon_produk($data->id);
            $i++;
        }
        $view = view('admin.include.data_tabel_tambah_produk', compact('list_produk'))->render();

        return response()->json(['view'=>$view]);
    }

    public function input_pesanan_baru(Request $request){
        $pesanan = Pesanan::where([
                                        ['nota_id', $request->id_nota],
                                        ['produk_id', $request->produk_id]
                        ])->first();
        if(!empty($pesanan)){
            $pesanan->jumlah = $request->jumlah;
            $pesanan->save();
        }
        else{
            $pesanan = new Pesanan;
            $pesanan->nota_id = $request->id_nota;
            $pesanan->produk_id = $request->id_produk;
            $pesanan->jumlah = $request->jumlah;
            $pesanan->harga_satuan = $request->harga_satuan;
            $pesanan->save();
        }

        $data_pesanan = array();
        $data_pesanan['id'] = $pesanan->id;
        $data_pesanan['nama'] = $pesanan->produk->nama;
        $data_pesanan['jumlah'] = $pesanan->jumlah;
        $data_pesanan['harga_satuan'] = $pesanan->harga_satuan;
        $data_pesanan['harga_total'] = $pesanan->jumlah * $pesanan->harga_satuan;
        return response()->json(['pesanan'=>$data_pesanan]);
    }

    public function get_total_pesanan($id_nota){
        $nota = Nota::find($id_nota);
        $total_harga = $nota->pesanan->sum('harga_satuan') + $nota->ongkos_kirim;

        return response()->json(['total_harga'=>$total_harga]);
    }

    public function get_harga($id_produk){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        $produk = Produk::find($id_produk);
        $diskon = Diskon::where([
                                ['produk_id', $id_produk],
                                ['diskon_akhir', '>=', $date_today],
                                ['diskon_mulai', '<=', $date_today]
        ])->first();
        if($diskon != null){
            $harga = $produk->harga - (($diskon->diskon/100) * $produk->harga);
        }
        else{
            $harga = $produk->harga;
        }
        return $harga;
    }

    public function get_diskon_produk($id_produk){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        $produk = Produk::find($id_produk);
        $diskon = Diskon::where([
                                ['produk_id', $id_produk],
                                ['diskon_akhir', '>=', $date_today],
                                ['diskon_mulai', '<=', $date_today]
        ])->first();
        if($diskon != null){
            $diskon = $diskon->diskon;
        }
        else{
            $diskon = 0;
        }
        return $diskon;
    }
}
