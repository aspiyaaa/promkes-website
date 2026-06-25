@extends('layouts.master_admin')

@section('title','Tambah Civitas')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    
    <!-- HEADER NAVIGASI -->
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-4 pb-3 border-bottom gap-3">
        <div>
            <h2 class="h4 mb-1 fw-bold text-dark">Tambah Data Civitas Akademik</h2>
            <p class="text-muted small mb-0">Kelola informasi biodata dan riwayat pendidikan dosen atau tenaga kependidikan</p>
        </div>
        <div>
            <a href="/civitas" class="btn btn-primary border btn-sm rounded-3 px-3 py-2 d-inline-flex align-items-center gap-2 small styles-btn">
                <i class="bi bi-arrow-left"></i> &nbsp; Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- FORM UTAMA -->
    <form action="/civitas" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Ditambahkan align-items-start agar kedua kolom rata atas sempurna -->
        <div class="row g-4 align-items-start">
            
            <!-- KOLOM KIRI: BIODATA UTAMA -->
            <div class="col-xl-5 col-lg-6">
                <!-- Class sticky dihapus agar posisi atasnya mengunci sejajar dengan kolom kanan -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 text-primary">
                            <div class="bg-primary-subtle p-2 rounded-3 me-3 text-primary d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-badge fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.1rem;">Biodata Utama</h5>
                                <p class="text-muted small mb-0">Informasi wajib civitas akademika</p>
                            </div>
                        </div>

                        <hr class="text-muted opacity-25 mt-4">
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="nama_lengkap" class="form-label fw-semibold text-secondary small mb-1">Nama Lengkap beserta Gelar <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-custom rounded-3 @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Contoh: Dr. Nama, M.KKK" required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="nip" class="form-label fw-semibold text-secondary small mb-1">NIP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-custom rounded-3 @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}" placeholder="Masukkan nomor induk pegawai" required>
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="pangkat_golongan" class="form-label fw-semibold text-secondary small mb-1">Pangkat / Golongan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-custom rounded-3 @error('pangkat_golongan') is-invalid @enderror" id="pangkat_golongan" name="pangkat_golongan" value="{{ old('pangkat_golongan') }}" placeholder="Contoh: Pembina / IVa" required>
                                @error('pangkat_golongan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="jabatan" class="form-label fw-semibold text-secondary small mb-1">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-custom rounded-3 @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" placeholder="Contoh: Ketua Jurusan / Dosen" required>
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="kategori_id" class="form-label fw-semibold text-secondary small mb-1">Kategori Civitas <span class="text-danger">*</span></label>
                                <input type="hidden" name="kategori_id" id="kategori_id" value="{{ old('kategori_id') }}" required>

                                <div class="dropdown">
                                    <button class="btn btn-light bg-light border w-100 text-start dropdown-toggle rounded-3 py-2 px-3 d-flex align-items-center justify-content-between @error('kategori_id') is-invalid border-danger text-danger @enderror" 
                                            type="button" 
                                            id="dropdownKategoriBtn" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false"
                                            style="font-size: 0.9rem; min-height: 41px;">
                                        <span id="dropdownSelectedText" class="text-dark">
                                            @if(old('kategori_id'))
                                                @foreach($data_kategori as $kategori)
                                                    @if($kategori->id_kategori == old('kategori_id'))
                                                        {{ $kategori->nama_kategori }}
                                                    @endif
                                                @endforeach
                                            @else
                                                <span class="text-muted">-- Pilih Kategori --</span>
                                            @endif
                                        </span>
                                    </button>

                                    <ul class="dropdown-menu w-100 shadow rounded-3 border-light py-2" aria-labelledby="dropdownKategoriBtn">
                                        @foreach ($data_kategori as $kategori)
                                            <li>
                                                <button class="dropdown-item py-2 small fw-medium" 
                                                        type="button" 
                                                        data-value="{{ $kategori->id_kategori }}" 
                                                        onclick="selectKategori(this)">
                                                    {{ $kategori->nama_kategori }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                @error('kategori_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="motto" class="form-label fw-semibold text-secondary small mb-1">Motto Hidup <span class="text-muted fw-normal">(Opsional)</span></label>
                                <input type="text" class="form-control form-custom rounded-3 @error('motto') is-invalid @enderror" id="motto" name="motto" value="{{ old('motto') }}" placeholder="Contoh: Mengabdi dengan prestasi">
                                @error('motto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="foto" class="form-label fw-semibold text-secondary small mb-1">Foto Profil <span class="text-danger">*</span></label>
                                <input type="file" class="form-control form-custom file-input-custom rounded-3 @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*" required style="font-size: 0.85rem;">
                                <div class="form-text text-muted" style="font-size: 0.75rem;"><i class="bi bi-info-circle me-1"></i>Format: JPG, PNG. Maksimal file 2MB.</div>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: RIWAYAT JENJANG PENDIDIKAN -->
            <div class="col-xl-7 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-2 text-secondary">
                            <div class="bg-secondary-subtle p-2 rounded-3 me-3 text-secondary d-flex align-items-center justify-content-center">
                                <i class="bi bi-mortarboard-fill fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.1rem;">Riwayat Jenjang Pendidikan</h5>
                                <p class="text-muted small mb-0">Isian opsional (boleh dikosongkan jika tidak ada)</p>
                            </div>
                        </div>
                        
                        <hr class="text-muted opacity-25 my-4">

                        <!-- SMA -->
                        <div class="mb-4 p-3 bg-light rounded-4 border-start border-secondary border-3 shadow-sm-inset">
                            <h6 class="fw-bold mb-3 text-dark d-flex align-items-center small-title"><i class="bi bi-building me-2 text-secondary"></i> &nbsp; Pendidikan Menengah: SMA / Sederajat</h6>
                            <div class="row g-2.5">
                                <div class="col-md-8">
                                    <label for="sma_nama" class="form-label text-secondary small mb-1">Nama Sekolah / Institusi</label>
                                    <input type="text" class="form-control rounded-3 bg-white border-light-subtle @error('sma_nama') is-invalid @enderror" id="sma_nama" name="sma_nama" value="{{ old('sma_nama') }}" placeholder="Contoh: SMAN 1 Bandung">
                                    @error('sma_nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="sma_tahun_lulus" class="form-label text-secondary small mb-1">Tahun Lulus</label>
                                    <input type="number" class="form-control rounded-3 bg-white border-light-subtle @error('sma_tahun_lulus') is-invalid @enderror" id="sma_tahun_lulus" name="sma_tahun_lulus" value="{{ old('sma_tahun_lulus') }}" placeholder="2022" min="1900" max="2100">
                                    @error('sma_tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- D3 -->
                        <div class="mb-4 p-3 bg-light rounded-4 border-start border-dark border-3 shadow-sm-inset">
                            <h6 class="fw-bold mb-3 text-dark d-flex align-items-center small-title"><i class="bi bi-award me-2 text-dark"></i> &nbsp; Program Diploma (D3)</h6>
                            <div class="row g-2.5">
                                <div class="col-md-8">
                                    <label for="d3_universitas" class="form-label text-secondary small mb-1">Nama Universitas / Politeknik</label>
                                    <input type="text" class="form-control rounded-3 bg-white border-light-subtle @error('d3_universitas') is-invalid @enderror" id="d3_universitas" name="d3_universitas" value="{{ old('d3_universitas') }}" placeholder="Contoh: Poltekkes Kemenkes Bandung">
                                    @error('d3_universitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="d3_tahun_lulus" class="form-label text-secondary small mb-1">Tahun Lulus</label>
                                    <input type="number" class="form-control rounded-3 bg-white border-light-subtle @error('d3_tahun_lulus') is-invalid @enderror" id="d3_tahun_lulus" name="d3_tahun_lulus" value="{{ old('d3_tahun_lulus') }}" placeholder="2025" min="1900" max="2100">
                                    @error('d3_tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- S1 -->
                        <div class="mb-4 p-3 bg-light rounded-4 border-start border-success border-3 shadow-sm-inset">
                            <h6 class="fw-bold mb-3 text-dark d-flex align-items-center small-title"><i class="bi bi-patch-check me-2 text-success"></i> &nbsp; Program Sarjana (S1 / D4)</h6>
                            <div class="row g-2.5">
                                <div class="col-md-6">
                                    <label for="s1_universitas" class="form-label text-secondary small mb-1">Nama Universitas</label>
                                    <input type="text" class="form-control rounded-3 bg-white border-light-subtle @error('s1_universitas') is-invalid @enderror" id="s1_universitas" name="s1_universitas" value="{{ old('s1_universitas') }}" placeholder="Contoh: Universitas Indonesia">
                                    @error('s1_universitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="s1_prodi" class="form-label text-secondary small mb-1">Program Studi</label>
                                    <input type="text" class="form-control rounded-3 bg-white border-light-subtle @error('s1_prodi') is-invalid @enderror" id="s1_prodi" name="s1_prodi" value="{{ old('s1_prodi') }}" placeholder="Contoh: Kesehatan Masyarakat">
                                    @error('s1_prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-8">
                                    <label for="s1_peminatan" class="form-label text-secondary small mb-1">Peminatan</label>
                                    <input type="text" class="form-control rounded-3 bg-white border-light-subtle @error('s1_peminatan') is-invalid @enderror" id="s1_peminatan" name="s1_peminatan" value="{{ old('s1_peminatan') }}" placeholder="Masukkan spesialisasi peminatan">
                                    @error('s1_peminatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="s1_tahun_lulus" class="form-label text-secondary small mb-1">Tahun Lulus</label>
                                    <input type="number" class="form-control rounded-3 bg-white border-light-subtle @error('s1_tahun_lulus') is-invalid @enderror" id="s1_tahun_lulus" name="s1_tahun_lulus" value="{{ old('s1_tahun_lulus') }}" placeholder="2012" min="1900" max="2100">
                                    @error('s1_tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- S2 -->
                        <div class="mb-4 p-3 bg-light rounded-4 border-start border-info border-3 shadow-sm-inset">
                            <h6 class="fw-bold mb-3 text-dark d-flex align-items-center small-title"><i class="bi bi-bookmark-star me-2 text-info"></i> &nbsp; Program Magister (S2)</h6>
                            <div class="row g-2.5">
                                <div class="col-md-6">
                                    <label for="s2_universitas" class="form-label text-secondary small mb-1">Nama Universitas</label>
                                    <input type="text" class="form-control rounded-3 bg-white border-light-subtle @error('s2_universitas') is-invalid @enderror" id="s2_universitas" name="s2_universitas" value="{{ old('s2_universitas') }}" placeholder="Contoh: Universitas Diponegoro">
                                    @error('s2_universitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="s2_prodi" class="form-label text-secondary small mb-1">Program Studi</label>
                                    <input type="text" class="form-control rounded-3 bg-white border-light-subtle @error('s2_prodi') is-invalid @enderror" id="s2_prodi" name="s2_prodi" value="{{ old('s2_prodi') }}" placeholder="Contoh: Promosi Kesehatan">
                                    @error('s2_prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-8">
                                    <label for="s2_peminatan" class="form-label text-secondary small mb-1">Peminatan</label>
                                    <input type="text" class="form-control rounded-3 bg-white border-light-subtle @error('s2_peminatan') is-invalid @enderror" id="s2_peminatan" name="s2_peminatan" value="{{ old('s2_peminatan') }}" placeholder="Contoh: Magister Kesehatan Masyarakat">
                                    @error('s2_peminatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="s2_tahun_lulus" class="form-label text-secondary small mb-1">Tahun Lulus</label>
                                    <input type="number" class="form-control rounded-3 bg-white border-light-subtle @error('s2_tahun_lulus') is-invalid @enderror" id="s2_tahun_lulus" name="s2_tahun_lulus" value="{{ old('s2_tahun_lulus') }}" placeholder="2016" min="1900" max="2100">
                                    @error('s2_tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- S3 -->
                        <div class="mb-3 p-3 bg-light rounded-4 border-start border-warning border-3 shadow-sm-inset">
                            <h6 class="fw-bold mb-3 text-dark d-flex align-items-center small-title"><i class="bi bi-trophy me-2 text-warning"></i> &nbsp; Program Doktor (S3)</h6>
                            <div class="row g-2.5">
                                <div class="col-md-6">
                                    <label for="s3_universitas" class="form-label text-secondary small mb-1">Nama Universitas</label>
                                    <input type="text" class="form-control rounded-3 bg-white border-light-subtle @error('s3_universitas') is-invalid @enderror" id="s3_universitas" name="s3_universitas" value="{{ old('s3_universitas') }}" placeholder="Masukkan nama universitas">
                                    @error('s3_universitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="s3_prodi" class="form-label text-secondary small mb-1">Program Studi</label>
                                    <input type="text" class="form-control rounded-3 bg-white border-light-subtle @error('s3_prodi') is-invalid @enderror" id="s3_prodi" name="s3_prodi" value="{{ old('s3_prodi') }}" placeholder="Masukkan program studi">
                                    @error('s3_prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-8">
                                    <label for="s3_peminatan" class="form-label text-secondary small mb-1">Peminatan</label>
                                    <input type="text" class="form-control rounded-3 bg-white border-light-subtle @error('s3_peminatan') is-invalid @enderror" id="s3_peminatan" name="s3_peminatan" value="{{ old('s3_peminatan') }}" placeholder="Masukkan peminatan">
                                    @error('s3_peminatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="s3_tahun_lulus" class="form-label text-secondary small mb-1">Tahun Lulus</label>
                                    <input type="number" class="form-control rounded-3 bg-white border-light-subtle @error('s3_tahun_lulus') is-invalid @enderror" id="s3_tahun_lulus" name="s3_tahun_lulus" value="{{ old('s3_tahun_lulus') }}" placeholder="2021" min="1900" max="2100">
                                    @error('s3_tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- STICKY ACTION BUTTON FOOTER -->
        <div class="d-flex justify-content-end gap-2 mt-4 mb-5 pt-3 border-top">
            <button type="reset" class="btn btn-warning rounded-3 px-4 py-2 border small fw-medium">Reset Form</button> &nbsp;&nbsp;
            <button type="submit" class="btn btn-success rounded-3 px-5 py-2 fw-bold shadow-sm small">Simpan Data Civitas</button>
        </div>
    </form>
</div>

<script>
    function selectKategori(element) {
        var value = element.getAttribute('data-value');
        var text = element.innerText;

        document.getElementById('kategori_id').value = value;
        document.getElementById('dropdownSelectedText').innerHTML = '<span class="text-dark fw-medium">' + text + '</span>';
    }
</script>

<style>
    .form-custom {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        padding: 0.6rem 0.85rem;
        font-size: 0.9rem;
        color: #212529;
        transition: all 0.25s ease-in-out;
    }
    .form-custom:focus {
        background-color: #ffffff;
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.12);
    }
    .small-title {
        font-size: 0.875rem;
        letter-spacing: 0.3px;
    }
    .styles-btn:hover {
        background-color: #f1f3f5;
        color: #212529 !important;
    }
    .shadow-sm-inset {
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.02);
        border: 1px solid rgba(0,0,0,0.03);
    }
    .file-input-custom {
    padding-top: 0.45rem !important;
    padding-bottom: 0.45rem !important;
    line-height: 1.5;
    }

    /* Mengatur posisi vertikal tombol browser agar pas di tengah */
    .file-input-custom::-webkit-file-upload-button {
        margin-top: -5px;
    }
    .file-input-custom::file-selector-button {
        margin-top: -5px;
    }
</style>
@endsection