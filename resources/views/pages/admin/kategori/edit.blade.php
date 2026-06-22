@extends('layouts.master_admin')

@section('title', 'Edit Kategori')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Data Kategori</h1>
        <p class="text-muted small">Perbarui informasi nama kategori secara berkala di sini.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 col-md-6">
        <div class="card-body p-4">
            <form action="/kategori/{{ $kategori->id_kategori }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="nama_kategori" class="form-label text-secondary fw-bold">Nama Kategori</label>
                    <input type="text" 
                           class="form-control @error('nama_kategori') is-invalid @enderror shadow-sm rounded-3" 
                           id="nama_kategori" 
                           name="nama_kategori" 
                           value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                           placeholder="Ubah nama kategori">
                    
                    @error('nama_kategori')
                        <div class="invalid-feedback mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <a href="/kategori" class="btn btn-light rounded-3 border px-3">Batal</a>
                    <button type="submit" class="btn btn-warning rounded-3 px-4 text-white shadow-sm">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection