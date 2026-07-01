<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\aspirasi; // Memanggil model dengan 'a' kecil sesuai buatanmu
use File;
use Illuminate\Support\Facades\File as FacadesFile;

class AspirasiController extends Controller
{
    // ==========================================
    // SISI USER (FITUR UTAMA)
    // ==========================================

    /**
     * Menampilkan form input saran/masukan untuk user
     */
    public function create()
    {
        // Mengarah ke resources/views/pages/fasilitas/aspirasi.blade.php
        return view('pages.fasilitas.aspirasi');
    }

    /**
     * Menyimpan data masukan dari user ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Data
        $request->validate([
            'nama_pengirim'    => 'nullable|string|max:255', // nullable karena bisa anonim
            'status_peran'     => 'required|in:mahasiswa_aktif,dosen_staf,alumni,umum',
            'kategori_masukan' => 'required|in:fasilitas_perkuliahan,kinerja_organisasi,teknis_website,lainnya',
            'subjek'           => 'required|string|max:255',
            'isi_pesan'        => 'required|string',
            'lampiran_file'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Batas 2MB
        ]);

        // 2. Handle Upload File (Pake folder public/uploads)
        $namaFile = null;
        if ($request->hasFile('lampiran_file')) {
            $file = $request->file('lampiran_file');
            // Membuat nama file unik: timestamp_nama-file-asli
            $namaFile = time() . '_' . $file->getClientOriginalName();
            
            // Pindahkan langsung ke folder public/uploads
            $file->move(public_path('uploads'), $namaFile);
        }

        // 3. Simpan ke Database menggunakan Mass Assignment
        aspirasi::create([
            'nama_pengirim'    => $request->nama_pengirim,
            'status_peran'     => $request->status_peran,
            'kategori_masukan' => $request->kategori_masukan,
            'subjek'           => $request->subjek,
            'isi_pesan'        => $request->isi_pesan,
            'lampiran_file'    => $namaFile,
        ]);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Terima kasih! Masukan Anda berhasil dikirim.');
    }


    // ==========================================
    // SISI ADMIN (MONITORING & MANAGEMENT)
    // ==========================================

    /**
     * Tampil seluruh data masukan di halaman admin
     */
    public function aspirasi()
    {
        // Mengambil seluruh data, diurutkan dari yang paling baru masuk
        $all_aspirasi = aspirasi::latest()->get();

        // Mengarah ke resources/views/pages/admin/aspirasi/show.blade.php
        return view('pages.admin.aspirasi.show', compact('all_aspirasi'));
    }

    /**
     * Tampil data detail sesuai ID di halaman admin
     */
    public function detail(String $id)
    {
        // Mencari data berdasarkan primary key 'id_aspirasi'
        // Jika id tidak ditemukan, otomatis memunculkan error 404
        $data = aspirasi::findOrFail($id);

        // Mengarah ke resources/views/pages/admin/aspirasi/detail.blade.php
        return view('pages.admin.aspirasi.detail', compact('data'));
    }

    /**
     * Menghapus data masukan dan file lampirannya
     */
    public function destroy(String $id)
    {
        $data = aspirasi::findOrFail($id);

        // Jika ada file lampiran di folder uploads, hapus dulu filenya dari public
        if ($data->lampiran_file) {
            $pathFile = public_path('uploads/' . $data->lampiran_file);
            if (FacadesFile::exists($pathFile)) {
                FacadesFile::delete($pathFile);
            }
        }

        // Hapus data dari database
        $data->delete();

        return redirect('/aspirasi')->with('success', 'Data masukan berhasil dihapus.');
    }
}