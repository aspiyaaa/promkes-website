@extends('layouts.master_admin')

@section('title', 'Tambah Kategori')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <!-- Mengubah ukuran menjadi col-12 agar memenuhi layar dan menghilangkan ruang kosong di kanan -->
        <div class="col-12">
            
            <!-- HEADER ACTION BAR -->
            <div class="d-flex flex-sm-row flex-column align-items-sm-center justify-content-between mb-4 pb-3 border-bottom gap-3">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-dark lh-sm">Tambah Kategori Baru</h2>
                    <p class="text-muted small mb-0">Buat entitas klasifikasi atau kelompok civitas akademik baru ke dalam sistem.</p>
                </div>
                <div>
                    <a href="/kategori" class="btn btn-primary border btn-sm rounded-3 px-3 py-2 d-inline-flex align-items-center gap-2 small custom-btn-hover shadow-sm">
                        <i class="bi bi-arrow-left"></i> &nbsp; Kembali
                    </a>
                </div>
            </div>

            <!-- MAIN FORM CARD (FULL WIDTH) -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="border-top: 4px solid #0d6efd !important;">
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <h6 class="mb-0 fw-bold text-dark">Form Input Kategori</h6>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="/kategori" method="POST">
                        @csrf
                        
                        <!-- INPUT GROUP: NAMA KATEGORI -->
                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label text-dark fw-bold small mb-2">
                                <i class="bi bi-tag-fill text-secondary me-1 small"></i> Nama Kategori Civitas
                            </label>
                            
                            <div class="input-group has-validation">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted"><i class="bi bi-pencil"></i></span>
                                <input type="text" 
                                       class="form-control ps-2 py-2.5 rounded-end-3 fs-6 @error('nama_kategori') is-invalid @enderror shadow-xs" 
                                       id="nama_kategori" 
                                       name="nama_kategori" 
                                       value="{{ old('nama_kategori') }}" 
                                       placeholder="Contoh: Mahasiswa, Tenaga Pendidik, Alumni"
                                       style="border-top-left-radius: 0; border-bottom-left-radius: 0;"
                                       autofocus>
                                
                                @error('nama_kategori')
                                    <div class="invalid-feedback mt-2 d-block fw-medium small">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text text-muted small mt-2 opacity-75">
                                Pastikan nama kategori belum pernah terdaftar sebelumnya untuk menghindari duplikasi data.
                            </div>
                        </div>

                        <hr class="text-black-50 my-4 opacity-10">

                        <!-- ACTION BUTTONS -->
                        <div class="d-flex gap-2.5 justify-content-end">
                            <a href="/kategori" class="btn btn-warning rounded-3 border px-4 py-2 small fw-medium custom-btn-hover">Batal</a> &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 small fw-bold shadow-xs d-inline-flex align-items-center gap-2">
                                Simpan Data Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- COMPONENT CUSTOM STYLING -->
<style>
    body {
        background-color: #f8f9fa;
    }
    .shadow-xs {
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .py-2\.5 {
        padding-top: 0.65rem !important;
        padding-bottom: 0.65rem !important;
    }
    .custom-btn-hover:hover {
        background-color: #e9ecef;
        color: #212529 !important;
    }
    .input-group-text {
        border-color: #dee2e6;
    }
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.15);
    }
</style>
@endsection