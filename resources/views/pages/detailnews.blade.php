@extends('layouts.master')

@section('content')
<!-- Container utama disamakan persis dengan layout container pembungkus Navbar kamu -->
<div class="container my-4 my-md-5">
    <div class="row">
        <!-- Menggunakan col-12 penuh agar lebarnya rata sejajar dengan batas Navbar -->
        <div class="col-12">
            
            <!-- 1. TOMBOL KEMBALI & BADGE -->
            <div class="mb-3 d-flex align-items-center justify-content-between">
                <a href="/news" class="btn btn-link text-decoration-none text-muted p-0 small d-inline-flex align-items-center hover-gap">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Berita
                </a>
                <span class="badge bg-light text-dark border rounded-pill px-3 py-1 small">
                    <i class="bi bi-eye me-1"></i> Artikel Publik
                </span>
            </div>

            <!-- 2. JUDUL UTAMA BERITA -->
            <h1 class="fw-bold text-dark lh-sm mb-3 fs-3 fs-md-1">
                {{ $detail_berita->title }}
            </h1>

            <!-- 3. METADATA PENULIS & TANGGAL -->
            <div class="d-flex flex-wrap align-items-center gap-3 text-muted small pb-4 mb-4 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold shadow-sm" style="width: 32px; height: 32px; font-size: 14px;">
                        {{ strtoupper(substr($detail_berita->author ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <span class="d-block text-dark fw-medium lh-1 mb-1">{{ $detail_berita->author }}</span>
                        <span class="text-muted extra-small">Kontributor Konten</span>
                    </div>
                </div>
                <div class="ms-md-auto d-flex align-items-center gap-2">
                    <span><i class="bi bi-calendar3 me-1"></i>{{ $detail_berita->created_at ? $detail_berita->created_at->format('d M Y') : '-' }}</span>
                    <span>•</span>
                    <span><i class="bi bi-clock me-1"></i>{{ $detail_berita->created_at ? $detail_berita->created_at->format('H:i') : '-' }} WIB</span>
                </div>
            </div>

            <!-- 4. SAMPUL / THUMBNAIL UTAMA (Lebar Maksimal Mengikuti Grid Navbar) -->
            <div class="mb-4 mx-n3 mx-md-0 overflow-hidden shadow-sm img-container">
                @if($detail_berita->thumbnail)
                    <img src="{{ asset('uploads/berita/' . $detail_berita->thumbnail) }}" alt="{{ $detail_berita->title }}" class="w-100 h-100 object-fit-cover rounded-md-4">
                @else
                    <div class="w-100 bg-light-subtle d-flex flex-column align-items-center justify-content-center border rounded-md-4 text-muted py-5" style="min-height: 250px;">
                        <i class="bi bi-image text-secondary display-4 mb-2"></i>
                        <span class="small italic">No Image Available</span>
                    </div>
                @endif
            </div>

            <!-- 5. ISI KONTEN UTAMA BERITA -->
            <!-- Sekarang membentang mengikuti lebar container utama, dengan baris kalimat yang seimbang -->
            <div class="article-content text-dark mb-5" style="text-align: justify; line-height: 1.8; font-size: 17px; white-space: pre-line;">
                @if($detail_berita->content)
                    {!! $detail_berita->content !!}
                @else
                    <p class="text-muted fst-italic text-center py-4">Maaf, naskah isi berita tidak ditemukan atau kosong.</p>
                @endif
            </div>

            <!-- 6. FOOTER ARTIKEL & SHARE BADGE -->
            <div class="p-3 bg-light rounded-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4 border border-light-subtle shadow-xs">
                <span class="small text-secondary fw-medium"><i class="bi bi-info-circle me-1"></i> Informasi pada artikel ini dikelola secara resmi.</span>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="window.print()">
                        <i class="bi bi-printer me-1"></i> Cetak
                    </button>
                    <button class="btn btn-sm btn-dark rounded-pill px-3" onclick="copyToClipboard()">
                        <i class="bi bi-share me-1"></i> Salin Tautan
                    </button>
                </div>
            </div>

        </div> <!-- End col-12 -->
    </div> <!-- End row -->
</div>

<!-- Tambahan CSS Khusus Responsif Android & Desktop Layout -->
<style>
    .object-fit-cover {
        object-fit: cover;
    }
    .extra-small {
        font-size: 11px;
    }
    
    /* Optimasi Tampilan Menyesuaikan Android (Mobile View) */
    @media (max-width: 767.98px) {
        .mx-n3 {
            margin-right: -1rem !important;
            margin-left: -1rem !important;
        }
        .img-container {
            height: 240px; /* Tinggi gambar proporsional di HP */
        }
        .img-container img {
            border-radius: 0px !important; /* Gambar rapat ke tepi layar HP agar clean */
        }
        .article-content {
            font-size: 16px !important; /* Ukuran teks ideal baca di layar HP */
        }
    }

    /* Optimasi Tampilan Laptop / Desktop */
    @media (min-width: 768px) {
        .img-container {
            height: 480px; /* Tinggi gambar sedikit dinaikkan karena lebar grid bertambah */
        }
        .rounded-md-4 {
            border-radius: 1rem !important;
        }
    }

    /* Efek transisi navigasi kembali */
    .hover-gap i {
        transition: transform 0.2s ease;
    }
    .hover-gap:hover i {
        transform: translateX(-3px);
    }
</style>

<script>
    function copyToClipboard() {
        navigator.clipboard.writeText(window.location.href);
        alert('Tautan berita berhasil disalin ke memori perangkat!');
    }
</script>
@endsection