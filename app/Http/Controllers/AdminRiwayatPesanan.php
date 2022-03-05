<?php

namespace App\Http\Controllers;
use App\Models\Riwayat_nota_pesanan;
use App\Models\Riwayat_pesanan;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Generator;


class AdminRiwayatPesanan extends Controller
{
    //
    public function daftar_riwayat(Request $request){
        date_default_timezone_set( 'Asia/Singapore' );
        $date_today = date("Y-m-d");
        $data_nota = array();
        $nota = Riwayat_nota_pesanan::orderBy('created_at', 'desc')->paginate(50);
        $i = 0;
        foreach($nota as $data){
            $data_nota[$i]['id'] = $data->id;
            $data_nota[$i]['id_pesanan'] = $data->id_pesanan;
            $data_nota[$i]['nama_pemesan'] = $data->nama_pemesan;
            $data_nota[$i]['nomor_pemesan'] = $data->nomor_pemesan;
            $data_nota[$i]['waktu_pemesanan'] = $data->waktu_pemesanan;
            $data_nota[$i]['total_pemesanan'] = $this->get_total_harga_riwayat_pesanan($data->id);
            $data_nota[$i]['pembayaran'] = $data->pembayaran;
            $data_nota[$i]['pengantaran'] = $data->pengantaran;
            $data_nota[$i]['admin'] = $data->admin;
            $i++;
        }
        if(count($request->all()) > 0){
            $html = view('admin.include.data_riwayat_pesanan', compact('data_nota'))->render();
            return response()->json(['html'=>$html]);
        }
        return view('admin.riwayat_pesanan', compact('data_nota')); 
    }



    public function daftar_riwayat_detail($id){
        $riwayat_nota = Riwayat_nota_pesanan::where('id_pesanan', $id)->first();
        $riwayat = Riwayat_pesanan::where('riwayat_nota_pesanan_id', $riwayat_nota->id)->get();
        // dd($riwayat);    
        $qrcode = new Generator;
        return view('admin/riwayat_pesanan_detail', compact('riwayat', 'riwayat_nota', 'qrcode'));
    }

    public function get_total_harga_riwayat_pesanan($id){
        $riwayat_pesanan = Riwayat_pesanan::where('riwayat_nota_pesanan_id', $id)->get();
        $total_pesanan = 0;
        foreach($riwayat_pesanan as $data){
            $total_pesanan += $data->jumlah * $data->harga_satuan;
        }
        return $total_pesanan;
    }

    public function get_riwayat_pesanan($id){
        $nota = Riwayat_nota_pesanan::find($id);
        $pesanan = Riwayat_pesanan::where('riwayat_nota_pesanan_id', $id)->get();
        $html = view('admin.include.detail_riwayat_pesanan_modal', compact('nota', 'pesanan'))->render();
        return response()->json(['html'=>$html]);
    }

    public function riwayat_pesanan_cari(Request $request){
        $data_nota = array();
        if($request->has('id_pesanan')){
            $nota = Riwayat_nota_pesanan::where('id_pesanan', 'LIKE', '%'.$request->id_pesanan.'%')->get();

        }
        elseif($request->has('tgl')){
            $nota = Riwayat_nota_pesanan::whereDate('waktu_pemesanan', $request->tgl)->get();
        }
        else{
            $nota = Riwayat_nota_pesanan::orderBy('created_at', 'desc')->paginate(50);
        }

        $i = 0;
        foreach($nota as $data){
            $data_nota[$i]['id'] = $data->id;
            $data_nota[$i]['id_pesanan'] = $data->id_pesanan;
            $data_nota[$i]['nama_pemesan'] = $data->nama_pemesan;
            $data_nota[$i]['nomor_pemesan'] = $data->nomor_pemesan;
            $data_nota[$i]['waktu_pemesanan'] = $data->waktu_pemesanan;
            $data_nota[$i]['total_pemesanan'] = $this->get_total_harga_riwayat_pesanan($data->id);
            $data_nota[$i]['pembayaran'] = $data->pembayaran;
            $data_nota[$i]['pengantaran'] = $data->pengantaran;
            $data_nota[$i]['admin'] = $data->admin;
            $i++;
        }

        if($request->has('id_pesanan')){
            $id_pesanan = $request->id_pesanan;
            return view('admin.riwayat_pesanan', compact('data_nota', 'id_pesanan')); 
        }
        elseif($request->has('tgl')){
            $tgl = $request->tgl;
            return view('admin.riwayat_pesanan', compact('data_nota', 'tgl')); 
        }

        return view('admin.riwayat_pesanan', compact('data_nota')); 

    }
}
