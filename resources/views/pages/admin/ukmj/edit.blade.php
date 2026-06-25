@extends('layouts.master_admin')

@section('title', 'Ubah Unit Kegiatan Mahasiswa Jurusan')

@section('content_admin')
<div class="container-fluid px-4 py-4" style="background-color: #f4f6f9; min-height: 100vh;">
    
    <div class="mb-4 pb-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h2 class="h4 mb-1 fw-bold text-dark">Ubah Data UKMJ</h2>
            <p class="text-muted small mb-0">Perbarui profil, tautan eksternal, atau lambang dari unit kegiatan mahasiswa.</p>
        </div>
        <div>
            <a href="/ukmj" class="btn btn-primary rounded-3 px-3 py-2 small fw-medium shadow-sm d-inline-flex align-items-center gap-2" style="background-color: #4e73df; border-color: #4e73df;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden w-100 mb-4" style="border-top: 4px solid #0d6efd !important;">
        <div class="card-header bg-white border-bottom py-3 px-4">
            <h5 class="h6 mb-0 fw-semibold text-secondary">Form Edit Data UKMJ</h5>
        </div>

        <div class="card-body p-3 p-md-4 bg-white">
            <form action="/ukmj/{{ $edit_bkj->id_ukmj }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <div class="col-12">
                        <label for="nama_ukmj" class="form-label text-secondary fw-bold small mb-2">Nama Unit Kegiatan Mahasiswa Jurusan</label>
                        <input type="text" 
                               class="form-control rounded-3 py-2.5 @error('nama_ukmj') is-invalid @enderror" 
                               id="nama_ukmj" 
                               name="nama_ukmj" 
                               value="{{ old('nama_ukmj', $edit_bkj->nama_ukmj) }}" 
                               placeholder="Contoh: UKMJ Olahraga">
                        @error('nama_ukmj')
                            <div class="invalid-feedback mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="deskripsi" class="form-label text-secondary fw-bold small mb-2">Deskripsi Singkat Kegiatan / Profil</label>
                        <textarea class="form-control rounded-3 p-3 @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" 
                                  name="deskripsi" 
                                  rows="5" 
                                  placeholder="Tuliskan profil singkat UKMJ...">{{ old('deskripsi', $edit_bkj->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="medsos" class="form-label text-secondary fw-bold small mb-2">Link Media Sosial / Instagram Resmi</label>
                        <input type="text" 
                               class="form-control rounded-3 py-2.5 @error('medsos') is-invalid @enderror" 
                               id="medsos" 
                               name="medsos" 
                               value="{{ old('medsos', $edit_bkj->medsos) }}" 
                               placeholder="Contoh: https://instagram.com/username_ukmj">
                        @error('medsos')
                            <div class="invalid-feedback mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="logo" class="form-label text-secondary fw-bold small mb-2">Logo Resmi UKMJ</label>
                        
                        <div class="mb-3 p-2 border rounded-3 bg-light d-flex align-items-center gap-3" style="max-width: 100%;">
                            @if($edit_bkj->logo)
                                <img src="{{ asset('uploads/ukmj/' . $edit_bkj->logo) }}" alt="Current Logo" class="img-thumbnail rounded-2" style="max-height: 60px; max-width: 60px; object-fit: cover;">
                                <div>
                                    <div class="small fw-bold text-dark">Logo Aktif Saat Ini</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">{{ $edit_bkj->logo }}</div>
                                </div>
                            @else
                                <div class="bg-white border rounded-2 d-flex align-items-center justify-content-center text-muted" style="height: 60px; width: 60px;">
                                    <i class="bi bi-image fs-4"></i>
                                </div>
                                <div class="small text-muted">Belum ada file logo yang terunggah.</div>
                            @endif
                        </div>

                        <input type="file" 
                               class="form-control rounded-3 @error('logo') is-invalid @enderror" 
                               id="logo" 
                               name="logo" 
                               accept="image/*">
                        <div class="form-text text-muted small mt-1">Kosongkan jika tidak ingin merubah logo (.png, .jpg, .jpeg, maks. 2MB).</div>
                        @error('logo')
                            <div class="invalid-feedback mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="border-top mt-3 pt-4 d-flex align-items-center justify-content-end gap-2">
                    <button type="reset" class="btn rounded-3 px-4 py-2 small fw-medium text-white" style="background-color: #f1b434; border-color: #f1b434;">
                        Reset
                    </button> &nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 small fw-medium" style="background-color: #4e73df; border-color: #4e73df;">
                        Perbarui Data UKMJ
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

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