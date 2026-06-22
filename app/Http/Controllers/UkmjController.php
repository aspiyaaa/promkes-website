<?php

namespace App\Http\Controllers;

use App\Models\ukmj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UkmjController extends Controller
{
    // Menampilkan data untuk halaman user/publik
    public function index() 
    {
        // Mengambil semua data UKMJ
        $ukmj = ukmj::all();

        return view('pages.kemahasiswaan.ukmj', ['data_ukmj' => $ukmj]);
    }

    // Menampilkan halaman utama admin (Show/Daftar UKMJ) dengan fitur pencarian
    public function ukmj(Request $request) 
    {
        $search = $request->keyword;

        $ukmj = ukmj::when($search, function($query, $search) {
            return $query->where('nama_ukmj', 'like', "%{$search}%");
        })->get();

        return view('pages.admin.ukmj.show', ['data_ukmj' => $ukmj]);
    }

    // Menampilkan form tambah data UKMJ
    public function create() 
    {
        return view('pages.admin.ukmj.add');
    }

    // Menyimpan data baru UKMJ ke database
    public function store(Request $request)
    {
        // 1. VALIDASI DATA
        $request->validate([
            'nama_ukmj'  => 'required|string|max:150',
            'deskripsi'  => 'required|string',
            'medsos'     => 'nullable',
            'logo'       => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ], [
            'required'   => 'Kolom :attribute wajib diisi!',
            'image'      => 'File yang diunggah harus berupa gambar.',
            'mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'max'        => 'Ukuran file maksimal adalah 2MB.',
        ]);

        // 2. PROSES UNGGAH LOGO
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            // Membuat nama file unik, misal: logo_ukmj_1718362421.png
            $namaLogo = 'logo_ukmj_' . time() . '.' . $file->getClientOriginalExtension();
            // File disimpan di folder: public/uploads/ukmj/
            $file->move(public_path('uploads/ukmj'), $namaLogo);
        } else {
            $namaLogo = null;
        }

        // 3. QUERY TAMBAH DATA
        ukmj::create([
            'nama_ukmj'  => $request->nama_ukmj,
            'deskripsi'  => $request->deskripsi,
            'medsos'     => $request->medsos,
            'logo'       => $namaLogo,
        ]);

        // 4. REDIRECT KEMBALI DENGAN NOTIFIKASI
        return redirect('/ukmj')->with('pesan', 'Berhasil menambahkan data unit kegiatan mahasiswa jurusan');
    }

    // Menampilkan halaman detail data ukmj versi admin
    public function detail(String $id) 
    {
        $detail = ukmj::findOrFail($id);

        return view('pages.admin.ukmj.detail', ['detail_ukmj' => $detail]);
    }

    // Menampilkan halaman detail ukmj versi user/publik
    public function detailuser(String $id) 
    {
        $detail = ukmj::findOrFail($id);
        
        return view('pages.detailukmj', ['detail_ukmj' => $detail]);
    }

    // Menampilkan form edit data ukmj
    public function edit(String $id) 
    {
        $edit = ukmj::findOrFail($id);

        return view('pages.admin.ukmj.edit', ['edit_bkj' => $edit]); // name key sengaja disamakan jika form edit menggunakan variabel yang sama
    }

    // Memperbarui data UKMJ di database
    public function update(Request $request, $id)
    {
        // 1. VALIDASI DATA
        $request->validate([
            'nama_ukmj'  => 'required|string|max:150',
            'deskripsi'  => 'required|string',
            'medsos'     => 'nullable',
            'logo'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ], [
            'required'   => 'Kolom :attribute wajib diisi!',
            'image'      => 'File yang diunggah harus berupa gambar.',
            'mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'max'        => 'Ukuran file maksimal adalah 2MB.',
        ]);

        // 2. CARI DATA UKMJ BERDASARKAN ID
        $ukmj = ukmj::findOrFail($id);

        // Ambil nama logo lama sebagai nilai bawaan (default)
        $namaLogo = $ukmj->logo; 

        // 3. PROSES JIKALAU ADA UNGGAHAN LOGO BARU
        if ($request->hasFile('logo')) {
            // Hapus logo lama dari server jika file fisiknya memang ada
            $pathLogoLama = public_path('uploads/ukmj/' . $ukmj->logo);
            if ($ukmj->logo && File::exists($pathLogoLama)) {
                File::delete($pathLogoLama);
            }

            // Simpan file logo yang baru
            $file = $request->file('logo');
            $namaLogo = 'logo_ukmj_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/ukmj'), $namaLogo);
        }

        // 4. PROSES UPDATE KE DATABASE
        $ukmj->update([
            'nama_ukmj'  => $request->nama_ukmj,
            'deskripsi'  => $request->deskripsi,
            'medsos'     => $request->medsos,
            'logo'       => $namaLogo, 
        ]);

        // 5. REDIRECT KEMBALI DENGAN NOTIFIKASI SUKSES
        return redirect('/ukmj')->with('pesan', 'Berhasil memperbarui data unit kegiatan mahasiswa jurusan');
    }

    // Menghapus data UKMJ secara permanen
    public function destroy(String $id) 
    {
        $ukmj = ukmj::findOrFail($id);

        // Hapus file logo dari folder public/uploads/ukmj/ sebelum record dihapus
        $pathLogo = public_path('uploads/ukmj/' . $ukmj->logo);
        if ($ukmj->logo && File::exists($pathLogo)) {
            File::delete($pathLogo);
        }

        $ukmj->delete();

        return redirect('/ukmj')->with('pesan', 'Data Berhasil dihapus');
    }
}
