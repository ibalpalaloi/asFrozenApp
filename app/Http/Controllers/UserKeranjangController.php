<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Nota;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Validator;


class UserKeranjangController extends Controller
{
    //

    public function autocode(){
        $current_date = date('mdYhis'); 
        return $current_date;
    }

    public function keranjang(){
        Keranjang::where('user_id', Auth()->user()->id)->update(['checked' => "true"]);
        $keranjang = Keranjang::where('user_id', Auth()->user()->id)->get();
        $data_keranjang = array();
        $i=0;
        foreach($keranjang as $data){
            $data_keranjang[$i]['id'] = $data->id;
            $data_keranjang[$i]['produk_id'] = $data->produk_id;
            $data_keranjang[$i]['harga'] = $data->produk->harga;
            $data_keranjang[$i]['jumlah'] = $data->jumlah;
            $data_keranjang[$i]['checked'] = $data->checked;
            $i++;
        }
        return view('user.keranjang', compact('keranjang', 'data_keranjang'));
    }

    public function tambah_keranjang($id){
        $keranjang = Keranjang::where([
                                        ['user_id', Auth()->user()->id],
                                        ['produk_id', $id]
        ])->first();

        if($keranjang != null){
            $keranjang->jumlah = $keranjang->jumlah+1;
            $keranjang->save();
        }
        else{
            $keranjang = new Keranjang;
            $keranjang->user_id = Auth()->user()->id;
            $keranjang->produk_id = $id;
            $keranjang->jumlah =1;
            $keranjang->save();
        }

        return "sukses";
    }

    public function checkout(){
        $kota = Kota::all();
        $kecamatan = Kecamatan::where('kota_id', Auth()->user()->biodata->kelurahan->kecamatan->kota->id)->get();
        $kelurahan = Kelurahan::where('kecamatan_id', Auth()->user()->biodata->kelurahan->kecamatan->id)->get();
        $list_keranjang = Keranjang::where([
                                            ['user_id', Auth()->user()->id],
                                            ['checked', "true"]
        ])->get();
        return view('user.checkout', compact('list_keranjang', 'kota', 'kecamatan', 'kelurahan'));
    }

    public function ubah_checked(Request $request){
        $keranjang = Keranjang::find($request->id);
        $keranjang->checked = $request->checked;
        $keranjang->save();
    }

    public function ubah_jumlah(Request $request){
        $keranjang = Keranjang::find($request->id);
        $keranjang->jumlah = $request->jumlah;
        $keranjang->save();
    }

    public function post_checkout(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required',
            'ongkos_kirim' => 'required',
            'total_harga_produk' => 'required',
            'alamat' => "required",
            'kota' => "required",
            'kecamatan' => "required",
            'kelurahan' => "required",
            'pembayaran' => "required",
            'pengantaran' => "required",
        ]);

        if($validator->fails()){
            return back()->with('error', 'Pastikan data terisi semua');
        }

        $nota = new Nota;
        $nota->user_id = Auth()->user()->id;
        $nota->ongkos_kirim = $request-> ongkos_kirim;
        $nota->penerima = $request->nama_penerima;
        $nota->id_pesanan = $this->autocode();
        $nota->no_telp_penerima = $request->no_telp_penerima;
        $nota->total_harga = $request->total_harga_produk;
        $nota->alamat =  $request->alamat;
        $nota->kota = $request->kota;
        $nota->kecamatan = $request->kecamatan;
        $nota->kelurahan = $request->kelurahan;
        $nota->pembayaran = $request->pembayaran;
        $nota->pengantaran = $request->pengantaran;
        $nota->catatan = $request->catatan_pesanan;
        $nota->status = "menunggu konfirmasi";
        $nota->save();

        $keranjang = Keranjang::where([['user_id', Auth()->user()->id], ['checked', 'true']])->get();

        foreach($keranjang as $data){
            $pesanan = new Pesanan;
            $pesanan->nota_id = $nota->id;
            $pesanan->produk_id = $data->produk_id;
            $pesanan->jumlah = $data->jumlah;
            $pesanan->harga_satuan = $data->produk->harga;
            $pesanan->save();
        }

        $keranjang = Keranjang::where([['user_id', Auth()->user()->id], ['checked', 'true']])->delete();
        return redirect('/pesanan');
    }
}
