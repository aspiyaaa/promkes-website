<?php

namespace App\Http\Controllers;

use App\Models\Kategori; // Sesuaikan dengan nama file Model kamu
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan semua data kategori (Halaman Utama)
    public function index()
    {
        $kategori = Kategori::all();
        return view('pages.admin.kategori.show', compact('kategori'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('pages.admin.kategori.add');
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_civitas,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);

        // Menggunakan ORM Mass Assignment
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Menampilkan form edit data
    public function edit(String $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('pages.admin.kategori.edit', compact('kategori'));
    }

    // Memperbarui data di database
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_civitas,nama_kategori,' . $id . ',id_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy(String $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect('/kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}