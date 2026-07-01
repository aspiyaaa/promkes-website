@extends('layouts.master_admin')

@section('title', 'Manajemen Ruangan')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom gap-3">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-dark">Daftar Ruangan Jurusan</h2>
                    <p class="text-muted small mb-0">Manajemen sarana prasarana ruang kelas dan laboratorium Jurusan Promosi Kesehatan</p>
                </div>
                <div>
                    <a href="/ruangan/create" class="btn btn-primary rounded-3 px-3 py-2 shadow-sm d-flex align-items-center gap-2 fw-medium small">
                        <i class="bi bi-plus-lg fs-6"></i> &nbsp; Tambah Data Ruangan
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center p-3" role="alert">
                    <i class="bi bi-check-circle-fill me-3 fs-5 text-success"></i>
                    <div class="text-success fw-medium">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                
                <div class="card-header bg-white border-bottom-0 pt-4 pb-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.1rem;">Data Sarana Ruangan</h5>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2">
                        @if (Request()->keyword != '')
                            <a href="/ruangan" class="btn btn-light border btn-sm rounded-3 d-flex align-items-center px-3 text-secondary" style="height: 36px; font-size: 0.85rem;">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        @endif
                        
                        <form class="input-group input-group-sm m-0" style="max-width: 320px;">
                            <input type="text" 
                                   class="form-control rounded-start-3 bg-light border-end-0 px-3" 
                                   name="keyword" placeholder="Cari data ruangan..." value="{{ Request()->keyword }}" 
                                   style="height: 36px; font-size: 0.875rem;">
                            <button class="btn btn-light border border-start-0 text-muted rounded-end-3 px-3 d-flex align-items-center" type="submit" id="button-addon2" style="height: 36px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                            <tr>
                                <th scope="col" class="py-3 ps-4 text-center" style="width: 5%">No</th>
                                <th scope="col" class="py-3 text-start" style="width: 10%">Foto</th>
                                <th scope="col" class="py-3 text-start" style="width: 25%">Nama Ruangan</th>
                                <th scope="col" class="py-3 text-start" style="width: 15%">Tipe</th>
                                <th scope="col" class="py-3 text-start" style="width: 13%">Kapasitas</th>
                                <th scope="col" class="py-3 text-start" style="width: 15%">Status</th>
                                <th scope="col" class="py-3 text-center pe-4" style="width: 17%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-secondary" style="font-size: 0.9rem;">
                            @forelse ($ruangan as $data)
                            <tr>
                                <td class="ps-4 fw-medium text-muted text-center">{{ $loop->iteration }}</td>
                                <td>
                                    @if($data->foto_ruangan)
                                        <img src="{{ asset('uploads/ruangan/' . $data->foto_ruangan) }}" class="rounded-3 object-cover shadow-sm" style="width: 60px; height: 45px; object-fit: cover;" alt="{{ $data->nama_ruangan }}">
                                    @else
                                        <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded-3 border small" style="width: 60px; height: 45px; font-size: 0.75rem;">
                                            No Pic
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark mb-0">{{ $data->nama_ruangan }}</div>
                                    <span class="font-monospace text-muted small bg-light px-1.5 py-0.5 rounded border border-light" style="font-size: 0.75rem;">{{ $data->kode_ruangan }}</span>
                                </td>
                                <td>
                                    @if ($data->tipe_ruangan == 'kelas_teori')
                                        <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-2 fw-semibold" style="font-size: 0.8rem;">Kelas Teori</span>
                                    @elseif ($data->tipe_ruangan == 'laboratorium')
                                        <span class="badge bg-purple-subtle text-purple border border-purple-subtle px-2 py-1 rounded-2 fw-semibold" style="font-size: 0.8rem;">Laboratorium</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1 rounded-2 fw-semibold" style="font-size: 0.8rem;">Aula</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-medium text-dark"><i class="bi bi-people me-1 text-muted"></i> {{ $data->kapasitas }} <span class="text-muted small">Mhs</span></div>
                                    <div class="text-muted small" style="font-size: 0.75rem;"><i class="bi bi-geo-alt"></i> {{ Str::limit($data->lokasi, 18) }}</div>
                                </td>
                                <td>
                                    @if ($data->status == 'tersedia')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle d-inline-flex align-items-center gap-1 px-2 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">
                                            <span class="bg-success rounded-circle" style="width: 6px; height: 6px; display: inline-block;"></span> Tersedia
                                        </span>
                                    @elseif ($data->status == 'digunakan')
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle d-inline-flex align-items-center gap-1 px-2 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">
                                            <span class="bg-warning rounded-circle" style="width: 6px; height: 6px; display: inline-block;"></span> Digunakan
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle d-inline-flex align-items-center gap-1 px-2 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">
                                            <span class="bg-danger rounded-circle" style="width: 6px; height: 6px; display: inline-block;"></span> Perbaikan
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-inline-flex gap-1">
                                        <a href="/ruangan/{{ $data->kode_ruangan }}" class="btn btn-sm btn-light border rounded-3 text-primary custom-action-btn shadow-xs" title="Lihat Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="/ruangan/{{ $data->id_ruangan }}/edit" class="btn btn-sm btn-light border rounded-3 text-warning custom-action-btn shadow-xs" title="Ubah Konfigurasi">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light border rounded-3 text-danger custom-action-btn shadow-xs" data-bs-toggle="modal" data-bs-target="#hapus{{ $data->id_ruangan }}" title="Hapus Data">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <div class="py-3">
                                        <i class="bi bi-folder-x fs-1 d-block mb-3 text-secondary opacity-50"></i>
                                        <p class="mb-0 fw-medium">Data ruangan tidak ditemukan atau masih kosong.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="card-footer bg-white border-top-0 py-3"></div>
            </div>

        </div>
    </div>
</div>

@foreach ($ruangan as $data)
<div class="modal fade" id="hapus{{ $data->id_ruangan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="max-width: 400px;">
        <form action="/ruangan/{{ $data->id_ruangan }}" method="POST" class="modal-content border-0 shadow-lg rounded-4">
            @csrf
            @method('DELETE')
            <div class="modal-body p-4 text-center">
                <div class="text-danger mb-3">
                    <i class="bi bi-exclamation-triangle fs-1"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Konfirmasi Hapus</h5>
                <p class="text-muted small mb-3">Apakah Anda yakin ingin menghapus data ruangan berikut secara permanen? Tindakan ini akan menghapus file foto dari server.</p>
                
                <div class="p-3 bg-light rounded-3 fw-bold text-dark mb-4 border small">
                    {{ $data->nama_ruangan }} ({{ $data->kode_ruangan }})
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

<style>
    .bg-purple-subtle {
        background-color: rgba(111, 66, 193, 0.12);
        color: #6f42c1 !important;
    }
    .border-purple-subtle {
        border-color: rgba(111, 66, 193, 0.2) !important;
    }
    .text-purple {
        color: #6f42c1 !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(248, 249, 250, 0.7);
    }
    .shadow-xs {
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
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