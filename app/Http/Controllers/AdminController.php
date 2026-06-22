<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Panggil semua model yang datanya ingin dihitung di atas sini
use App\Models\Civitas; 
use App\Models\Kategori;
use App\Models\Bkj; // Sesuaikan dengan nama model BKJ kamu
use App\Models\Ukmj; // Sesuaikan dengan nama model UKMJ kamu

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil total jumlah baris data dari masing-masing tabel database
        $total_civitas  = Civitas::count();
        $total_kategori = Kategori::count();
        $total_bkj      = Bkj::count();
        $total_ukmj     = Ukmj::count();

        // Kirim semua variabel hitungan ke view dashboard admin
        return view('pages.admin.dashboard', compact(
            'total_civitas', 
            'total_kategori', 
            'total_bkj', 
            'total_ukmj'
        ));
    }
}