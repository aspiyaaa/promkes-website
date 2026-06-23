<?php

namespace App\Http\Controllers;

use App\Models\galeriBkj;
use App\Models\bkj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GaleriBkjController extends Controller
{
    /**
     * Menampilkan semua data galeri BKJ (Halaman Utama Admin/Show)
     */
    public function galeri(Request $request)
    {
        $search = $request->keyword;

        // 1. Sesuaikan nama tabel join menjadi 'badan_kelengkapan_jurusan'
        $galeri = galeriBkj::when($search, function($query, $search) {
                return $query->where('keterangan_foto', 'like', "%{$search}%");
            })
            ->join('badan_kelengkapan_jurusan', 'galeri_bkj.bkj_id', '=', 'badan_kelengkapan_jurusan.id_bkj')
            ->select('galeri_bkj.*', 'badan_kelengkapan_jurusan.nama_bkj') 
            
            // 2. Ubah dari 'created_at' menjadi 'create_at' sesuai kolom di database kamu
            ->orderBy('galeri_bkj.created_at', 'desc') 
            ->get();

        return view('pages.admin.galeriBkj.show', ['data_galeri' => $galeri]);
    }

    /**
     * Menampilkan form tambah data galeri
     */
    public function create()
    {
        // Mengambil semua data Badan Kelengkapan Jurusan untuk pilihan dropdown
        $bkj = bkj::all();
        return view('pages.admin.galeriBkj.add', ['data_bkj' => $bkj]);
    }

    /**
     * Menyimpan data galeri baru ke database
     */
    public function store(Request $request)
    {
        // 1. VALIDASI DATA
        $request->validate([
            'bkj_id'          => 'required|integer',
            'foto_kegiatan'   => 'required|image|mimes:jpeg,png,jpg|max:10240', // Maksimal 10MB sesuai info view
            'keterangan_foto' => 'required|string',
        ], [
            'required' => 'Kolom :attribute wajib diisi!',
            'image'    => 'File yang diunggah harus berupa gambar.',
            'mimes'    => 'Format gambar harus jpeg, png, atau jpg.',
            'max'      => 'Ukuran file maksimal adalah 10MB.',
        ]);

        // 2. PROSES UNGGAH FOTO KEGIATAN
        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            // Disimpan di folder: public/uploads/galeri_bkj/
            $file->move(public_path('uploads/galeri_bkj'), $namaFoto);
        } else {
            $namaFoto = null;
        }

        // 3. QUERY TAMBAH DATA (Menggunakan Query Builder DB)
        DB::table('galeri_bkj')->insert([
            'bkj_id'          => $request->bkj_id,
            'foto_kegiatan'   => $namaFoto,
            'keterangan_foto' => $request->keterangan_foto,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        // 4. REDIRECT KEMBALI DENGAN NOTIFIKASI
        return redirect('/galeri_bkj')->with('pesan', 'Berhasil menambahkan dokumentasi galeri BKJ');
    }

    /**
     * Menampilkan detail dokumentasi galeri
     */
    public function detail(String $id)
    {
        $detail = galeriBkj::join('badan_kelengkapan_jurusan', 'galeri_bkj.bkj_id', '=', 'badan_kelengkapan_jurusan.id_bkj')
            ->select('galeri_bkj.*', 'badan_kelengkapan_jurusan.nama_bkj')
            ->where('galeri_bkj.id_galeri_bkj', $id)
            ->firstOrFail();

        return view('pages.admin.galeriBkj.detail', ['detail_galeri' => $detail]);
    }

    public function detailuser(String $id_bkj)
    {
        $bkj = DB::table('bkj')->where('id', $id_bkj)->first();

        if (!$bkj) {
            abort(404);
        }

        $list_galeri = DB::table('galeri_bkj')
                        ->where('bkj_id', $id_bkj) 
                        ->get();

        return view('pages.kemahasiswaan.detailbkj', compact('bkj', 'list_galeri'));
    }

    /**
     * Menampilkan form edit data galeri
     */
    public function edit(String $id)
    {
        $edit = galeriBkj::findOrFail($id);
        $bkj = bkj::all();
        
        return view('pages.admin.galeriBkj.edit', [
            'edit_galeri' => $edit,
            'data_bkj'    => $bkj
        ]);
    }

    /**
     * Memperbarui data galeri di database
     */
    public function update(Request $request, $id)
    {
        // 1. VALIDASI DATA
        $request->validate([
            'bkj_id'          => 'required|integer',
            'foto_kegiatan'   => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // Nullable saat edit
            'keterangan_foto' => 'required|string',
        ]);

        // 2. CARI DATA GALERI BERDASARKAN ID
        $galeri = galeriBkj::findOrFail($id);
        $namaFoto = $galeri->foto_kegiatan; // Default menggunakan foto lama

        // 3. PROSES JIKA ADA UNGGAHAN FOTO BARU
        if ($request->hasFile('foto_kegiatan')) {
            // Hapus foto lama dari server jika ada
            $pathFotoLama = public_path('uploads/galeri_bkj/' . $galeri->foto_kegiatan);
            if ($galeri->foto_kegiatan && File::exists($pathFotoLama)) {
                File::delete($pathFotoLama);
            }

            // Simpan foto baru
            $file = $request->file('foto_kegiatan');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galeri_bkj'), $namaFoto);
        }

        // 4. PROSES UPDATE MENGGUNAKAN ELOQUENT MODEL
        $galeri->update([
            'bkj_id'          => $request->bkj_id,
            'foto_kegiatan'   => $namaFoto,
            'keterangan_foto' => $request->keterangan_foto,
        ]);

        // 5. REDIRECT KEMBALI
        return redirect('/galeri_bkj')->with('pesan', 'Berhasil memperbarui dokumentasi galeri BKJ');
    }

    /**
     * Menghapus data galeri beserta berkas fotonya
     */
    public function destroy(String $id)
    {
        $galeri = galeriBkj::findOrFail($id);

        // Hapus file fisik foto kegiatan dari folder server sebelum data di DB dihapus
        $pathFoto = public_path('uploads/galeri_bkj/' . $galeri->foto_kegiatan);
        if ($galeri->foto_kegiatan && File::exists($pathFoto)) {
            File::delete($pathFoto);
        }

        $galeri->delete();

        return redirect('/galeri_bkj')->with('pesan', 'Data dokumentasi berhasil dihapus');
    }
}