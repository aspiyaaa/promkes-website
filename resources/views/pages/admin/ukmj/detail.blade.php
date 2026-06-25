@extends('layouts.master_admin')

@section('title', 'Detail Unit Kegiatan Mahasiswa Jurusan')

@section('content_admin')
<div class="container-fluid px-4 py-4" style="background-color: #f4f6f9; min-height: 100vh;">
    
    <div class="mb-4 pb-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h2 class="h4 mb-1 fw-bold text-dark">Detail Unit Kegiatan Mahasiswa Jurusan</h2>
            <p class="text-muted small mb-0">Informasi lengkap mengenai profil dan identitas organisasi UKMJ.</p>
        </div>
        <div>
            <a href="/ukmj" class="btn btn-primary rounded-3 px-3 py-2 small fw-medium shadow-sm d-inline-flex align-items-center gap-2" style="background-color: #4e73df; border-color: #4e73df;">
                <i class="bi bi-arrow-left"></i> &nbsp; Kembali
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden w-100 mb-4" style="border-top: 4px solid #0d6efd !important;">
        <div class="card-header bg-white border-bottom py-3 px-4">
            <h5 class="h6 mb-0 fw-semibold text-secondary">Informasi Profil Organisasi</h5>
        </div>

        <div class="card-body p-4 p-md-5 bg-white">
            <div class="row g-4 align-items-center align-items-md-start">
                
                <div class="col-12 col-md-4 col-lg-3 text-center text-md-start">
                    <div class="p-3 bg-light rounded-3 border d-inline-block shadow-sm">
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

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="mb-3">
                        <label class="text-secondary small fw-bold text-uppercase">Nama Organisasi / Unit Kegiatan</label>
                        <h3 class="h4 fw-bold text-dark mt-1">{{ $detail_ukmj->nama_ukmj }}</h3>
                    </div>
                    
                    <hr class="opacity-10 my-3">

                    <div class="mb-4">
                        <label class="text-secondary small fw-bold text-uppercase">Deskripsi Profil & Kegiatan</label>
                        <p class="text-dark lh-base text-justify" style="white-space: pre-line;">{{ $detail_ukmj->deskripsi }}</p>
                    </div>

                </div>
            </div>

            <div class="border-top mt-4 pt-4 d-flex align-items-center justify-content-end">
                <a href="/ukmj/{{ $detail_ukmj->id_ukmj }}/edit" class="btn rounded-3 px-4 py-2 small fw-medium text-white" style="background-color: #f1b434; border-color: #f1b434;">
                    <i class="bi bi-pencil-square me-1"></i> Ubah Data UKMJ
                </a>
            </div>
        </div>
    </div>
</div>
@endsection