<?php

namespace App\Http\Controllers;

use App\Models\bkj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BkjController extends Controller
{
    // Menampilkan data untuk halaman user/publik (jika dibutuhkan)
    public function index() 
    {
        // Mengurutkan berdasarkan nama BKJ secara berurutan (A-Z)
        $bkj = bkj::all();

        return view('pages.kemahasiswaan.bkj', ['data_bkj' => $bkj]);
    }

    // Menampilkan halaman utama admin (Show/Daftar BKJ) dengan fitur pencarian
    public function bkj(Request $request) 
    {
        $search = $request->keyword;

        $bkj = bkj::when($search, function($query, $search) {
            return $query->where('nama_bkj', 'like', "%{$search}%");
        })->get();

        return view('pages.admin.bkj.show', ['data_bkj' => $bkj]);
    }

    // Menampilkan form tambah data BKJ
    public function create() 
    {
        return view('pages.admin.bkj.add');
    }

    // Menyimpan data baru BKJ ke database
    public function store(Request $request)
    {
        // 1. VALIDASI DATA
        $request->validate([
            'nama_bkj'  => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'medsos'    => 'nullable', // Tambahkan validasi medsos (opsional)
            'logo'      => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ], [
            'required'  => 'Kolom :attribute wajib diisi!',
            'image'     => 'File yang diunggah harus berupa gambar.',
            'mimes'     => 'Format gambar harus jpeg, png, atau jpg.',
            'max'       => 'Ukuran file maksimal adalah 2MB.',
        ]);

        // 2. PROSES UNGGAH LOGO
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            // Membuat nama file unik berdasarkan waktu, misal: logo_1718362421.png
            $namaLogo = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            // File disimpan di folder: public/uploads/bkj/
            $file->move(public_path('uploads/bkj'), $namaLogo);
        } else {
            $namaLogo = null;
        }

        // 3. QUERY TAMBAH DATA (Menggunakan Eloquent Model agar sinkron dengan timestamps)
        bkj::create([
            'nama_bkj'  => $request->nama_bkj,
            'deskripsi' => $request->deskripsi,
            'medsos'    => $request->medsos, // Simpan inputan medsos ke array
            'logo'      => $namaLogo,
        ]);

        // 4. REDIRECT KEMBALI DENGAN NOTIFIKASI
        return redirect('/badan_kelengkapan_jurusan')->with('pesan', 'Berhasil menambahkan data badan kelengkapan jurusan');
    }

    // Menampilkan halaman detail data bkj versi admin
    public function detail(String $id) 
    {
        $detail = bkj::findOrFail($id);

        return view('pages.admin.bkj.detail', ['detail_bkj' => $detail]);
    }

    // Menampilkan halaman detail bkj versi user/publik
    public function detailuser(String $id) 
    {
        $detail = bkj::findOrFail($id);
        
        return view('pages.detailbkj', ['detail_bkj' => $detail]);
    }

    // Menampilkan form edit data bkj
    public function edit(String $id) 
    {
        $edit = bkj::findOrFail($id);

        return view('pages.admin.bkj.edit', ['edit_bkj' => $edit]);
    }

    // Memperbarui data BKJ di database
    public function update(Request $request, $id)
    {
        // 1. VALIDASI DATA
        $request->validate([
            'nama_bkj'  => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'medsos'    => 'nullable', // Tambahkan validasi medsos
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Di form edit, logo bersifat opsional
        ], [
            'required'  => 'Kolom :attribute wajib diisi!',
            'image'     => 'File yang diunggah harus berupa gambar.',
            'mimes'     => 'Format gambar harus jpeg, png, atau jpg.',
            'max'       => 'Ukuran file maksimal adalah 2MB.',
        ]);

        // 2. CARI DATA BKJ BERDASARKAN ID
        $bkj = Bkj::findOrFail($id);

        // Ambil nama logo lama sebagai nilai bawaan (default)
        $namaLogo = $bkj->logo; 

        // 3. PROSES JIKALAU ADA UNGGAHAN LOGO BARU
        if ($request->hasFile('logo')) {
            // Hapus logo lama dari server jika file fisiknya memang ada
            $pathLogoLama = public_path('uploads/bkj/' . $bkj->logo);
            if ($bkj->logo && File::exists($pathLogoLama)) {
                File::delete($pathLogoLama);
            }

            // Simpan file logo yang baru
            $file = $request->file('logo');
            $namaLogo = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/bkj'), $namaLogo);
        }

        // 4. PROSES UPDATE KE DATABASE MENGGUNAKAN ELOQUENT MODEL
        $bkj->update([
            'nama_bkj'  => $request->nama_bkj,
            'deskripsi' => $request->deskripsi,
            'medsos' => $request->medsos,
            'logo'      => $namaLogo, // Menggunakan logo baru atau mempertahankan yang lama
        ]);

        // 5. REDIRECT KEMBALI DENGAN NOTIFIKASI SUKSES
        return redirect('/badan_kelengkapan_jurusan')->with('pesan', 'Berhasil memperbarui data badan kelengkapan jurusan');
    }

    // Menghapus data BKJ secara permanen
    public function destroy(String $id) 
    {
        $bkj = bkj::findOrFail($id);

        // Tambahan: Hapus file logo dari server sebelum menghapus record data agar folder tidak penuh
        $pathLogo = public_path('uploads/bkj/' . $bkj->logo);
        if ($bkj->logo && File::exists($pathLogo)) {
            File::delete($pathLogo);
        }

        $bkj->delete();

        return redirect('/badan_kelengkapan_jurusan')->with('pesan', 'Data Berhasil dihapus');
    }
}
