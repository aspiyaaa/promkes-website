@extends('layouts.master_admin')

@section('title', 'Daftar Berita')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom gap-3">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-gray-800">Daftar Konten Berita</h2>
                    <p class="text-muted small mb-0">Manajemen publikasi artikel, pengumuman, dan berita Jurusan Promosi Kesehatan</p>
                </div>
                <div>
                    <a href="/berita/create" class="btn btn-primary rounded-3 px-3 shadow-sm d-flex align-items-center gap-2 text-decoration-none">
                        <i class="bi bi-plus-lg"></i> Tambah Data Berita
                    </a>
                </div>
            </div>

            @if (session('pesan'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5 text-success"></i>
                    <div>{{ session('pesan') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                
                <div class="card-header bg-white border-bottom py-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <div class="d-flex align-items-center text-secondary">
                        <h6 class="mb-0 fw-bold">Data Manajemen Berita</h6>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2">
                        @if (Request()->keyword != '')
                            <a href="/berita" class="btn btn-outline-secondary btn-sm rounded-3 d-flex align-items-center px-3 text-decoration-none" style="height: 31px; font-size: 0.85rem;">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        @endif
                        
                        <form class="input-group input-group-sm m-0" style="max-width: 320px;">
                            <input type="text" class="form-control rounded-start-3" name="keyword" placeholder="Cari judul berita..." value="{{ Request()->keyword }}" style="height: 31px;">
                            <button class="btn btn-dark rounded-end-3 px-3 d-flex align-items-center" type="submit" id="button-addon2" style="height: 31px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-nowrap">
                        <thead class="table-light text-secondary text-uppercase fs-7 small">
                            <tr class="text-center">
                                <th scope="col" class="py-3 ps-4 text-center" style="width: 5%">No</th>
                                <th scope="col" class="py-3 text-start" style="width: 35%">Judul Berita</th>
                                <th scope="col" class="py-3 text-center" style="width: 15%">Penulis / Author</th>
                                <th scope="col" class="py-3 text-center" style="width: 15%">Status</th>
                                <th scope="col" class="py-3 text-center" style="width: 15%">Tanggal Dibuat</th>
                                <th scope="col" class="py-3 text-end pe-4" style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @forelse ($data_berita as $data)
                            <tr>
                                <td class="ps-4 fw-medium text-muted text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-bold text-dark text-wrap" style="max-width: 350px;">
                                        {{ Str::limit($data->title, 65) }}
                                    </div>
                                    <small class="text-muted d-block font-monospace small">slug: /{{ $data->slug }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="text-secondary small">{{ $data->author }}</span>
                                </td>
                                <td class="text-center">
                                    @if ($data->status == 'published')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1.5 rounded-2 fw-medium">Published</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning-dominant border border-warning-subtle px-2 py-1.5 rounded-2 fw-medium text-dark">Draft</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="text-secondary small">{{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->format('d M Y') : '-' }}</span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-1">
                                        <a href="/berita/{{ $data->slug }}" class="btn btn-sm btn-light border rounded-3 text-info" title="Detail Data">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="/berita/{{ $data->id_berita }}/edit" class="btn btn-sm btn-light border rounded-3 text-warning" title="Ubah Data">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light border rounded-3 text-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $data->id_berita }}" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                    Data berita yang Anda cari tidak ditemukan atau masih kosong.
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

@foreach ($data_berita as $data)
<div class="modal fade" id="hapus{{ $data->id_berita }}" tabindex="-1" aria-labelledby="modalHapusLabel{{ $data->id_berita }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/berita/{{ $data->id_berita }}" method="POST" class="modal-content border-0 shadow rounded-4">
            @csrf
            @method('DELETE')
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark fs-5" id="modalHapusLabel{{ $data->id }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                <p class="mb-1 text-secondary">Apakah Anda yakin ingin menghapus artikel berita berikut beserta file gambarnya secara permanen?</p>
                <div class="p-2 bg-light rounded-3 fw-bold text-dark mt-2 text-center small text-wrap">
                    {{ $data->title }}
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