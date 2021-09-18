<?php

namespace App\Http\Controllers;
use App\Models\Riwayat_nota_pesanan;
use App\Models\Riwayat_pesanan;
use Illuminate\Http\Request;

class AdminRiwayatPesanan extends Controller
{
    //
    public function daftar_riwayat(){
        $nota = Riwayat_nota_pesanan::all();
        return view('admin.riwayat_pesanan', compact('nota')); 
    }

    public function get_riwayat_pesanan($id){
        $nota = Riwayat_nota_pesanan::find($id);
        $pesanan = Riwayat_pesanan::where('riwayat_nota_pesanan_id', $id)->get();
        $html = view('admin.include.detail_riwayat_pesanan_modal', compact('nota', 'pesanan'))->render();
        return response()->json(['html'=>$html]);
    }
}
