@extends('layouts.master_admin')

@section('title', 'Tambah Unit Kegiatan Mahasiswa Jurusan')

@section('content_admin')
<div class="container-fluid px-4 py-4" style="background-color: #f8f9fa; min-height: 100vh;">
    <div class="row">
        <div class="col-12">
            
            <div class="d-flex flex-sm-row flex-column align-items-sm-center justify-content-between mb-4 pb-3 border-bottom gap-3">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-dark lh-sm">Tambah UKMJ Baru</h2>
                    <p class="text-muted small mb-0">Tambahkan kelompok atau unit kegiatan mahasiswa jurusan baru ke dalam sistem.</p>
                </div>
                <div>
                    <a href="/ukmj" class="btn btn-primary border btn-sm rounded-3 d-inline-flex align-items-center gap-2 px-3" style="height: 38px; font-size: 0.875rem;">
                        <i class="bi bi-arrow-left"></i> &nbsp; Kembali ke Daftar
                    </a>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden w-100 mb-4" style="border-top: 4px solid #0d6efd !important;">
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <h6 class="mb-0 fw-bold text-dark">Form Isian Entitas UKMJ Baru</h6>
                </div>

                <div class="card-body p-4 p-md-4 bg-white">
                    <form action="/ukmj" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nama_ukmj" class="form-label text-secondary fw-bold small text-uppercase">Nama Unit Kegiatan Mahasiswa Jurusan</label>
                            <input type="text" 
                                   class="form-control rounded-3 shadow-sm custom-input @error('nama_ukmj') is-invalid @enderror" 
                                   id="nama_ukmj" 
                                   name="nama_ukmj" 
                                   value="{{ old('nama_ukmj') }}" 
                                   placeholder="Contoh: UKMJ Olahraga, Forkat" 
                                   style="height: 42px;"
                                   autofocus>
                            @error('nama_ukmj')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label text-secondary fw-bold small text-uppercase">Deskripsi Singkat Kegiatan / Profil</label>
                            <textarea class="form-control rounded-3 shadow-sm custom-input @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="6" 
                                      placeholder="Tuliskan peranan, fokus kegiatan, atau visi misi UKMJ ini...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="medsos" class="form-label text-secondary fw-bold small text-uppercase">Link Media Sosial / Instagram Resmi</label>
                            <input type="text" 
                                   class="form-control rounded-3 shadow-sm custom-input @error('medsos') is-invalid @enderror" 
                                   id="medsos" 
                                   name="medsos" 
                                   value="{{ old('medsos') }}" 
                                   placeholder="Contoh: https://instagram.com/username_ukmj"
                                   style="height: 42px;">
                            @error('medsos')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="logo" class="form-label text-secondary fw-bold small text-uppercase">Logo Resmi UKMJ</label>
                            <input type="file" 
                                   class="form-control form-custom file-input-custom rounded-3 @error('logo') is-invalid @enderror" 
                                   id="logo" 
                                   name="logo" 
                                   accept="image/*">
                            <div class="form-text text-muted small mt-1"><i class="bi bi-info-circle me-1"></i> Format wajib: .png, .jpg, .jpeg (Maksimal ukuran file 2MB).</div>
                            @error('logo')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-4 mt-5 border-top">
                            <button type="reset" class="btn btn-warning rounded-3 border px-4 py-2 small fw-medium custom-btn-hover">
                                Reset
                            </button> &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 small fw-bold shadow-xs d-inline-flex align-items-center gap-1.5 text-white">
                                Simpan Data UKMJ
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .shadow-xs {
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .custom-input {
        border-color: #dee2e6;
        transition: all 0.2s ease-in-out;
    }
    .custom-input:focus {
        background-color: #ffffff !important;
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }
    .custom-btn-hover:hover {
        background-color: #e9ecef;
        color: #212529 !important;
        border-color: #dee2e6 !important;
    }
    .text-uppercase {
        letter-spacing: 0.5px;
    }
</style>
@endsection