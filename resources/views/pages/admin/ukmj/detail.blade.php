@extends('layouts.master_admin')

@section('title', 'Detail Unit Kegiatan Mahasiswa Jurusan')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8">
            
            <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-gray-800">Detail Unit Kegiatan Mahasiswa Jurusan</h2>
                    <p class="text-muted small mb-0">Informasi profil lengkap dan aset media dari unit kegiatan mahasiswa.</p>
                </div>
                <a href="/ukmj" class="btn btn-outline-secondary btn-sm rounded-3 d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    <div class="row g-4 align-items-md-start">
                        
                        <div class="col-12 col-md-4 text-center">
                            <div class="p-3 bg-light rounded-4 border d-inline-block shadow-sm">
                                @if($detail_ukmj->logo)
                                    <img src="{{ asset('uploads/ukmj/' . $detail_ukmj->logo) }}" 
                                         alt="Logo {{ $detail_ukmj->nama_ukmj }}" 
                                         class="img-fluid rounded-3" 
                                         style="max-height: 200px; object-fit: contain;">
                                @else
                                    <div class="d-flex flex-column align-items-center justify-content-center text-muted" style="height: 180px; width: 180px;">
                                        <i class="bi bi-image fs-1 opacity-50 mb-2"></i>
                                        <span class="small fw-medium">Belum Ada Logo</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-md-8">
                            <div class="mb-3">
                                <label class="text-secondary small fw-bold text-uppercase">Nama Organisasi / Unit Kegiatan</label>
                                <h3 class="h4 fw-bold text-dark mt-1">{{ $detail_ukmj->nama_ukmj }}</h3>
                            </div>
                            
                            <hr class="opacity-10 my-3">

                            <div class="mb-3">
                                <label class="text-secondary small fw-bold text-uppercase">Tautan Media Sosial</label>
                                <div class="mt-1">
                                    @if($detail_ukmj->medsos)
                                        <a href="{{ $detail_ukmj->medsos }}" target="_blank" class="btn btn-link btn-sm text-primary p-0 text-decoration-none fw-medium">
                                            <i class="bi bi-box-arrow-up-right me-1"></i> Hubungkan ke Link Eksternal
                                        </a>
                                    @else
                                        <span class="text-muted small italic d-block">Media sosial belum dicantumkan.</span>
                                    @endif
                                </div>
                            </div>

                            <hr class="opacity-10 my-3">

                            <div class="mb-4">
                                <label class="text-secondary small fw-bold text-uppercase">Deskripsi Profil & Kegiatan</label>
                                <p class="text-dark mt-2 lh-base text-justify" style="white-space: pre-line;">{{ $detail_ukmj->deskripsi }}</p>
                            </div>

                            <hr class="opacity-10 my-3">

                            <div class="row text-muted small">
                                <div class="col-6">
                                    <i class="bi bi-calendar-plus me-1"></i> Input: {{ $detail_ukmj->created_at ? $detail_ukmj->created_at->format('d M Y, H:i') : '-' }}
                                </div>
                                <div class="col-6">
                                    <i class="bi bi-pencil-square me-1"></i> Update: {{ $detail_ukmj->updated_at ? $detail_ukmj->updated_at->format('d M Y, H:i') : '-' }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
                <div class="card-footer bg-light border-top-0 px-4 py-3 d-flex justify-content-end gap-2">
                    <a href="/ukmj/{{ $detail_ukmj->id_ukmj }}/edit" class="btn btn-warning rounded-3 btn-sm px-4 fw-bold shadow-sm">
                        <i class="bi bi-pencil-square me-1"></i> Ubah Data UKMJ
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection