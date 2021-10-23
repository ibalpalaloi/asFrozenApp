<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Nota;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Diskon;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;


class UserKeranjangController extends Controller
{
    //

    public function autocode(){
        $current_date = date('mdYhis'); 
        return $current_date;
    }

    public function get_diskon($id_produk, $date){
        
        $cek_diskon = Diskon::where([
            ['produk_id', $id_produk],
            ['diskon_akhir', '>=', $date],
            ['diskon_mulai', '<=', $date]
        ])->first();

        if(!empty($cek_diskon)){
            $diskon = $cek_diskon->diskon;
        }else{
            $diskon = 0;
        }
        return $diskon;
    }

    public function get_harga_total_no_json(){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $user_id = Auth()->user()->id;
        $date_today = date("Y-m-d");
        $harga_total = 0;
        $keranjang = Keranjang::where([
                                        ['user_id', $user_id],
                                        ['checked', 'true']
        ])->get();
        foreach($keranjang as $data){
            $produk = Produk::find($data->produk_id);
            $cek_diskon = Diskon::where([
                                        ['produk_id', $produk->id],
                                        ['diskon_akhir', '>=', $date_today],
                                        ['diskon_mulai', '<=', $date_today]
            ])->first();
            if(!empty($cek_diskon)){
                $diskon = $cek_diskon->diskon;
            }else{
                $diskon = 0;
            }

            $harga_diskon = $this->get_harga_diskon($produk->harga, $diskon);
            $harga_total += $data->jumlah * $harga_diskon;
        }

        return $harga_total;
    }

    public function keranjang(){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");

        Keranjang::where('user_id', Auth()->user()->id)->update(['checked' => "true"]);
        $keranjang = Keranjang::where('user_id', Auth()->user()->id)->get();
        $data_keranjang = array();
        $i=0;
        foreach($keranjang as $data){
            $diskon = $this->get_diskon($data->produk_id, $date_today);
            $harga = $data->produk->harga;
            $data_keranjang[$i]['id'] = $data->id;
            $data_keranjang[$i]['produk_id'] = $data->produk_id;
            $data_keranjang[$i]['nama_produk'] = $data->produk->nama;
            $data_keranjang[$i]['harga'] = $data->produk->harga;
            $data_keranjang[$i]['jumlah'] = $data->jumlah;
            $data_keranjang[$i]['checked'] = $data->checked;
            $data_keranjang[$i]['diskon'] = $diskon;
            $data_keranjang[$i]['foto'] = $data->produk->foto;
            $data_keranjang[$i]['harga_diskon'] = $this->get_harga_diskon($data->produk->harga, $diskon);
            $i++;
        }
        $harga_total = $this->get_harga_total_no_json();
        $rekomendasi_produk = Produk::take(4)->get();
        $agent = new Agent();
        if ($agent->isMobile()){
            return view('user.payment.keranjang.mobile', compact('keranjang', 'data_keranjang', 'rekomendasi_produk', 'harga_total'));
        }
        else {
            return view('user.payment.keranjang.desktop1', compact('keranjang', 'data_keranjang', 'rekomendasi_produk', 'harga_total'));
        }

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
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        $kota = Kota::all();
        $kecamatan = Kecamatan::where('kota_id', Auth()->user()->biodata->kelurahan->kecamatan->kota->id)->get();
        $kelurahan = Kelurahan::where('kecamatan_id', Auth()->user()->biodata->kelurahan->kecamatan->id)->get();
        $list_keranjang = Keranjang::where([
            ['user_id', Auth()->user()->id],
            ['checked', "true"]
        ])->get();
        $total_harga_produk = $this->get_harga_total_no_json();
        $data_produk_checkout = array();
        $i=0;
        foreach($list_keranjang as $data){
            $diskon = $this->get_diskon($data->produk_id, $date_today);
            $harga = $data->produk->harga;
            $data_produk_checkout[$i]['id'] = $data->id;
            $data_produk_checkout[$i]['produk_id'] = $data->produk_id;
            $data_produk_checkout[$i]['nama_produk'] = $data->produk->nama;
            $data_produk_checkout[$i]['harga'] = $data->produk->harga;
            $data_produk_checkout[$i]['jumlah'] = $data->jumlah;
            $data_produk_checkout[$i]['checked'] = $data->checked;
            $data_produk_checkout[$i]['diskon'] = $diskon;
            $data_produk_checkout[$i]['foto'] = $data->produk->foto;
            $data_produk_checkout[$i]['harga_diskon'] = $this->get_harga_diskon($data->produk->harga, $diskon);
            $i++;
        }

        $agent = new Agent();
        if ($agent->isMobile()){
            return view('user.payment.checkout.mobile', compact('data_produk_checkout', 'kota', 'kecamatan', 'kelurahan', 'total_harga_produk'));
        }
        else {
            return view('user.payment.checkout.desktop', compact('data_produk_checkout', 'kota', 'kecamatan', 'kelurahan', 'total_harga_produk'));
        }

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

    public function get_harga_total(){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $user_id = Auth()->user()->id;
        $date_today = date("Y-m-d");
        $harga_total = 0;
        $keranjang = Keranjang::where([
                                        ['user_id', $user_id],
                                        ['checked', 'true']
        ])->get();
        foreach($keranjang as $data){
            $produk = Produk::find($data->produk_id);
            $cek_diskon = Diskon::where([
                                        ['produk_id', $produk->id],
                                        ['diskon_akhir', '>=', $date_today],
                                        ['diskon_mulai', '<=', $date_today]
            ])->first();
            if(!empty($cek_diskon)){
                $diskon = $cek_diskon->diskon;
            }else{
                $diskon = 0;
            }

            $harga_diskon = $this->get_harga_diskon($produk->harga, $diskon);
            $harga_total += $data->jumlah * $harga_diskon;
        }

        return response()->json(['harga_total'=>$harga_total]);
    }

    public function get_harga_diskon($harga, $diskon){
        $harga_diskon = $harga - (($diskon/100) * $harga);
        return $harga_diskon;
    }
}
