@extends('layouts.master')

@section('content')
<div class="container-fluid px-4 py-4 mt--3" style="background-color: #ffffff; min-height: 100vh;">
    
    <!-- HEADER UTAMA -->
    <div class="mb-4 pb-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h2 class="h4 mb-1 fw-bold text-dark">Layanan Kemahasiswaan</h2>
            <p class="text-muted small mb-0">Daftar layanan surat-menyurat, pengajuan cuti, undur diri, dan beasiswa mahasiswa.</p>
        </div>
        <div>
            <!-- Tombol jika admin ingin menambah jenis layanan baru di kemudian hari -->
            <button class="btn btn-primary rounded-3 px-3 py-2 small fw-medium shadow-sm d-inline-flex align-items-center gap-2" style="background-color: #4e73df; border-color: #4e73df;">
                <i class="bi bi-plus-circle"></i> Tambah Layanan
            </button>
        </div>
    </div>

    <!-- PROSEDUR SINGKAT (Alert Box Modern) -->
    <div class="alert alert-white border shadow-sm rounded-3 p-4 mb-4" style="border-left: 4px solid #4e73df !important;">
        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-info-circle-fill text-primary me-2"></i>Alur Umum Pengajuan Layanan:</h6>
        <div class="row g-3 text-secondary small">
            <div class="col-12 col-md-3">
                <div class="p-2 bg-light rounded-2 border-start border-primary border-3">
                    <strong>1. Unduh Dokumen</strong><br>Pilih format dokumen sesuai kebutuhan pada tabel di bawah.
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="p-2 bg-light rounded-2 border-start border-primary border-3">
                    <strong>2. Isi & Lengkapi</strong><br>Isi data secara lengkap sesuai format yang dibutuhkan.
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="p-2 bg-light rounded-2 border-start border-primary border-3">
                    <strong>3. Scan Dokumen</strong><br>Siapkan berkas fisik/digital untuk diunggah ke sistem.
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="p-2 bg-light rounded-2 border-start border-primary border-3">
                    <strong>4. Ajukan Link</strong><br>Klik tombol "Ajukan" untuk mengisi formulir final.
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL UTAMA LAYANAN -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden w-100 mb-4" style="border-top: 4px solid #0d6efd !important;">
        <div class="card-header bg-white border-bottom py-3 px-4">
            <h5 class="h6 mb-0 fw-semibold text-secondary">Master Data Layanan</h5>
        </div>

        <div class="card-body p-0 bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                    <thead class="table-light text-secondary uppercase-heading">
                        <tr>
                            <th class="text-center px-4" style="width: 80px;">No</th>
                            <th style="width: 350px;">Jenis Layanan Kemahasiswaan</th>
                            <th style="width: 250px;">Format Unduhan</th>
                            <th class="text-center px-4" style="width: 180px;">Aksi Formulir</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        <!-- Baris 1: Surat Keterangan Aktif -->
                        <tr>
                            <td class="text-center px-4 fw-medium text-secondary">1</td>
                            <td>
                                <div class="fw-bold text-dark">Surat Keterangan Aktif Mahasiswa</div>
                                <span class="text-muted" style="font-size: 0.8rem;">Untuk keperluan BPJS, beasiswa luar, atau tunjangan lainnya.</span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-light border btn-sm rounded-3 text-secondary d-inline-flex align-items-center gap-1.5 custom-btn-table">
                                    <i class="bi bi-file-earmark-word text-primary"></i> F-Aktif_Mahasiswa.docx
                                </a>
                            </td>
                            <td class="text-center px-4">
                                <a href="https://gizi.poltekkesbandung.ac.id/layanan-kemahasiswaan" target="_blank" class="btn btn-primary btn-sm rounded-3 px-3 fw-medium d-inline-flex align-items-center gap-1 shadow-xs" style="background-color: #4e73df; border-color: #4e73df;">
                                    Ajukan <i class="bi bi-box-arrow-up-right small"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Baris 2: Surat Tunjangan Gaji Orang Tua -->
                        <tr>
                            <td class="text-center px-4 fw-medium text-secondary">2</td>
                            <td>
                                <div class="fw-bold text-dark">Surat Tunjangan Gaji Orang Tua</div>
                                <span class="text-muted" style="font-size: 0.8rem;">Surat keterangan untuk instansi tempat kerja orang tua (PNS/Swasta).</span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-light border btn-sm rounded-3 text-secondary d-inline-flex align-items-center gap-1.5 custom-btn-table">
                                    <i class="bi bi-file-earmark-word text-primary"></i> F-Tunjangan_Gaji.docx
                                </a>
                            </td>
                            <td class="text-center px-4">
                                <a href="https://gizi.poltekkesbandung.ac.id/layanan-kemahasiswaan" target="_blank" class="btn btn-primary btn-sm rounded-3 px-3 fw-medium d-inline-flex align-items-center gap-1 shadow-xs" style="background-color: #4e73df; border-color: #4e73df;">
                                    Ajukan <i class="bi bi-box-arrow-up-right small"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Baris 3: Pengajuan Cuti / Undur Di -->
                        <tr>
                            <td class="text-center px-4 fw-medium text-secondary">3</td>
                            <td>
                                <div class="fw-bold text-dark">Pengajuan Cuti / Undur Diri</div>
                                <span class="text-muted" style="font-size: 0.8rem;">Prosedur resmi untuk berhenti akademis sementara atau permanen.</span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-light border btn-sm rounded-3 text-secondary d-inline-flex align-items-center gap-1.5 custom-btn-table">
                                    <i class="bi bi-file-earmark-pdf text-danger"></i> F-Cuti_UndurDiri.pdf
                                </a>
                            </td>
                            <td class="text-center px-4">
                                <a href="https://gizi.poltekkesbandung.ac.id/layanan-kemahasiswaan" target="_blank" class="btn btn-primary btn-sm rounded-3 px-3 fw-medium d-inline-flex align-items-center gap-1 shadow-xs" style="background-color: #4e73df; border-color: #4e73df;">
                                    Ajukan <i class="bi bi-box-arrow-up-right small"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Baris 4: Pengajuan Beasiswa -->
                        <tr>
                            <td class="text-center px-4 fw-medium text-secondary">4</td>
                            <td>
                                <div class="fw-bold text-dark">Pengajuan Beasiswa</div>
                                <span class="text-muted" style="font-size: 0.8rem;">Pengumpulan berkas internal untuk usulan beasiswa institusi/pemerintah.</span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-light border btn-sm rounded-3 text-secondary d-inline-flex align-items-center gap-1.5 custom-btn-table">
                                    <i class="bi bi-file-earmark-spreadsheet text-success"></i> Kelengkapan_Beasiswa.xlsx
                                </a>
                            </td>
                            <td class="text-center px-4">
                                <a href="https://gizi.poltekkesbandung.ac.id/layanan-kemahasiswaan" target="_blank" class="btn btn-primary btn-sm rounded-3 px-3 fw-medium d-inline-flex align-items-center gap-1 shadow-xs" style="background-color: #4e73df; border-color: #4e73df;">
                                    Ajukan <i class="bi bi-box-arrow-up-right small"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- CSS KUSTOMISASI KONSISTENSI FORM -->
<style>
    .uppercase-heading th {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding-top: 12px;
        padding-bottom: 12px;
        border-bottom: 2px solid #dee2e6;
    }
    .custom-btn-table {
        font-size: 0.8rem;
        transition: all 0.15s ease-in-out;
    }
    .custom-btn-table:hover {
        background-color: #e9ecef;
        color: #111 !important;
    }
    .shadow-xs {
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    table tbody tr {
        transition: background-color 0.15s ease-in-out;
    }
    table tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.02) !important;
    }
</style>
@endsection