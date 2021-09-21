<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminkController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\AdminRiwayatPesanan;
use App\Http\Controllers\GetController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\UserKatalogController;
use App\Http\Controllers\UserKeranjangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserPesananController;
use App\Http\Controllers\UserRiwayatController;

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
Route::get('/user_login', [AuthController::class, 'user_login'])->name('login');
Route::get('/registrasi', [AuthController::class, 'registrasi']);
Route::post('/post_login', [AuthController::class, 'post_login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/auth/post_registrasi', [AuthController::class, 'post_registrasi']);

// keranjang
Route::get('/keranjang', [UserKeranjangController::class, 'keranjang'])->middleware('auth');
Route::get('/tambah_keranjang/{id}', [UserKeranjangController::class, 'tambah_keranjang'])->middleware('auth');
Route::get('/keranjang/checkout', [UserKeranjangController::class, 'checkout'])->middleware('auth');
Route::post('/keranjang/ubah_checked', [UserKeranjangController::class, 'ubah_checked'])->middleware('auth');
Route::post('/keranjang/ubah_jumlah', [UserKeranjangController::class, 'ubah_jumlah'])->middleware('auth');
Route::post('/keranjang/post_checkout', [UserKeranjangController::class, 'post_checkout'])->middleware('auth');


// pesanan
Route::get('/pesanan', [UserPesananController::class, 'pesanan'])->middleware('auth');
Route::get('/batalkan-pesanan/{id}', [UserPesananController::class, 'batalkan_pesanan'])->middleware('auth');

// Kategori
Route::get('/admin-index', [AdminController::class, 'index']);
Route::get('/admin-kategori', [AdminKategoriController::class, 'kategori']);
Route::post('/admin-post-kategori-baru', [AdminKategoriController::class, 'post_kategori_baru']);
Route::post('/admin-post-sub-kategori-baru', [AdminKategoriController::class, 'admin_post_sub_kategori_baru']);
Route::post('/admin-post-update-kategori', [AdminKategoriController::class, 'post_update_kategori']);
Route::post('/admin-post-update-sub-kategori', [AdminKategoriController::class, 'post_update_sub_kategori']);

// get
Route::get('/get_list_sub_kategori/{id}', [GetController::class, 'get_sub_kategori']);
Route::get('/get_kecamatan/{id}', [GetController::class, 'get_kecamatan']);
Route::get('/get_kelurahan/{id}', [GetController::class, 'get_kelurahan']);
Route::get('/get_ongkir/{id}', [GetController::class, 'get_ongkir']);
Route::get('/get-detail-produk/{id}', [GetController::class, 'get_detail_produk']);
Route::get('/get-kategori', [GetController::class, 'get_kategori']);


// admin pesanan
Route::get('/admin/daftar-pesanan', [AdminPesananController::class, 'daftar_pesanan']);
Route::get('/admin/ubah_status_pesanan/{id}/{status}', [AdminPesananController::class, 'ubah_status_pesanan']);
Route::get('/admin/pesanan-packaging', [AdminPesananController::class, 'packaging']);
Route::get('/admin/pesanan-dalam-pengantaran', [AdminPesananController::class, 'dalam_pengantaran']);
Route::get('/admin/pesanan-selesai/{id}', [AdminPesananController::class, 'pesanan_selesai']);

// admin riwayat
Route::get('/admin/riwayat-pesanan', [AdminRiwayatPesanan::class, 'daftar_riwayat']);
Route::get('/admin/get_riwayat_pesanan/{id}', [AdminRiwayatPesanan::class, 'get_riwayat_pesanan']);

// Produk
Route::get('/admin-daftar-produk', [AdminProdukController::class, 'daftar_produk']);
Route::get('/admin-tambah-produk', [AdminProdukController::class, 'tambah_produk']);
Route::post('/admin-post-produk-baru', [AdminProdukController::class, 'admin_post_produk_baru']);
Route::get('/admin--diskon-produk', [AdminProdukController::class, 'diskon']);
Route::post('/admin/post-ubah-stok', [AdminProdukController::class, 'post_ubah_stok']);
Route::post('/admin/post-ubah-diskon', [AdminProdukController::class, 'post_ubah_diskon']);
Route::post('/post-update-produk', [AdminProdukController::class, 'post_update_produk']);

// wilayah
Route::get('/admin-kota', [WilayahController::class, 'kota']);
Route::post('/admin-post-kota', [WilayahController::class, 'post_kota']);
Route::get('/admin-kecamatan/{id}', [WilayahController::class, 'list_kecamatan']);
Route::post('/admin-post-kecamatan', [WilayahController::class, 'post_kecamatan']);


// katalog
Route::get('/', [UserKatalogController::class, 'index']);
Route::get('/get_produk_sub_kategori', [UserKatalogController::class, 'get_produK_sub_kategori']);
Route::get('/kategori/{kategori}', [UserKatalogController::class, 'kategori']);

// 

