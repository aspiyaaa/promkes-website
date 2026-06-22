@extends('layouts.master_admin')

@section('title', 'Tambah Unit Kegiatan Mahasiswa Jurusan')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="mb-4 pb-2 border-bottom">
                <h2 class="h4 mb-1 fw-bold text-gray-800">Tambah UKMJ Baru</h2>
                <p class="text-muted small mb-0">Tambahkan kelompok atau unit kegiatan mahasiswa jurusan baru ke dalam sistem.</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    
                    <form action="/ukmj" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nama_ukmj" class="form-label text-secondary fw-bold small">Nama Unit Kegiatan Mahasiswa Jurusan</label>
                            <input type="text" 
                                   class="form-control rounded-3 shadow-sm @error('nama_ukmj') is-invalid @enderror" 
                                   id="nama_ukmj" 
                                   name="nama_ukmj" 
                                   value="{{ old('nama_ukmj') }}" 
                                   placeholder="Contoh: UKMJ Olahraga, Forkat" 
                                   autofocus>
                            @error('nama_ukmj')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label text-secondary fw-bold small">Deskripsi Singkat Kegiatan / Profil</label>
                            <textarea class="form-control rounded-3 shadow-sm @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="5" 
                                      placeholder="Tuliskan peranan, fokus kegiatan, atau visi misi UKMJ ini...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="medsos" class="form-label text-secondary fw-bold small">Link Media Sosial / Instagram Resmi</label>
                            <input type="text" 
                                   class="form-control rounded-3 shadow-sm @error('medsos') is-invalid @enderror" 
                                   id="medsos" 
                                   name="medsos" 
                                   value="{{ old('medsos') }}" 
                                   placeholder="Contoh: https://instagram.com/username_ukmj">
                            @error('medsos')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="logo" class="form-label text-secondary fw-bold small">Logo Resmi UKMJ</label>
                            <input type="file" 
                                   class="form-control rounded-3 shadow-sm @error('logo') is-invalid @enderror" 
                                   id="logo" 
                                   name="logo" 
                                   accept="image/*">
                            <div class="form-text text-muted small mt-1">Format wajib: .png, .jpg, .jpeg (Maksimal ukuran file 2MB).</div>
                            @error('logo')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                            <a href="/ukmj" class="btn btn-light rounded-3 border px-3 btn-sm text-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary rounded-3 px-4 btn-sm fw-bold shadow-sm">
                                <i class="bi bi-save me-1"></i> Simpan Data UKMJ
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection