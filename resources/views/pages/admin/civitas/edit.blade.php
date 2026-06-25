@extends('layouts.master_admin')

@section('title', 'Update Civitas')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    
    <!-- HEADER ACTION -->
    <div class="d-flex flex-sm-row flex-column align-items-sm-center justify-content-between mb-4 pb-3 border-bottom gap-3">
        <div>
            <h2 class="h4 mb-1 fw-bold text-dark lh-sm">Edit Profil Civitas Akademik</h2>
            <p class="text-muted small mb-0">Perbarui informasi biodata kepegawaian dan riwayat pendidikan formal</p>
        </div>
        <div>
            <a href="/civitas" class="btn btn-primary border btn-sm rounded-3 px-3 py-2 d-inline-flex align-items-center gap-2 small custom-btn-hover shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- FORM UTAMA -->
    <form action="/civitas/{{ $edit_civitas->id_civitas }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

        <div class="row g-4">
            
            <!-- KOLOM KIRI: PROFIL & FOTO -->
            <div class="col-xl-4 col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 position-sticky" style="top: 24px; border-top: 4px solid #0d6efd !important;">
                    <div class="card-body pt-2">
                        
                        <!-- Preview Foto Saat Ini (Tanpa Icon Kamera) -->
                        <div class="mb-4 d-inline-block position-relative">
                            <img id="preview-foto-profile" 
                                 src="{{ asset('uploads/civitas/' . $edit_civitas->foto) }}" 
                                 alt="Foto {{ $edit_civitas->nama_lengkap }}" 
                                 class="rounded-circle border border-4 border-white shadow" 
                                 style="width: 140px; height: 140px; object-fit: cover;">
                        </div>

                        <h6 class="fw-bold mb-1 text-dark text-truncate px-2">{{ $edit_civitas->nama_lengkap ?? 'Nama Civitas' }}</h6>
                        <p class="text-muted small mb-4"><i class="bi bi-card-text me-1"></i> NIP: {{ $edit_civitas->nip ?? '-' }}</p>

                        <hr class="text-black-50 my-4 opacity-25">

                        <!-- Input Upload Foto -->
                        <div class="text-start mb-4">
                            <label class="form-label fw-semibold small text-secondary mb-2">Unggah Foto Baru</label>
                            <input type="file" class="form-control rounded-3 @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*" onchange="previewImage(this)">
                            <div class="form-text style-muted-text mt-1">Format: JPG, PNG. Maksimal 2MB. Kosongkan jika tidak diubah.</div>
                            @error('foto')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Dropdown Kategori -->
                        <div class="text-start mb-2">
                            <label class="form-label fw-semibold small text-secondary mb-2">Kategori Civitas <span class="text-danger">*</span></label>
                            <input type="hidden" name="kategori_id" id="kategori_id" value="{{ old('kategori_id', $edit_civitas->kategori_id) }}" required>
                            
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary w-100 text-start dropdown-toggle rounded-3 py-2.5 d-flex align-items-center justify-content-between btn-dropdown-custom @error('kategori_id') is-invalid border-danger text-danger @enderror" 
                                        type="button" 
                                        id="dropdownKategoriBtn" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false">
                                    <span id="dropdownSelectedText" class="small fw-medium">
                                        @php
                                            $selectedId = old('kategori_id', $edit_civitas->kategori_id);
                                            $selectedText = '-- Pilih Kategori --';
                                            foreach($data_kategori as $kategori) {
                                                if($kategori->id_kategori == $selectedId) {
                                                    $selectedText = $kategori->nama_kategori;
                                                }
                                            }
                                        @endphp
                                        {{ $selectedText }}
                                    </span>
                                </button>
                                <ul class="dropdown-menu w-100 shadow rounded-3" aria-labelledby="dropdownKategoriBtn">
                                    @foreach ($data_kategori as $kategori)
                                        <li>
                                            <button class="dropdown-item py-2 small {{ old('kategori_id', $edit_civitas->kategori_id) == $kategori->id_kategori ? 'active' : '' }}" 
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
                                <div class="invalid-feedback d-block small">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: FORM INPUT DATA & PENDIDIKAN -->
            <div class="col-xl-8 col-lg-7">
                <div class="d-flex flex-column gap-4">
                    
                    <!-- BLOK DATA BIODATA UTAMA -->
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4 pb-2 border-bottom border-light-subtle">
                                <div class="bg-primary-subtle p-2 rounded-3 me-3 text-primary d-flex align-items-center justify-content-center shadow-xs" style="width: 36px; height: 36px;">
                                    <i class="bi bi-person-vcard-fill fs-5"></i>
                                </div>
                                <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Biodata Kepegawaian</h5>
                            </div>

                            <div class="row g-4"> <!-- Menggunakan g-4 agar jarak antar baris input lebih longgar -->
                                <div class="col-md-6">
                                    <label for="nama_lengkap" class="form-label fw-medium small text-secondary mb-2">Nama Lengkap beserta Gelar <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3 py-2.5 @error('nama_lengkap') is-invalid @enderror {{ $edit_civitas->nama_lengkap ? 'form-filled' : 'form-empty' }}" id="nama_lengkap" name="nama_lengkap" value="{{ $edit_civitas->nama_lengkap }}" placeholder="Contoh: Dr. Nama, M.KKK" required>
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="nip" class="form-label fw-medium small text-secondary mb-2">NIP / Nomor Induk <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3 py-2.5 fw-mono @error('nip') is-invalid @enderror {{ $edit_civitas->nip ? 'form-filled' : 'form-empty' }}" id="nip" name="nip" value="{{ $edit_civitas->nip }}" placeholder="Masukkan NIP" required>
                                    @error('nip')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="pangkat_golongan" class="form-label fw-medium small text-secondary mb-2">Pangkat / Golongan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3 py-2.5 @error('pangkat_golongan') is-invalid @enderror {{ $edit_civitas->pangkat_golongan ? 'form-filled' : 'form-empty' }}" id="pangkat_golongan" name="pangkat_golongan" value="{{ $edit_civitas->pangkat_golongan }}" placeholder="Contoh: Pembina / IVa" required>
                                    @error('pangkat_golongan')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="jabatan" class="form-label fw-medium small text-secondary mb-2">Jabatan Struktural/Resmi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3 py-2.5 @error('jabatan') is-invalid @enderror {{ $edit_civitas->jabatan ? 'form-filled' : 'form-empty' }}" id="jabatan" name="jabatan" value="{{ $edit_civitas->jabatan }}" placeholder="Contoh: Ketua Jurusan / Dosen" required>
                                    @error('jabatan')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="motto" class="form-label fw-medium small text-secondary mb-2">Motto Hidup <span class="text-muted fw-normal">(Opsional)</span></label>
                                    <input type="text" class="form-control rounded-3 py-2.5 @error('motto') is-invalid @enderror {{ $edit_civitas->motto ? 'form-filled' : 'form-empty' }}" id="motto" name="motto" value="{{ $edit_civitas->motto }}" placeholder="Contoh: Mengabdi dengan prestasi dan ketulusan hati">
                                    @error('motto')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BLOK RIWAYAT PENDIDIKAN TINGGI (S3, S2, S1) -->
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4 pb-2 border-bottom border-light-subtle">
                                <div class="bg-primary-subtle p-2 rounded-3 me-3 text-primary d-flex align-items-center justify-content-center shadow-xs" style="width: 36px; height: 36px;">
                                    <i class="bi bi-mortarboard-fill fs-5"></i>
                                </div>
                                <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Pendidikan Tinggi <span class="fw-normal text-muted small">(Kosongkan jika tidak ada)</span></h5>
                            </div>

                            <!-- INPUT JENJANG S3 -->
                            <div class="mb-4 p-4 bg-light rounded-3 border border-light-subtle">
                                <div class="badge bg-warning text-white px-3 py-1.5 mb-3 rounded-pill fw-bold small shadow-xs">Program Doktor (S3)</div>
                                <div class="row g-3">
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control form-control-sm rounded-3 @error('s3_universitas') is-invalid @enderror {{ $edit_civitas->s3_universitas ? 'form-filled' : 'form-empty' }}" name="s3_universitas" value="{{ $edit_civitas->s3_universitas }}" placeholder="Nama Universitas S3">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control form-control-sm rounded-3 @error('s3_prodi') is-invalid @enderror {{ $edit_civitas->s3_prodi ? 'form-filled' : 'form-empty' }}" name="s3_prodi" value="{{ $edit_civitas->s3_prodi }}" placeholder="Program Studi S3">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm rounded-3 @error('s3_peminatan') is-invalid @enderror {{ $edit_civitas->s3_peminatan ? 'form-filled' : 'form-empty' }}" name="s3_peminatan" value="{{ $edit_civitas->s3_peminatan }}" placeholder="Bidang Peminatan / Konsentrasi S3">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control form-control-sm rounded-3 @error('s3_tahun_lulus') is-invalid @enderror {{ $edit_civitas->s3_tahun_lulus ? 'form-filled' : 'form-empty' }}" name="s3_tahun_lulus" value="{{ $edit_civitas->s3_tahun_lulus }}" placeholder="Tahun Lulus S3" min="1900" max="2100">
                                    </div>
                                </div>
                            </div>

                            <!-- INPUT JENJANG S2 -->
                            <div class="mb-4 p-4 bg-light rounded-3 border border-light-subtle">
                                <div class="badge bg-info text-white px-3 py-1.5 mb-3 rounded-pill fw-bold small shadow-xs">Program Magister (S2)</div>
                                <div class="row g-3">
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control form-control-sm rounded-3 @error('s2_universitas') is-invalid @enderror {{ $edit_civitas->s2_universitas ? 'form-filled' : 'form-empty' }}" name="s2_universitas" value="{{ $edit_civitas->s2_universitas }}" placeholder="Nama Universitas S2">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control form-control-sm rounded-3 @error('s2_prodi') is-invalid @enderror {{ $edit_civitas->s2_prodi ? 'form-filled' : 'form-empty' }}" name="s2_prodi" value="{{ $edit_civitas->s2_prodi }}" placeholder="Program Studi S2">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm rounded-3 @error('s2_peminatan') is-invalid @enderror {{ $edit_civitas->s2_peminatan ? 'form-filled' : 'form-empty' }}" name="s2_peminatan" value="{{ $edit_civitas->s2_peminatan }}" placeholder="Bidang Peminatan / Konsentrasi S2">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control form-control-sm rounded-3 @error('s2_tahun_lulus') is-invalid @enderror {{ $edit_civitas->s2_tahun_lulus ? 'form-filled' : 'form-empty' }}" name="s2_tahun_lulus" value="{{ $edit_civitas->s2_tahun_lulus }}" placeholder="Tahun Lulus S2" min="1900" max="2100">
                                    </div>
                                </div>
                            </div>

                            <!-- INPUT JENJANG S1 / D4 -->
                            <div class="p-4 bg-light rounded-3 border border-light-subtle">
                                <div class="badge bg-success text-white px-3 py-1.5 mb-3 rounded-pill fw-bold small shadow-xs">Program Sarjana / D4 (S1)</div>
                                <div class="row g-3">
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control form-control-sm rounded-3 @error('s1_universitas') is-invalid @enderror {{ $edit_civitas->s1_universitas ? 'form-filled' : 'form-empty' }}" name="s1_universitas" value="{{ $edit_civitas->s1_universitas }}" placeholder="Nama Universitas S1">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control form-control-sm rounded-3 @error('s1_prodi') is-invalid @enderror {{ $edit_civitas->s1_prodi ? 'form-filled' : 'form-empty' }}" name="s1_prodi" value="{{ $edit_civitas->s1_prodi }}" placeholder="Program Studi S1">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm rounded-3 @error('s1_peminatan') is-invalid @enderror {{ $edit_civitas->s1_peminatan ? 'form-filled' : 'form-empty' }}" name="s1_peminatan" value="{{ $edit_civitas->s1_peminatan }}" placeholder="Bidang Peminatan / Konsentrasi S1">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control form-control-sm rounded-3 @error('s1_tahun_lulus') is-invalid @enderror {{ $edit_civitas->s1_tahun_lulus ? 'form-filled' : 'form-empty' }}" name="s1_tahun_lulus" value="{{ $edit_civitas->s1_tahun_lulus }}" placeholder="Tahun Lulus S1" min="1900" max="2100">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- BLOK PENDIDIKAN MENENGAH & DIPLOMA TIMED -->
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4 pb-2 border-bottom border-light-subtle">
                                <div class="bg-secondary-subtle p-2 rounded-3 me-3 text-secondary d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <i class="bi bi-building-fill fs-5"></i>
                                </div>
                                <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Pendidikan Diploma & Menengah <span class="fw-normal text-muted small">(Kosongkan jika tidak ada)</span></h5>
                            </div>

                            <div class="row g-4">
                                <!-- D3 -->
                                <div class="col-md-6 border-end border-light-subtle pe-md-3">
                                    <label class="form-label fw-bold text-dark small mb-2"><i class="bi bi-award text-dark me-1"></i> Program Diploma (D3)</label>
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-sm rounded-3 {{ $edit_civitas->d3_universitas ? 'form-filled' : 'form-empty' }}" name="d3_universitas" value="{{ $edit_civitas->d3_universitas }}" placeholder="Nama Politeknik / Institusi D3">
                                    </div>
                                    <div>
                                        <input type="number" class="form-control form-control-sm rounded-3 {{ $edit_civitas->d3_tahun_lulus ? 'form-filled' : 'form-empty' }}" name="d3_tahun_lulus" value="{{ $edit_civitas->d3_tahun_lulus }}" placeholder="Tahun Lulus D3" min="1900" max="2100">
                                    </div>
                                </div>

                                <!-- SMA -->
                                <div class="col-md-6 ps-md-3">
                                    <label class="form-label fw-bold text-secondary small mb-2"><i class="bi bi-house-door text-secondary me-1"></i> SMA / Sederajat</label>
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-sm rounded-3 {{ $edit_civitas->sma_nama ? 'form-filled' : 'form-empty' }}" name="sma_nama" value="{{ $edit_civitas->sma_nama }}" placeholder="Nama Sekolah SMA/SMK">
                                    </div>
                                    <div>
                                        <input type="number" class="form-control form-control-sm rounded-3 {{ $edit_civitas->sma_tahun_lulus ? 'form-filled' : 'form-empty' }}" name="sma_tahun_lulus" value="{{ $edit_civitas->sma_tahun_lulus }}" placeholder="Tahun Lulus SMA" min="1900" max="2100">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- FOOTER ACTION BUTTONS -->
                    <div class="d-flex align-items-center justify-content-end gap-2 mb-4 mt-2">
                        <a href="/civitas" class="btn btn-warning border rounded-3 px-4 py-2 small shadow-sm">Batal</a> &nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary rounded-3 px-5 py-2 small fw-semibold shadow">
                            Perbarui Data Civitas
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </form>
</div>

<!-- STYLING TAMBAHAN (DENGAN KLASIFIKASI PEMBEDA INPUT) -->
<style>
    body {
        background-color: #f8f9fa;
    }
    .fw-mono {
        font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    }
    .shadow-xs {
        box-shadow: 0 2px 4px rgba(0,0,0,0.04);
    }
    .style-muted-text {
        font-size: 0.725rem;
        color: #8492a6;
    }
    .custom-btn-hover:hover {
        background-color: #e9ecef;
        color: #212529 !important;
    }
    .btn-dropdown-custom {
        border-color: #dee2e6;
        color: #495057;
        background-color: #fff;
    }
    .btn-dropdown-custom:hover, .btn-dropdown-custom:focus {
        background-color: #f8f9fa;
        border-color: #ced4da;
        color: #212529;
    }
    .dropdown-menu .dropdown-item.active {
        background-color: #0d6efd;
        color: #fff;
    }

    /* === PEMBEDA VISUAL FORM TERISI VS KOSONG === */
    /* Gaya untuk Input yang sudah ada nilainya */
    .form-filled {
        background-color: #f1f3f5 !important;
        border-color: #ced4da !important;
        color: #2b303a !important;
        font-weight: 500;
    }
    .form-filled:focus {
        background-color: #fff !important;
        border-color: #86b7fe !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    /* Gaya untuk Input yang masih kosong */
    .form-empty {
        background-color: #ffffff !important;
        border-style: dashed !important; /* Sengaja dibuat dashed tipis agar menandakan butuh perhatian untuk diisi */
        border-color: #cdd4dc !important;
    }
    .form-empty:focus {
        border-style: solid !important;
        border-color: #86b7fe !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>

<!-- JAVASCRIPT LOGIC INTERAKTIF -->
<script>
    function selectKategori(element) {
        var value = element.getAttribute('data-value');
        var text = element.innerText;

        document.getElementById('kategori_id').value = value;
        document.getElementById('dropdownSelectedText').innerText = text;

        document.querySelectorAll('.dropdown-menu .dropdown-item').forEach(item => item.classList.remove('active'));
        element.classList.add('active');
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-foto-profile').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection