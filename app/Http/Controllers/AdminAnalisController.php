<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\Riwayat_nota_pesanan;
use App\Models\Riwayat_pesanan;
use App\Models\Biodata;
use App\Models\Produk;
use App\Models\Kategori;


class AdminAnalisController extends Controller
{
    //
    public function produk(Request $request){
        $menu = "analisis";
        $sub_menu = "analisis produk";
        $tgl_mulai = "0";
        $tgl_akhir = "0";
        $nama_produk = ["-"];
        $jumlah_produk = ["-"];
        $produk = array();
        $kategori_show = Kategori::withCount('produk')->orderBy('produk_count', 'desc')->paginate(1);

        if(count($request->all()) != 0){
            $nama_produk = array();
            $jumlah_produk = array();
            $tgl_mulai = $request->tgl_mulai;
            $tgl_akhir = $request->tgl_akhir;
            $produk = DB::select("select produk, sum(jumlah) as jumlah from riwayat_pesanan where DATE(created_at) between '".$tgl_mulai."' and '".$tgl_akhir."' group BY produk order By sum(jumlah) desc limit 0, 10");
            
            foreach($produk as $data){
                array_push($nama_produk, $data->produk);
                array_push($jumlah_produk, $data->jumlah);
            }
            return view('admin.analisis_produk', compact('menu', 'sub_menu', 'nama_produk', 'jumlah_produk', 'produk', 'tgl_mulai', 'tgl_akhir', 'kategori_show'));
        }
        return view('admin.analisis_produk', compact('menu', 'sub_menu','nama_produk', 'jumlah_produk', 'produk', 'kategori_show'));
    }

    public function transaksi(Request $request){
        $menu = "analisis";
        $sub_menu = "analisis transaksi";
        $jumlah_transaksi = array();
        $total_transaksi = array();
        $list_data = array();
        $dateRange = array();
        $startDate ="";
        $endDate = "";
        if(count($request->all())>0){
            $startDate = Carbon::createFromFormat('Y-m-d', $request->tgl_mulai);
            $endDate = Carbon::createFromFormat('Y-m-d', $request->tgl_akhir);

            $CreateDateRange = CarbonPeriod::create($startDate, $endDate);
            $date = $CreateDateRange->toArray();
            
            foreach($date as $data){
                array_push($dateRange, $data->format('Y-m-d'));
            }
            
            $i = 0;
            foreach($dateRange as $data){
                // total_transaksi
                $list_data[$i]['tanggal'] = $data;
                $get_total_transaksi = DB::select("select sum(total_harga) as jumlah from riwayat_nota_pesanan where DATE(waktu_pemesanan) = '".$data."'");
                if($get_total_transaksi[0]->jumlah == null){
                    array_push($total_transaksi, 0);
                    $list_data[$i]['total_transaksi'] = 0;
                }
                else{
                    array_push($total_transaksi, $get_total_transaksi[0]->jumlah);
                    $list_data[$i]['total_transaksi'] = $get_total_transaksi[0]->jumlah;
                }
                
                // jumlah_transaksi
                $list_data[$i]['jumlah_transaksi'] = Riwayat_nota_pesanan::whereDate('created_at', $data)->count();
                array_push($jumlah_transaksi, Riwayat_nota_pesanan::whereDate('created_at', $data)->count());
                
                $i++;
            }
        }
        return view('admin.analisis_transaksi', compact('menu', 'sub_menu', 'dateRange', 'jumlah_transaksi', 'total_transaksi', 'startDate', 'endDate'));
    }

    public function pelanggan(Request $request){

        $menu = 'analisis';
        $sub_menu = 'analisis pelanggan';
        $tgl_mulai = "";
        $tgl_akhir = "";
        $list_data_transaksi = array();
        if(count($request->all())>0){
            $tgl_mulai = $request->tgl_mulai;
            $tgl_akhir = $request->tgl_akhir;
            $list_transaksi = DB::select("select user_id, count(*) as jumlah from riwayat_nota_pesanan where DATE(created_at) between'".$request->tgl_mulai."' and '".$request->tgl_akhir."' group by user_id limit 0, 10");
        }
        else{
            $list_transaksi = DB::select("select user_id, count(*) as jumlah from riwayat_nota_pesanan group by user_id limit 0, 10");
        }
        
        $i = 0;

        foreach($list_transaksi as $data){
            $biodata = Biodata::where('user_id', $data->user_id)->first();
            if(!empty($biodata)){
                $list_data_transaksi[$i]['user_id'] = $data->user_id;
                $list_data_transaksi[$i]['nama'] = $biodata->nama; 
                $list_data_transaksi[$i]['jumlah_transaksi'] = $data->jumlah;
                $i++;
            }
            
        }
        return view('admin.analisis-pelanggan-transaksi-terbanyak', compact('menu', 'sub_menu', 'list_data_transaksi', 'tgl_mulai', 'tgl_akhir'));
    }

    public function total_transaksi_terbanyak(){
        $menu = 'analisis';
        $sub_menu = 'analisis pelanggan';
        $list_pelanggan = array();
        $nota_pesanan = DB::select("select user_id, sum(total_harga) as total from riwayat_nota_pesanan group by user_id order by sum(total_harga) desc");
        $i=0;
        foreach($nota_pesanan as $data){
            $biodata = Biodata::where('user_id', $data->user_id)->first();
            if(!empty($biodata)){
                $list_pelanggan[$i]['user_id'] = $data->user_id;
                $list_pelanggan[$i]['nama'] = $biodata->nama;
                $list_pelanggan[$i]['total_transaksi'] = $data->total;
                $i++;
            }
        }
        return view('admin.analisis-pelanggan-terbanyak-total-transaksi', compact('menu', 'sub_menu', 'list_pelanggan'));
    }

    public function jenis_kelamin(Request $request){
        $menu = 'analisis';
        $sub_menu = 'analisis pelanggan';
        $tgl_mulai = "";
        $tgl_akhir = "";
        $jumlah_pria = 0;
        $jumlah_wanita = 0;
        $presentase_pria = 0;
        $presentase_wanita = 0;
        $jumlah_riwayat_nota= 0;
        if(count($request->all()) > 0){
            $tgl_mulai = $request->tgl_mulai;
            $tgl_akhir = $request->tgl_akhir;
            $riwayat_nota = Riwayat_nota_pesanan::whereDate('created_at', '>=' , date($tgl_mulai))->whereDate('created_at', '<=' , date($tgl_akhir))->get();
            $jumlah_riwayat_nota = count($riwayat_nota);
            foreach($riwayat_nota as $data){
                $biodata = Biodata::where('user_id', $data->user_id)->first();
                if(!empty($biodata)){
                    if($biodata->jenis_kelamin == "L"){
                        $jumlah_pria += 1;
                    }
                    else{
                        $jumlah_wanita += 1;
                    }
                }
            }
        }
        $presentase_pria = ($jumlah_pria/$jumlah_riwayat_nota) * 100;
        $presentase_wanita = ($jumlah_wanita/$jumlah_riwayat_nota) * 100;
        return view('admin.analisis-pelanggan-jenis-kelamin', compact('menu', 'sub_menu', 'presentase_pria', 'presentase_wanita', 'jumlah_wanita', 'jumlah_pria', 'tgl_mulai', 'tgl_akhir'));
    }
}
