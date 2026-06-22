@extends('layouts.master_admin')

@section('title', 'Tambah Kategori')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kategori Baru</h1>
        <p class="text-muted small">Buat entitas kategori civitas baru untuk sistem.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 col-md-6">
        <div class="card-body p-4">
            <form action="/kategori" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="nama_kategori" class="form-label text-secondary fw-bold">Nama Kategori</label>
                    <input type="text" 
                           class="form-control @error('nama_kategori') is-invalid @enderror shadow-sm rounded-3" 
                           id="nama_kategori" 
                           name="nama_kategori" 
                           value="{{ old('nama_kategori') }}" 
                           placeholder="Contoh: Mahasiswa, Dosen, Alumni"
                           autofocus>
                    
                    @error('nama_kategori')
                        <div class="invalid-feedback mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <a href="/kategori" class="btn btn-light rounded-3 border px-3">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 shadow-sm">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection