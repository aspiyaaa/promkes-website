@extends('layouts.master_admin')

@section('title', 'Daftar Unit Kegiatan Mahasiswa Jurusan')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom gap-3">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-gray-800">Daftar Unit Kegiatan Mahasiswa Jurusan</h2>
                    <p class="text-muted small mb-0">Manajemen data Unit Kegiatan Mahasiswa di Jurusan Promosi Kesehatan</p>
                </div>
                <div>
                    <a href="/ukmj/create" class="btn btn-primary rounded-3 px-3 shadow-sm d-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg"></i> Tambah Data UKMJ
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
                        <h6 class="mb-0 fw-bold">Data Manajemen UKMJ</h6>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2">
                        @if (Request()->keyword != '')
                            <a href="/ukmj" class="btn btn-outline-secondary btn-sm rounded-3 d-flex align-items-center px-3" style="height: 31px; font-size: 0.85rem;">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        @endif
                        
                        <form class="input-group input-group-sm m-0" style="max-width: 320px;" method="GET" action="/ukmj">
                            <input type="text" class="form-control rounded-start-3" name="keyword" placeholder="Cari data ukmj..." value="{{ Request()->keyword }}" style="height: 31px;">
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
                                <th scope="col" class="py-3 text-center" style="width: 15%">Logo</th>
                                <th scope="col" class="py-3 text-start" style="width: 30%">Nama Unit Kegiatan</th>
                                <th scope="col" class="py-3 text-start" style="width: 35%">Media Sosial</th>
                                <th scope="col" class="py-3 text-end pe-4" style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @forelse ($data_ukmj as $data)
                            <tr>
                                <td class="ps-4 fw-medium text-muted text-center"> {{ $loop->iteration }} </td>
                                <td class="text-center">
                                    @if($data->logo)
                                        <img src="{{ asset('uploads/ukmj/' . $data->logo) }}" alt="Logo {{ $data->nama_ukmj }}" class="img-thumbnail rounded-3" style="max-height: 45px; max-width: 45px; object-fit: cover;">
                                    @else
                                        <span class="badge bg-light text-secondary border">No Logo</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $data->nama_ukmj }}</div>
                                </td>
                                <td class="text-center">
                                    @if($data->medsos)
                                        <a href="{{ $data->medsos }}" target="_blank" class="text-decoration-none fw-medium text-primary">
                                            <i class="bi bi-link-45deg me-1"></i>Link Sosmed
                                        </a>
                                    @else
                                        <span class="text-muted small italic">Tidak ada sosmed</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4 text-center">
                                    <div class="d-inline-flex gap-1">
                                        <a href="/ukmj/{{ $data->id_ukmj }}" class="btn btn-sm btn-light border rounded-3 text-info" title="Detail Data">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="/ukmj/{{ $data->id_ukmj }}/edit" class="btn btn-sm btn-light border rounded-3 text-warning" title="Ubah Data">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light border rounded-3 text-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $data->id_ukmj }}" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                    Data yang Anda cari tidak ditemukan atau masih kosong.
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
    <div class="modal-dialog modal-dialog-centered">
        <form action="/ukmj/{{ $data->id_ukmj }}" method="POST" class="modal-content border-0 shadow rounded-4">
            @csrf
            @method('DELETE')
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark fs-5" id="modalLabel{{ $data->id_ukmj }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                <p class="mb-1 text-secondary">Apakah Anda yakin ingin menghapus data unit kegiatan mahasiswa jurusan berikut secara permanen?</p>
                <div class="p-2 bg-light rounded-3 fw-bold text-dark mt-2 text-center small">
                    {{ $data->nama_ukmj }}
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