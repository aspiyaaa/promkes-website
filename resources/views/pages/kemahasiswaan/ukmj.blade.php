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

/* Galeri Foto Kegiatan Melengkung */
.gallery-img-wrapper {
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    aspect-ratio: 4 / 3; /* Memastikan frame foto berasio konsisten dan proporsional */
}

.gallery-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-img-wrapper:hover .gallery-img {
    transform: scale(1.1); /* Efek zoom estetik saat foto disentuh/di-hover */
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
    
    /* Mengubah susunan grid galeri foto di HP agar lebih hemat ruang */
    .gallery-grid {
        --bs-gutter-x: 0.5rem !important;
        --bs-gutter-y: 0.5rem !important;
    }
}
</style>

<div class="container org-container-main pt-3 pb-5 mt-3">
    <div class="text-center">
        <h4 class="fw-bold tracking-wide text-uppercase mb-1">Daftar Unit Kegiatan Mahasiswa Jurusan</h4>
        <p class="text-muted small">Promosi Kesehatan</p>
    </div>
    
    <div class="row g-5 justify-content-center pt-4">
        
        @forelse ($data_ukmj as $data)
        <div class="col-12 col-lg-6 mt-5">
            <div class="card org-card h-100 p-4 pt-4">
                
                <!-- Lingkaran Logo Dinamis -->
                <div class="org-logo-wrapper mt-3">
                    @if ($data->logo)
                        <img src="{{ asset('uploads/ukmj/' . $data->logo) }}" class="org-logo" alt="Logo {{ $data->nama_ukmj }}">
                    @else
                        <!-- Menggunakan gambar siluet default apabila logo tidak tersedia -->
                        <img src="{{ asset('assets/default-logo.png') }}" class="org-logo" alt="Logo Default">
                    @endif
                </div>

                <div class="card-body text-center p-0 mt-2">
                    <!-- Nama UKMJ Dinamis -->
                    <h4 class="card-title fw-bold text-dark mb-1">{{ $data->nama_ukmj }}</h4>
                    <p class="text-muted small mb-3 fw-medium" style="color: #ff6600 !important;">Promosi Kesehatan</p>
                    
                    <!-- Sosial Media Tautan Langsung -->
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
                    
                    <!-- Deskripsi Dinamis -->
                    <p class="text-secondary mb-4 px-1" style="text-align: justify; line-height: 1.7; white-space: pre-line;">
                        {{ $data->deskripsi }}
                    </p>

                    <!-- Bagian Dokumentasi Kegiatan Kegiatan Statis -->
                    <div class="text-start">
                        <h6 class="fw-bold text-dark mb-3 small text-uppercase tracking-wider" style="color: #2e636e !important;">
                            <i class="bi bi-images me-1"></i> Dokumentasi Kegiatan
                        </h6>
                        <div class="row gallery-grid g-2">
                            <div class="col-4">
                                <div class="gallery-img-wrapper">
                                    <img src="{{ asset('assets/kegiatan-hima1.jpg') }}" class="gallery-img" alt="Kegiatan 1">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="gallery-img-wrapper">
                                    <img src="{{ asset('assets/kegiatan-hima2.jpg') }}" class="gallery-img" alt="Kegiatan 2">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="gallery-img-wrapper">
                                    <img src="{{ asset('assets/kegiatan-hima3.jpg') }}" class="gallery-img" alt="Kegiatan 3">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @empty
        <!-- Keadaan jika tidak ada data sama sekali di dalam tabel UKMJ -->
        <div class="col-12 text-center py-5 text-muted">
            <i class="bi bi-folder-x display-1 opacity-50 mb-3"></i>
            <h5>Belum ada data Unit Kegiatan Mahasiswa Jurusan yang dimuat.</h5>
        </div>
        @endforelse

    </div>
</div>

@endsection