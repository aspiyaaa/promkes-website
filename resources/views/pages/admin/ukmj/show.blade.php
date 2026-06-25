@extends('layouts.master_admin')

@section('title', 'Daftar Unit Kegiatan Mahasiswa Jurusan')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            
            <div class="d-flex flex-sm-row flex-column align-items-sm-center justify-content-between mb-4 pb-3 border-bottom gap-3">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-dark lh-sm">Daftar Unit Kegiatan Mahasiswa Jurusan</h2>
                    <p class="text-muted small mb-0">Manajemen data Unit Kegiatan Mahasiswa di Jurusan Promosi Kesehatan.</p>
                </div>
                <div>
                    <a href="/ukmj/create" class="btn btn-primary rounded-3 px-3 py-2 text-white shadow-xs d-inline-flex align-items-center gap-2 small fw-bold">
                        <i class="bi bi-plus-lg fs-6"></i> &nbsp; Tambah Data UKMJ
                    </a>
                </div>
            </div>

            @if (session('pesan'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center p-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2.5 fs-5 text-success"></i>
                    <div class="fw-medium text-success small">{{ session('pesan') }}</div>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close" style="top: 14px;"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="border-top: 4px solid #0d6efd !important;">
                
                <div class="card-header bg-white border-bottom py-3.5 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div class="d-flex align-items-center gap-2 text-dark">
                        <h6 class="mb-0 fw-bold">Data Manajemen UKMJ</h6>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2">
                        @if (Request()->keyword != '')
                            <a href="/ukmj" class="btn btn-light border btn-sm rounded-3 d-flex align-items-center px-3 text-secondary" style="height: 36px; font-size: 0.85rem;">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        @endif
                        
                        <form class="input-group input-group-sm m-0" style="max-width: 320px;" method="GET" action="/ukmj">
                            <input type="text" 
                                   class="form-control rounded-start-3 bg-light border-end-0 px-3" 
                                   name="keyword" placeholder="Cari data ukmj..." value="{{ Request()->keyword }}"
                                   style="height: 36px; font-size: 0.875rem;">
                            <button class="btn btn-light border border-start-0 text-muted rounded-end-3 px-3 d-flex align-items-center" type="submit" id="button-addon2" style="height: 36px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-nowrap custom-table-hover">
                        <thead class="table-light text-secondary text-uppercase fs-7 small border-bottom fw-bold">
                            <tr>
                                <th scope="col" class="py-3.5 ps-4 text-center" style="width: 5%">No</th>
                                <th scope="col" class="py-3.5 text-center" style="width: 15%">Logo</th>
                                <th scope="col" class="py-3.5 text-start" style="width: 30%">Nama Unit Kegiatan</th>
                                <th scope="col" class="py-3.5 text-start" style="width: 35%">Media Sosial</th>
                                <th scope="col" class="py-3.5 text-center pe-4" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 border-top-0">
                            @forelse ($data_ukmj as $data)
                            <tr>
                                <td class="ps-4 fw-bold text-muted text-center small">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-center py-3">
                                    @if($data->logo)
                                        <div class="d-inline-block p-1 bg-light rounded-3 border shadow-xs">
                                            <img src="{{ asset('uploads/ukmj/' . $data->logo) }}" alt="Logo {{ $data->nama_ukmj }}" class="rounded-2" style="height: 42px; width: 42px; object-fit: cover;">
                                        </div>
                                    @else
                                        <span class="badge bg-light text-secondary border px-2.5 py-1.5 rounded-3 fw-medium small opacity-75">
                                            <i class="bi bi-image me-1"></i> Tanpa Logo
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold text-dark fs-6">{{ $data->nama_ukmj }}</div>
                                    <div class="text-muted small opacity-75 mt-0.5">ID Komponen: #UKMJ-{{ $data->id_ukmj }}</div>
                                </td>
                                <td>
                                    @if($data->medsos && $data->medsos != '-')
                                        <span class="text-decoration-none badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-semibold small d-inline-flex align-items-center gap-1.5">
                                            {{ $data->medsos }}
                                        </span>
                                    @else
                                        <span class="text-muted small fw-medium italic opacity-50">-</span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-inline-flex gap-1.5">
                                        <a href="/ukmj/{{ $data->id_ukmj }}" class="btn btn-sm btn-light border rounded-3 text-primary custom-action-btn shadow-xs" title="Lihat Detail Profil">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="/ukmj/{{ $data->id_ukmj }}/edit" class="btn btn-sm btn-light border rounded-3 text-warning custom-action-btn shadow-xs" title="Ubah Konfigurasi">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light border rounded-3 text-danger custom-action-btn shadow-xs" data-bs-toggle="modal" data-bs-target="#hapus{{ $data->id_ukmj }}" title="Hapus Permanen">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <div class="py-4">
                                        <i class="bi bi-folder-x text-black-50 opacity-25" style="font-size: 3.5rem;"></i>
                                        <h5 class="fw-bold text-dark mt-3 mb-1 fs-6">Data Tidak Ditemukan</h5>
                                        <p class="text-muted small mb-0 px-3">Kata kunci pencarian Anda tidak cocok dengan record entitas UKMJ mana pun di sistem.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@foreach ($data_ukmj as $data)
<div class="modal fade" id="hapus{{ $data->id_ukmj }}" tabindex="-1" aria-labelledby="modalLabel{{ $data->id_ukmj }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
        <form action="/ukmj/{{ $data->id_ukmj }}" method="POST" class="modal-content border-0 shadow rounded-4 overflow-hidden">
            @csrf
            @method('DELETE')
            
            <div class="modal-body text-center p-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle mb-3 p-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-exclamation-triangle-fill fs-3"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2" id="modalLabel{{ $data->id_ukmj }}">Konfirmasi Hapus Data</h5>
                <p class="text-muted small mb-4 px-2">Tindakan ini bersifat ireversibel. Apakah Anda yakin ingin menghapus data unit kegiatan mahasiswa jurusan ini dari database?</p>
                
                <div class="p-3 bg-light rounded-3 fw-bold text-primary border text-center small mb-2 border-dashed">
                    <i class="bi bi-layers me-1.5"></i> {{ $data->nama_ukmj }}
                </div>
            </div>
            
            <div class="modal-footer bg-light border-top p-3 d-flex gap-2 justify-content-center">
                <button type="button" class="btn btn-light rounded-3 border px-4 py-2 small fw-medium text-secondary flex-grow-1" data-bs-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-danger rounded-3 px-4 py-2 small fw-bold flex-grow-1">Ya, Hapus Data</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<style>
    body {
        background-color: #f8f9fa;
    }
    .shadow-xs {
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .py-3\.5 {
        padding-top: 0.85rem !important;
        padding-bottom: 0.85rem !important;
    }
    .me-2\.5 {
        margin-right: 0.65rem !important;
    }
    .fs-7 {
        font-size: 0.8rem !important;
    }
    .custom-btn-hover:hover {
        background-color: #e9ecef;
        color: #212529 !important;
    }
    .custom-search-input {
        border-color: #dee2e6;
    }
    .custom-search-input:focus {
        background-color: #ffffff !important;
        border-color: #86b7fe;
        box-shadow: none;
    }
    .custom-table-hover tbody tr {
        transition: background-color 0.15s ease-in-out;
    }
    .custom-table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.015) !important;
    }
    .custom-action-btn {
        transition: all 0.2s ease-in-out;
    }
    .custom-action-btn:hover {
        transform: translateY(-1px);
        background-color: #ffffff !important;
    }
    .btn-light.text-primary:hover { border-color: #0d6efd !important; color: #0a58ca !important; }
    .btn-light.text-warning:hover { border-color: #ffc107 !important; color: #ffcd39 !important; }
    .btn-light.text-danger:hover { border-color: #dc3545 !important; color: #a52834 !important; }
    
    .border-dashed {
        border-style: dashed !important;
    }
    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.08) !important;
    }
    .bg-danger-subtle {
        background-color: rgba(220, 53, 69, 0.1) !important;
    }
</style>
@endsection