@extends('layouts.master_admin')

@section('title', 'Detail Berita')

@section('content_admin')
<div class="my-3 mx-2">
    <div class="card shadow-sm">
        <!-- Header Tampilan Detail Berita -->
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span class="fw-bold">Konten Berita: {{ $detail_berita->title }}</span>
            <a href="/berita" class="btn btn-info btn-sm text-white">Kembali ke Daftar</a>
        </div>
        
        <div class="card-body bg-white">
            <div class="row g-4">
                
                <!-- Sisi Kiri: Preview Sampul / Gambar Thumbnail & Metadata Singkat -->
                <div class="col-md-4 text-center border-end">
                    <div class="mb-3">
                        @if($detail_berita->thumbnail)
                            <img src="{{ asset('uploads/berita/' . $detail_berita->thumbnail) }}" alt="Thumbnail {{ $detail_berita->title }}" class="img-thumbnail shadow-sm mb-3" style="max-height: 280px; object-fit: cover;">
                        @else
                            <div class="bg-light text-muted d-flex align-items-center justify-content-center mx-auto img-thumbnail" style="width: 250px; height: 180px;">
                                <span>Tidak Ada Thumbnail</span>
                            </div>
                        @endif
                    </div>
                    <h5 class="fw-bold mb-1">{{ $detail_berita->title }}</h5>
                    <p class="text-muted small mb-3">Oleh: {{ $detail_berita->author }}</p>
                    
                    <!-- Badge Status Publikasi -->
                    <div class="p-3 bg-light rounded text-start">
                        <small class="text-secondary d-block fw-bold mb-1">Status Publikasi:</small>
                        @if($detail_berita->status == 'published')
                            <span class="badge bg-success fs-7 px-3 py-2">Published / Terbit</span>
                        @else
                            <span class="badge bg-secondary fs-7 px-3 py-2">Draft / Arsip</span>
                        @endif
                    </div>
                </div>

                <!-- Sisi Kanan: Informasi Detail Dokumen & Konten Utama Berita -->
                <div class="col-md-8">
                    <!-- Lembar Metadata Sistem -->
                    <h5 class="text-primary border-bottom pb-2 mb-3 fw-bold">Informasi Artikel</h5>
                    <table class="table table-sm table-borderless mb-4">
                        <tr>
                            <td style="width: 30%" class="fw-bold text-secondary">Judul Artikel</td>
                            <td style="width: 3%">:</td>
                            <td>{{ $detail_berita->title }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-secondary">Penulis / Author</td>
                            <td>:</td>
                            <td>{{ $detail_berita->author }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-secondary">Tanggal Dibuat</td>
                            <td>:</td>
                            <td>{{ $detail_berita->created_at ? $detail_berita->created_at->format('d F Y, H:i') . ' WIB' : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-secondary">Pembaruan Terakhir</td>
                            <td>:</td>
                            <td>{{ $detail_berita->updated_at ? $detail_berita->updated_at->format('d F Y, H:i') . ' WIB' : '-' }}</td>
                        </tr>
                    </table>

                    <!-- Lembar Area Narasi Konten Utama -->
                    <h5 class="text-primary border-bottom pb-2 mb-3 fw-bold">Isi Konten Berita</h5>
                    
                    <div class="accordion" id="accordionBerita">
                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button bg-light text-dark py-2 fs-6 fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKonten">
                                    Naskah Lengkap Berita
                                </button>
                            </h6>
                            <div id="collapseKonten" class="accordion-collapse collapse show">
                                <div class="accordion-body py-3" style="line-height: 1.6; text-align: justify; white-space: pre-line;">
                                    @if($detail_berita->content)
                                        {{ $detail_berita->content }}
                                    @else
                                        <span class="text-muted fst-italic small">Narasi isi berita kosong atau belum diinput.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> 

                </div> <!-- End col-md-8 -->
            </div> <!-- End row -->
        </div> <!-- End card-body -->
    </div> <!-- End card -->
</div>
@endsection