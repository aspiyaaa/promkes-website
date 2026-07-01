@extends('layouts.master_admin')

@section('title', 'Detail Masukan Pembaca')

@section('content_admin')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Masukan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/aspirasi') }}">Masukan & Saran</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span><i class="fas fa-info-circle me-1"></i> Subjek: <strong>{{ $data->subjek }}</strong></span>
            <span class="badge bg-light text-dark">{{ $data->created_at->format('d M Y, H:i') }} WIB</span>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6 border-end">
                    <h5 class="text-muted mb-3">Informasi Pengirim</h5>
                    <table class="table table-borderless fs-6">
                        <tr>
                            <th width="35%">Nama Pengirim</th>
                            <td>: {{ $data->nama_pengirim ?? 'Anonim (Dirahasiakan)' }}</td>
                        </tr>
                        <tr>
                            <th>Status/Peran</th>
                            <td>: 
                                @if($data->status_peran == 'mahasiswa_aktif')
                                    Mahasiswa Aktif
                                @elseif($data->status_peran == 'dosen_staf')
                                    Dosen / Staf Jurusan
                                @elseif($data->status_peran == 'alumni')
                                    Alumni Promkes
                                @else
                                    Masyarakat Umum
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Kategori Utama</th>
                            <td>: 
                                <span class="badge bg-warning text-dark text-uppercase">{{ str_replace('_', ' ', $data->kategori_masukan) }}</span>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5 class="text-muted mb-3">File Lampiran</h5>
                    @if($data->lampiran_file)
                        <div class="p-3 border border-dashed rounded bg-light d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-alt fa-2x text-primary me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Nama Berkas:</small>
                                    <span class="fw-bold text-truncate" style="max-width: 250px;">{{ $data->lampiran_file }}</span>
                                </div>
                            </div>
                            <a href="{{ asset('uploads/' . $data->lampiran_file) }}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i> Lihat / Unduh
                            </a>
                        </div>
                    @else
                        <div class="p-3 text-center border rounded bg-light text-muted">
                            <i class="fas fa-times-circle me-1"></i> Pengirim tidak menyertakan file lampiran.
                        </div>
                    @endif
                </div>
            </div>

            <hr>

            <div class="mb-3">
                <h5 class="text-muted mb-3">Isi Pesan / Saran / Kritik:</h5>
                <div class="p-4 border rounded bg-white shadow-sm" style="white-space: pre-wrap; line-height: 1.6; font-size: 1.1rem;">{{ $data->isi_pesan }}</div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ url('/aspirasi') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
            
            <form action="{{ url('/aspirasi/'.$data->id_aspirasi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus masukan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-1"></i> Hapus Permanen
                </button>
            </form>
        </div>
    </div>
</div>
@endsection