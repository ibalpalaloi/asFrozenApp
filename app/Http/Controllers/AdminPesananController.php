<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;
use App\Models\Riwayat_nota_pesanan;
use App\Models\Riwayat_pesanan;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Diskon;
use App\Models\Keranjang;
use App\Models\Nota_expired;
use App\Models\Stok_produk;
use App\Models\Kurir;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Generator;


class AdminPesananController extends Controller
{
    //
    public function daftar_pesanan(){
        $nota = Nota::where('status', 'menunggu konfirmasi')->get();
        $menu = "pesanan";
        $sub_menu = "daftar pesanan";
        return view('admin.daftar_pesanan', compact('nota', 'menu', 'sub_menu'));
    }

    public function control_pesanan($id, $status){
        $nota = Nota::where('id', $id)->first();
        if ($status == 'pause'){
            $nota->time_status = "pause";
            $nota->time_expired = null;
            $nota->time_left = "00:".$_GET['waktu'];
            $nota->save(); 
            echo "sukses";
        }
        else {
            $nota->time_status = "run";
            $time_now = date('H:i:s');

            $minutes = date('i', strtotime($nota->time_left));
            $seconds = date('s', strtotime($nota->time_left));
            $fix_time_future = strtotime("+".$minutes." minutes ".$seconds." seconds", strtotime($time_now));
            $time_future = date("H:i:s", $fix_time_future);
            
            $nota->time_left = null;
            $nota->time_expired = $time_future;
            $nota->save();
            // echo $nota->time_left;
            // $nota->time_expired = null;
            $data['menit'] = $minutes;
            $data['detik'] = $seconds;
            $data['id'] = $id;
            echo json_encode($data);
        }


    }

    public function packaging(){
        $kurir = Kurir::all();
        $nota = Nota::where([
                ['status', 'packaging'],
                ['penerima_pesanan_id', Auth()->user()->id]
        ])->get();
        $qrcode = new Generator;
        $menu = "pesanan";
        $sub_menu = "packaging";
        $list = "list";
        return view('admin.pesanan_packaging', compact('nota', 'qrcode', 'menu', 'sub_menu', 'list', 'kurir'));
    }

    public function packaging_semua(){
        $nota = Nota::where([
                ['status', 'packaging']
        ])->get();
        $qrcode = new Generator;
        $menu = "pesanan";
        $sub_menu = "packaging";
        $list = "semua";
        return view('admin.pesanan_packaging', compact('nota', 'qrcode', 'menu', 'sub_menu', 'list'));
    }

    public function detail_pesanan($id){
        $nota = Nota::where('id', $id)->first();
        if(empty($nota)){
            return back()->with('error', 'Pesanan Expired');
        }
        $qrcode = new Generator;
        // dd($nota);
        return view('admin.detail_pesanan', compact('nota', 'qrcode'));
    }

    public function dalam_pengantaran(){
        $nota = Nota::where([
            ['status', 'dalam pengantaran'],
            ['pengantaran', 'Diantarkan'],
            ['penerima_pesanan_id', Auth()->user()->id]
        ])->get();
        $qrcode = new Generator;
        $menu = "pesanan";
        $sub_menu = "dalam pengantaran";
        $list = 'list';
        return view('admin.pesanan_dalam_pengantaran', compact('nota', 'qrcode', 'menu', 'sub_menu', 'list'));
    }

    public function dalam_pengantaran_semua(){
        $nota = Nota::where([
            ['status', 'dalam pengantaran'],
            ['pengantaran', 'Diantarkan']
        ])->get();
        $qrcode = new Generator;
        $menu = "pesanan";
        $sub_menu = "dalam pengantaran";
        $list = 'semua';
        return view('admin.pesanan_dalam_pengantaran', compact('nota', 'qrcode', 'menu', 'sub_menu', 'list'));
    }

    public function siap_diambil(){
        $nota = Nota::where([
            ['status', 'dalam pengantaran'],
            ['pengantaran', 'Ambil Sendiri'],
            ['penerima_pesanan_id', Auth()->user()->id]
        ])->get();
        $qrcode = new Generator;
        $menu = "pesanan";
        $sub_menu = "siap diambil";
        $list = 'list';
        return view('admin.pesanan_dalam_pengantaran', compact('nota', 'qrcode', 'menu', 'sub_menu', 'list'));
    }

    public function siap_diambil_semua(){
        $nota = Nota::where([
            ['status', 'dalam pengantaran'],
            ['pengantaran', 'Ambil Sendiri']
        ])->get();
        $qrcode = new Generator;
        $menu = "pesanan";
        $sub_menu = "siap diambil";
        $list = 'semua';
        return view('admin.pesanan_dalam_pengantaran', compact('nota', 'qrcode', 'menu', 'sub_menu', 'list'));
    }

    public function pesanan_selesai($id){
        $nota = Nota::find($id);
        $user = User::find($nota->user_id);

        $riwayat_nota = new Riwayat_nota_pesanan;
        $riwayat_nota->user_id = $nota->user->id;
        $riwayat_nota->id_pesanan = $nota->id_pesanan;
        $riwayat_nota->nama_pemesan = $nota->penerima;
        $riwayat_nota->jenis_kelamin = $nota->user->biodata->jenis_kelamin;
        $riwayat_nota->nama_penerima = $nota->user->biodata->nama;
        $riwayat_nota->nomor_pemesan = $nota->user->biodata->no_telp;
        $riwayat_nota->nomor_penerima = $nota->no_telp_penerima;
        $riwayat_nota->ongkos_kirim = $nota->ongkos_kirim;
        $riwayat_nota->total_harga = $this->get_total_harga_pesanan($nota->id);
        $riwayat_nota->alamat = $nota->alamat;
        $riwayat_nota->pengantaran = $nota->pengantaran;
        $riwayat_nota->pembayaran = $nota->pembayaran;
        $riwayat_nota->kota = $nota->kota;
        $riwayat_nota->kecamatan = $nota->kecamatan;
        $riwayat_nota->kelurahan = $nota->kelurahan;
        $riwayat_nota->waktu_pemesanan = $nota->created_at;
        $riwayat_nota->catatan = $nota->catatan;
        $riwayat_nota->admin = Auth()->user()->name;
        $riwayat_nota->nama_kurir = $nota->nama_kurir;
        $riwayat_nota->no_telp_kurir = $nota->no_telp_kurir;
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

    public function get_total_harga_pesanan($id){
        $pesanan = Pesanan::where('nota_id', $id)->get();
        $total_pesanan = 0;
        foreach($pesanan as $data){
            $total_pesanan += $data->jumlah * $data->harga_satuan;
        }
        return $total_pesanan;
    }

    public function ubah_status_pesanan($id, $status){
        $nota = Nota::find($id);
        if(empty($nota)){
            return redirect('/daftar-pesanan')->with('error', 'Pesanan Expired');
        }
        $nota->status = $status;
        $nota->penerima_pesanan_id = Auth()->user()->id;
        $nota->save();
        if($status == "packaging"){
            return redirect('/admin/daftar-pesanan');    
        }
        elseif($status == "dalam pengantaran"){
            return redirect('/admin/pesanan-packaging');
        }
        else{
            return redirect('/admin/pesanan-dalam-pengantaran');
        }
        
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
            if($data->stok_produk){
                $list_produk[$i]['stok'] = $data->stok_produk->stok;
            }else{
                $list_produk[$i]['stok'] = 0;
            }
            
            $list_produk[$i]['harga'] = $this->get_harga($data->id);
            $list_produk[$i]['diskon'] = $this->get_diskon_produk($data->id);
            $i++;
        }
        $view = view('admin.include.data_tabel_tambah_produk', compact('list_produk'))->render();

        return response()->json(['view'=>$view]);
    }

    public function input_pesanan_baru(Request $request){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        $nota = Nota::find($request->id_nota);
        $pesanan = Pesanan::where([
            ['nota_id', $request->id_nota],
            ['produk_id', $request->produk_id]
        ])->first();
        if(!empty($pesanan)){
            $pesanan->jumlah = $request->jumlah;
            $pesanan->save();
        }
        else{
            $produk = Produk::find($request->id_produk);
            $diskon = $this->get_diskon($request->id_produk, $date_today);
            $pesanan = new Pesanan;
            $pesanan->nota_id = $request->id_nota;
            $pesanan->produk_id = $request->id_produk;
            $pesanan->jumlah = $request->jumlah;
            $pesanan->diskon = $diskon;
            $pesanan->harga_satuan = $this->get_harga_diskon($produk->harga, $diskon);
            $pesanan->save();
        }

        $data_pesanan = array();
        $data_pesanan['id'] = $pesanan->id;
        $data_pesanan['nama'] = $pesanan->produk->nama;
        $data_pesanan['jumlah'] = $pesanan->jumlah;
        $data_pesanan['harga_satuan'] = $pesanan->harga_satuan;
        $data_pesanan['harga_total'] = $pesanan->jumlah * $pesanan->harga_satuan;
        $count = Pesanan::where('nota_id', $nota->id)->count();
        $html = view('admin.include.trow_tambah_pesanan', compact('pesanan', 'nota', 'count'))->render();
        return response()->json(['html'=>$html]);
    }

    public function get_harga_diskon($harga, $diskon){
        $harga_diskon = $harga - (($diskon/100) * $harga);
        return $harga_diskon;
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

    public function get_total_pesanan($id_nota){
        $nota = Nota::find($id_nota);
        $total_harga = 0;
        foreach($nota->pesanan as $pesanan){
            $total_sub_pesanan = $pesanan->jumlah * $pesanan->harga_satuan;
            $total_harga += $total_sub_pesanan;
        }

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

    public function batalkan_pesanan($id){
        $nota = Nota::find($id);
        foreach($nota->pesanan as $pesanan){
            $keranjang = new Keranjang;
            $keranjang->user_id = $nota->user_id;
            $keranjang->produk_id = $pesanan->produk_id;
            $keranjang->jumlah = $pesanan->jumlah;
            $keranjang->save();
        }

        Pesanan::where('nota_id', $nota->id)->delete();
        $nota->delete();
    }

    public function cek_pesanan_expired(){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        $time = date("H:i:s");
        $nota = Nota::where([
            ['time_expired', '<', $time],
            ['status', 'menunggu konfirmasi']
        ])->orWhere('time_date', '<', $date_today)->get();
        $list_id_pesanan_expired = array();
        foreach($nota as $data){
            array_push($list_id_pesanan_expired, $data->id);
            $nota_expired = new Nota_expired;
            $nota_expired->user_id = $data->user_id;
            $nota_expired->alamat = $data->alamat;
            $nota_expired->kota = $data->kota;
            $nota_expired->kecamatan = $data->kecamatan;
            $nota_expired->kelurahan = $data->kelurahan;
            $nota_expired->pembayaran = $data->pembayaran;
            $nota_expired->pengantaran = $data->pengantaran;
            $nota_expired->catatan = $data->catatan;
            $nota_expired->notif = "true";
            $nota_expired->time_expired = $data->time_expired;
            $nota_expired->save();

            $pesanan = Pesanan::where('nota_id', $data->id)->get();
            $id_user = $data->user_id;
            foreach($pesanan as $row){
                $keranjang = new Keranjang;
                $keranjang->user_id = $id_user;
                $keranjang->produk_id = $row->produk_id;
                $keranjang->jumlah = $row->jumlah;
                $keranjang->checked = "true";
                $keranjang->save();

                $this->ubah_stok($row->produk_id, $row->jumlah);
            }
        }
        Nota::where([
            ['time_expired', '<', $time],
            ['status', 'menunggu konfirmasi']
        ])->orWhere('time_date', '<', $date_today)->delete();

        return response()->json(['list_id_pesanan_expired'=>$list_id_pesanan_expired]);
    }

    public function ubah_stok($produk_id, $jumlah){
        $stok = Stok_produk::where('produk_id', $produk_id)->first();
        if(!empty($stok)){
            $stok->stok = $stok->stok + $jumlah;
            $stok->save();
        }
    }

    public function daftar_pesanan_expired(Request $request){
        $nota = Nota_expired::orderBy('created_at', 'desc')->paginate(30);
        $data_nota = array();
        $i = 0;
        foreach($nota as $data){
            $data_nota[$i]['nama_pemesan'] = $data->user->biodata->nama;
            $data_nota[$i]['alamat'] = $data->alamat;
            $data_nota[$i]['pembayaran'] = $data->pembayaran;
            $data_nota[$i]['pengantaran'] = $data->pengantaran;
            $data_nota[$i]['time_expired'] = $data->time_expired;
            $data_nota[$i]['notif'] = $data->notif;
            $newtime = strtotime($data->created_at);
            $data_nota[$i]['date_expired'] = date('d, M, Y', $newtime);
            $i++;
        }
        Nota_expired::where('notif', 'true')->update(['notif' => "false"]);
        if(count($request->all()) > 0){
            $view = view('admin.data_pesanan_expired', compact('data_nota'))->render();
            return response()->json(['view'=>$view]);
        }
        $menu = "pesanan";
        $sub_menu = "pesanan expired";
        return view('admin.daftar_pesanan_expired', compact('data_nota', 'menu', 'sub_menu'));
    }

    public function post_kurir_packaging(Request $request){
        $nota = Nota::find($request->id_pesanan);
        $nota->nama_kurir = $request->nama;
        $nota->no_telp_kurir = $request->no_telp;
        $nota->save();

        return redirect('/admin/ubah_status_pesanan/'.$request->id_pesanan.'/dalam pengantaran');
    }
}
