@extends('layouts.master')

@section('content')

<style>
    body {
        background-color: #f8f9fa;
    }
    /* --- EFEK KOLASE OTOMATIS (MASONRY STYLE) --- */
    .gallery-masonry {
        column-count: 4; /* Jumlah kolom default di desktop */
        column-gap: 1.5rem;
    }
    .gallery-item-wrapper {
        break-inside: avoid;
        margin-bottom: 1.5rem;
    }
    
    /* Responsive Kolase */
    @media (max-width: 1200px) { .gallery-masonry { column-count: 3; } }
    @media (max-width: 768px) { .gallery-masonry { column-count: 2; } }
    @media (max-width: 576px) { .gallery-masonry { column-count: 1; } }

    /* Gaya Item Galeri */
    .gallery-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        border-radius: 12px;
        cursor: pointer; /* Mengubah kursor jadi tangan agar tahu bisa diklik */
    }
    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }
    .gallery-img {
        width: 100%;
        height: auto; /* Biar tinggi gambar otomatis/alami mengikuti aslinya (efek kolase) */
        display: block;
        transition: transform 0.5s ease;
    }
    .gallery-item:hover .gallery-img {
        transform: scale(1.05);
    }
</style>

<div class="container py-5">
    <div class="d-flex align-items-center mb-4 gap-3">
        <a href="/BKJ" class="btn btn-outline-secondary rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div>
            <h2 class="fw-bold text-dark mb-0">Galeri Kegiatan: {{ $bkj->nama_bkj }}</h2>
        </div>
    </div>

    <hr class="mb-5 text-muted">

    <div class="gallery-masonry">
        @forelse($bkj->galeri as $foto)
            <div class="gallery-item-wrapper">
                <div class="card border-0 shadow-sm gallery-item" 
                     data-bs-toggle="modal" 
                     data-bs-target="#imageModal" 
                     data-bs-img="{{ asset('uploads/galeri_bkj/' . $foto->foto_kegiatan) }}"
                     data-bs-caption="{{ $foto->keterangan_foto }}"
                     data-bs-date="{{ $foto->created_at->translatedFormat('d M Y') }}">
                     
                    <img src="{{ asset('uploads/galeri_bkj/' . $foto->foto_kegiatan) }}" class="gallery-img" alt="{{ $foto->keterangan_foto }}">
                    
                </div>
            </div>
        @empty
            <div class="w-100 text-center py-5">
                <div class="card border-0 shadow-sm p-5 bg-white text-muted rounded-4">
                    <i class="bi bi-image-alt display-1 text-secondary mb-3"></i>
                    <h4 class="fw-bold">Belum Ada Foto Kegiatan</h4>
                    <p class="mb-0">Dokumentasi kegiatan untuk {{ $bkj->nama_bkj }} masih kosong atau belum diunggah.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 bg-transparent">
            <div class="d-flex justify-content-end mb-2">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 position-relative rounded-3 overflow-hidden bg-white shadow-lg">
                <img src="" id="modalImage" class="w-100 h-auto d-block" alt="Detail Foto">
                
                <div class="p-3 bg-white border-top">
                    <p id="modalCaption" class="fw-semibold text-dark mb-1 fs-5"></p>
                    <small text-muted>
                        <i class="bi bi-calendar-event me-1"></i> <span id="modalDate"></span>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var imageModal = document.getElementById('imageModal');
        imageModal.addEventListener('show.bs.modal', function (event) {
            // Mengambil data dari card galeri yang di-klik
            var button = event.relatedTarget;
            var imgSrc = button.getAttribute('data-bs-img');
            var imgCaption = button.getAttribute('data-bs-caption');
            var imgDate = button.getAttribute('data-bs-date');

            // Memasukkan data ke dalam elemen modal pop-up
            var modalImage = imageModal.querySelector('#modalImage');
            var modalCaption = imageModal.querySelector('#modalCaption');
            var modalDate = imageModal.querySelector('#modalDate');

            modalImage.src = imgSrc;
            // Jika keterangan kosong, sembunyikan teksnya agar rapi
            if (imgCaption) {
                modalCaption.textContent = imgCaption;
                modalCaption.style.display = 'block';
            } else {
                modalCaption.style.display = 'none';
            }
            modalDate.textContent = imgDate;
        });
    });
</script>

@endsection