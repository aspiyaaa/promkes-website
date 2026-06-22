@extends('layouts.master_admin')

@section('title', 'Dashboard Admin')

@section('content_admin')
<div class="container-fluid px-4 py-4">

    <div class="d-sm-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">Dashboard Overview</h1>
        <span class="text-muted small"><i class="fas fa-calendar-alt me-1"></i> Panel Manajemen Promkes</span>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 rounded-4 border-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Civitas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_civitas }} Orang</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 rounded-4 border-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Badan Kelengkapan (BKJ)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_bkj }} Organisasi</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 rounded-4 border-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Unit Kegiatan (UKMJ)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_ukmj }} Unit</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-running fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 rounded-4 border-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Data Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_kategori }} Kategori</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-7 mb-4">
            <div class="card shadow border-0 rounded-4 bg-gradient-primary text-white p-3">
                <div class="card-body">
                    <h4 class="fw-bold mb-2">Selamat Datang Kembali, Admin! 👋</h4>
                    <p class="small mb-4 opacity-75">Melalui halaman ini, Anda dapat mengelola seluruh data civitas akademik, kategori konten, sistem data Badan Kelengkapan Jurusan (BKJ), serta Unit Kegiatan Mahasiswa Jurusan (UKMJ) Promosi Kesehatan dengan cepat.</p>
                    <a href="/civitas" class="btn btn-light btn-sm rounded-3 fw-bold px-3 text-primary shadow-sm">
                        Mulai Kelola Civitas <i class="fas fa-arrow-right ms-1 fa-sm"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-5 mb-4">
            <div class="card shadow border-0 rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4">
                    <h6 class="m-0 font-weight-bold text-dark text-uppercase small tracking-wide"><i class="fas fa-bolt text-warning mr-1"></i> Akses Cepat Konten</h6>
                </div>
                <div class="card-body d-flex flex-column gap-2 justify-content-center">
                    <a href="/ukmj/create" class="btn btn-outline-dark btn-sm rounded-3 text-left py-2 px-3 d-flex align-items-center justify-content-between">
                        <span><i class="fas fa-plus-circle mr-2 text-info"></i> Tambah Data Baru UKMJ</span>
                        <i class="fas fa-chevron-right fa-xs opacity-50"></i>
                    </a>
                    <a href="/badan_kelengkapan_jurusan/create" class="btn btn-outline-dark btn-sm rounded-3 text-left py-2 px-3 d-flex align-items-center justify-content-between">
                        <span><i class="fas fa-plus-circle mr-2 text-success"></i> Tambah Data Baru BKJ</span>
                        <i class="fas fa-chevron-right fa-xs opacity-50"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection