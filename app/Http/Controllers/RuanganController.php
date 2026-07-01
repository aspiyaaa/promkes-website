<?php

namespace App\Http\Controllers;

use App\Models\ruangan;
use Illuminate\Http\Request;
use File; // Digunakan untuk menghapus foto lama secara fisik

class RuanganController extends Controller
{
    
    public function userKelas()
    {
        // Mengambil semua ruangan dengan tipe 'kelas'
        $ruangan = \App\Models\Ruangan::where('tipe_ruangan', 'kelas')->get();
        
        // Mengarahkan ke file view di folder pages/fasilitas/ruangkelas.blade.php
        return view('pages.fasilitas.ruangkelas', compact('ruangan'));
    }

    public function userLab()
    {
        // Mengambil semua ruangan dengan tipe 'laboratorium'
        $ruangan = \App\Models\Ruangan::where('tipe_ruangan', 'laboratorium')->get();
        
        // Mengarahkan ke file view di folder pages/fasilitas/lab.blade.php
        return view('pages.fasilitas.lab', compact('ruangan'));
    }

    public function ruangan()
    {
        $ruangan = ruangan::all();
        // Mengarah ke folder views/pages/admin/ruangan/show.blade.php
        return view('pages.admin.ruangan.show', compact('ruangan'));
    }

    /**
     * Tampilkan form tambah ruangan
     */
    public function create()
    {
        return view('pages.admin.ruangan.add');
    }

    /**
     * Simpan data ruangan baru ke database
     */
    public function store(Request $request)
    {
        // Perbaikan dilakukan pada baris 'nama_ruangan' di bawah ini:
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|unique:ruangan,kode_ruangan|max:255',
            'tipe_ruangan' => 'required|in:kelas,laboratorium,aula',
            'kapasitas'    => 'required|integer',
            'lokasi'       => 'required|string|max:255',
            'fasilitas'    => 'required|string',
            'status'       => 'required|in:tersedia,digunakan,perbaikan',
            'foto_ruangan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi'    => 'nullable|string',
        ]);

        $data = $request->all();

        // Proses Upload Foto (Simpan ke public/uploads/ruangan)
        if ($request->hasFile('foto_ruangan')) {
            $file = $request->file('foto_ruangan');
            // Membuat nama unik gabungan waktu dan nama file asli
            $nama_foto = time() . '_' . $file->getClientOriginalName();
            // Pindahkan file ke folder public/uploads/ruangan
            $file->move(public_path('uploads/ruangan'), $nama_foto);
            
            $data['foto_ruangan'] = $nama_foto;
        }

        ruangan::create($data);

        return redirect('/ruangan')->with('success', 'Data ruangan berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail satu ruangan berdasarkan kode_ruangan (sebagai slug)
     */
    public function detail(String $slug)
    {
        // Mencari data berdasarkan kode_ruangan karena route kamu menggunakan {slug}
        $ruangan = ruangan::where('kode_ruangan', $slug)->firstOrFail();
        return view('pages.admin.ruangan.detail', compact('ruangan'));
    }

    /**
     * Tampilkan form edit ruangan berdasarkan ID
     */
    public function edit(String $id)
    {
        $ruangan = ruangan::findOrFail($id);
        return view('pages.admin.ruangan.edit', compact('ruangan'));
    }

    /**
     * Update data ruangan di database
     */
    public function update(Request $request, String $id)
    {
        $ruangan = ruangan::findOrFail($id);

        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'kode_ruangan' => 'required|string|max:255|unique:ruangan,kode_ruangan,' . $id . ',id_ruangan',
            'tipe_ruangan' => 'required|in:kelas,laboratorium,aula',
            'kapasitas'    => 'required|integer',
            'lokasi'       => 'required|string|max:255',
            'fasilitas'    => 'required|string',
            'status'       => 'required|in:tersedia,digunakan,perbaikan',
            'foto_ruangan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi'    => 'nullable|string',
        ]);

        $data = $request->all();

        // Proses Update Foto jika ada file baru yang diunggah
        if ($request->hasFile('foto_ruangan')) {
            $file = $request->file('foto_ruangan');
            $nama_foto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ruangan'), $nama_foto);

            // Hapus foto lama secara fisik jika ada di folder uploads
            if ($ruangan->foto_ruangan && file_exists(public_path('uploads/ruangan/' . $ruangan->foto_ruangan))) {
                unlink(public_path('uploads/ruangan/' . $ruangan->foto_ruangan));
            }

            $data['foto_ruangan'] = $nama_foto;
        }

        $ruangan->update($data);

        return redirect('/ruangan')->with('success', 'Data ruangan berhasil diperbarui!');
    }

    /**
     * Hapus data ruangan dari database beserta fotonya
     */
    public function destroy(String $id)
    {
        $ruangan = ruangan::findOrFail($id);

        // Hapus file foto secara fisik sebelum menghapus data dari database
        if ($ruangan->foto_ruangan && file_exists(public_path('uploads/ruangan/' . $ruangan->foto_ruangan))) {
            unlink(public_path('uploads/ruangan/' . $ruangan->foto_ruangan));
        }

        $ruangan->delete();

        return redirect('/ruangan')->with('success', 'Data ruangan berhasil dihapus!');
    }
}