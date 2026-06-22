@extends('layouts.master')

@section('content')
<div class="container my-5">
    
    <div class="row mb-5 text-center text-md-start align-items-center">
        <div class="col-md-8">
            <h1 class="fw-bold display-5 text-dark mb-2">Pusat Berita & Informasi</h1>
            <p class="text-muted lead fs-6 fs-md-5">Dapatkan informasi, artikel, dan dokumentasi kegiatan terbaru yang terpercaya.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <span class="badge bg-primary px-3 py-2 rounded-pill fs-7">
                Total: {{ $data_berita->count() }} Berita
            </span>
        </div>
    </div>

    @if($data_berita->isEmpty())
        <div class="text-center py-5 my-4 bg-light rounded-4 shadow-sm mx-2">
            <i class="bi bi-newspaper text-muted display-1 d-block mb-3"></i>
            <h4 class="fw-bold text-secondary">Belum Ada Berita</h4>
            <p class="text-muted px-3">Saat ini belum ada artikel atau berita yang diterbitkan. Silakan kembali lagi nanti!</p>
        </div>
    @else

        @php $headline = $data_berita->first(); @endphp
        <div class="row mb-5 mx-1 mx-md-0">
            <div class="col-12 p-0 bg-white rounded-4 shadow-sm overflow-hidden border border-light">
                <div class="row g-0">
                    <div class="col-lg-7">
                        <div class="position-relative h-100" style="min-height: 250px; max-height: 400px;">
                            @if($headline->thumbnail)
                                <img src="{{ asset('uploads/berita/' . $headline->thumbnail) }}" alt="{{ $headline->title }}" class="w-100 h-100 object-fit-cover position-absolute">
                            @else
                                <div class="w-100 h-100 bg-light-subtle d-flex align-items-center justify-content-center position-absolute border-end">
                                    <span class="text-muted italic small">No Thumbnail Image</span>
                                </div>
                            @endif
                            <span class="position-absolute top-0 start-0 m-3 badge bg-danger px-3 py-2 rounded-pill fw-semibold shadow-sm">
                                BARU
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-5 d-flex flex-column justify-content-center p-4 p-md-5">
                        <div class="text-muted small mb-2 d-flex align-items-center gap-2">
                            <span><i class="bi bi-person-fill me-1"></i>{{ $headline->author }}</span>
                            <span>•</span>
                            <span><i class="bi bi-calendar3 me-1"></i>{{ $headline->created_at ? $headline->created_at->format('d M Y') : '-' }}</span>
                        </div>
                        <h2 class="fw-bold text-dark lh-sm mb-3">
                            <a href="/news/{{ $headline->slug ?? $headline->id_berita }}" class="text-decoration-none text-dark link-primary">
                                {{ Str::limit($headline->title, 75) }}
                            </a>
                        </h2>
                        <p class="text-secondary mb-4 fs-6">
                            {{ Str::limit(strip_tags($headline->content), 140) }}
                        </p>
                        <div>
                            <a href="/news/{{ $headline->slug ?? $headline->id_berita }}" class="btn btn-dark px-4 py-2 rounded-pill shadow-sm transition-all hover-lift">
                                Baca Selengkapnya <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="fw-bold text-dark mb-4 border-bottom pb-2">Artikel Lainnya</h3>
        <div class="row g-4">
            {{-- Kita skip berita pertama karena sudah dijadikan Headline di atas --}}
            @foreach($data_berita->skip(1) as $item)
                <div class="col-12 col-md-6 col-lg-4 d-flex">
                    <div class="card w-100 border-0 bg-white rounded-4 shadow-sm overflow-hidden border border-light-subtle transition-all hover-lift d-flex flex-column">
                        
                        <div class="position-relative" style="height: 200px;">
                            @if($item->thumbnail)
                                <img src="{{ asset('uploads/berita/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover">
                            @else
                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center border-bottom">
                                    <span class="text-muted small">No Image</span>
                                </div>
                            @endif
                        </div>

                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2 d-flex align-items-center gap-2">
                                <span class="text-truncate" style="max-width: 120px;"><i class="bi bi-person me-1"></i>{{ $item->author }}</span>
                                <span>•</span>
                                <span><i class="bi bi-calendar3 me-1"></i>{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</span>
                            </div>
                            
                            <h5 class="card-title fw-bold text-dark mb-2 lh-base">
                                <a href="/news/{{ $item->slug ?? $item->id_berita }}" class="text-decoration-none text-dark link-primary">
                                    {{ Str::limit($item->title, 60) }}
                                </a>
                            </h5>
                            
                            <p class="card-text text-secondary small mb-4 line-clamp">
                                {{ Str::limit(strip_tags($item->content), 100) }}
                            </p>
                            
                            <div class="mt-auto pt-2">
                                <a href="/news/{{ $item->slug ?? $item->id_berita }}" class="text-decoration-none fw-bold text-primary small d-inline-flex align-items-center hover-gap">
                                    Baca Artikel <i class="bi bi-arrow-right ms-1 transition-all"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    @endif
</div>

<style>
    .object-fit-cover {
        object-fit: cover;
    }
    /* Efek hover modern pada kartu berita */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }
    .hover-gap i {
        transition: transform 0.2s ease;
    }
    .hover-gap:hover i {
        transform: translateX(4px);
    }
    /* Mencegah tulisan merusak kerapian grid */
    .line-clamp {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    
    /* Menggunakan standar modern penulisan baris */
    line-clamp: 3; 
    -webkit-line-clamp: 3;
    }
</style>
@endsection