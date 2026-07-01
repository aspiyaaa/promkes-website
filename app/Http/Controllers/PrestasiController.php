<?php

namespace App\Http\Controllers;

use App\Models\prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrestasiController extends Controller
{

    public function index() 
    {
        // Mengambil semua data prestasi dan diurutkan dari tahun terbaru, lalu berdasarkan nama mahasiswa secara berurutan (A-Z)
        $prestasi = prestasi::orderBy('tahun_prestasi', 'desc')
                            ->orderBy('nama_mahasiswa', 'asc')
                            ->get();

        // Mengarah ke resources/views/pages/kemahasiswaan/prestasi.blade.php (atau sesuaikan dengan nama file blade user kamu)
        return view('pages.kemahasiswaan.prestasi', ['data_prestasi' => $prestasi]);
    }

    // 1. Menampilkan semua data prestasi di halaman admin (Route: /prestasi)
    public function prestasi()
    {
        // Mengambil semua data prestasi diurutkan dari yang terbaru
        $prestasi = prestasi::orderBy('created_at', 'desc')->get();
        
        // Mengarah ke resources/views/pages/admin/prestasi/show.blade.php
        return view('pages.admin.prestasi.show', compact('prestasi'));
    }

    // 2. Menampilkan form tambah data (Route: /prestasi/create)
    public function create()
    {
        // Mengarah ke resources/views/pages/admin/prestasi/add.blade.php
        return view('pages.admin.prestasi.add');
    }

    // 3. Menyimpan data baru ke database (Route: POST /prestasi)
    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'nim'            => 'required|string|max:20',
            'nama_kompetisi' => 'required|string|max:255',
            'tingkat'        => 'required|in:Wilayah,Nasional,Internasional',
            'pencapaian'     => 'required|string|max:255',
            'tahun_prestasi' => 'required|digits:4',
            'penyelenggara'  => 'required|string|max:255',
            'bukti_prestasi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        $data = $request->all();

        // Proses Upload File ke folder public/uploads
        if ($request->hasFile('bukti_prestasi')) {
            $file = $request->file('bukti_prestasi');
            // Membuat nama file unik: waktu-nama-file-asli
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            
            // Pindahkan file langsung ke public/uploads
            $file->move(public_path('uploads'), $fileName);
            
            // Simpan nama file ke array data untuk dimasukkan ke database
            $data['bukti_prestasi'] = $fileName;
        }

        // Simpan data ke database menggunakan model prestasi
        prestasi::create($data);

        return redirect('/prestasi')->with('success', 'Data prestasi berhasil ditambahkan!');
    }

    // 4. Menampilkan detail prestasi berdasarkan id atau parameter unik (Route: /prestasi/{slug})
    // Catatan: Karena di route menggunakan {slug} namun di model tidak ada kolom slug, 
    // method ini akan mencari berdasarkan id_prestasi agar data bisa tampil dengan aman.
    public function detail(String $id)
    {
        $prestasi = prestasi::findOrFail($id);
        
        // Mengarah ke resources/views/pages/admin/prestasi/detaill.blade.php (sesuai nama file di SS kamu)
        return view('pages.admin.prestasi.detail', compact('prestasi'));
    }

    // 5. Menampilkan form edit data (Route: /prestasi/{id}/edit)
    public function edit($id)
    {
        $prestasi = prestasi::findOrFail($id);
        
        // Mengarah ke resources/views/pages/admin/prestasi/edit.blade.php
        return view('pages.admin.prestasi.edit', compact('prestasi'));
    }

    // 6. Memperbarui data di database (Route: PUT /prestasi/{id})
    public function update(Request $request, $id)
    {
        $prestasi = prestasi::findOrFail($id);

        // Validasi inputan form
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'nim'            => 'required|string|max:20',
            'nama_kompetisi' => 'required|string|max:255',
            'tingkat'        => 'required|in:Wilayah,Nasional,Internasional',
            'pencapaian'     => 'required|string|max:255',
            'tahun_prestasi' => 'required|digits:4',
            'penyelenggara'  => 'required|string|max:255',
            'bukti_prestasi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Proses Update File jika ada file baru yang diunggah
        if ($request->hasFile('bukti_prestasi')) {
            $file = $request->file('bukti_prestasi');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            
            // Pindahkan file baru ke public/uploads
            $file->move(public_path('uploads'), $fileName);
            
            // Hapus file lama di folder public/uploads jika ada dan filenya eksis
            if ($prestasi->bukti_prestasi && file_exists(public_path('uploads/' . $prestasi->bukti_prestasi))) {
                unlink(public_path('uploads/' . $prestasi->bukti_prestasi));
            }

            $data['bukti_prestasi'] = $fileName;
        }

        // Update data ke database
        $prestasi->update($data);

        return redirect('/prestasi')->with('success', 'Data prestasi berhasil diperbarui!');
    }

    // 7. Menghapus data beserta filenya (Route: DELETE /prestasi/{id})
    public function destroy(String $id)
    {
        $prestasi = prestasi::findOrFail($id);

        // Hapus file bukti prestasi dari folder public/uploads jika ada
        if ($prestasi->bukti_prestasi && file_exists(public_path('uploads/' . $prestasi->bukti_prestasi))) {
            unlink(public_path('uploads/' . $prestasi->bukti_prestasi));
        }

        // Hapus baris data dari database
        $prestasi->delete();

        return redirect('/prestasi')->with('success', 'Data prestasi berhasil dihapus!');
    }
}