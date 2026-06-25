@extends('layouts.master_admin')

@section('title', 'Detail Civitas')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    
    <!-- HEADER ACTION BAR -->
    <div class="d-flex flex-sm-row flex-column align-items-sm-center justify-content-between mb-4 pb-3 border-bottom gap-3">
        <div>
            <h2 class="h4 mb-1 fw-bold text-dark lh-sm">Detail Informasi Civitas</h2>
            <p class="text-muted small mb-0">Manajemen berkas data personal, jabatan, dan riwayat akademis resmi</p>
        </div>
        <div>
            <a href="/civitas" class="btn btn-primary border btn-sm rounded-3 px-3 py-2 d-inline-flex align-items-center gap-2 small custom-btn-hover shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    <div class="row g-4">
        
        <!-- SISI KIRI: KARTU PROFIL UTAMA (MELAYANG/FLOATING) -->
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 position-sticky" style="top: 24px; border-top: 4px solid #0d6efd !important;">
                <div class="card-body pt-2">
                    
                    <!-- Frame Foto Profil -->
                    <div class="mb-4 d-inline-block position-relative">
                        @if($detail_civitas->foto)
                            <img src="{{ asset('uploads/civitas/' . $detail_civitas->foto) }}" 
                                 alt="Foto {{ $detail_civitas->nama_lengkap }}" 
                                 class="rounded-circle border border-4 border-white shadow" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-light text-muted d-flex flex-column align-items-center justify-content-center rounded-circle border border-4 border-white shadow mx-auto" style="width: 150px; height: 150px;">
                                <i class="bi bi-person-fill text-secondary opacity-50" style="font-size: 3rem;"></i>
                                <span class="style-muted-text fw-bold">TANPA FOTO</span>
                            </div>
                        @endif
                    </div>

                    <!-- Info Singkat -->
                    <h6 class="fw-bold mb-1 text-dark text-truncate px-2">{{ $detail_civitas->nama_lengkap }}</h6>
                    <p class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1.5 fw-semibold small mb-2">{{ $detail_civitas->jabatan }}</p>
                    <p class="text-muted small mb-4"><i class="bi bi-card-text me-1"></i> NIP: {{ $detail_civitas->nip ?? '-' }}</p>

                    <hr class="text-black-50 my-4 opacity-25">

                    <!-- Blok Motto Hidup -->
                    <div class="text-start p-3 bg-light rounded-3 border border-light-subtle position-relative overflow-hidden shadow-xs">
                        <!-- UKURAN ICON KUTIP DIPERKECIL -->
                        <div class="position-absolute end-0 bottom-0 opacity-10 text-secondary pe-2 pb-1" style="font-size: 1rem; line-height: 1;">
                            <i class="bi bi-quote"></i>
                        </div>
                        <small class="text-secondary d-block fw-bold small mb-1">Motto Hidup</small>
                        @if($detail_civitas->motto)
                            <span class="fst-italic text-dark text-medium lh-base">"{{ $detail_civitas->motto }}"</span>
                        @else
                            <span class="text-muted fst-italic small">"Belum ada motto hidup yang ditambahkan."</span>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <!-- SISI KANAN: RINCIAN DATA LENGKAP -->
        <div class="col-xl-8 col-lg-7">
            <div class="d-flex flex-column gap-4">
                
                <!-- BLOK DATA KEPEGAWAIAN -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 pb-2 border-bottom border-light-subtle">
                            <div class="bg-primary-subtle p-2 rounded-3 me-3 text-primary d-flex align-items-center justify-content-center shadow-xs" style="width: 36px; height: 36px;">
                                <i class="bi bi-person-vcard-fill fs-5"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Data Kepegawaian</h5>
                        </div>

                        <!-- Grid Data List -->
                        <div class="row g-3">
                            <div class="col-sm-6 py-2 border-bottom border-light-subtle">
                                <span class="d-block text-secondary small fw-medium mb-1">Nama Lengkap</span>
                                <span class="text-dark fw-bold">{{ $detail_civitas->nama_lengkap }}</span>
                            </div>
                            <div class="col-sm-6 py-2 border-bottom border-light-subtle">
                                <span class="d-block text-secondary small fw-medium mb-1">Nomor Induk Pegawai (NIP)</span>
                                <span class="text-dark fw-mono fw-bold">{{ $detail_civitas->nip ?? '-' }}</span>
                            </div>
                            <div class="col-sm-6 py-2 border-bottom border-light-subtle">
                                <span class="d-block text-secondary small fw-medium mb-1">Pangkat / Golongan</span>
                                <span class="text-dark fw-medium">{{ $detail_civitas->pangkat_golongan ?? '-' }}</span>
                            </div>
                            <div class="col-sm-6 py-2 border-bottom border-light-subtle">
                                <span class="d-block text-secondary small fw-medium mb-1">Kategori Civitas</span>
                                <span class="text-dark fw-medium"><i class="bi bi-tag-fill me-1 small text-muted"></i>{{ $detail_civitas->nama_kategori ?? '-' }}</span>
                            </div>
                            <div class="col-12 py-2">
                                <span class="d-block text-secondary small fw-medium mb-1">Jabatan Struktural Utama</span>
                                <span class="text-dark fw-medium">{{ $detail_civitas->jabatan ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BLOK RIWAYAT PENDIDIKAN TINGGI -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 pb-2 border-bottom border-light-subtle">
                            <div class="p-2 rounded-3 me-3 d-flex align-items-center text-primary justify-content-center" style="width: 36px; height: 36px;">
                                <i class="bi bi-mortarboard-fill fs-5"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Riwayat Pendidikan Tinggi</h5>
                        </div>

                        <!-- TIMELINE AKADEMIK -->
                        <div class="academic-timeline ps-2">
                            
                            <!-- JALUR S3 -->
                            <div class="timeline-item pb-4 position-relative">
                                <div class="timeline-badge bg-warning text-light"><i class="bi bi-mortarboard"></i></div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="fw-bold text-dark mb-0">Program Doktor (S3)</h6>
                                    @if($detail_civitas->s3_universitas)
                                        <span class="badge bg-secondary text-white rounded px-2.5 py-1 small">Lulus Tahun: {{ $detail_civitas->s3_tahun_lulus ?? '-' }}</span>
                                    @endif
                                </div>
                                @if($detail_civitas->s3_universitas)
                                    <div class="card bg-light border-0 rounded-3 p-3 mt-2 shadow-xs">
                                        <div class="row g-3">
                                            <div class="col-md-6"><small class="text-muted d-block mb-0.5">Universitas</small><span class="fw-semibold text-dark">{{ $detail_civitas->s3_universitas }}</span></div>
                                            <div class="col-md-6"><small class="text-muted d-block mb-0.5">Program Studi</small><span class="fw-medium text-dark">{{ $detail_civitas->s3_prodi ?? '-' }}</span></div>
                                            <div class="col-12 border-top border-white pt-2"><small class="text-muted d-block mb-0.5">Peminatan / Konsentrasi</small><span class="text-dark fw-medium">{{ $detail_civitas->s3_peminatan ?? '-' }}</span></div>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted fst-italic small mb-0 mt-1 ps-1">Tidak menempuh/belum mengisi jenjang pendidikan S3.</p>
                                @endif
                            </div>

                            <!-- JALUR S2 -->
                            <div class="timeline-item pb-4 position-relative">
                                <div class="timeline-badge bg-info text-white"><i class="bi bi-mortarboard"></i></div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="fw-bold text-dark mb-0">Program Magister (S2)</h6>
                                    @if($detail_civitas->s2_universitas)
                                        <span class="badge bg-secondary text-white rounded px-2.5 py-1 small">Lulus Tahun: {{ $detail_civitas->s2_tahun_lulus ?? '-' }}</span>
                                    @endif
                                </div>
                                @if($detail_civitas->s2_universitas)
                                    <div class="card bg-light border-0 rounded-3 p-3 mt-2 shadow-xs">
                                        <div class="row g-3">
                                            <div class="col-md-6"><small class="text-muted d-block mb-0.5">Universitas</small><span class="fw-semibold text-dark">{{ $detail_civitas->s2_universitas }}</span></div>
                                            <div class="col-md-6"><small class="text-muted d-block mb-0.5">Program Studi</small><span class="fw-medium text-dark">{{ $detail_civitas->s2_prodi ?? '-' }}</span></div>
                                            <div class="col-12 border-top border-white pt-2"><small class="text-muted d-block mb-0.5">Peminatan / Konsentrasi</small><span class="text-dark fw-medium">{{ $detail_civitas->s2_peminatan ?? '-' }}</span></div>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted fst-italic small mb-0 mt-1 ps-1">Tidak menempuh/belum mengisi jenjang pendidikan S2.</p>
                                @endif
                            </div>

                            <!-- JALUR S1 / D4 -->
                            <div class="timeline-item position-relative">
                                <div class="timeline-badge bg-success text-white"><i class="bi bi-mortarboard"></i></div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="fw-bold text-dark mb-0">Program Sarjana / D4 (S1)</h6>
                                    @if($detail_civitas->s1_universitas)
                                        <span class="badge bg-secondary text-white rounded px-2.5 py-1 small">Lulus Tahun: {{ $detail_civitas->s1_tahun_lulus ?? '-' }}</span>
                                    @endif
                                </div>
                                @if($detail_civitas->s1_universitas)
                                    <div class="card bg-light border-0 rounded-3 p-3 mt-2 shadow-xs">
                                        <div class="row g-3">
                                            <div class="col-md-6"><small class="text-muted d-block mb-0.5">Universitas</small><span class="fw-semibold text-dark">{{ $detail_civitas->s1_universitas }}</span></div>
                                            <div class="col-md-6"><small class="text-muted d-block mb-0.5">Program Studi</small><span class="fw-medium text-dark">{{ $detail_civitas->s1_prodi ?? '-' }}</span></div>
                                            <div class="col-12 border-top border-white pt-2"><small class="text-muted d-block mb-0.5">Peminatan / Konsentrasi</small><span class="text-dark fw-medium">{{ $detail_civitas->s1_peminatan ?? '-' }}</span></div>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted fst-italic small mb-0 mt-1 ps-1">Data pendidikan S1 tidak ditemukan.</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <!-- BLOK PENDIDIKAN MENENGAH & DIPLOMA -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 pb-2 border-bottom border-light-subtle">
                            <div class="bg-secondary-subtle p-2 rounded-3 me-3 text-secondary d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <i class="bi bi-building-fill fs-5"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Pendidikan Diploma & Menengah</h5>
                        </div>

                        <div class="row g-4">
                            <!-- D3 -->
                            <div class="col-md-6 border-end border-light-subtle pe-md-4">
                                <div class="p-3 bg-light rounded-3 border border-light-subtle h-100 shadow-xs">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="fw-bold text-dark small"><i class="bi bi-award text-primary me-1"></i> Diploma (D3)</span>
                                        @if($detail_civitas->d3_tahun_lulus)
                                            <span class="badge bg-secondary small text-white">Lulus: {{ $detail_civitas->d3_tahun_lulus }}</span>
                                        @endif
                                    </div>
                                    @if($detail_civitas->d3_universitas)
                                        <p class="mb-0 fw-medium text-dark small">{{ $detail_civitas->d3_universitas }}</p>
                                    @else
                                        <span class="text-muted fst-italic small">Data D3 kosong/tidak diisi.</span>
                                    @endif
                                </div>
                            </div>

                            <!-- SMA -->
                            <div class="col-md-6 ps-md-4">
                                <div class="p-3 bg-light rounded-3 border border-light-subtle h-100 shadow-xs">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="fw-bold text-dark small"><i class="bi bi-house-door text-success me-1"></i> SMA / Sederajat</span>
                                        @if($detail_civitas->sma_tahun_lulus)
                                            <span class="badge bg-secondary small text-white">Lulus: {{ $detail_civitas->sma_tahun_lulus }}</span>
                                        @endif
                                    </div>
                                    @if($detail_civitas->sma_nama)
                                        <p class="mb-0 fw-medium text-dark small">{{ $detail_civitas->sma_nama }}</p>
                                    @else
                                        <span class="text-muted fst-italic small">Data SMA kosong/tidak diisi.</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- TIMELINE STYLING FOR ACADEMIC PREFERENCE -->
<style>
    body {
        background-color: #f8f9fa;
    }
    .fw-mono {
        font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    }
    .shadow-xs {
        box-shadow: 0 2px 4px rgba(0,0,0,0.03);
    }
    .style-muted-text {
        font-size: 0.65rem;
        letter-spacing: 0.5px;
    }
    .custom-btn-hover:hover {
        background-color: #e9ecef;
        color: #212529 !important;
    }

    /* === TIMELINE DESIGN === */
    .academic-timeline {
        border-left: 2px solid #dee2e6;
    }
    .timeline-item {
        padding-left: 28px;
    }
    .timeline-item:not(:last-child)::before {
        content: "";
        position: absolute;
        left: -2px;
        top: 24px;
        bottom: 0;
        width: 2px;
        background-color: #dee2e6;
    }
    .timeline-badge {
        position: absolute;
        left: -13px;
        top: 0;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        box-shadow: 0 0 0 3px #ffffff;
    }
</style>
@endsection