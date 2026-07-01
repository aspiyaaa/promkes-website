@extends('layouts.master_admin')

@section('title', 'Detail Prestasi Mahasiswa Promkes')

@section('content_admin')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Data Prestasi</h1>
        <a href="/prestasi" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Informasi Detail -->
        <div class="col-lg-7 mb-4">
            <div class="card shadow border-left-info">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-info">Biodata & Informasi Kompetisi</h6>
                    <a href="/prestasi/{{ $prestasi->id_prestasi }}/edit" class="btn btn-warning btn-sm text-white shadow-sm">
                        <i class="fas fa-edit fa-sm"></i> Edit Data
                    </a>
                </div>
                <div class="card-body text-dark">
                    <dl class="row mb-0">
                        <!-- Nama Mahasiswa -->
                        <dt class="col-sm-4 mb-3 text-muted">Nama Mahasiswa</dt>
                        <dd class="col-sm-8 mb-3 font-weight-bold">{{ $prestasi->nama_mahasiswa }}</dd>

                        <!-- NIM -->
                        <dt class="col-sm-4 mb-3 text-muted">NIM</dt>
                        <dd class="col-sm-8 mb-3">{{ $prestasi->nim }}</dd>

                        <!-- Program Studi -->
                        <dt class="col-sm-4 mb-3 text-muted">Program Studi</dt>
                        <dd class="col-sm-8 mb-3"><span class="badge badge-light border px-2 py-1">{{ $prestasi->program_studi }}</span></dd>

                        <hr class="w-100 my-2">

                        <!-- Nama Kompetisi -->
                        <dt class="col-sm-4 mb-3 text-muted mt-2">Nama Kompetisi</dt>
                        <dd class="col-sm-8 mb-3 font-weight-bold text-primary mt-2">{{ $prestasi->nama_kompetisi }}</dd>

                        <!-- Pencapaian -->
                        <dt class="col-sm-4 mb-3 text-muted">Pencapaian / Juara</dt>
                        <dd class="col-sm-8 mb-3">
                            <span class="badge badge-success px-3 py-1 font-weight-bold">{{ $prestasi->pencapaian }}</span>
                        </dd>

                        <!-- Tingkat Lomba -->
                        <dt class="col-sm-4 mb-3 text-muted">Tingkat Lomba</dt>
                        <dd class="col-sm-8 mb-3">
                            @if($prestasi->tingkat == 'Internasional')
                                <span class="badge badge-danger">Internasional</span>
                            @elseif($prestasi->tingkat == 'Nasional')
                                <span class="badge badge-primary">Nasional</span>
                            @else
                                <span class="badge badge-warning text-dark">Wilayah</span>
                            @endif
                        </dd>

                        <!-- Penyelenggara -->
                        <dt class="col-sm-4 mb-3 text-muted">Penyelenggara</dt>
                        <dd class="col-sm-8 mb-3">{{ $prestasi->penyelenggara }}</dd>

                        <!-- Tahun Prestasi -->
                        <dt class="col-sm-4 mb-1 text-muted">Tahun Kegiatan</dt>
                        <dd class="col-sm-8 mb-1 font-weight-bold">{{ $prestasi->tahun_prestasi }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Lampiran Bukti File -->
        <div class="col-lg-5 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray-800">Bukti Lampiran</h6>
                </div>
                <div class="card-body text-center text-dark">
                    @if($prestasi->bukti_prestasi)
                        <p class="small text-muted text-left mb-2"><i class="fas fa-image mr-1"></i> Dokumentasi / Sertifikat:</p>
                        <div class="p-2 border bg-light rounded">
                            <img src="{{ asset('uploads/' . $prestasi->bukti_prestasi) }}" alt="Bukti Prestasi" class="img-fluid rounded shadow-sm" style="max-height: 350px; width: 100%; object-fit: contain;">
                        </div>
                        <div class="mt-3">
                            <a href="{{ asset('uploads/' . $prestasi->bukti_prestasi) }}" target="_blank" class="btn btn-outline-primary btn-sm btn-block">
                                <i class="fas fa-external-link-alt mr-1"></i> Buka Gambar Penuh
                            </a>
                        </div>
                    @else
                        <div class="py-5 text-muted">
                            <i class="fas fa-file-invoice fa-3x mb-3 text-gray-300"></i>
                            <p class="mb-0 small">Tidak ada berkas bukti gambar yang diunggah untuk prestasi ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection