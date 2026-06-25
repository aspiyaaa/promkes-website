@extends('layouts.master_admin')

@section('title', 'Tambah Badan Kelengkapan Jurusan')

@section('content_admin')
<div class="container-fluid px-4 py-4" style="background-color: #f4f6f9; min-height: 100vh;">
    
    <!-- Header Utama dengan Tombol Kembali di Pojok Kanan Atas -->
    <div class="mb-4 pb-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h2 class="h4 mb-1 fw-bold text-dark">Tambah Badan Kelengkapan Jurusan</h2>
            <p class="text-muted small mb-0">Tambahkan organisasi atau unit kegiatan mahasiswa baru ke dalam sistem.</p>
        </div>
        <div>
            <a href="/badan_kelengkapan_jurusan" class="btn btn-primary rounded-3 px-3 py-2 small fw-medium shadow-sm d-inline-flex align-items-center gap-2" style="background-color: #4e73df; border-color: #4e73df;">
                <i class="bi bi-arrow-left"></i> &nbsp; Kembali
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden w-100 mb-4" style="border-top: 4px solid #0d6efd !important;">
        <!-- Header Dalam Card -->
        <div class="card-header bg-white border-bottom py-3 px-4">
            <h5 class="h6 mb-0 fw-semibold text-secondary">Form Input Badan Kelengkapan Jurusan</h5>
        </div>

        <div class="card-body p-3 p-md-4 bg-white">
            <form action="/badan_kelengkapan_jurusan" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    <!-- Input Nama BKJ -->
                    <div class="col-12">
                        <label for="nama_bkj" class="form-label text-secondary fw-bold small mb-2">Nama Badan Kelengkapan Jurusan</label>
                        <input type="text" 
                               class="form-control rounded-3 py-2.5 @error('nama_bkj') is-invalid @enderror" 
                               id="nama_bkj" 
                               name="nama_bkj" 
                               value="{{ old('nama_bkj') }}" 
                               placeholder="Contoh: HMJ Promosi Kesehatan, Hima Promkes" 
                               autofocus>
                        @error('nama_bkj')
                            <div class="invalid-feedback mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Deskripsi Singkat -->
                    <div class="col-12">
                        <label for="deskripsi" class="form-label text-secondary fw-bold small mb-2">Deskripsi Singkat Organisasi</label>
                        <textarea class="form-control rounded-3 p-3 @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" 
                                  name="deskripsi" 
                                  rows="5" 
                                  placeholder="Tuliskan profil singkat, visi misi, atau peranan BKJ ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Link Instagram -->
                    <div class="col-12">
                        <label for="medsos" class="form-label text-secondary fw-bold small mb-2">Link Instagram</label>
                        <input type="text" 
                               class="form-control rounded-3 py-2.5 @error('medsos') is-invalid @enderror" 
                               id="medsos" 
                               name="medsos" 
                               value="{{ old('medsos') }}" 
                               placeholder="Contoh: https://instagram.com/himapromkesbdg">
                        @error('medsos')
                            <div class="invalid-feedback mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Logo Resmi BKJ -->
                    <div class="col-12">
                        <label for="logo" class="form-label fw-semibold text-secondary small mb-1">Logo Resmi BKJ</label>
                        <input type="file" 
                               class="form-control form-custom file-input-custom rounded-3 @error('logo') is-invalid @enderror" 
                               id="logo" 
                               name="logo" 
                               accept="image/*">
                        <div class="form-text text-muted small mt-1">Format file wajib: .png, .jpg, .jpeg (Maksimal ukuran file 2MB).</div>
                        @error('logo')
                            <div class="invalid-feedback mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Garis Pembatas & Tombol Aksi di Kanan Bawah Sesuai Referensi -->
                <div class="border-top mt-3 pt-4 d-flex align-items-center justify-content-end gap-2">
                    <!-- Mengubah element ke button type="reset" untuk mengosongkan seluruh form inputan -->
                    <button type="reset" class="btn rounded-3 px-4 py-2 small fw-medium text-white" style="background-color: #f1b434; border-color: #f1b434;">
                        Reset
                    </button> &nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 small fw-medium" style="background-color: #4e73df; border-color: #4e73df;">
                        Simpan Data BKJ
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Pemoles Kerapihan Kustom -->
<style>
    .form-control {
        border-color: #ced4da;
        color: #5a5a5a;
    }
    .form-control::placeholder {
        color: #b2b2b2;
    }
    .form-control:focus {
        border-color: #b0c4de;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1);
    }
</style>
@endsection