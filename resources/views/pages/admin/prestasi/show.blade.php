@extends('layouts.master_admin')

@section('title', 'Daftar Prestasi Mahasiswa Promkes')

@section('content_admin')
<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Prestasi Mahasiswa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Prestasi</li>
    </ol>

    <!-- Alert Sukses Setelah CRUD -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-trophy me-1"></i>
                Data Prestasi Mahasiswa Promkes
            </div>
            <!-- Tombol Tambah Data -->
            <a href="/prestasi/create" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Prestasi
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle" id="datatablesSimple" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Mahasiswa / NIM</th>
                            <th>Nama Kompetisi</th>
                            <th>Pencapaian</th>
                            <th>Tingkat</th>
                            <th>Penyelenggara / Tahun</th>
                            <th>Bukti</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prestasi as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $item->nama_mahasiswa }}</strong><br>
                                    <small class="text-muted">{{ $item->nim }}</small>
                                </td>
                                <td>{{ $item->nama_kompetisi }}</td>
                                <td>
                                    <span class="badge bg-success">{{ $item->pencapaian }}</span>
                                </td>
                                <td>
                                    @if($item->tingkat == 'Internasional')
                                        <span class="badge bg-danger">Internasional</span>
                                    @elseif($item->tingkat == 'Nasional')
                                        <span class="badge bg-primary">Nasional</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Wilayah</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->penyelenggara }} <br>
                                    <small class="text-muted">Tahun: {{ $item->tahun_prestasi }}</small>
                                </td>
                                <td>
                                    @if($item->bukti_prestasi)
                                        <img src="{{ asset('uploads/' . $item->bukti_prestasi) }}" alt="Bukti" class="img-thumbnail" style="max-height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted small">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <!-- Tombol Detail (Mengarah ke route /prestasi/{id}, di-pass id karena slug belum dibuat) -->
                                        <a href="/prestasi/{{ $item->id_prestasi }}" class="btn btn-info btn-sm text-white" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <!-- Tombol Edit -->
                                        <a href="/prestasi/{{ $item->id_prestasi }}/edit" class="btn btn-warning btn-sm text-white" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Form Hapus Data -->
                                        <form action="/prestasi/{{ $item->id_prestasi }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data prestasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada data prestasi mahasiswa yang tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection