@extends('layouts.master_admin')

@section('title', 'Edit Ruangan')

@section('content_admin')
<div class="container-fluid px-4 py-5" style="background-color: #f8fafc; min-height: 100vh;">
    
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-5 pb-4 border-bottom gap-3">
        <div>
            <h2 class="h3 mb-2 fw-bold text-dark d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square text-warning"></i> Edit Data Ruangan
            </h2>
            <p class="text-muted small mb-0">Perbarui informasi inventaris, tipe, lokasi, kondisi, atau dokumentasi foto ruangan.</p>
        </div>
        <div>
            <a href="/ruangan" class="btn btn-outline-secondary btn-sm rounded-3 px-4 py-2 d-inline-flex align-items-center gap-2 small fw-medium transition-all">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4 p-4 shadow-sm" role="alert">
            <h6 class="fw-bold mb-2 text-danger d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i> Gagal Memperbarui Data!
            </h6>
            <ul class="mb-0 small ps-3 text-secondary">
                @foreach ($errors->all() as $error)
                    <li class="mb-1">{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="/ruangan/{{ $ruangan->id_ruangan }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-5 align-items-start">
            
            <div class="col-xl-5 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-3">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 pb-3 border-bottom text-primary">
                            <div class="bg-primary-subtle p-3 rounded-3 me-3 text-primary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-door-open-fill fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark" style="font-size: 1.15rem;">Detail Ruangan</h5>
                                <p class="text-muted small mb-0">Informasi identitas fisik ruangan</p>
                            </div>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="nama_ruangan" class="form-label fw-semibold text-secondary small mb-2">Nama Ruangan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-custom rounded-3 @error('nama_ruangan') is-invalid @enderror" id="nama_ruangan" name="nama_ruangan" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" placeholder="Contoh: Ruang Kelas Teori 2A" required>
                                @error('nama_ruangan')
                                    <div class="invalid-feedback mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="kode_ruangan" class="form-label fw-semibold text-secondary small mb-2">Kode Ruangan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-custom rounded-3 @error('kode_ruangan') is-invalid @enderror" id="kode_ruangan" name="kode_ruangan" value="{{ old('kode_ruangan', $ruangan->kode_ruangan) }}" placeholder="Contoh: R-PROMKES-01" required>
                                @error('kode_ruangan')
                                    <div class="invalid-feedback mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="tipe_ruangan" class="form-label fw-semibold text-secondary small mb-2">Tipe Ruangan <span class="text-danger">*</span></label>
                                <select class="form-select form-custom rounded-3 @error('tipe_ruangan') is-invalid @enderror" id="tipe_ruangan" name="tipe_ruangan" required style="min-height: 46px;">
                                    <option value="" disabled>-- Pilih Tipe Ruangan --</option>
                                    <option value="kelas" {{ old('tipe_ruangan', $ruangan->tipe_ruangan) == 'kelas' ? 'selected' : '' }}>Kelas</option>
                                    <option value="laboratorium" {{ old('tipe_ruangan', $ruangan->tipe_ruangan) == 'laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                                    <option value="aula" {{ old('tipe_ruangan', $ruangan->tipe_ruangan) == 'aula' ? 'selected' : '' }}>Aula</option>
                                </select>
                                @error('tipe_ruangan')
                                    <div class="invalid-feedback mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="lokasi" class="form-label fw-semibold text-secondary small mb-2">Lokasi Gedung / Lantai <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-custom rounded-3 @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $ruangan->lokasi) }}" placeholder="Contoh: Gedung Direktorat Lantai 2" required>
                                @error('lokasi')
                                    <div class="invalid-feedback mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="kapasitas" class="form-label fw-semibold text-secondary small mb-2">Kapasitas Maksimal <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control form-custom rounded-start-3 @error('kapasitas') is-invalid @enderror" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $ruangan->kapasitas) }}" placeholder="40" min="1" required style="border-right: none;">
                                    <span class="input-group-text bg-light text-secondary small px-3" style="font-size: 0.85rem; border-color: #cbd5e1; border-top-right-radius: 8px; border-bottom-right-radius: 8px;">Orang</span>
                                </div>
                                @error('kapasitas')
                                    <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-7 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-3">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 pb-3 border-bottom text-secondary">
                            <div class="bg-secondary-subtle p-3 rounded-3 me-3 text-secondary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-hdd-rack-fill fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark" style="font-size: 1.15rem;">Fasilitas & Kondisi</h5>
                                <p class="text-muted small mb-0">Status operasional, kelengkapan alat, dan dokumentasi foto</p>
                            </div>
                        </div>

                        <div class="mb-5 p-4 bg-light rounded-4 border-start border-success border-4 shadow-xs">
                            <h6 class="fw-bold mb-3 text-dark d-flex align-items-center small-title">
                                <i class="bi bi-toggle-on me-2 text-success fs-5"></i> Status Operasional Ruangan <span class="text-danger ms-1">*</span>
                            </h6>
                            <div class="d-flex flex-column flex-sm-row gap-3 mt-3">
                                <div class="form-check custom-radio-wrapper flex-fill">
                                    <input class="form-check-input d-none" type="radio" name="status" id="status_tersedia" value="tersedia" {{ old('status', $ruangan->status) == 'tersedia' ? 'checked' : '' }}>
                                    <label class="custom-radio-label p-3 rounded-3 d-block text-center cursor-pointer border fw-semibold small" for="status_tersedia">
                                         <i class="bi bi-check-circle-fill me-1 text-success"></i> Tersedia
                                    </label>
                                </div>
                                <div class="form-check custom-radio-wrapper flex-fill mb-0">
                                    <input class="form-check-input d-none" type="radio" name="status" id="status_digunakan" value="digunakan" {{ old('status', $ruangan->status) == 'digunakan' ? 'checked' : '' }}>
                                    <label class="custom-radio-label p-3 rounded-3 d-block text-center cursor-pointer border fw-semibold small" for="status_digunakan">
                                        <i class="bi bi-activity me-1 text-info"></i> Digunakan
                                    </label>
                                </div>
                                <div class="form-check custom-radio-wrapper flex-fill mb-0">
                                    <input class="form-check-input d-none" type="radio" name="status" id="status_perbaikan" value="perbaikan" {{ old('status', $ruangan->status) == 'perbaikan' ? 'checked' : '' }}>
                                    <label class="custom-radio-label p-3 rounded-3 d-block text-center cursor-pointer border fw-semibold small" for="status_perbaikan">
                                        <i class="bi bi-tools me-1 text-warning"></i> Perbaikan
                                    </label>
                                </div>
                            </div>
                            @error('status') <div class="text-danger small mt-2 d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-5 p-4 bg-light rounded-4 border-start border-info border-4">
                            <h6 class="fw-bold mb-3 text-dark d-flex align-items-center small-title">
                                <i class="bi bi-cpu me-2 text-info fs-5"></i> Detail Fasilitas Ruangan <span class="text-danger ms-1">*</span>
                            </h6>
                            <textarea class="form-control rounded-3 bg-white border-light-subtle p-3 @error('fasilitas') is-invalid @enderror" id="fasilitas" name="fasilitas" rows="3" placeholder="Contoh: AC 2 Unit, Proyektor LCD, Smart TV, Whiteboard" required style="font-size: 0.9rem; line-height: 1.6; border-color: #cbd5e1;">{{ old('fasilitas', $ruangan->fasilitas) }}</textarea>
                            @error('fasilitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-5 p-4 bg-light rounded-4 border-start border-primary border-4">
                            <h6 class="fw-bold mb-3 text-dark d-flex align-items-center small-title">
                                <i class="bi bi-file-earmark-text me-2 text-primary fs-5"></i> Deskripsi Ruangan <span class="text-muted fw-normal ms-1">(Opsional)</span>
                            </h6>
                            <textarea class="form-control rounded-3 bg-white border-light-subtle p-3 @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="2" placeholder="Masukkan deskripsi singkat fungsi atau kondisi khusus ruangan..." style="font-size: 0.9rem; line-height: 1.6; border-color: #cbd5e1;">{{ old('deskripsi', $ruangan->deskripsi) }}</textarea>
                            @error('deskripsi') <div class="invalid-feedback mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3 p-4 bg-light rounded-4 border-start border-warning border-4">
                            <h6 class="fw-bold mb-3 text-dark d-flex align-items-center small-title">
                                <i class="bi bi-image me-2 text-warning fs-5"></i> Foto Ruangan <span class="text-muted fw-normal ms-1">(Opsional)</span>
                            </h6>
                            
                            @if($ruangan->foto_ruangan)
                                <div class="mb-3 p-2 bg-white rounded-3 border d-inline-block">
                                    <p class="text-muted small mb-1 fw-medium ps-1">Foto Saat Ini:</p>
                                    <img src="{{ asset('uploads/ruangan/' . $ruangan->foto_ruangan) }}" alt="Foto Ruangan" class="img-thumbnail rounded-3" style="max-height: 120px; object-fit: cover;">
                                </div>
                            @endif

                            <input type="file" class="form-control rounded-3 bg-white @error('foto_ruangan') is-invalid @enderror p-2" id="foto_ruangan" name="foto_ruangan" accept="image/*" style="border-color: #cbd5e1; font-size: 0.9rem;">
                            <div class="form-text text-muted small mt-2 d-flex align-items-center gap-1">
                                <i class="bi bi-info-circle"></i> Biarkan kosong jika tidak ingin mengubah foto ruangan. Max 2MB.
                            </div>
                            @error('foto_ruangan') <div class="invalid-feedback mt-2">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end align-items-center gap-3 mt-5 pt-4 border-top">
            <a href="/ruangan" class="btn btn-light rounded-3 px-4 py-2 border small text-secondary fw-semibold">Batalkan</a>
            <button type="submit" class="btn btn-warning text-white rounded-3 px-5 py-2 fw-bold shadow-sm border-0" style="background-color: #f59e0b; min-height: 44px;">
                <i class="bi bi-cloud-arrow-up me-1"></i> Perbarui Data Ruangan
            </button>
        </div>
    </form>
</div>

<style>
    /* Styling Field Form Input */
    .form-custom {
        background-color: #ffffff;
        border: 1px solid #cbd5e1;
        padding: 0.7rem 1rem;
        font-size: 0.92rem;
        color: #334155;
        border-radius: 8px !important;
        transition: all 0.2s ease-in-out;
    }
    .form-custom:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
        background-color: #ffffff;
    }
    .small-title {
        font-size: 0.9rem;
        letter-spacing: 0.2px;
    }
    .transition-all {
        transition: all 0.2s ease-in-out;
    }
    
    /* Custom Radio Buttons Style */
    .custom-radio-wrapper {
        padding-left: 0 !important;
    }
    .custom-radio-label {
        background-color: #ffffff;
        color: #64748b;
        border-color: #e2e8f0;
        transition: all 0.2s ease;
        user-select: none;
    }
    .custom-radio-label:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
    }
    .form-check-input:checked + .custom-radio-label {
        background-color: #ffffff;
        border-color: #10b981 !important;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
        color: #0f172a;
    }
    #status_digunakan:checked + .custom-radio-label {
        border-color: #0ea5e9 !important;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15);
    }
    #status_perbaikan:checked + .custom-radio-label {
        border-color: #f59e0b !important;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
    }
    .cursor-pointer {
        cursor: pointer;
    }
</style>
@endsection