<?php

namespace App\Http\Controllers;

use App\Models\civitas;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpParser\Builder\Function_;

class StrukturController extends Controller
{
    public function index() {
    $civitas = civitas::with('kategori')
                // Mengurutkan berdasarkan 4 karakter pertama NIP secara ascending (rendah ke tinggi)
                ->orderByRaw('LEFT(nip, 4) ASC')
                // Tambahan: jika tahun NIP sama, urutkan berdasarkan nama lengkap (A-Z)
                ->orderBy('nama_lengkap', 'asc') 
                ->get();

    return view('pages.struktur', ['data_civitas' => $civitas]);
}

    public function civitas(Request $request) {
        // $data = [
        //     'nama_lengkap' => 'Afifah Zhafirah',
        //     'nip' => 'P17336124401',
        //     'jabatan' => 'Dosen Ahli'
        // ];
        $search = $request->keyword;

        $civitas = civitas::when($search, function($query,$search){
            return $query->where('nama_lengkap','like',"%{$search}%");
        })
        ->join('kategori_civitas','civitas_akademik.kategori_id','=','kategori_civitas.id_kategori')
        ->get();
        return view('pages.admin.civitas.show', ['data_civitas'=>$civitas]);
    }

    public function create() {
        $kategori = kategori::all();
        return view('pages.admin.civitas.add', ['data_kategori'=>$kategori]);
    }

    public function store(Request $request)
    {
        // 1. VALIDASI DATA
        $request->validate([
            'nama_lengkap'     => 'required|string|max:150',
            'nip'              => 'required|string|max:30',
            'pangkat_golongan' => 'required|string|max:50',
            'jabatan'          => 'required|string|max:100',
            'kategori_id'      => 'required|integer', // TAMBAHAN: Validasi untuk kategori_id
            'foto'             => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
            'motto'            => 'nullable|string|max:255',

            // Semua riwayat pendidikan dibuat opsional/nullable
            'sma_nama'         => 'nullable|string|max:150',
            'sma_tahun_lulus'  => 'nullable|digits:4',

            'd3_universitas'   => 'nullable|string|max:150',
            'd3_tahun_lulus'   => 'nullable|digits:4',

            's1_universitas'   => 'nullable|string|max:150',
            's1_prodi'         => 'nullable|string|max:150',
            's1_peminatan'     => 'nullable|string|max:150',
            's1_tahun_lulus'   => 'nullable|digits:4',

            's2_universitas'   => 'nullable|string|max:150',
            's2_prodi'         => 'nullable|string|max:150',
            's2_peminatan'     => 'nullable|string|max:150',
            's2_tahun_lulus'   => 'nullable|digits:4',

            's3_universitas'   => 'nullable|string|max:150',
            's3_prodi'         => 'nullable|string|max:150',
            's3_peminatan'     => 'nullable|string|max:150',
            's3_tahun_lulus'   => 'nullable|digits:4',
        ], [
            // Pesan kustom jika ada kolom wajib yang terlewat
            'required' => 'Kolom :attribute wajib diisi!',
            'image'    => 'File yang diunggah harus berupa gambar.',
            'mimes'    => 'Format gambar harus jpeg, png, atau jpg.',
            'max'      => 'Ukuran file maksimal adalah 2MB.',
            'digits'   => 'Format tahun harus berupa 4 digit angka.',
        ]);

        // 2. PROSES UNGGAH FOTO PROFIL
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Membuat nama file unik berdasarkan waktu, misal: 1718362421.png
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            // Foto disimpan di folder: public/uploads/civitas/
            $file->move(public_path('uploads/civitas'), $namaFoto);
        } else {
            $namaFoto = null;
        }

        // 3. QUERY TAMBAH DATA (Menggunakan Query Builder DB)
        DB::table('civitas_akademik')->insert([
            'nama_lengkap'     => $request->nama_lengkap,
            'nip'              => $request->nip,
            'pangkat_golongan' => $request->pangkat_golongan,
            'jabatan'          => $request->jabatan,
            'kategori_id'      => $request->kategori_id, // TAMBAHAN: Menyimpan kategori_id ke database
            'foto'             => $namaFoto,
            'motto'            => $request->motto,

            // Bagian SMA
            'sma_nama'         => $request->sma_nama,
            'sma_tahun_lulus'  => $request->sma_tahun_lulus,

            // Bagian D3
            'd3_universitas'   => $request->d3_universitas,
            'd3_tahun_lulus'   => $request->d3_tahun_lulus,

            // Bagian S1
            's1_universitas'   => $request->s1_universitas,
            's1_prodi'         => $request->s1_prodi,
            's1_peminatan'     => $request->s1_peminatan,
            's1_tahun_lulus'   => $request->s1_tahun_lulus,

            // Bagian S2
            's2_universitas'   => $request->s2_universitas,
            's2_prodi'         => $request->s2_prodi,
            's2_peminatan'     => $request->s2_peminatan,
            's2_tahun_lulus'   => $request->s2_tahun_lulus,

            // Bagian S3
            's3_universitas'   => $request->s3_universitas,
            's3_prodi'         => $request->s3_prodi,
            's3_peminatan'     => $request->s3_peminatan,
            's3_tahun_lulus'   => $request->s3_tahun_lulus,

            // Menambahkan timestamp manual jika tidak menggunakan Eloquent Model
            'created_at'       => now(),
            'updated_at'       => now(), // Menyesuaikan nama kolom standar laravel
        ]);

        // 4. REDIRECT KEMBALI DENGAN NOTIFIKASI
        return redirect('/civitas')->with('pesan', 'Berhasil menambahkan data civitas akademik');
    }

    public function detail(String $id) {
        $detail = civitas::join('kategori_civitas', 'civitas_akademik.kategori_id', '=', 'kategori_civitas.id_kategori')
            ->select('civitas_akademik.*', 'kategori_civitas.nama_kategori')
            ->where('civitas_akademik.id_civitas', $id) 
            
            ->firstOrFail();

        return view('pages.admin.civitas.detail', ['detail_civitas' => $detail]);
    }

    public function detailuser(String $id) {
        $detail = civitas::findOrFail($id);
        return view('pages.detailstruktur', ['detail_civitas'=>$detail]);
    }

    public function edit(String $id) {
        // mengambil data spesifik yang akan di edit
        $edit = civitas::findOrFail($id);
        $kategori = kategori::all();
        return view('pages.admin.civitas.edit', [
            'edit_civitas'=>$edit,
            'data_kategori'=>$kategori
            ]);
    }

    public function update(Request $request, $id)
    {
        // 1. VALIDASI DATA
        $request->validate([
            'nama_lengkap'     => 'required|string|max:150',
            'nip'              => 'required|string|max:30',
            'pangkat_golongan' => 'required|string|max:50',
            'jabatan'          => 'required|string|max:100',
            'kategori_id'      => 'required|integer', // TAMBAHAN: Validasi untuk kategori_id
            'foto'             => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Di form edit, foto bersifat nullable
            'motto'            => 'nullable|string|max:255',

            // Semua riwayat pendidikan bersifat opsional/nullable
            'sma_nama'         => 'nullable|string|max:150',
            'sma_tahun_lulus'  => 'nullable|digits:4',

            'd3_universitas'   => 'nullable|string|max:150',
            'd3_tahun_lulus'   => 'nullable|digits:4',

            's1_universitas'   => 'nullable|string|max:150',
            's1_prodi'         => 'nullable|string|max:150',
            's1_peminatan'     => 'nullable|string|max:150',
            's1_tahun_lulus'   => 'nullable|digits:4',

            's2_universitas'   => 'nullable|string|max:150',
            's2_prodi'         => 'nullable|string|max:150',
            's2_peminatan'     => 'nullable|string|max:150',
            's2_tahun_lulus'   => 'nullable|digits:4',

            's3_universitas'   => 'nullable|string|max:150',
            's3_prodi'         => 'nullable|string|max:150',
            's3_peminatan'     => 'nullable|string|max:150',
            's3_tahun_lulus'   => 'nullable|digits:4',
        ]);

        // 2. CARI DATA CIVITAS BERDASARKAN ID
        $civitas = civitas::findOrFail($id);

        // Ambil nama foto lama sebagai nilai bawaan (default)
        $namaFoto = $civitas->foto; 

        // 3. PROSES JIKA ADA UNGGAHAN FOTO BARU
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari server jika file-nya memang ada
            $pathFotoLama = public_path('uploads/civitas/' . $civitas->foto);
            if ($civitas->foto && File::exists($pathFotoLama)) {
                File::delete($pathFotoLama);
            }

            // Simpan foto yang baru
            $file = $request->file('foto');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/civitas'), $namaFoto);
        }

        // 4. PROSES UPDATE KE DATABASE MENGGUNAKAN ELOQUENT MODEL
        $civitas->update([
            'nama_lengkap'     => $request->nama_lengkap,
            'nip'              => $request->nip,
            'pangkat_golongan' => $request->pangkat_golongan,
            'jabatan'          => $request->jabatan,
            'kategori_id'      => $request->kategori_id, // TAMBAHAN: Menyimpan kategori_id ke database
            'foto'             => $namaFoto, // Menggunakan foto baru atau mempertahankan yang lama
            'motto'            => $request->motto,

            // Bagian SMA
            'sma_nama'         => $request->sma_nama,
            'sma_tahun_lulus'  => $request->sma_tahun_lulus,

            // Bagian D3
            'd3_universitas'   => $request->d3_universitas,
            'd3_tahun_lulus'   => $request->d3_tahun_lulus,

            // Bagian S1
            's1_universitas'   => $request->s1_universitas,
            's1_prodi'         => $request->s1_prodi,
            's1_peminatan'     => $request->s1_peminatan,
            's1_tahun_lulus'   => $request->s1_tahun_lulus,

            // Bagian S2
            's2_universitas'   => $request->s2_universitas,
            's2_prodi'         => $request->s2_prodi,
            's2_peminatan'     => $request->s2_peminatan,
            's2_tahun_lulus'   => $request->s2_tahun_lulus,

            // Bagian S3
            's3_universitas'   => $request->s3_universitas,
            's3_prodi'         => $request->s3_prodi,
            's3_peminatan'     => $request->s3_peminatan,
            's3_tahun_lulus'   => $request->s3_tahun_lulus,
        ]);

        // 5. REDIRECT KEMBALI DENGAN NOTIFIKASI SUKSES
        return redirect('/civitas')->with('pesan', 'Berhasil memperbarui data civitas akademik');
    }

    public function destroy(String $id) {
        civitas::findOrFail($id)->delete();
        return redirect('/civitas')->with('pesan','Data Berhasil dihapus');
    }
}
