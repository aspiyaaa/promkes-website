<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BeritaController extends Controller
{

    public function index() {
        // Mengambil berita yang sudah diterbitkan, diurutkan dari yang terbaru
        $berita = berita::where('status', 'published')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('pages.news', ['data_berita' => $berita]);
    }

    public function detailuser(String $slug) {
        // Mencari berita berdasarkan slug URL
        $detail = berita::where('slug', $slug)
                        ->where('status', 'published')
                        ->firstOrFail();

        return view('pages.detailnews', ['detail_berita' => $detail]);
    }

    public function berita(Request $request) {
        $search = $request->keyword;

        // Skema pencarian kata kunci berdasarkan Judul Berita
        $berita = berita::when($search, function($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('pages.admin.berita.show', ['data_berita' => $berita]);
    }

    public function create() {
        return view('pages.admin.berita.add');
    }

    public function store(Request $request)
    {
        // 1. VALIDASI DATA MASUKAN
        $request->validate([
            'title'     => 'required|string|max:205',
            'author'    => 'required|string|max:100',
            'status'    => 'required|in:draft,published',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
            'content'   => 'required|string',
        ], [
            'required' => 'Kolom :attribute wajib diisi!',
            'image'    => 'File yang diunggah harus berupa gambar.',
            'mimes'    => 'Format gambar harus jpeg, png, atau jpg.',
            'max'      => 'Ukuran file maksimal adalah 2MB.',
            'in'       => 'Status yang dipilih tidak valid.',
        ]);

        // 2. PROSES UNGGAH FILE THUMBNAIL
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            // Membuat nama file unik berdasarkan timestamp waktu
            $namaThumbnail = time() . '.' . $file->getClientOriginalExtension();
            // File dipindahkan ke folder: public/uploads/berita/
            $file->move(public_path('uploads/berita'), $namaThumbnail);
        } else {
            $namaThumbnail = null;
        }

        // 3. QUERY TAMBAH DATA (Menggunakan Query Builder DB seperti StrukturController)
        DB::table('berita')->insert([
            'title'      => $request->title,
            'slug'       => Str::slug($request->title), // Membuat slug otomatis dari judul artikel
            'author'     => $request->author,
            'status'     => $request->status,
            'thumbnail'  => $namaThumbnail,
            'content'    => $request->content,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. REDIRECT KEMBALI DENGAN NOTIFIKASI
        return redirect('/berita')->with('pesan', 'Berhasil menambahkan konten berita baru');
    }

    public function detail(String $slug) {
        $detail = berita::where('slug', $slug)->firstOrFail();

        return view('pages.admin.berita.detail', ['detail_berita' => $detail]);
    }

    public function edit(String $id)
    {
        // Ambil data berita berdasarkan ID
        $edit_berita = Berita::findOrFail($id); // Sesuaikan dengan nama Model beritamu

        // Pastikan di dalam compact() namanya sama persis tanpa tanda $
        return view('pages.admin.berita.edit', compact('edit_berita'));
    }

    public function update(Request $request, $id)
    {
        // 1. VALIDASI DATA MASUKAN
        $request->validate([
            'title'     => 'required|string|max:205',
            'author'    => 'required|string|max:100',
            'status'    => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Nullable saat proses edit
            'content'   => 'required|string',
        ]);

        // 2. CARI DATA BERITA BERDASARKAN ID
        $berita = berita::findOrFail($id);

        // Ambil nama file gambar lama sebagai nilai default
        $namaThumbnail = $berita->thumbnail; 

        // 3. PROSES JIKA ADMIN MENGUNGGAH GAMBAR BARU
        if ($request->hasFile('thumbnail')) {
            // Hapus berkas gambar lama dari folder lokal server jika ada
            $pathGambarLama = public_path('uploads/berita/' . $berita->thumbnail);
            if ($berita->thumbnail && File::exists($pathGambarLama)) {
                File::delete($pathGambarLama);
            }

            // Simpan file gambar yang baru dimasukkan
            $file = $request->file('thumbnail');
            $namaThumbnail = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/berita'), $namaThumbnail);
        }

        // 4. PROSES UPDATE DATA KE DATABASE MENGGUNAKAN ELOQUENT
        $berita->update([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title), // Memperbarui slug jika judul berubah
            'author'    => $request->author,
            'status'    => $request->status,
            'thumbnail' => $namaThumbnail,
            'content'   => $request->content,
        ]);

        // 5. REDIRECT KEMBALI DENGAN NOTIFIKASI SUKSES
        return redirect('/berita')->with('pesan', 'Berhasil memperbarui data konten berita');
    }

    public function destroy(String $id) {
        $berita = berita::findOrFail($id);

        // Tambahan Keamanan: Hapus file gambar dari local storage sebelum baris data di database hilang
        $pathGambar = public_path('uploads/berita/' . $berita->thumbnail);
        if ($berita->thumbnail && File::exists($pathGambar)) {
            File::delete($pathGambar);
        }

        $berita->delete();

        return redirect('/berita')->with('pesan', 'Data berita berhasil dihapus dari sistem');
    }
}