<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Kota;
use App\Models\Biodata;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Nota;
use App\Models\Bank;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Diskon;
use App\Models\Stok_produk;
use App\Models\Waktu_buka;
use App\Models\Waktu_tutup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;



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

    public function keranjang_delete(Request $request){
        Keranjang::where('id', $request->id)->delete();
        return back()->with('success', 'Produk berhasil dihapus dari keranjang');
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
            $stok_produk = Stok_produk::where('produk_id', $data->produk_id)->first();

            if(empty($stok_produk)){
                $stok = new Stok_produk;
                $stok->produk_id = $data->produk_id;
                $stok->stok = 0;
                $stok->save();

                $stok_produk = Stok_produk::where('produk_id', $data->produk_id)->first();
            }

            if($data->jumlah < $stok_produk->stok){
                $jumlah = $data->jumlah;
            }else{
                $jumlah = $stok_produk->stok;
                $ubah_jumlah = Keranjang::find($data->id);
                $ubah_jumlah->jumlah = $jumlah;
                $ubah_jumlah->save();
            }

            if($stok_produk->stok == 0){
                $ubah_checked = Keranjang::find($data->id);
                $ubah_checked->checked = 'false';
                $ubah_checked->save();
            }

            $data_keranjang[$i]['id'] = $data->id;
            $data_keranjang[$i]['produk_id'] = $data->produk_id;
            $data_keranjang[$i]['nama_produk'] = $data->produk->nama;
            $data_keranjang[$i]['harga'] = $data->produk->harga;
            $data_keranjang[$i]['jumlah'] = $jumlah;
            $data_keranjang[$i]['checked'] = $data->checked;
            $data_keranjang[$i]['diskon'] = $diskon;
            $data_keranjang[$i]['foto'] = $data->produk->foto;
            $data_keranjang[$i]['stok'] = $stok_produk->stok;
            $data_keranjang[$i]['harga_diskon'] = $this->get_harga_diskon($data->produk->harga, $diskon);
            $i++;
        }
        $harga_total = $this->get_harga_total_no_json();
        $rekomendasi_produk = Produk::inRandomOrder()->take(4)->get();
        $agent = new Agent();
        if ($agent->isMobile()){
            return view('user.payment.keranjang.mobile', compact('keranjang', 'data_keranjang', 'rekomendasi_produk', 'harga_total'));
        }
        else {
            return view('user.payment.keranjang.desktop1', compact('keranjang', 'data_keranjang', 'rekomendasi_produk', 'harga_total'));
        }

    }

    public function tambah_keranjang($id){
        if(Auth::check()){
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
        else{
            return "gagal";
        }
        


    }

    public function checkout(){
        $this->cek_jadwal();
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        $status_jadwal = $this->cek_jadwal();
        $biodata = Biodata::where('id', Auth()->user()->biodata->id)->first();
        if ($biodata->kelurahan_id != ''){
            if($status_jadwal){
                $kota = Kota::all();
                $kecamatan = Kecamatan::where('kota_id', Auth()->user()->biodata->kelurahan->kecamatan->kota->id)->get();
                $kelurahan = Kelurahan::where('kecamatan_id', Auth()->user()->biodata->kelurahan->kecamatan->id)->get();
                $list_keranjang = Keranjang::where([
                    ['user_id', Auth()->user()->id],
                    ['checked', "true"]
                ])->get();
                $total_harga_produk = $this->get_harga_total_no_json();
                $data_produk_checkout = array();
                $bank = Bank::all();
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
                // dd($bank);
                if ($agent->isMobile()){
                    return view('user.payment.checkout.mobile', compact('data_produk_checkout', 'kota', 'kecamatan', 'kelurahan', 'total_harga_produk', 'bank'));
                }
                else {
                    return view('user.payment.checkout.desktop', compact('data_produk_checkout', 'kota', 'kecamatan', 'kelurahan', 'total_harga_produk', 'bank'));
                }
            }
            else{
                return redirect()->back()->with('error', "Hari Ini Kami Telah Tutup, Silahkan Pesan Pada Hari Lain");
            }

        }
        else {
            return redirect('biodata?from=keranjang')->with('error', "Silahkan lengkapi biodata terlebih dahulu");            
        }

        

    }

    public function cek_jadwal(){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $hari = date("D");
        $date_today = date("Y-m-d");
        $jam = date('H:i:s');
        switch($hari){
            case 'Sun':
            $hari_ini = "minggu";
            break;

            case 'Mon':			
            $hari_ini = "senin";
            break;

            case 'Tue':
            $hari_ini = "selasa";
            break;

            case 'Wed':
            $hari_ini = "rabu";
            break;

            case 'Thu':
            $hari_ini = "kamis";
            break;

            case 'Fri':
            $hari_ini = "jumat";
            break;

            case 'Sat':
            $hari_ini = "sabtu";
            break;
            
            default:
            $hari_ini = "Tidak di ketahui";		
            break;
        }
        $status = true;
        $jadwal = Waktu_buka::where('hari', $hari_ini)
        ->where('keterangan', 'buka')
        ->whereTime('waktu_buka', '<', $jam)
        ->whereTime('waktu_tutup', '>', $jam)
        ->get();
        if(count($jadwal) == 0){
            $status = false;
        }

        $cek_jadwal_tutup = Waktu_tutup::where('tgl_tutup', $date_today)->get();
        if(count($cek_jadwal_tutup)>0){
            $status = false;
        }
        return $status;
    }

    public function ubah_checked(Request $request){
        $keranjang = Keranjang::find($request->id);
        $keranjang->checked = $request->checked;
        $keranjang->save();
    }

    public function ubah_jumlah(Request $request){
        $keranjang = Keranjang::find($request->id);
        $stok_produk = Stok_produk::where('produk_id', $keranjang->produk_id)->first();
        if($request->jumlah > $stok_produk->stok){
            return response()->json(['status'=>'gagal', 'jumlah'=>$stok_produk->stok]);
        }
        else{
            $keranjang->jumlah = $request->jumlah;
            $keranjang->save();
            return response()->json(['status'=>'sukses', 'jumlah'=>$request->jumlah]);
        }
        
    }

    public function post_checkout(Request $request){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required',
            'ongkos_kirim' => 'required',
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
        $nota->alamat =  $request->alamat;
        $nota->kota = $request->kota;
        $nota->kecamatan = $request->kecamatan;
        $nota->kelurahan = $request->kelurahan;
        $nota->pembayaran = $request->pembayaran;
        $nota->pengantaran = $request->pengantaran;
        $nota->catatan = $request->catatan_pesanan;
        $time_now = date('H:i:s');
        $time_expired = strtotime("+10 minutes", strtotime($time_now));
        $nota->time_status = "run";
        $nota->time_date = date('Y-m-d');
        $nota->time_expired = date('H:i:s', $time_expired);
        $nota->status = "menunggu konfirmasi";
        $nota->notifikasi = 'true';
        $nota->save();

        $keranjang = Keranjang::where([['user_id', Auth()->user()->id], ['checked', 'true']])->get();

        foreach($keranjang as $data){
            $diskon = $this->get_diskon($data->produk_id, $date_today);
            $pesanan = new Pesanan;
            $pesanan->nota_id = $nota->id;
            $pesanan->produk_id = $data->produk_id;
            $pesanan->jumlah = $data->jumlah;
            $pesanan->diskon = $diskon;
            $pesanan->harga_satuan = $this->get_harga_diskon($data->produk->harga, $diskon);
            $pesanan->save();

            $this->ubah_stok($data->produk_id, $data->jumlah);
        }

        $keranjang = Keranjang::where([['user_id', Auth()->user()->id], ['checked', 'true']])->delete();
        return redirect('/pesanan');
    }

    public function ubah_stok($id_produk, $jumlah_dikurangi){
        $stok_produk = Stok_produk::where('produk_id', $id_produk)->first();
        if(!empty($stok_produk)){
            $stok = $stok_produk->stok - $jumlah_dikurangi;
            if($stok < 0){
                $stok = 0;
            }
            $stok_produk->stok = $stok;
            $stok_produk->save();
        }
        
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
