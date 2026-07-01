@extends('layouts.master')

@section('content')
<div class="container py-5" style="min-height: 80vh;">
    
    <div class="text-center mb-5">
        <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fw-semibold mb-2">Laboratorium Spesifik</span>
        <h2 class="fw-bold text-dark mb-2">Daftar Laboratorium & Studio</h2>
        <p class="text-muted mx-auto" style="max-width: 600px;">Fasilitas laboratorium penunjang praktikum, riset, dan eksperimen mahasiswa guna mendukung kompetensi keahlian kerja nyata.</p>
        <div class="mx-auto bg-info rounded" style="width: 60px; height: 4px;"></div>
    </div>

    <div class="row g-4 justify-content-center">
        @forelse($ruangan as $item)
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover transition-all">
                    
                    <div class="position-relative bg-light text-center overflow-hidden" style="height: 220px;">
                        @if($item->foto_ruangan && file_exists(public_path('uploads/ruangan/' . $item->foto_ruangan)))
                            <img src="{{ asset('uploads/ruangan/' . $item->foto_ruangan) }}" alt="{{ $item->nama_ruangan }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted opacity-50">
                                <i class="bi bi-flask fs-1 mb-2 text-info"></i>
                                <span class="small fw-medium">Foto Belum Tersedia</span>
                            </div>
                        @endif

                        <div class="position-absolute top-0 end-0 m-3">
                            @if($item->status == 'tersedia')
                                <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm small"><i class="bi bi-check-circle-fill me-1"></i> Tersedia</span>
                            @elseif($item->status == 'digunakan')
                                <span class="badge bg-info text-white px-3 py-2 rounded-pill shadow-sm small"><i class="bi bi-activity me-1"></i> Digunakan</span>
                            @else
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm small"><i class="bi bi-tools me-1"></i> Perbaikan</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-info fw-bold small text-uppercase tracking-wider"><i class="bi bi-hash"></i> {{ $item->kode_ruangan }}</span>
                            <span class="text-secondary small fw-medium"><i class="bi bi-people-fill me-1"></i> {{ $item->kapasitas }} Orang</span>
                        </div>
                        
                        <h5 class="card-title fw-bold text-dark mb-3">{{ $item->nama_ruangan }}</h5>
                        
                        <p class="text-muted small mb-3 d-flex align-items-start gap-2">
                            <i class="bi bi-geo-alt-fill text-danger mt-1"></i>
                            <span>{{ $item->lokasi }}</span>
                        </p>

                        <div class="mt-auto pt-3 border-top">
                            <h6 class="fw-bold text-dark small mb-2"><i class="bi bi-shield-check text-success me-1"></i> Alat & Fasilitas:</h6>
                            <p class="text-secondary small mb-0 text-truncate-2" title="{{ $item->fasilitas }}">
                                {{ $item->fasilitas }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-4 bg-white rounded-4 shadow-sm border inline-block" style="max-width: 400px; margin: 0 auto;">
                    <i class="bi bi-inboxes text-muted display-4"></i>
                    <h5 class="fw-bold text-dark mt-3">Data Belum Tersedia</h5>
                    <p class="text-muted small mb-0">Belum ada data laboratorium yang dimasukkan oleh admin.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.08) !important;
    }
    .transition-all {
        transition: all 0.3s ease-in-out;
    }
    .object-fit-cover {
        object-fit: cover;
    }
    .tracking-wider {
        letter-spacing: 0.5px;
    }
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-box-orient: vertical;  
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.5;
        height: 3rem;
    }
</style>
@endsection