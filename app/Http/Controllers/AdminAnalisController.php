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
        $kategori = Kategori::get();

        // check rentan waktu
        $rentan_waktu = "";
        if (isset($_GET['rentan_waktu'])){
            $rentan_waktu = $_GET['rentan_waktu']; 
        }

        if ($rentan_waktu == ''){
            $data = $this->filter_tanggal('7 hari terakhir');            
        }
        else if ($rentan_waktu == 'Pilih Tanggal'){
            $data['tanggal_terakhir'] = $_GET['tgl_akhir'];
            $data['tanggal_mulai'] = $_GET['tgl_mulai'];
            $data['text_rentan_waktu'] = " (".$this->tgl_indo(date('Y-m-d', strtotime($_GET['tgl_mulai'])))." - ".$this->tgl_indo(date('Y-m-d', strtotime($_GET['tgl_akhir']))).")";
        }
        else {
            $data = $this->filter_tanggal($rentan_waktu);                        
        }

        $nama_produk = array();
        $jumlah_produk = array();
        
        $tgl_mulai = $data['tanggal_mulai'];
        $tgl_akhir = $data['tanggal_terakhir'];
        $text_rentan_waktu = $data['text_rentan_waktu'];

        // check kategori
        $id_kategori = "Semua Kategori";
        $nama_kategori = "Semua Kategori";
        if (isset($_GET['kategori'])){
            $id_kategori = $_GET['kategori'];
            if ($id_kategori == 'Semua Kategori'){
                $produk = DB::select("select produk.foto, kategori, harga, nama, produk, sum(jumlah) as jumlah from riwayat_pesanan inner join produk on produk.id=riwayat_pesanan.produk_id inner join kategori on kategori.id=produk.kategori_id where DATE(riwayat_pesanan.created_at) between '".$tgl_mulai."' and '".$tgl_akhir."' group BY kategori, produk, nama, harga, foto order By sum(jumlah) desc limit 0, 10"); 
            }
            else {
                $nama_kategori = Kategori::where('id', $id_kategori)->first()->kategori;
                $produk = DB::select("select produk.foto, kategori, nama, harga, produk, sum(jumlah) as jumlah from riwayat_pesanan inner join produk on produk.id=riwayat_pesanan.produk_id inner join kategori on kategori.id=produk.kategori_id where produk.kategori_id='$id_kategori' and DATE(riwayat_pesanan.created_at) between '".$tgl_mulai."' and '".$tgl_akhir."' group BY produk, kategori, nama, harga, foto order By sum(jumlah) desc limit 0, 10");                 
            }
        }
        else {
            $produk = DB::select("select produk.foto, nama, kategori, harga, produk, sum(jumlah) as jumlah from riwayat_pesanan inner join produk on produk.id=riwayat_pesanan.produk_id inner join kategori on kategori.id=produk.kategori_id where DATE(riwayat_pesanan.created_at) between '".$tgl_mulai."' and '".$tgl_akhir."' group BY produk, kategori, nama, harga, foto order By sum(jumlah) desc limit 0, 10");            
        }

        foreach($produk as $data){
            array_push($nama_produk, $data->produk);
            array_push($jumlah_produk, $data->jumlah);
        }

        $produks = $produk;
        return view('admin.analisis_produk', compact('menu', 'sub_menu','nama_produk', 'jumlah_produk', 'produk', 'kategori_show', 'kategori', 'text_rentan_waktu', 'nama_kategori', 'id_kategori', 'produks'));
    }

    public function filter_tanggal($value){
        if ($value == "Hari ini"){
            $tanggal_terakhir = date('Y-m-d');
            $tanggal_mulai = date('Y-m-d');             
            $tanggal_terakhir_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_terakhir))); 
            $tanggal_mulai_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_mulai)));
        }        
        else if ($value == "3 hari terakhir"){
            $tanggal_terakhir = date('Y-m-d');
            $tanggal_mulai = date('Y-m-d', strtotime($tanggal_terakhir."-3 days"));             
            $tanggal_terakhir_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_terakhir))); 
            $tanggal_mulai_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_mulai)));
        }
        else if ($value == "7 hari terakhir"){
            $tanggal_terakhir = date('Y-m-d');
            $tanggal_mulai = date('Y-m-d', strtotime($tanggal_terakhir."-7 days"));             
            $tanggal_terakhir_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_terakhir))); 
            $tanggal_mulai_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_mulai)));
        }
        else if ($value == "30 hari terakhir"){
            $tanggal_terakhir = date('Y-m-d');
            $tanggal_mulai = date('Y-m-d', strtotime($tanggal_terakhir."-30 days")); 
            $tanggal_terakhir_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_terakhir))); 
            $tanggal_mulai_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_mulai)));
        }
        else if ($value == "60 hari terakhir"){
            $tanggal_terakhir = date('Y-m-d');
            $tanggal_mulai = date('Y-m-d', strtotime($tanggal_terakhir."-60 days")); 
            $tanggal_terakhir_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_terakhir))); 
            $tanggal_mulai_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_mulai)));
        }
        else if ($value == "90 hari terakhir"){
            $tanggal_terakhir = date('Y-m-d');
            $tanggal_mulai = date('Y-m-d', strtotime($tanggal_terakhir."-90 days")); 
            $tanggal_terakhir_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_terakhir))); 
            $tanggal_mulai_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_mulai)));
        }
        else if ($value == "Tahun ini"){
            $tanggal_terakhir = date('Y-m-d');
            $tanggal_mulai = date('Y')."-01-01"; 
            $tanggal_terakhir_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_terakhir))); 
            $tanggal_mulai_text = $this->tgl_indo(date('Y-m-d', strtotime($tanggal_mulai)));
        }

        $data['tanggal_terakhir'] = $tanggal_terakhir;
        $data['tanggal_mulai'] = $tanggal_mulai;
        $data['tanggal_terakhir_text'] = $tanggal_terakhir_text;
        $data['tanggal_mulai_text'] = $tanggal_mulai_text;
        $data['text_rentan_waktu'] = $value." (".$tanggal_mulai_text." - ".$tanggal_terakhir_text.")";
        if ($value == 'Hari ini'){
            $data['text_rentan_waktu'] = $value." (".$tanggal_mulai_text.")";            
        }
        return $data;
    }


    public function tgl_indo($tanggal){
        $bulan = array (
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);     
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }


    public function transaksi(Request $request){
        $menu = "analisis";
        $sub_menu = "analisis produk";
        $rentan_waktu = "";
        if (isset($_GET['rentan_waktu'])){
            $rentan_waktu = $_GET['rentan_waktu']; 
        }

        if ($rentan_waktu == ''){
            $data = $this->filter_tanggal('7 hari terakhir');            
        }
        else if ($rentan_waktu == 'Pilih Tanggal'){
            $data['tanggal_terakhir'] = $_GET['tgl_akhir'];
            $data['tanggal_mulai'] = $_GET['tgl_mulai'];
            $data['text_rentan_waktu'] = " (".$this->tgl_indo(date('Y-m-d', strtotime($_GET['tgl_mulai'])))." - ".$this->tgl_indo(date('Y-m-d', strtotime($_GET['tgl_akhir']))).")";
        }
        else {
            $data = $this->filter_tanggal($rentan_waktu);                        
        }
        $list_data = array();
        $jumlah_transaksi = array();
        $dateRange = array();
        $total_transaksi = array();
        $startDate ="";
        $endDate = "";

        $tgl_mulai = $data['tanggal_mulai'];
        $tgl_akhir = $data['tanggal_terakhir'];
        $text_rentan_waktu = $data['text_rentan_waktu'];

        $startDate = Carbon::createFromFormat('Y-m-d', $tgl_mulai);
        $endDate = Carbon::createFromFormat('Y-m-d', $tgl_akhir);

        $CreateDateRange = CarbonPeriod::create($startDate, $endDate);
        $date = $CreateDateRange->toArray();

        foreach($date as $data){
            array_push($dateRange, $data->format('Y-m-d'));
        }

        $i = 0;
        foreach($dateRange as $data){
            $list_data[$i]['tanggal'] = date('d-m-Y', strtotime($data));
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


        $top_transaksi['jumlah'] = collect($list_data)->sortBy('jumlah_transaksi')->reverse()->toArray();
        $top_transaksi['total'] = collect($list_data)->sortBy('total_transaksi')->reverse()->toArray();
        // dd($top_transaksi['jumlah']);
        return view('admin.analisis_transaksi', compact('menu', 'sub_menu', 'dateRange', 'jumlah_transaksi', 'total_transaksi', 'startDate', 'endDate', 'text_rentan_waktu', 'tgl_mulai', 'tgl_akhir', 'top_transaksi'));
    }

    public function pelanggan(Request $request){
        $menu = "analisis";
        $sub_menu = "analisis pelanggan";
        $rentan_waktu = "";
        if (isset($_GET['rentan_waktu'])){
            $rentan_waktu = $_GET['rentan_waktu']; 
        }

        if ($rentan_waktu == ''){
            $data = $this->filter_tanggal('7 hari terakhir');            
        }
        else if ($rentan_waktu == 'Pilih Tanggal'){
            $data['tanggal_terakhir'] = $_GET['tgl_akhir'];
            $data['tanggal_mulai'] = $_GET['tgl_mulai'];
            $data['text_rentan_waktu'] = " (".$this->tgl_indo(date('Y-m-d', strtotime($_GET['tgl_mulai'])))." - ".$this->tgl_indo(date('Y-m-d', strtotime($_GET['tgl_akhir']))).")";
        }
        else {
            $data = $this->filter_tanggal($rentan_waktu);                        
        }
        $list_data_transaksi = array();
        $dateRange = array();
        $total_transaksi = array();
        $startDate ="";
        $endDate = "";

        $tgl_mulai = $data['tanggal_mulai'];
        $tgl_akhir = $data['tanggal_terakhir'];
        $text_rentan_waktu = $data['text_rentan_waktu'];

        $startDate = Carbon::createFromFormat('Y-m-d', $tgl_mulai);
        $endDate = Carbon::createFromFormat('Y-m-d', $tgl_akhir);

        // $CreateDateRange = CarbonPeriod::create($startDate, $endDate);
        // $date = $CreateDateRange->toArray();

        if(count($request->all())>0){
            $tgl_mulai = $request->tgl_mulai;
            $tgl_akhir = $request->tgl_akhir;
            $list_transaksi = DB::select("select user_id, count(*) as jumlah, sum(total_harga) as total_transaksi from riwayat_nota_pesanan where DATE(created_at) between'".$startDate."' and '".$endDate."' group by user_id limit 0, 10");
        }
        else{
            $list_transaksi = DB::select("select user_id, count(*) as jumlah, sum(total_harga) as total_transaksi from riwayat_nota_pesanan group by user_id limit 0, 10");
        }
        
        $i = 0;

        foreach($list_transaksi as $data){
            $biodata = Biodata::where('user_id', $data->user_id)->first();
            if(!empty($biodata)){
                $list_data_transaksi[$i]['user_id'] = $data->user_id;
                $list_data_transaksi[$i]['nama'] = $biodata->nama; 
                $list_data_transaksi[$i]['no_telp'] = $biodata->no_telp;
                $list_data_transaksi[$i]['jenis_kelamin'] = $biodata->jenis_kelamin;                  
                $list_data_transaksi[$i]['jumlah_transaksi'] = $data->jumlah;
                $list_data_transaksi[$i]['total_transaksi'] = $data->total_transaksi;
                $i++;
            }
            
        }

        $top_transaksi['jumlah'] = collect($list_data_transaksi)->sortBy('jumlah_transaksi')->reverse()->toArray();
        $jumlah['nama_pelanggan'] = array();
        $jumlah['transaksi'] = array();
        foreach($top_transaksi['jumlah'] as $data){
            array_push($jumlah['nama_pelanggan'], $data['nama']);
            array_push($jumlah['transaksi'], $data['jumlah_transaksi']);
        }

        $top_transaksi['total'] = collect($list_data_transaksi)->sortBy('total_transaksi')->reverse()->toArray();
        $total['nama_pelanggan'] = array();
        $total['transaksi'] = array();
        foreach($top_transaksi['total'] as $data){
            array_push($total['nama_pelanggan'], $data['nama']);
            array_push($total['transaksi'], $data['total_transaksi']);
        }

        $jenis_kelamin = DB::table('riwayat_nota_pesanan')->select('jenis_kelamin', DB::raw('count(id) as jumlah'))->whereBetween('created_at', [$startDate, $endDate])->orderBy('jenis_kelamin', 'asc')->groupBy('jenis_kelamin')->get();
        $jenis_kelamin_laki = DB::table('riwayat_nota_pesanan')->select('jenis_kelamin', DB::raw('count(id) as jumlah'))->whereBetween('created_at', [$startDate, $endDate])->orderBy('jenis_kelamin', 'asc')->groupBy('jenis_kelamin')->where('jenis_kelamin', 'Laki-Laki')->get()->count();
        $jenis_kelamin_perempuan = DB::table('riwayat_nota_pesanan')->select('jenis_kelamin', DB::raw('count(id) as jumlah'))->whereBetween('created_at', [$startDate, $endDate])->orderBy('jenis_kelamin', 'asc')->groupBy('jenis_kelamin')->where('jenis_kelamin', 'Perempuan')->get()->count();

        $jenkel['jenis'] = array();
        $jenkel['jumlah'] = array();
        array_push($jenkel['jenis'], 'Laki-Laki');
        array_push($jenkel['jumlah'], $jenis_kelamin_laki);
        array_push($jenkel['jenis'], 'Perempuan');
        array_push($jenkel['jumlah'], $jenis_kelamin_perempuan);


        // dd($jenis_kelamin);
        // dd($jenkel);    


        return view('admin.analisis-pelanggan-transaksi-terbanyak', compact('menu', 'sub_menu', 'list_data_transaksi', 'tgl_mulai', 'tgl_akhir', 'text_rentan_waktu', 'jumlah', 'total', 'top_transaksi', 'jenis_kelamin', 'jenkel'));
    }

    // public function total_transaksi_terbanyak(){
    //     $menu = 'analisis';
    //     $sub_menu = 'analisis pelanggan';
    //     $list_pelanggan = array();
    //     $nota_pesanan = DB::select("select user_id, sum(total_harga) as total from riwayat_nota_pesanan group by user_id order by sum(total_harga) desc");
    //     $i=0;
    //     foreach($nota_pesanan as $data){
    //         $biodata = Biodata::where('user_id', $data->user_id)->first();
    //         if(!empty($biodata)){
    //             $list_pelanggan[$i]['user_id'] = $data->user_id;
    //             $list_pelanggan[$i]['nama'] = $biodata->nama;
    //             $list_pelanggan[$i]['total_transaksi'] = $data->total;
    //             $i++;
    //         }
    //     }
    //     return view('admin.analisis-pelanggan-terbanyak-total-transaksi', compact('menu', 'sub_menu', 'list_pelanggan'));
    // }

    // public function jenis_kelamin(Request $request){
    //     $menu = 'analisis';
    //     $sub_menu = 'analisis pelanggan';
    //     $tgl_mulai = "";
    //     $tgl_akhir = "";
    //     $jumlah_pria = 0;
    //     $jumlah_wanita = 0;
    //     $presentase_pria = 0;
    //     $presentase_wanita = 0;
    //     $jumlah_riwayat_nota= 0;
    //     if(count($request->all()) > 0){
    //         $tgl_mulai = $request->tgl_mulai;
    //         $tgl_akhir = $request->tgl_akhir;
    //         $riwayat_nota = Riwayat_nota_pesanan::whereDate('created_at', '>=' , date($tgl_mulai))->whereDate('created_at', '<=' , date($tgl_akhir))->get();
    //         $jumlah_riwayat_nota = count($riwayat_nota);
    //         foreach($riwayat_nota as $data){
    //             $biodata = Biodata::where('user_id', $data->user_id)->first();
    //             if(!empty($biodata)){
    //                 if($biodata->jenis_kelamin == "L"){
    //                     $jumlah_pria += 1;
    //                 }
    //                 else{
    //                     $jumlah_wanita += 1;
    //                 }
    //             }
    //         }
    //         $presentase_pria = ($jumlah_pria/$jumlah_riwayat_nota) * 100;
    //         $presentase_wanita = ($jumlah_wanita/$jumlah_riwayat_nota) * 100;
    //     }
    //     else{
    //         $presentase_pria = 0;
    //         $presentase_wanita = 0;
    //     }

    //     return view('admin.analisis-pelanggan-jenis-kelamin', compact('menu', 'sub_menu', 'presentase_pria', 'presentase_wanita', 'jumlah_wanita', 'jumlah_pria', 'tgl_mulai', 'tgl_akhir'));
    // }
}
