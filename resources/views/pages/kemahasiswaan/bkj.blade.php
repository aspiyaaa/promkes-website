@extends('layouts.master')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
/* TENTUKAN STYLE BARU UNTUK KOTAK (CARD) */
.org-card {
    border: 1px solid rgba(0, 0, 0, 0.09); /* MENAMBAHKAN BORDER HALUS DI KOTAK */
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02); /* Sedikit mengurangi shadow agar border lebih terlihat */
    background-color: #ffffff;
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    overflow: hidden;
}

/* EFEK SAAT KURSOR MAUSE MENYENTUH KOTAK (HOVER) */
.org-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.06);
    border-color: #ff6600; /* Border otomatis berubah warna jadi oranye saat di-hover/sentuh */
}

/* LINGKARAN LOGO ORGANISASI (Diberi border juga agar menyatu dengan kartu) */
.org-logo-wrapper {
    width: 130px;
    height: 130px;
    margin: -65px auto 15px auto;
    background: #ffffff;
    padding: 8px;
    border-radius: 50%;
    border: 1px solid rgba(0, 0, 0, 0.09); /* Menyelaraskan border lingkaran logo dengan kartu */
    box-shadow: 0 8px 20px rgba(0,0,0,0.04);
}

.org-logo {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* Desain Badge Instagram */
.btn-instagram {
    background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
    color: #ffffff !important;
    border: none;
    border-radius: 30px;
    font-weight: 500;
    padding: 0.4rem 1.2rem;
    transition: opacity 0.2s ease;
}

.btn-instagram:hover {
    opacity: 0.9;
}

/* Desain Tombol Galeri Kegiatan Baru */
.btn-galeri-bkj {
    background-color: #2e636e;
    color: #ffffff !important;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    padding: 0.6rem 1.5rem;
    transition: all 0.3s ease;
}

.btn-galeri-bkj:hover {
    background-color: #20464e;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(46, 99, 110, 0.2);
}

/* 📱 OPTIMASI RESEPIF UNTUK LAYAR HP ANDROID */
@media (max-width: 767.98px) {
    .org-container-main {
        padding-top: 4rem !important; /* Jarak pas dari navbar saat dibuka di android */
    }

    .org-card {
        margin-top: 60px; /* Memberi ruang di atas karena logo ditarik naik */
    }
    
    .org-logo-wrapper {
        width: 110px;
        height: 110px;
        margin-top: -55px;
    }
    
    .org-card .card-title {
        font-size: 1.25rem !important;
    }

    .org-card p {
        font-size: 0.875rem !important;
        line-height: 1.6;
    }
}
</style>

<div class="container org-container-main pt-3 pb-5 mt-3">
    <div class="text-center">
        <h4 class="fw-bold tracking-wide text-uppercase mb-1">Daftar Badan Kelengkapan Jurusan</h4>
        <p class="text-muted small">Promosi Kesehatan</p>
    </div>
    <div class="row g-5 justify-content-center pt-4">
        
        @forelse ($data_bkj as $data)
        <div class="col-12 col-lg-6 mt-5">
            <div class="card org-card h-100 p-4 pt-4 d-flex flex-column justify-content-between">
                
                <div>
                    <div class="org-logo-wrapper mt-3">
                        @if ($data->logo)
                            <img src="{{ asset('uploads/bkj/' . $data->logo) }}" class="org-logo" alt="Logo {{ $data->nama_bkj }}">
                        @else
                            <img src="{{ asset('assets/default-logo.png') }}" class="org-logo" alt="Logo Default">
                        @endif
                    </div>

                    <div class="card-body text-center p-0 mt-2">
                        <h4 class="card-title fw-bold text-dark mb-1">{{ $data->nama_bkj }}</h4>
                        <p class="text-muted small mb-3 fw-medium" style="color: #ff6600 !important;">Promosi Kesehatan</p>
                        
                        <div class="mb-4">
                            @if($data->medsos)
                                <a href="{{ $data->medsos }}" target="_blank" class="btn btn-instagram btn-sm d-inline-flex align-items-center gap-2 shadow-sm">
                                    <i class="bi bi-instagram"></i> Kunjungi Instagram
                                </a>
                            @else
                                <button class="btn btn-light btn-sm d-inline-flex align-items-center gap-2 border disabled" style="border-radius: 30px;">
                                    <i class="bi bi-instagram text-muted"></i> <span class="text-muted small">Belum ada sosmed</span>
                                </button>
                            @endif
                        </div>
                        
                        <hr class="opacity-10 my-3">
                        
                        <p class="text-secondary mb-4 px-1" style="text-align: justify; line-height: 1.7; white-space: pre-line;">
                            {{ $data->deskripsi }}
                        </p>
                    </div>
                </div>

                <div class="text-center mt-auto pt-2">
                    <a href="{{ route('bkj.galeri', $data->id_bkj) }}" class="btn btn-galeri-bkj w-100 d-inline-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <i class="bi bi-images"></i> Lihat Galeri Kegiatan
                    </a>
                </div>

            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">
            <i class="bi bi-folder-x display-1 opacity-50 mb-3"></i>
            <h5>Belum ada data Badan Kelengkapan Jurusan yang dimuat.</h5>
        </div>
        @endforelse

    </div>
</div>

@endsection