@extends('layouts.master_admin')

@section('title', 'Daftar Masukan Pembaca')

@section('content_admin')
<div class="container-fluid px-4">
    <h1 class="mt-4">Kotak Masukan Jurusan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Masukan & Saran</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i> Data Masukan & Kritik Terakhir
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle" id="datatablesSimple" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Pengirim</th>
                            <th width="15%">Status / Peran</th>
                            <th width="20%">Kategori</th>
                            <th width="25%">Subjek</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($all_aspirasi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_pengirim ?? 'Anonim' }}</td>
                            <td>
                                @if($item->status_peran == 'mahasiswa_aktif')
                                    <span class="badge bg-primary">Mahasiswa Aktif</span>
                                @elseif($item->status_peran == 'dosen_staf')
                                    <span class="badge bg-success">Dosen/Staf</span>
                                @elseif($item->status_peran == 'alumni')
                                    <span class="badge bg-info text-dark">Alumni</span>
                                @else
                                    <span class="badge bg-secondary">Umum</span>
                                @endif
                            </td>
                            <td>
                                @if($item->kategori_masukan == 'fasilitas_perkuliahan')
                                    <span class="text-danger fw-bold"><i class="fas fa-building me-1"></i>Fasilitas</span>
                                @elseif($item->kategori_masukan == 'kinerja_organisasi')
                                    <span class="text-warning fw-bold"><i class="fas fa-users me-1"></i>Organisasi</span>
                                @elseif($item->kategori_masukan == 'teknis_website')
                                    <span class="text-primary fw-bold"><i class="fas fa-globe me-1"></i>Website</span>
                                @else
                                    <span class="text-secondary fw-bold"><i class="fas fa-comment me-1"></i>Lainnya</span>
                                @endif
                            </td>
                            <td>{{ $item->subjek }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ url('/aspirasi/'.$item->id_aspirasi) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>
                                    
                                    <form action="{{ url('/aspirasi/'.$item->id_aspirasi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus masukan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada masukan atau saran yang dikirimkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection