<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProdukController;
// use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminBankController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\AdminRiwayatPesanan;
use App\Http\Controllers\AdminBannerController;
use App\Http\Controllers\AdminVideoController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\UserKatalogController;
use App\Http\Controllers\UserTestimoniController;
use App\Http\Controllers\UserKeranjangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserPesananController;
use App\Http\Controllers\UserRiwayatController;
use App\Http\Controllers\UserBiodataController;
use App\Http\Controllers\AdminAnalisController;
use App\Http\Controllers\AdminGetController;
use App\Http\Controllers\AdminDiskonController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ManajemenPengguanController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DataTokoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// auth
Route::get('/', [UserKatalogController::class, 'index']);
Route::get('/user_login', [AuthController::class, 'user_login'])->name('login');
Route::get('/admin_login', [AuthController::class, 'admin_login']);
Route::get('/registrasi', [AuthController::class, 'registrasi']);
Route::post('/post_login', [AuthController::class, 'post_login']);
Route::post('/post-admin-login', [AuthController::class, 'post_admin_login']);
Route::get('/download', [AuthController::class, 'download']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/auth/post_registrasi', [AuthController::class, 'post_registrasi']);
Route::get('/lupa-password', [AuthController::class, 'lupa_password']);
Route::post('/post-lupa-password', [AuthController::class, 'post_lupa_password']);

 // get
 Route::get('/get_list_sub_kategori/{id}', [GetController::class, 'get_sub_kategori']);
 Route::get('/get_kecamatan/{id}', [GetController::class, 'get_kecamatan']);
 Route::get('/get_kelurahan/{id}', [GetController::class, 'get_kelurahan']);
 Route::get('/get_ongkir/{id}', [GetController::class, 'get_ongkir']);
 Route::get('/get-detail-produk/{id}', [GetController::class, 'get_detail_produk']);
 Route::get('/get-kategori', [GetController::class, 'get_kategori']);
 Route::post('/get-embed-link', [GetController::class, 'get_embed_video']);
 Route::get('/get-jumlah-pesanan', [GetController::class, 'get_jumlah_pesanan']);
 Route::get('/get_jumlah_keranjang', [GetController::class, 'get_jumlah_keranjang']);
 Route::get('/get-data-diskon/{id}', [GetController::class, 'get_data_diskon']);
 Route::get('/get-total-harga-pesanan/{id}', [GetController::class, 'get_total_pesanan']);
 Route::get('/get-image-kategori', [GetController::class, 'get_img_kategori']);
 Route::get('/cek_lupa_password', [GetController::class, 'cek_lupa_password']);
 


 // katalog
    
 Route::get('/pencarian', [UserKatalogController::class, 'pencarian']);
 Route::get('/get_produk_sub_kategori', [UserKatalogController::class, 'get_produK_sub_kategori']);
 Route::get('/kategori/{kategori}', [UserKatalogController::class, 'kategori']);

//  pesanan
Route::get('/cek_pesanan_expired', [AdminPesananController::class, 'cek_pesanan_expired']);

Route::group(['middleware' => ['auth', 'checkRole:user']], function(){

    // pesanan
    Route::post('/testimoni/delete', [UserTestimoniController::class, 'delete'])->middleware('auth');
    Route::post('/testimoni/store', [UserTestimoniController::class, 'store'])->middleware('auth');
    Route::get('/testimoni', [UserTestimoniController::class, 'index'])->middleware('auth');



    Route::post('/keranjang/delete', [UserKeranjangController::class, 'keranjang_delete']);
    Route::get('/keranjang', [UserKeranjangController::class, 'keranjang']);
    Route::get('/tambah_keranjang/{id}', [UserKeranjangController::class, 'tambah_keranjang']);
    Route::get('/keranjang/checkout', [UserKeranjangController::class, 'checkout']);
    Route::post('/keranjang/ubah_checked', [UserKeranjangController::class, 'ubah_checked']);
    Route::post('/keranjang/ubah_jumlah', [UserKeranjangController::class, 'ubah_jumlah']);
    Route::post('/keranjang/post_checkout', [UserKeranjangController::class, 'post_checkout']);
    Route::get('/keranjang/get-harga-total', [UserKeranjangController::class, 'get_harga_total']);


    // pesanan
    Route::get('/pesanan', [UserPesananController::class, 'pesanan']);
    Route::get('/batalkan-pesanan/{id}', [UserPesananController::class, 'batalkan_pesanan']);
    Route::get('/riwayat-pesanan/{id}', [UserPesananController::class, 'riwayat_pesanan_detail']);
    Route::get('/riwayat-pesanan', [UserPesananController::class, 'riwayat_pesanan']);  

    // biodata
    Route::post('/biodata/update', [UserPesananController::class, 'update_biodata']);
    Route::get('/biodata', [UserPesananController::class, 'biodata']);

    // ubah password
    Route::get('/ubah-password', [UserBiodataController::class, 'ubah_password']);   
    Route::post('/post-ubah-password', [UserBiodataController::class, 'post_ubah_password']);

});

Route::group(['middleware' => ['auth', 'checkRole:admin produk,admin pesanan,super admin']], function(){

        // admin analisis
    Route::get('/admin-analisis/produk', [AdminAnalisController::class, 'produk']);
    Route::get('/admin-analisis/transaksi', [AdminAnalisController::class, 'transaksi']);
    Route::get('/admin-analisis/pelanggan', [AdminAnalisController::class, 'pelanggan']);
    Route::get('/admin-analisis/pelanggan/jenis-kelamin', [AdminAnalisController::class, 'jenis_kelamin']);
    Route::get('/admin-analisis/pelanggan/total-transaksi-terbanyak', [AdminAnalisController::class, 'total_transaksi_terbanyak']);

    // Kategori
    Route::get('/admin-index', [AdminController::class, 'index']);
    Route::get('/admin-kategori', [AdminKategoriController::class, 'kategori']);
    Route::post('/admin-post-kategori-baru', [AdminKategoriController::class, 'post_kategori_baru']);
    Route::post('/admin-post-sub-kategori-baru', [AdminKategoriController::class, 'admin_post_sub_kategori_baru']);
    Route::post('/admin-post-update-kategori', [AdminKategoriController::class, 'post_update_kategori']);
    Route::post('/admin-post-update-sub-kategori', [AdminKategoriController::class, 'post_update_sub_kategori']);
    Route::post('/admin-delete-kategori', [AdminKategoriController::class, 'delete_kategori']);
    Route::post('/admin/ubah_urutan', [AdminKategoriController::class, 'ubah_urutan']);
   

    // admin Banner
    Route::post('/admin-banner-side-tambah', [AdminBannerController::class, 'store_side']);
    Route::post('/admin-banner-side-update', [AdminBannerController::class, 'update_side']);
    Route::post('/admin-banner-hapus', [AdminBannerController::class, 'delete']);
    Route::get('/admin-banner', [AdminBannerController::class, 'banner']);

    // admin video
    Route::get('/admin-video', [AdminVideoController::class, 'video']);
    Route::post('/admin-post-video', [AdminVideoController::class, 'post_video']);
    Route::get('/get-embed-link', [GetController::class, 'get_embed_video']);


    Route::post('/admin/bank/delete', [AdminBankController::class, 'delete']);
    Route::post('/admin/bank/update', [AdminBankController::class, 'update']);
    Route::post('/admin/bank/store', [AdminBankController::class, 'store']);
    Route::get('/admin/bank', [AdminBankController::class, 'index']);

    // admin pesanan
    Route::get('/admin/daftar-pesanan/{produk}/control/{status}', [AdminPesananController::class, 'control_pesanan']);
    Route::get('/admin/daftar-pesanan/{produk}', [AdminPesananController::class, 'detail_pesanan']);
    Route::get('/admin/daftar-pesanan', [AdminPesananController::class, 'daftar_pesanan']);

    Route::get('/admin/ubah_status_pesanan/{id}/{status}', [AdminPesananController::class, 'ubah_status_pesanan']);
    Route::get('/admin/pesanan-packaging', [AdminPesananController::class, 'packaging']);
    Route::get('/admin/pesanan-packaging-semua', [AdminPesananController::class, 'packaging_semua']);
    Route::get('/admin/pesanan-dalam-pengantaran-semua', [AdminPesananController::class, 'dalam_pengantaran_semua']);
    Route::get('/admin/pesanan-siap-diambil-semua', [AdminPesananController::class, 'siap_diambil_semua']);
    Route::get('/admin/pesanan-dalam-pengantaran', [AdminPesananController::class, 'dalam_pengantaran']);
    Route::get('/admin/pesanan-siap-diambil', [AdminPesananController::class, 'siap_diambil']);
    Route::get('/admin/pesanan-selesai/{id}', [AdminPesananController::class, 'pesanan_selesai']);
    Route::delete('/admin/hapus_pesanan/{id}', [AdminPesananController::class, 'hapus_pesanan']);
    Route::get('/admin/get_list_produk/{produk}', [AdminPesananController::class, 'get_list_produk']);
    Route::post('/admin/input_pesanan_baru', [AdminPesananController::class, 'input_pesanan_baru']);
    Route::get('/admin/get_total_pesanan/{id_nota}', [AdminPesananController::class, 'get_total_pesanan']);
    Route::get('/admin/get_harga_produk/{id_produk}', [AdminPesananController::class, 'get_harga']);
    Route::get('/admin/batalkan_pesanan/{id}', [AdminPesananController::class, 'batalkan_pesanan']);
    Route::get('/admin/daftar-pesanan-expired', [AdminPesananController::class, 'daftar_pesanan_expired']);


    // admin riwayat
    Route::get('/admin/riwayat-pesanan/{id}', [AdminRiwayatPesanan::class, 'daftar_riwayat_detail']);
    Route::get('/admin/riwayat-pesanan', [AdminRiwayatPesanan::class, 'daftar_riwayat']);
    Route::get('/admin/get_riwayat_pesanan/{id}', [AdminRiwayatPesanan::class, 'get_riwayat_pesanan']);

    // Produk
    Route::get('/admin-daftar-produk', [AdminProdukController::class, 'daftar_produk']);
    Route::get('/admin-tambah-produk', [AdminProdukController::class, 'tambah_produk']);
    Route::post('/admin-post-produk-baru', [AdminProdukController::class, 'admin_post_produk_baru']);
    Route::get('/admin-diskon-produk', [AdminProdukController::class, 'diskon']);
    Route::post('/admin/post-ubah-stok', [AdminProdukController::class, 'post_ubah_stok']);
    Route::post('/admin/post-ubah-diskon', [AdminProdukController::class, 'post_ubah_diskon']);
    Route::post('/post-update-produk', [AdminProdukController::class, 'post_update_produk']);
    Route::get('/admin/get-data-cari-produk', [AdminProdukController::class, 'get_data_cari_produk']);
    Route::get('/admin/hapus-produk/{id}', [AdminProdukController::class, 'hapus_produk']);
    Route::get('/admin-daftar-produk-kosong', [AdminProdukController::class, 'daftar_produk_kosong']);
    Route::get('/admin-daftar-produk-perkategori/{id_kategori}', [AdminProdukController::class, 'produk_perkategori']);

    // wilayah
    Route::get('/admin-kota', [WilayahController::class, 'kota']);
    Route::post('/admin-post-kota', [WilayahController::class, 'post_kota']);
    Route::get('/admin-kecamatan/{id}', [WilayahController::class, 'list_kecamatan']);
    Route::post('/admin-post-kecamatan', [WilayahController::class, 'post_kecamatan']);
    Route::get('/admin-kelurahan', [WilayahController::class, 'kelurahan']);
    Route::post('/admin-post-kelurahan', [WilayahController::class, 'post_kelurahan']);

    //  ongkos kirim
    Route::get('/admin/ongkos-kirim', [WilayahController::class, 'ongkos_kirim']);
    Route::post('/admin-post-ubah-ongkir', [WilayahController::class, 'post_ubah_ongkir']);

    // diskon
    Route::get('/admin/get/sub-kategori/{id}', [AdminGetController::class, 'get_sub_kategori']);
    Route::get('/admin/get/produk/{id}', [AdminGetController::class, 'get_produk_from_sub']);
    Route::get('/admin-manajemen-diskon', [AdminDiskonController::class, 'manajemen_diskon']);
    Route::post('/admin/post_ubah_diskon', [AdminDiskonController::class, 'post_ubah_diskon']);
    Route::get('/admin/hapus_diskon/{id}', [AdminDiskonController::class, 'hapus_diskon']);
    Route::get('/admin/cari-produk-diskon-tanggal', [AdminDiskonController::class, 'cari_produk_diskon_tanggal']);

    // Route::post('/admin/diskon/update', )

    // get
    Route::get('/get-produk/{id}', [AdminGetController::class, 'get_produk']);


    // jadwal
    Route::get('/admin-jadwal-buka', [JadwalController::class, 'jadwal_buka']);
    Route::get('/admin-jadwal-tutup', [JadwalController::class, 'jadwal_tutup']);
    Route::get('/admin-get-jadwal-buka/{id}', [JadwalController::class, 'get_jadwal_buka']);
    Route::post('/admin-ubah-jadwal', [JadwalController::class, 'ubah_jadwal']);
    Route::post('/post-tambah-tgl-tutup', [JadwalController::class, 'post_tambah_tgl_tutup']);
    Route::get('/admin-hapus-jadwal-tutup/{id}', [JadwalController::class, 'hapus_jadwal_tutup']);

    // manajemen pengguan
    Route::get('/admin-daftar-admin', [ManajemenPengguanController::class, 'daftar_admin']);
    Route::post('/post-admin-baru', [ManajemenPengguanController::class, 'post_admin_baru']);
    Route::get('/admin-get-data-admin/{id}', [ManajemenPengguanController::class, 'get_data_admin']);
    Route::post('/post-ubah-admin', [ManajemenPengguanController::class, 'post_ubah_admin']);
    Route::get('/admin-hapus-admin/{id}', [ManajemenPengguanController::class, 'hapus_admin']);

    // user
    Route::get('/admin-daftar-pengguna', [AdminUserController::class, 'daftar_pengguna']);
    Route::get('/admin-daftar-pengguna/get-data-pengguna/{id}', [AdminUserController::class, 'get_data_pengguna']);
    Route::post('/admin-daftar-pengguna/post-ubah-pengguna', [AdminUserController::class, 'post_ubah_pengguna']);
    Route::get('/admin-daftar-pengguna/banned/{id}', [AdminUserController::class, 'banned_pengguna']);
    Route::get('/admin-daftar-pengguna/hapus/{id}', [AdminUserController::class, 'hapus_pengguna']);
    Route::get('/admin-daftar-pengguna-banned', [AdminUserController::class, 'daftar_pengguna_banned']);
    Route::get('/admin-lupa-password', [AdminUserController::class, 'lupa_password']);

    // manajemen testimoni
    Route::get('/admin-testimoni', [ManajemenPengguanController::class, 'testimoni']);
    Route::get('/admin-testimoni-delete/{id}', [ManajemenPengguanController::class, 'hapus_testimoni']);

    // ubah password
    Route::get('/admin-ubah-password', [AdminController::class, 'ubah_password']);
    Route::post('/admin-post-ubah-password', [AdminController::class, 'post_ubah_password']);

    // data toko
    Route::get('/admin-data-toko', [DataTokoController::class, 'data_toko']);
    Route::post('/admin-post-ubah-data-toko', [DataTokoController::class, 'post_ubah_data']);

});



