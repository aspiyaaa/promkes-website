@extends('layouts.master_admin')

@section('title', 'Daftar Kategori')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom gap-3">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-gray-800">Manajemen Kategori Civitas</h2>
                    <p class="text-muted small mb-0">Kelola kategori data civitas kampus Anda di sini.</p>
                </div>
                <div>
                    <a href="/kategori/create" class="btn btn-primary rounded-3 px-3 shadow-sm d-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg"></i> Tambah Kategori
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5 text-success"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-bottom py-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <div class="d-flex align-items-center text-secondary">
                        <h6 class="mb-0 fw-bold">Data Kategori Civitas</h6>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-nowrap">
                        <thead class="table-light text-secondary text-uppercase fs-7 small">
                            <tr>
                                <th scope="col" class="py-3 ps-4 text-center" style="width: 10%">No</th>
                                <th scope="col" class="py-3 text-start" style="width: 65%">Nama Kategori</th>
                                <th scope="col" class="py-3 text-end pe-4" style="width: 25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @forelse($kategori as $item)
                            <tr>
                                <td class="ps-4 fw-medium text-muted text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->nama_kategori }}</div>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-1">
                                        <a href="/kategori/{{$item->id_kategori}}/edit" class="btn btn-sm btn-light border rounded-3 text-warning" title="Ubah Data">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light border rounded-3 text-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id_kategori }}" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                    Belum ada data kategori tersedia.
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

@foreach ($kategori as $item)
<div class="modal fade" id="hapus{{ $item->id_kategori }}" tabindex="-1" aria-labelledby="modalHapusLabel{{ $item->id_kategori }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/kategori/{{$item->id_kategori}}" method="POST" class="modal-content border-0 shadow rounded-4">
            @csrf
            @method('DELETE')
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark fs-5" id="modalHapusLabel{{ $item->id_kategori }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                <p class="mb-1 text-secondary">Apakah Anda yakin ingin menghapus kategori berikut secara permanen?</p>
                <div class="p-2 bg-light rounded-3 fw-bold text-dark mt-2 text-center small">
                    {{ $item->nama_kategori }}
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-light rounded-3 border px-3 btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger rounded-3 px-4 btn-sm fw-bold">Ya, Hapus Data</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection