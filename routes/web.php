<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BkjController;
use App\Http\Controllers\GaleriBkjController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\UkmjController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.beranda');
});

// navbar beranda
Route::view('/beranda', 'pages.beranda');

// navbar tentang kami
Route::view('/akreditasi', 'pages.tentangkami.akreditasi');
Route::view('/sejarah', 'pages.tentangkami.sejarah');
Route::view('/tujuanstrategi', 'pages.tentangkami.tujuanstrategi');
Route::view('/visimisi', 'pages.tentangkami.visimisi');

// navbar struktur
// Route::view('/struktur', 'pages.struktur');
Route::get('/struktur', [StrukturController::class, 'index']);
Route::get('/struktur/{id}', [StrukturController::class, 'detailuser']);// tampil detail data dosen di tampilan user

// navbar kemahasiswaan
Route::get('/BKJ', [BkjController::class, 'index']);
Route::get('/BKJ/{id_bkj}/galeri', [GaleriBkjController::class, 'showGaleri'])->name('bkj.galeri');
Route::get('/UKMJ', [UkmjController::class, 'index']);
Route::view('/layanan', 'pages.kemahasiswaan.layanan');
Route::get('/prestasi_mahasiswa', [PrestasiController::class, 'index']);
Route::view('/tracer', 'pages.kemahasiswaan.tracer');

// navbar fasilitas
Route::view('/ruangkelas', 'pages.fasilitas.ruangkelas');
Route::view('/lab', 'pages.fasilitas.lab');
Route::view('/fasilitaslain', 'pages.fasilitas.fasilitaslain');
Route::view('/peminjaman', 'pages.fasilitas.peminjaman');

// navbar bertita
Route::get('/news', [BeritaController::class, 'index']);
Route::get('/news/{slug}', [BeritaController::class, 'detailuser']);

// ==================== HALAMAN ADMIN ====================
Route::get('/admin', [AdminController::class, 'index']);

// civitas
Route::get('/civitas', [StrukturController::class, 'civitas']); //menampilkan seluruh data civitas
Route::get('/civitas/create', [StrukturController::class, 'create']); // halaman form data
Route::post('/civitas', [StrukturController::class, 'store']); // memproses penambahan data
Route::get('/civitas/{id}', [StrukturController::class, 'detail']);// tampil detail data
Route::get('/civitas/{id}/edit', [StrukturController::class, 'edit']);
Route::put('/civitas/{id}', [StrukturController::class, 'update']);
Route::delete('/civitas/{id}', [StrukturController::class, 'destroy']);

// Group route admin (bisa disesuaikan dengan middleware jika ada)
// Route::prefix('admin')->name('admin.')->group(function () {});

// Route::resource('kategori', KategoriController::class)->except(['show']);

// kategori
Route::get('/kategori', [KategoriController::class, 'index']); //menampilkan seluruh data civitas
Route::get('/kategori/create', [KategoriController::class, 'create']); // halaman form data
Route::post('/kategori', [KategoriController::class, 'store']); // memproses penambahan data
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);
Route::put('/kategori/{id}', [KategoriController::class, 'update']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

// badan kelengkapan jurusan
Route::get('/badan_kelengkapan_jurusan', [BkjController::class, 'bkj']);
Route::get('/badan_kelengkapan_jurusan/create', [BkjController::class, 'create']);
Route::post('/badan_kelengkapan_jurusan', [BkjController::class, 'store']);
Route::get('/badan_kelengkapan_jurusan/{id}', [BkjController::class, 'detail']);
Route::get('/badan_kelengkapan_jurusan/{id}/edit', [BkjController::class, 'edit']);
Route::put('/badan_kelengkapan_jurusan/{id}', [BkjController::class, 'update']);
Route::delete('/badan_kelengkapan_jurusan/{id}', [BkjController::class, 'destroy']);

// galeri bkj
Route::get('/galeri_bkj', [GaleriBkjController::class, 'galeri']);
Route::get('/galeri_bkj/create', [GaleriBkjController::class, 'create']);
Route::post('/galeri_bkj', [GaleriBkjController::class, 'store']);
Route::get('/galeri_bkj/{id}', [GaleriBkjController::class, 'detail']);
Route::get('/galeri_bkj/{id}/edit', [GaleriBkjController::class, 'edit']);
Route::put('/galeri_bkj/{id}', [GaleriBkjController::class, 'update']);
Route::delete('/galeri_bkj/{id}', [GaleriBkjController::class, 'destroy']);


// unit kegiatan mahasiswa
Route::get('/ukmj', [UkmjController::class, 'ukmj']);
Route::get('/ukmj/create', [UkmjController::class, 'create']);
Route::post('/ukmj', [UkmjController::class, 'store']);
Route::get('/ukmj/{id}', [UkmjController::class, 'detail']);
Route::get('/ukmj/{id}/edit', [UkmjController::class, 'edit']);
Route::put('/ukmj/{id}', [UkmjController::class, 'update']);
Route::delete('/ukmj/{id}', [UkmjController::class, 'destroy']);

// berita
Route::get('/berita', [BeritaController::class, 'berita']);
Route::get('/berita/create', [BeritaController::class, 'create']);
Route::post('/berita', [BeritaController::class, 'store']);
Route::get('/berita/{slug}', [BeritaController::class, 'detail']);
Route::get('/berita/{id}/edit', [BeritaController::class, 'edit']);
Route::put('/berita/{id}', [BeritaController::class, 'update']);
Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);

// prestasi
Route::get('/prestasi', [PrestasiController::class, 'prestasi']);
Route::get('/prestasi/create', [PrestasiController::class, 'create']);
Route::post('/prestasi', [PrestasiController::class, 'store']);
Route::get('/prestasi/{slug}', [PrestasiController::class, 'detail']);
Route::get('/prestasi/{id}/edit', [PrestasiController::class, 'edit']);
Route::put('/prestasi/{id}', [PrestasiController::class, 'update']);
Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy']);