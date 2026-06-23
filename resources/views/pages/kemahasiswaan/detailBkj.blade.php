@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
/* Style Grid Galeri */
.gallery-user-card {
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 16px;
    overflow: hidden;
    background: #ffffff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gallery-user-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

.img-container {
    width: 100%;
    aspect-ratio: 4 / 3;
    overflow: hidden;
    background-color: #f8f9fa;
}

.img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-user-card:hover .img-container img {
    transform: scale(1.08);
}

.back-btn {
    color: #2e636e;
    border-color: #2e636e;
    font-weight: 500;
    border-radius: 10px;
    transition: all 0.2s;
}

.back-btn:hover {
    background-color: #2e636e;
    color: #ffffff;
}

</style>

<div class="container my-5 pt-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center border-bottom pb-3 mb-4 gap-3">
        <div>
            <span class="text-muted small text-uppercase fw-bold tracking-wider">Galeri Kegiatan</span>
            <h2 class="fw-bold text-dark m-0">{{ $bkj->nama_bkj }}</h2>
        </div>
        <a href="/bkj" class="btn btn-outline-secondary back-btn d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row g-4">
        @forelse($list_galeri as $galeri)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card gallery-user-card h-100">
                    <div class="img-container">
                        @if($galeri->foto_kegiatan && file_exists(public_path('uploads/galeri_bkj/' . $galeri->foto_kegiatan)))
                            <img src="{{ asset('uploads/galeri_bkj/' . $galeri->foto_kegiatan) }}" alt="Foto Kegiatan {{ $bkj->nama_bkj }}">
                        @else
                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                <i class="bi bi-image fs-2 mb-1"></i>
                                <span class="small">Gambar tidak tersedia</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="card-body p-3">
                        <p class="card-text text-secondary small lh-base mb-0" style="white-space: pre-line; text-align: justify;">
                            {{ $galeri->keterangan_foto }}
                        </p>
                        <div class="mt-2 pt-2 border-top d-flex justify-content-between align-items-center text-muted" style="font-size: 0.75rem;">
                            <span><i class="bi bi-calendar-check me-1"></i> Dokumentasi</span>
                            <span>{{ \Carbon\Carbon::parse($galeri->created_at)->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 my-4 text-muted">
                <i class="bi bi-images display-3 opacity-25 mb-3 d-block"></i>
                <h5 class="fw-medium">Belum ada dokumentasi kegiatan untuk {{ $bkj->nama_bkj }}.</h5>
                <p class="small text-secondary">Pantau terus halaman ini untuk pembaruan kegiatan mendatang.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection