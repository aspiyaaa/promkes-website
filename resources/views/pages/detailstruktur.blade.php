@extends ('layouts.master')

@section('content')

<style>
/* Desain Kustom Halaman Detail Civitas */
.civitas-card-profile {
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.05);
}

.civitas-avatar-wrapper {
    width: 180px;
    height: 180px;
    margin: 0 auto;
    position: relative;
}

.civitas-avatar {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top;
    border: 5px solid #ffffff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Desain Navigasi Tab Deskripsi */
.custom-tabs .nav-link {
    color: #495057;
    font-weight: 600;
    border: none;
    padding: 0.75rem 1.2rem;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.custom-tabs .nav-link.active {
    background-color: rgba(255, 98, 0, 0.1) !important;
    color: #ff6200 !important; /* Warna oranye khas Promkes */
}

.tab-content-box {
    background-color: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
}

/* Timeline Pendidikan */
.timeline-education {
    border-left: 2px dashed #2e636e;
    padding-left: 25px;
    position: relative;
}

.timeline-item {
    position: relative;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -32px;
    top: 5px;
    width: 12px;
    height: 12px;
    background-color: #2e636e;
    border-radius: 50%;
}

/* 📱 OPTIMASI TAMPILAN ANDROID */
@media (max-width: 767.98px) {
    .civitas-avatar-wrapper {
        width: 140px;
        height: 140px;
    }
    
    .custom-tabs {
        flex-wrap: nowrap !important;
        overflow-x: auto; /* Menu tab bisa di-swipe geser ke samping di HP */
        padding-bottom: 5px;
        -webkit-overflow-scrolling: touch;
    }
    
    .custom-tabs .nav-link {
        white-space: nowrap; /* Teks tab tidak patah ke bawah */
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }
}
</style>

<div class="container py-5">
    <div class="mb-4">
        <a href="javascript:history.back()" class="text-decoration-none text-secondary fw-medium small">
            <i class="bi bi-arrow-left-short fs-5 align-middle"></i> Kembali ke Struktur Organisasi
        </a>
    </div>

    <div class="row g-4">
        
        <div class="col-12 col-md-5 col-lg-4 mx-auto">
            <div class="card civitas-card-profile bg-white p-4 text-center">
                
                <div class="civitas-avatar-wrapper mb-3">
                    <img src="{{ asset('uploads/civitas/' . $detail_civitas->foto) }}" 
                         class="rounded-circle civitas-avatar" 
                         alt="Foto {{ $detail_civitas->nama_lengkap }}">
                </div>

                <div class="w-100 px-1 mb-1" style="white-space: nowrap; overflow: hidden;">
                    <h4 class="fw-bold text-dark mb-0 d-inline" style="font-size: 0.95rem;" title="{{ $detail_civitas->nama_lengkap }}">
                        {{ $detail_civitas->nama_lengkap }}
                    </h4>
                </div>
                <p class="text-muted small mb-1" style="color: #2e636e !important; font-weight: 500;">
                    {{ $detail_civitas->jabatan ?? 'Dosen / Staf Pengajar' }}
                </p>
                @if($detail_civitas->pangkat_golongan)
                    <span class="badge bg-light text-secondary border border-light-subtle px-2 py-1 small" style="font-size: 0.75rem;">
                        {{ $detail_civitas->pangkat_golongan }}
                    </span>
                @endif
                
                <hr class="opacity-10 my-3">

                <div class="text-start d-flex flex-column gap-2 small text-secondary">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-card-text text-muted"></i>
                        <span>NIP. {{ $detail_civitas->nip ?? '-' }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-building text-muted"></i>
                        <span>Prodi Promosi Kesehatan</span>
                    </div>
                    @if($detail_civitas->motto)
                        <div class="d-flex align-items-start gap-2 mt-2 pt-2 border-top border-light">
                            <i class="bi bi-quote text-warning fs-5 lh-1"></i>
                            <span class="fst-italic text-muted">{{ $detail_civitas->motto }}</span>
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <div class="col-12 col-md-8">
            
            <ul class="nav nav-pills custom-tabs mb-3 gap-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-bio-tab" data-bs-toggle="pill" data-bs-target="#pills-bio" type="button" role="tab" aria-controls="pills-bio" aria-selected="true">
                        <i class="bi bi-person-badge-fill me-1"></i> Biodata
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-edu-tab" data-bs-toggle="pill" data-bs-target="#pills-edu" type="button" role="tab" aria-controls="pills-edu" aria-selected="false">
                        <i class="bi bi-mortarboard-fill me-1"></i> Pendidikan
                    </button>
                </li>
            </ul>

            <div class="tab-content text-secondary" id="pills-tabContent">
                
                <div class="tab-pane fade show active p-4 tab-content-box" id="pills-bio" role="tabpanel" aria-labelledby="pills-bio-tab">
                    <h5 class="fw-bold text-dark mb-3 small tracking-wider text-uppercase" style="color: #2e636e !important;">Profil Singkat</h5>
                    <p style="text-align: justify; line-height: 1.7;">
                        <strong>{{ $detail_civitas->nama_lengkap }}</strong> merupakan <strong>{{ $detail_civitas->jabatan }}</strong> di Jurusan Promosi Kesehatan yang memiliki peran dalam mendukung berbagai kegiatan akademik maupun non-akademik, serta berkontribusi dalam menciptakan lingkungan organisasi yang aktif, inovatif, dan kolaboratif. Dengan semangat pengabdian dan kepedulian terhadap kesehatan masyarakat, beliau berkomitmen untuk memberikan kontribusi terbaik bagi kemajuan Jurusan Promosi Kesehatan.
                    </p>
                </div>

                <div class="tab-pane fade p-4 tab-content-box" id="pills-edu" role="tabpanel" aria-labelledby="pills-edu-tab">
                    <h5 class="fw-bold text-dark mb-4 small tracking-wider text-uppercase" style="color: #2e636e !important;">Riwayat Pendidikan</h5>
                    
                    <div class="timeline-education d-flex flex-column gap-4">
                        
                        @if($detail_civitas->s3_universitas)
                            <div class="timeline-item">
                                <span class="badge bg-dark mb-1 text-white">S3 - Doktor</span>
                                <h6 class="fw-bold text-dark mb-1">{{ $detail_civitas->s3_universitas }}</h6>
                                <p class="mb-0 small text-muted">
                                    Prodi: {{ $detail_civitas->s3_prodi ?? '-' }} 
                                    @if($detail_civitas->s3_peminatan) | Peminatan: {{ $detail_civitas->s3_peminatan }} @endif
                                    ({{ $detail_civitas->s3_tahun_lulus }} Lulus)
                                </p>
                            </div>
                        @endif

                        @if($detail_civitas->s2_universitas)
                            <div class="timeline-item">
                                <span class="badge bg-secondary mb-1 text-white" style="background-color: #2e636e !important;">S2 - Magister</span>
                                <h6 class="fw-bold text-dark mb-1">{{ $detail_civitas->s2_universitas }}</h6>
                                <p class="mb-0 small text-muted">
                                    Prodi: {{ $detail_civitas->s2_prodi ?? '-' }} 
                                    @if($detail_civitas->s2_peminatan) | Peminatan: {{ $detail_civitas->s2_peminatan }} @endif
                                    ({{ $detail_civitas->s2_tahun_lulus }} Lulus)
                                </p>
                            </div>
                        @endif

                        @if($detail_civitas->s1_universitas)
                            <div class="timeline-item">
                                <span class="badge bg-primary mb-1 text-white" style="background-color: #ff6200 !important;">S1 / D4 - Sarjana</span>
                                <h6 class="fw-bold text-dark mb-1">{{ $detail_civitas->s1_universitas }}</h6>
                                <p class="mb-0 small text-muted">
                                    Prodi: {{ $detail_civitas->s1_prodi ?? '-' }} 
                                    @if($detail_civitas->s1_peminatan) | Peminatan: {{ $detail_civitas->s1_peminatan }} @endif
                                    ({{ $detail_civitas->s1_tahun_lulus }} Lulus)
                                </p>
                            </div>
                        @endif

                        @if($detail_civitas->d3_universitas)
                            <div class="timeline-item">
                                <span class="badge bg-info mb-1 text-dark">D3 - Ahli Madya</span>
                                <h6 class="fw-bold text-dark mb-1">{{ $detail_civitas->d3_universitas }}</h6>
                                <p class="mb-0 small text-muted">Lulus Tahun {{ $detail_civitas->d3_tahun_lulus }}</p>
                            </div>
                        @endif

                        <div class="timeline-item">
                            <span class="badge bg-light text-dark border mb-1">SMA / Sederajat</span>
                            <h6 class="fw-bold text-dark mb-1">{{ $detail_civitas->sma_nama }}</h6>
                            <p class="mb-0 small text-muted">Lulus Tahun {{ $detail_civitas->sma_tahun_lulus }}</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection