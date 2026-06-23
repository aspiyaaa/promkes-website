@extends('layouts.master_admin')

@section('title', 'Daftar Galeri BKJ')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom gap-3">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-gray-800">Daftar Galeri BKJ</h2>
                    <p class="text-muted small mb-0">Manajemen dokumentasi foto kegiatan Badan Koordinasi Jurusan (BKJ)</p>
                </div>
                <div>
                    <a href="/galeri_bkj/create" class="btn btn-primary rounded-3 px-3 shadow-sm d-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg"></i> Tambah Dokumentasi Galeri
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
                        <h6 class="mb-0 fw-bold">Data Manajemen Galeri</h6>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2">
                        @if (Request()->keyword != '')
                            <a href="/galeri_bkj" class="btn btn-outline-secondary btn-sm rounded-3 d-flex align-items-center px-3" style="height: 31px; font-size: 0.85rem;">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        @endif
                        
                        <form class="input-group input-group-sm m-0" style="max-width: 320px;">
                            <input type="text" class="form-control rounded-start-3" name="keyword" placeholder="Cari keterangan foto..." value="{{ Request()->keyword }}" style="height: 31px;">
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
                                <th scope="col" class="py-3 text-start" style="width: 15%">Foto Kegiatan</th>
                                <th scope="col" class="py-3 text-start" style="width: 40%">Keterangan Dokumentasi</th>
                                <th scope="col" class="py-3 text-center" style="width: 25%">Organisasi / BKJ</th>
                                <th scope="col" class="py-3 text-end pe-4" style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @forelse ($data_galeri as $data)
                            <tr>
                                <td class="ps-4 fw-medium text-muted text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="rounded-3 overflow-hidden bg-light border d-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 50px;">
                                        @if($data->foto_kegiatan)
                                            <img src="{{ asset('uploads/galeri_bkj/' . $data->foto_kegiatan) }}" alt="Foto Kegiatan" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <i class="bi bi-image text-muted opacity-50"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark text-wrap" style="max-width: 380px;">
                                        {{ Str::limit($data->keterangan_foto ?? 'Tidak ada keterangan.', 80) }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-2 py-1.5 rounded-2 fw-medium">
                                        {{ $data->bkj->nama_bkj ?? 'Umum / Tanpa Organisasi' }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-1">
                                        <a href="/galeri_bkj/{{ $data->id_galeri_bkj }}" class="btn btn-sm btn-light border rounded-3 text-info" title="Detail Data">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="/galeri_bkj/{{ $data->id_galeri_bkj }}/edit" class="btn btn-sm btn-light border rounded-3 text-warning" title="Ubah Data">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light border rounded-3 text-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $data->id_galeri_bkj }}" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                    Data dokumentasi galeri tidak ditemukan atau masih kosong.
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

@foreach ($data_galeri as $data)
<div class="modal fade" id="hapus{{ $data->id_galeri_bkj }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/galeri_bkj/{{ $data->id_galeri_bkj }}" method="POST" class="modal-content border-0 shadow rounded-4">
            @csrf
            @method('DELETE')
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark fs-5" id="exampleModalLabel">Konfirmasi Hapus Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                <p class="mb-1 text-secondary">Apakah Anda yakin ingin menghapus dokumentasi kegiatan ini secara permanen?</p>
                <div class="p-3 bg-light rounded-3 text-dark mt-2 text-center small border">
                    <div class="text-muted mb-1 fs-7">Keterangan:</div>
                    <span class="fw-bold">{{ Str::limit($data->keterangan_foto ?? 'Tanpa Keterangan', 50) }}</span>
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