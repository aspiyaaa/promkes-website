@extends('layouts.master_admin')

@section('title', 'Tambah Badan Kelengkapan Jurusan')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="mb-4 pb-2 border-bottom">
                <h2 class="h4 mb-1 fw-bold text-gray-800">Tambah Badan Kelengkapan Jurusan</h2>
                <p class="text-muted small mb-0">Tambahkan organisasi atau unit kegiatan mahasiswa baru ke dalam sistem.</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    
                    <form action="/badan_kelengkapan_jurusan" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nama_bkj" class="form-label text-secondary fw-bold small">Nama Badan Kelengkapan Jurusan</label>
                            <input type="text" 
                                   class="form-control rounded-3 shadow-sm @error('nama_bkj') is-invalid @enderror" 
                                   id="nama_bkj" 
                                   name="nama_bkj" 
                                   value="{{ old('nama_bkj') }}" 
                                   placeholder="Contoh: HMJ Promosi Kesehatan, Hima Promkes" 
                                   autofocus>
                            @error('nama_bkj')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label text-secondary fw-bold small">Deskripsi Singkat Organisasi</label>
                            <textarea class="form-control rounded-3 shadow-sm @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="5" 
                                      placeholder="Tuliskan profil singkat, visi misi, atau peranan BKJ ini..."></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="medsos" class="form-label text-secondary fw-bold small">Link Instagram</label>
                            <input type="text" class="form-control rounded-3 shadow-sm" id="medsos" name="medsos" value="{{ old('medsos') }}" placeholder="Contoh: https://instagram.com/himapromkesbdg">
                        </div>

                        <div class="mb-4">
                            <label for="logo" class="form-label text-secondary fw-bold small">Logo Resmi BKJ</label>
                            <input type="file" 
                                   class="form-control rounded-3 shadow-sm @error('logo') is-invalid @enderror" 
                                   id="logo" 
                                   name="logo" 
                                   accept="image/*">
                            <div class="form-text text-muted small mt-1">Format file wajib: .png, .jpg, .jpeg (Maksimal ukuran file 2MB).</div>
                            @error('logo')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                            <a href="/badan_kelengkapan_jurusan" class="btn btn-light rounded-3 border px-3 btn-sm text-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary rounded-3 px-4 btn-sm fw-bold shadow-sm">
                                <i class="bi bi-save me-1"></i> Simpan Data BKJ
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection