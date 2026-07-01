@extends('layouts.master_admin')

@section('title', 'Detail Ruangan')

@section('content_admin')
<div class="container-fluid px-4 py-5" style="background-color: #f8fafc; min-height: 100vh;">
    
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-5 pb-4 border-bottom gap-3">
        <div>
            <h2 class="h3 mb-2 fw-bold text-dark d-flex align-items-center gap-2">
                <i class="bi bi-info-circle-fill text-info"></i> Detail Informasi Ruangan
            </h2>
            <p class="text-muted small mb-0">Melihat spesifikasi lengkap, kapasitas, fasilitas, serta status operasional ruangan saat ini.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="/ruangan" class="btn btn-outline-secondary btn-sm rounded-3 px-4 py-2 d-inline-flex align-items-center gap-2 small fw-medium transition-all">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <a href="/ruangan/{{ $ruangan->id_ruangan }}/edit" class="btn btn-warning text-white btn-sm rounded-3 px-4 py-2 d-inline-flex align-items-center gap-2 small fw-semibold shadow-sm border-0" style="background-color: #f59e0b;">
                <i class="bi bi-pencil-square"></i> Edit Ruangan
            </a>
        </div>
    </div>

    <div class="row g-5 align-items-start">
        
        <div class="col-xl-5 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden p-3">
                <div class="position-relative rounded-3 overflow-hidden bg-light d-flex align-items-center justify-content-center" style="min-height: 320px; max-height: 400px;">
                    @if($ruangan->foto_ruangan && file_exists(public_path('uploads/ruangan/' . $ruangan->foto_ruangan)))
                        <img src="{{ asset('uploads/ruangan/' . $ruangan->foto_ruangan) }}" alt="{{ $ruangan->nama_ruangan }}" class="w-100 h-100 object-fit-cover position-absolute top-0 start-0">
                    @else
                        <div class="text-center p-5">
                            <i class="bi bi-image text-muted opacity-25" style="font-size: 5rem;"></i>
                            <p class="text-muted small fw-medium mt-2 mb-0">Belum ada dokumentasi foto untuk ruangan ini</p>
                        </div>
                    @endif
                </div>
                <div class="card-body p-3 pt-4">
                    <h5 class="fw-bold text-dark mb-1">{{ $ruangan->nama_ruangan }}</h5>
                    <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill mt-2 small fw-semibold" style="letter-spacing: 0.3px;">
                        <i class="bi bi-tag-fill me-1 text-primary"></i> {{ strtoupper($ruangan->kode_ruangan) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-xl-7 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-3">
                <div class="card-body p-4">
                    
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                        <span class="text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Kondisi Operasional</span>
                        
                        @if($ruangan->status == 'tersedia')
                            <span class="badge bg-success-subtle text-success px-4 py-2 rounded-3 border border-success-subtle fw-bold small">
                                <i class="bi bi-check-circle-fill me-1"></i> Tersedia / Siap Digunakan
                            </span>
                        @elseif($ruangan->status == 'digunakan')
                            <span class="badge bg-info-subtle text-info px-4 py-2 rounded-3 border border-info-subtle fw-bold small">
                                <i class="bi bi-activity me-1"></i> Sedang Digunakan
                            </span>
                        @else
                            <span class="badge bg-warning-subtle text-warning px-4 py-2 rounded-3 border border-warning-subtle fw-bold small">
                                <i class="bi bi-tools me-1"></i> Dalam Perbaikan
                            </span>
                        @endif
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-4 border-start border-primary border-4 shadow-xs">
                                <p class="text-muted small mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem;">Tipe Ruangan</p>
                                <h6 class="fw-bold text-dark mb-0 text-capitalize d-flex align-items-center gap-2">
                                    <i class="bi bi-grid-1x2-fill text-primary"></i> {{ $ruangan->tipe_ruangan }}
                                </h6>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-4 border-start border-dark border-4 shadow-xs">
                                <p class="text-muted small mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem;">Kapasitas Maksimal</p>
                                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                                    <i class="bi bi-people-fill text-dark"></i> {{ $ruangan->kapasitas }} Orang
                                </h6>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-light rounded-4 border-start border-secondary border-4 shadow-xs">
                                <p class="text-muted small mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem;">Lokasi Spesifik</p>
                                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                                    <i class="bi bi-geo-alt-fill text-secondary"></i> {{ $ruangan->lokasi }}
                                </h6>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 p-4 bg-light rounded-4 border-start border-info border-4">
                        <h6 class="fw-bold mb-3 text-dark d-flex align-items-center small-title">
                            <i class="bi bi-cpu me-2 text-info fs-5"></i> Kelengkapan Fasilitas Ruangan
                        </h6>
                        <div class="bg-white rounded-3 p-3 border border-light-subtle text-secondary small" style="line-height: 1.7; font-size: 0.92rem;">
                            {!! nl2br(e($ruangan->fasilitas)) !!}
                        </div>
                    </div>

                    <div class="mb-2 p-4 bg-light rounded-4 border-start border-primary border-4">
                        <h6 class="fw-bold mb-3 text-dark d-flex align-items-center small-title">
                            <i class="bi bi-file-earmark-text me-2 text-primary fs-5"></i> Deskripsi / Catatan Tambahan
                        </h6>
                        <div class="bg-white rounded-3 p-3 border border-light-subtle text-secondary small" style="line-height: 1.7; font-size: 0.92rem; min-height: 60px;">
                            @if($ruangan->deskripsi)
                                {!! nl2br(e($ruangan->deskripsi)) !!}
                            @else
                                <span class="text-muted italic">Tidak ada catatan deskripsi tambahan untuk ruangan ini.</span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .small-title {
        font-size: 0.9rem;
        letter-spacing: 0.2px;
    }
    .transition-all {
        transition: all 0.2s ease-in-out;
    }
    .object-fit-cover {
        object-fit: cover;
    }
    .shadow-xs {
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    }
    .italic {
        font-style: italic;
    }
</style>
@endsection