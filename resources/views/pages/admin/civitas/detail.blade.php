@extends('layouts.master_admin')

@section('title','Detail Civitas')

@section('content_admin')
<div class="my-3 mx-2">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span class="fw-bold">Profil Lengkap: {{ $detail_civitas->nama_lengkap }}</span>
            <a href="/civitas" class="btn btn-info btn-sm text-white">Kembali ke Daftar</a>
        </div>
        
        <div class="card-body bg-white">
            <div class="row g-4">
                
                <div class="col-md-4 text-center border-end">
                    <div class="mb-3">
                        @if($detail_civitas->foto)
                            <img src="{{ asset('uploads/civitas/' . $detail_civitas->foto) }}" alt="Foto {{ $detail_civitas->nama_lengkap }}" class="img-thumbnail shadow-sm mb-3" style="max-height: 280px; object-fit: cover;">
                        @else
                            <div class="bg-light text-muted d-flex align-items-center justify-content-center mx-auto img-thumbnail" style="width: 200px; height: 250px;">
                                <span>Tidak Ada Foto</span>
                            </div>
                        @endif
                    </div>
                    <h5 class="fw-bold mb-1">{{ $detail_civitas->nama_lengkap }}</h5>
                    <p class="text-muted small mb-3">{{ $detail_civitas->jabatan }}</p>
                    
                    @if($detail_civitas->motto)
                        <div class="p-3 bg-light rounded text-start italic">
                            <small class="text-secondary d-block fw-bold mb-1">Motto Hidup:</small>
                            <span class="fst-italic">"{{ $detail_civitas->motto }}"</span>
                        </div>
                    @endif
                </div>

                <div class="col-md-8">
                    <h5 class="text-primary border-bottom pb-2 mb-3 fw-bold">Data Kepegawaian</h5>
                    <table class="table table-sm table-borderless mb-4">
                        <tr>
                            <td style="width: 30%" class="fw-bold text-secondary">Nama Lengkap</td>
                            <td style="width: 3%">:</td>
                            <td>{{ $detail_civitas->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-secondary">NIP</td>
                            <td>:</td>
                            <td>{{ $detail_civitas->nip }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-secondary">Pangkat / Golongan</td>
                            <td>:</td>
                            <td>{{ $detail_civitas->pangkat_golongan }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-secondary">Jabatan</td>
                            <td>:</td>
                            <td>{{ $detail_civitas->jabatan }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-secondary">Kategori</td>
                            <td>:</td>
                            <td>{{ $detail_civitas->nama_kategori }}</td>
                        </tr>
                    </table>

                    <h5 class="text-primary border-bottom pb-2 mb-3 fw-bold">Riwayat Pendidikan</h5>
                    
                    <div class="accordion" id="accordionPendidikan">
                        
                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button bg-light text-dark py-2 fs-6 fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSMA">
                                    Pendidikan Menengah (SMA / Sederajat)
                                </button>
                            </h6>
                            <div id="collapseSMA" class="accordion-collapse collapse show">
                                <div class="accordion-body py-2">
                                    @if($detail_civitas->sma_nama)
                                        <p class="mb-1"><strong>Sekolah:</strong> {{ $detail_civitas->sma_nama }}</p>
                                        <p class="mb-0 text-muted small"><strong>Tahun Lulus:</strong> {{ $detail_civitas->sma_tahun_lulus ?? '-' }}</p>
                                    @else
                                        <span class="text-muted fst-italic small">Data tidak diisi/tidak ada.</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed bg-light text-dark py-2 fs-6 fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseD3">
                                    Program Diploma (D3)
                                </button>
                            </h6>
                            <div id="collapseD3" class="accordion-collapse collapse">
                                <div class="accordion-body py-2">
                                    @if($detail_civitas->d3_universitas)
                                        <p class="mb-1"><strong>Universitas/Politeknik:</strong> {{ $detail_civitas->d3_universitas }}</p>
                                        <p class="mb-0 text-muted small"><strong>Tahun Lulus:</strong> {{ $detail_civitas->d3_tahun_lulus ?? '-' }}</p>
                                    @else
                                        <span class="text-muted fst-italic small">Data tidak diisi/tidak ada.</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed bg-light text-dark py-2 fs-6 fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseS1">
                                    Program Sarjana (S1 / D4)
                                </button>
                            </h6>
                            <div id="collapseS1" class="accordion-collapse collapse">
                                <div class="accordion-body py-2">
                                    @if($detail_civitas->s1_universitas)
                                        <p class="mb-1"><strong>Universitas:</strong> {{ $detail_civitas->s1_universitas }}</p>
                                        <p class="mb-1"><strong>Program Studi:</strong> {{ $detail_civitas->s1_prodi ?? '-' }}</p>
                                        <p class="mb-1"><strong>Peminatan:</strong> {{ $detail_civitas->s1_peminatan ?? '-' }}</p>
                                        <p class="mb-0 text-muted small"><strong>Tahun Lulus:</strong> {{ $detail_civitas->s1_tahun_lulus ?? '-' }}</p>
                                    @else
                                        <span class="text-muted fst-italic small">Data tidak diisi/tidak ada.</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed bg-light text-dark py-2 fs-6 fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseS2">
                                    Program Magister (S2)
                                </button>
                            </h6>
                            <div id="collapseS2" class="accordion-collapse collapse">
                                <div class="accordion-body py-2">
                                    @if($detail_civitas->s2_universitas)
                                        <p class="mb-1"><strong>Universitas:</strong> {{ $detail_civitas->s2_universitas }}</p>
                                        <p class="mb-1"><strong>Program Studi:</strong> {{ $detail_civitas->s2_prodi ?? '-' }}</p>
                                        <p class="mb-1"><strong>Peminatan:</strong> {{ $detail_civitas->s2_peminatan ?? '-' }}</p>
                                        <p class="mb-0 text-muted small"><strong>Tahun Lulus:</strong> {{ $detail_civitas->s2_tahun_lulus ?? '-' }}</p>
                                    @else
                                        <span class="text-muted fst-italic small">Data tidak diisi/tidak ada.</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed bg-light text-dark py-2 fs-6 fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseS3">
                                    Program Doktor (S3)
                                </button>
                            </h6>
                            <div id="collapseS3" class="accordion-collapse collapse">
                                <div class="accordion-body py-2">
                                    @if($detail_civitas->s3_universitas)
                                        <p class="mb-1"><strong>Universitas:</strong> {{ $detail_civitas->s3_universitas }}</p>
                                        <p class="mb-1"><strong>Program Studi:</strong> {{ $detail_civitas->s3_prodi ?? '-' }}</p>
                                        <p class="mb-1"><strong>Peminatan:</strong> {{ $detail_civitas->s3_peminatan ?? '-' }}</p>
                                        <p class="mb-0 text-muted small"><strong>Tahun Lulus:</strong> {{ $detail_civitas->s3_tahun_lulus ?? '-' }}</p>
                                    @else
                                        <span class="text-muted fst-italic small">Data tidak diisi/tidak ada.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</div>
@endsection