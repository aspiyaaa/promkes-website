@extends('layouts.master_admin')

@section('title', 'Detail Galeri BKJ')

@section('content_admin')
<div class="my-3 mx-2">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span class="fw-bold">Detail Dokumentasi Kegiatan</span>
            <a href="/galeri_bkj" class="btn btn-info btn-sm text-white">Kembali ke Daftar</a>
        </div>
        
        <div class="card-body bg-white">
            <div class="row g-4">
                
                <div class="col-md-6 text-center border-end">
                    <div class="mb-3">
                        @if($detail_galeri->foto_kegiatan && file_exists(public_path('uploads/galeri_bkj/' . $detail_galeri->foto_kegiatan)))
                            <img src="{{ asset('uploads/galeri_bkj/' . $detail_galeri->foto_kegiatan) }}" alt="Foto Kegiatan {{ $detail_galeri->nama_bkj }}" class="img-thumbnail shadow-sm rounded" style="max-width: 100%; max-height: 400px; object-fit: contain;">
                        @else
                            <div class="bg-light text-muted d-flex align-items-center justify-content-center mx-auto img-thumbnail" style="width: 100%; height: 300px; max-width: 400px;">
                                <div class="text-center">
                                    <i class="bi bi-image text-secondary fs-1 d-block mb-2"></i>
                                    <span>Gambar Tidak Ditemukan</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <h5 class="text-primary border-bottom pb-2 mb-3 fw-bold">Informasi Dokumentasi</h5>
                    
                    <table class="table table-sm table-borderless mb-4">
                        <tr>
                            <td style="width: 35%" class="fw-bold text-secondary">Pelaksana (BKJ)</td>
                            <td style="width: 3%">:</td>
                            <td><span class="badge bg-primary fs-6">{{ $detail_galeri->nama_bkj }}</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-secondary">Tanggal Diunggah</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($detail_galeri->created_at)->translatedFormat('d F Y (H:i)') }} WIB</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-secondary">Pembaruan Terakhir</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($detail_galeri->updated_at)->translatedFormat('d F Y (H:i)') }} WIB</td>
                        </tr>
                    </table>

                    <h5 class="text-primary border-bottom pb-2 mb-3 fw-bold">Keterangan / Deskripsi Foto</h5>
                    <div class="p-3 bg-light rounded border">
                        <p class="mb-0 text-dark lh-base" style="white-space: pre-line;">{{ $detail_galeri->keterangan_foto }}</p>
                    </div>
                </div>

            </div> 
        </div> 
    </div> 
</div>
@endsection