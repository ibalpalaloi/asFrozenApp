<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Diskon;

class AdminDiskonController extends Controller
{
    //
    public function manajemen_diskon(Request $request){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-M-d");
        if(count($request->all()) != 0){
            if($request->keyword == ""){
                $produk = Produk::all();
            }
            else{
                $produk = Produk::where('nama', 'LIKE', '%'.$request->keyword.'%')->get();
            }
            
        }
        else{
            $produk = Produk::all();
        }
        
        $list_produk = array();
        $i = 0; 
        foreach($produk as $data){
            $list_produk[$i]['id'] = $data->id;
            $list_produk[$i]['nama_produk'] = $data->nama;
            $list_produk[$i]['harga'] = $data->harga;
            
            if($data->diskon != null){
                $list_produk[$i]['diskon_mulai'] = date("d/M/Y", strtotime($data->diskon->diskon_mulai));
                $list_produk[$i]['diskon_akhir'] =  date("d/M/Y", strtotime($data->diskon->diskon_akhir));
                $list_produk[$i]['diskon'] = $data->diskon->diskon;
                $list_produk[$i]['harga_diskon'] = $this->get_harga_diskon($data->harga, $data->diskon->diskon);
            }
            else{
                $list_produk[$i]['diskon_mulai'] = "-";
                $list_produk[$i]['diskon_akhir'] = "-";
                $list_produk[$i]['diskon'] = "0";
                $list_produk[$i]['harga_diskon'] = $data->harga;
            }

            $i++;
        }
        if(count($request->all()) != 0){
            $view = view('admin.include.data_manajemen_diskon', compact('list_produk'))->render();
            return response()->json(['view'=>$view]);
        }
        return view('admin.manajemen_diskon', compact('list_produk'));
    }

    public function post_ubah_diskon(Request $request){
        $produk = Produk::find($request->id_produk);
        $diskon = Diskon::where('produk_id', $request->id_produk)->first();
        if(!empty($diskon)){
            $diskon->diskon = $request->diskon;
            $diskon->diskon_mulai = $request->tgl_mulai;
            $diskon->diskon_akhir = $request->tgl_akhir;
            $diskon->save();
        }
        else{
            $diskon = new Diskon;
            $diskon->produk_id = $request->id_produk;
            $diskon->diskon = $request->diskon;
            $diskon->diskon_mulai = $request->tgl_mulai;
            $diskon->diskon_akhir = $request->tgl_akhir;
            $diskon->save();
        }

        

        $data_diskon = array();
        $data_diskon['id'] = $diskon->id;
        $data_diskon['diskon'] = $diskon->diskon;
        $data_diskon['harga'] = $produk->harga;
        $data_diskon['harga_diskon'] = $this->get_harga_diskon($produk->harga, $diskon->diskon);
        $data_diskon['diskon_mulai'] = date("d/M/Y", strtotime($diskon->diskon_mulai));
        $data_diskon['diskon_akhir'] = date("d/M/Y", strtotime($diskon->diskon_akhir));

        return response()->json(['data_diskon'=>$data_diskon]);
    }

    public function get_harga_diskon($harga, $diskon){
        $harga_diskon = $harga - (($diskon/100) * $harga);
        return $harga_diskon;
    }

    public function hapus_diskon($id){
        Diskon::where('produk_id', $id)->delete();
        $produk = Produk::find($id);
        if(!empty($produk)){
            $data_diskon = array();
            $data_diskon['id_produk'] = $produk->id;
            $data_diskon['diskon'] = 0;
            $data_diskon['harga'] = $produk->harga;
            $data_diskon['harga_diskon'] = $this->get_harga_diskon($produk->harga, 0);
            $data_diskon['diskon_mulai'] = "-";
            $data_diskon['diskon_akhir'] = "-";
        }
        else{
            $data_diskon = array();
            $data_diskon['id_produk'] = "-";
            $data_diskon['diskon'] = 0;
            $data_diskon['harga'] = 0;
            $data_diskon['harga_diskon'] =0;
            $data_diskon['diskon_mulai'] = "-";
            $data_diskon['diskon_akhir'] = "-";
        }
        

        return response()->json(['data_diskon'=>$data_diskon]);
    }
}
