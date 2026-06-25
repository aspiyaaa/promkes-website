@extends('layouts.master_admin')

@section('title', 'Daftar Kategori')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            
            <!-- HEADER ACTION BAR (MODERN & RESPONSIF) -->
            <div class="d-flex flex-sm-row flex-column align-items-sm-center justify-content-between mb-4 pb-3 border-bottom gap-3">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-dark lh-sm">Manajemen Kategori Civitas</h2>
                    <p class="text-muted small mb-0">Atur dan klasifikasikan data struktur civitas akademik secara terpusat</p>
                </div>
                <div>
                    <a href="/kategori/create" class="btn btn-primary rounded-3 px-3 py-2 shadow-sm d-flex align-items-center gap-2 small fw-medium">
                        <i class="bi bi-plus-lg fs-6"></i> &nbsp; Tambah Kategori Baru
                    </a>
                </div>
            </div>

            <!-- FLOATING FLASH MESSAGE ALERT -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 p-3 d-flex align-items-center bg-white" role="alert" style="border-left: 4px solid #198754 !important;">
                    <div class="bg-success-subtle p-2 rounded-3 text-success d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                    </div>
                    <div class="text-dark small fw-medium">{{ session('success') }}</div>
                    <button type="button" class="btn-close mt-1 me-1" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- MAIN DATA CARD (MELAYANG/FLOATING LOOK) -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-bottom py-3.5 px-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0 fw-bold text-dark">Data Master Kategori</h6>
                        </div>
                        <!-- <span class="badge bg-light text-secondary border rounded-pill px-2.5 py-1 small fw-medium">Total: {{ count($kategori) }} Item</span> -->
                    </div>
                </div>

                <!-- TABLE LAYOUT -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped-columns align-middle mb-0 text-nowrap">
                        <thead class="table-light text-secondary text-uppercase fs-7 small border-bottom">
                            <tr>
                                <th scope="col" class="py-3 ps-4 text-center fw-bold" style="width: 8%">No</th>
                                <th scope="col" class="py-3 text-start fw-bold" style="width: 72%">Nama Kategori Terdaftar</th>
                                <th scope="col" class="py-3 text-center pe-4 fw-bold" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 border-0">
                            @forelse($kategori as $item)
                            <tr class="align-middle transition-row">
                                <td class="ps-4 fw-semibold text-muted text-center bg-light-subtle">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2.5 py-1">
                                        <div class="fw-bold text-dark fs-6">{{ $item->nama_kategori }}</div>
                                    </div>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <!-- Tombol Edit Gaya Modern -->
                                        <a href="/kategori/{{$item->id_kategori}}/edit" class="btn btn-action-edit border rounded-3 text-warning shadow-xs" title="Ubah Kategori">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <!-- Tombol Hapus Gaya Modern -->
                                        <button type="button" class="btn btn-action-delete border rounded-3 text-danger shadow-xs" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id_kategori }}" title="Hapus Kategori">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted bg-white">
                                    <div class="py-4">
                                        <i class="bi bi-folder-x display-5 d-block mb-3 text-secondary opacity-25"></i>
                                        <span class="fw-medium d-block text-secondary">Belum Ada Data Tersedia</span>
                                        <small class="text-muted opacity-75">Silakan klik tombol "Tambah Kategori" untuk menginput data baru.</small>
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

<!-- MODAL KONFIRMASI HAPUS (MODERN & CENTERED) -->
@foreach ($kategori as $item)
<div class="modal fade" id="hapus{{ $item->id_kategori }}" tabindex="-1" aria-labelledby="modalHapusLabel{{ $item->id_kategori }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <form action="/kategori/{{$item->id_kategori}}" method="POST" class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            @csrf
            @method('DELETE')
            
            <div class="modal-body p-4 text-center">
                <!-- Ikon Warning Hapus -->
                <div class="text-danger mb-3 d-inline-flex align-items-center justify-content-center bg-danger-subtle rounded-circle" style="width: 56px; height: 56px;">
                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                </div>
                
                <h5 class="fw-bold text-dark mb-2" id="modalHapusLabel{{ $item->id_kategori }}">Hapus Kategori?</h5>
                <p class="mb-3 text-secondary small lh-base">Tindakan ini bersifat permanen. Apakah Anda yakin ingin menghapus kategori ini?</p>
                
                <!-- Box Highlight Nama Kategori -->
                <div class="p-3 bg-light rounded-3 fw-bold text-primary border border-light-subtle fs-6 mb-2 text-truncate">
                    {{ $item->nama_kategori }}
                </div>
            </div>
            
            <div class="modal-footer border-top-0 pt-0 px-4 pb-4 d-flex gap-2">
                <button type="button" class="btn btn-light rounded-3 border flex-fill py-2 small fw-medium text-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger rounded-3 flex-fill py-2 small fw-bold shadow-xs">Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- STYLING KHUSUS PANEL ADMIN KATEGORI -->
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
    
    /* Hover Row Transisi Lembut */
    .transition-row {
        transition: background-color 0.15s ease-in-out;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.02) !important;
    }

    /* Kustomisasi Desain Tombol Aksi */
    .btn-action-edit, .btn-action-delete {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        padding: 0;
        font-size: 0.9rem;
        transition: all 0.2s ease-in-out;
    }
    .btn-action-edit:hover {
        background-color: #fff3cd !important;
        border-color: #ffc107 !important;
        color: #9a6e00 !important;
    }
    .btn-action-delete:hover {
        background-color: #f8d7da !important;
        border-color: #f5c2c7 !important;
        color: #842029 !important;
    }
</style>
@endsection