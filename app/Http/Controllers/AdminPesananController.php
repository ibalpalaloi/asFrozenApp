<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;
use App\Models\Riwayat_nota_pesanan;
use App\Models\Riwayat_pesanan;
use App\Models\User;
use App\Models\pesanan;

class AdminPesananController extends Controller
{
    //
    public function daftar_pesanan(){
        $nota = Nota::where('status', 'menunggu konfirmasi')->get();
        return view('admin.daftar_pesanan', compact('nota'));
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
}
