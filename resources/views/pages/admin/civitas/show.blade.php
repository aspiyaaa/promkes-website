@extends('layouts.master_admin')

@section('title','Daftar Civitas')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            
            <!-- HEADER SECTION -->
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom gap-3">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-dark">Daftar Civitas Akademika</h2>
                    <p class="text-muted small mb-0">Manajemen data dosen dan tendik Jurusan Promosi Kesehatan</p>
                </div>
                <div>
                    <a href="/civitas/create" class="btn btn-primary rounded-3 px-3 py-2 shadow-sm d-flex align-items-center gap-2 fw-medium small">
                        <i class="bi bi-plus-lg fs-6"></i> &nbsp; Tambah Data Civitas
                    </a>
                </div>
            </div>

            <!-- ALERT NOTIFIKASI -->
            @if (session('pesan'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center p-3" role="alert">
                    <i class="bi bi-check-circle-fill me-3 fs-5 text-success"></i>
                    <div class="text-success fw-medium">{{ session('pesan') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- CARD UTAMA -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                
                <!-- CARD HEADER & SEARCH BAR -->
                <div class="card-header bg-white border-bottom-0 pt-4 pb-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.1rem;">Data Manajemen Civitas</h5>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2">
                        @if (Request()->keyword != '')
                            <a href="/civitas" class="btn btn-light border btn-sm rounded-3 d-flex align-items-center px-3 text-secondary" style="height: 36px; font-size: 0.85rem;">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        @endif
                        
                        <form class="input-group input-group-sm m-0" style="max-width: 320px;">
                            <input type="text" 
                                   class="form-control rounded-start-3 bg-light border-end-0 px-3" 
                                   name="keyword" placeholder="Cari data civitas..." value="{{ Request()->keyword }}" 
                                   style="height: 36px; font-size: 0.875rem;">
                            <button class="btn btn-light border border-start-0 text-muted rounded-end-3 px-3 d-flex align-items-center" type="submit" id="button-addon2" style="height: 36px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- TABLE SECTION -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                            <tr>
                                <th scope="col" class="py-3 ps-4 text-center" style="width: 8%">No</th>
                                <th scope="col" class="py-3 text-start" style="width: 30%">Nama Lengkap</th>
                                <th scope="col" class="py-3 text-start" style="width: 25%">NIP</th>
                                <th scope="col" class="py-3 text-start" style="width: 20%">Kategori</th>
                                <th scope="col" class="py-3 text-end pe-4 text-center" style="width: 17%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-secondary" style="font-size: 0.9rem;">
                            @forelse ($data_civitas as $data)
                            <tr>
                                <td class="ps-4 fw-medium text-muted text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $data->nama_lengkap }}</div>
                                </td>
                                <td>
                                    <span class="font-monospace text-secondary bg-light px-2 py-1 rounded small border border-light">{{ $data->nip }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1.5 rounded-2 fw-semibold" style="font-size: 0.8rem;">
                                        {{ $data->nama_kategori }}
                                    </span>
                                </td>
                                <td class="text-end pe-4 text-center">
                                    <div class="d-inline-flex gap-1">
                                        <a href="/civitas/{{$data->id_civitas}}" class="btn btn-sm btn-light border rounded-3 text-primary custom-action-btn shadow-xs" title="Lihat Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="/civitas/{{$data->id_civitas}}/edit" class="btn btn-sm btn-light border rounded-3 text-warning custom-action-btn shadow-xs" title="Ubah Konfigurasi">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light border rounded-3 text-danger custom-action-btn shadow-xs" data-bs-toggle="modal" data-bs-target="#hapus{{$data->id_civitas}}" title="Hapus Data">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <div class="py-3">
                                        <i class="bi bi-folder-x fs-1 d-block mb-3 text-secondary opacity-50"></i>
                                        <p class="mb-0 fw-medium">Data yang Anda cari tidak ditemukan atau masih kosong.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Extra space at the bottom of card for dynamic look -->
                <div class="card-footer bg-white border-top-0 py-3"></div>
            </div>

        </div>
    </div>
</div>

<!-- MODAL KONFIRMASI HAPUS -->
@foreach ($data_civitas as $data)
<div class="modal fade" id="hapus{{$data->id_civitas}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="max-width: 400px;">
        <form action="/civitas/{{$data->id_civitas}}" method="POST" class="modal-content border-0 shadow-lg rounded-4">
            @csrf
            @method('DELETE')
            <div class="modal-body p-4 text-center">
                <!-- Icon Warning Peringatan -->
                <div class="text-danger mb-3">
                    <i class="bi bi-exclamation-triangle fs-1"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Konfirmasi Hapus</h5>
                <p class="text-muted small mb-3">Apakah Anda yakin ingin menghapus data civitas berikut secara permanen? Tindakan ini tidak dapat dibatalkan.</p>
                
                <div class="p-3 bg-light rounded-3 fw-bold text-dark mb-4 border small">
                    {{ $data->nama_lengkap }}
                </div>
                
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light border rounded-3 px-3 py-2 w-50 small" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-3 px-3 py-2 w-50 small fw-bold">Ya, Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- CSS Tambahan Opsional untuk mempercantik Tombol Aksi Saja -->
<style>
    .btn-icon {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    .btn-icon:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .table-hover tbody tr:hover {
        background-color: rgba(248, 249, 250, 0.7);
    }
    .shadow-xs {
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .custom-btn-hover:hover {
        background-color: #e9ecef;
        color: #212529 !important;
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
</style>
@endsection