@extends('layouts.master')

@section('content')
<div class="container">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-11 col-lg-10">
                
                <div class="card border border-secondary-subtle shadow-sm rounded-4 overflow-hidden bg-white p-2 p-sm-3">
                    <div class="card-body p-0 d-flex justify-content-center align-items-center">
                        
                        <img src="{{ asset('assets/struktur.png') }}" 
                            class="img-fluid rounded-3 w-100 shadow-sm" 
                            alt="Struktur Organisasi Jurusan"
                            style="max-width: 100%; height: auto; object-fit: contain;">
                            
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <hr class="mb-4 opacity-25">

    <!-- ==================== KELOMPOK 1: DOSEN ==================== -->
    <div class="mb-5">
        <div class="text-center mb-4">
            <h4 class="fw-bold tracking-wide text-uppercase mb-1">Daftar Dosen</h4>
            <p class="text-muted small">Civitas Akademika Jurusan Promosi Kesehatan</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
            @php 
            
            $hasDosen = false; 
            
            @endphp
            
            @foreach ($data_civitas as $dosen)
                {{-- Angka 1 disesuaikan dengan id_kategori untuk Dosen di database Anda --}}
                @if ($dosen->kategori_id == 1) 
                    @php $hasDosen = true; @endphp
                    <div class="col d-flex justify-content-center">
                        <a href="/struktur/{{ $dosen->id_civitas }}" 
                        class="card border border-secondary-subtle shadow-sm text-center h-100 text-decoration-none civitas-card w-100" 
                        style="transition: all 0.2s ease-in-out;">
                            
                            <img src="{{ asset('uploads/civitas/' . $dosen->foto) }}" class="card-img-top" alt="Foto {{ $dosen->nama_lengkap }}" style="height: 300px; object-fit: cover;">
                            
                            <div class="card-body px-3 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="card-title fw-bold fs-6 mb-1 text-dark">{{ $dosen->nama_lengkap }}</h6>
                                    <p class="card-text text-muted small mb-2">{{ $dosen->jabatan }}</p>
                                </div>
                                @if($dosen->nip)
                                    <div class="mt-auto">
                                        <span class="badge bg-light text-secondary border fs-7">NIP. {{ $dosen->nip }}</span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach

            @if (!$hasDosen)
                <div class="col-12 text-center">
                    <p class="text-muted fst-italic">Belum ada data dosen yang tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    <hr class="my-5 opacity-25">

    <!-- ==================== KELOMPOK 2: TENAGA KEPENDIDIKAN ==================== -->
    <div class="mb-5">
        <div class="text-center mb-4">
            <h4 class="fw-bold tracking-wide text-uppercase mb-1">Tenaga Kependidikan / Staf</h4>
            <p class="text-muted small">Staf Administrasi & Akademik Jurusan Promosi Kesehatan</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
            @php $hasTendik = false; @endphp

            @foreach ($data_civitas as $dosen)
                {{-- Angka 2 disesuaikan dengan id_kategori untuk Tenaga Kependidikan di database Anda --}}
                @if ($dosen->kategori_id == 2)
                    @php $hasTendik = true; @endphp
                    <div class="col d-flex justify-content-center">
                        <a href="/struktur/{{ $dosen->id_civitas }}" 
                        class="card border border-secondary-subtle shadow-sm text-center h-100 text-decoration-none civitas-card w-100" 
                        style="transition: all 0.2s ease-in-out;">
                            
                            <img src="{{ asset('uploads/civitas/' . $dosen->foto) }}" class="card-img-top" alt="Foto {{ $dosen->nama_lengkap }}" style="height: 300px; object-fit: cover;">
                            
                            <div class="card-body px-3 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="card-title fw-bold fs-6 mb-1 text-dark">{{ $dosen->nama_lengkap }}</h6>
                                    <p class="card-text text-muted small mb-2">{{ $dosen->jabatan }}</p>
                                </div>
                                @if($dosen->nip)
                                    <div class="mt-auto">
                                        <span class="badge bg-light text-secondary border fs-7">NIP. {{ $dosen->nip }}</span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach

            @if (!$hasTendik)
                <div class="col-12 text-center">
                    <p class="text-muted fst-italic">Belum ada data tenaga kependidikan yang tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    <style>
        .civitas-card:hover {
            transform: translateY(-5px);
            border-color: #6c757d !important;
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
    </style>
</div>
@endsection