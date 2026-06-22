@extends('layouts.master_admin')

@section('title','Update Civitas')

@section('content_admin')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="h3 mb-0 text-gray-800">Edit Data Civitas Akademik</h2>
                <a href="/civitas" class="btn btn-secondary btn-sm">Kembali</a>
            </div>

            <form action="/civitas/{{ $edit_civitas->id_civitas }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Biodata Utama</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap beserta Gelar <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ $edit_civitas->nama_lengkap }}" placeholder="Contoh: Dr. Nama, M.KKK" required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ $edit_civitas->nip }}" placeholder="Masukkan NIP" required>
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pangkat_golongan" class="form-label">Pangkat / Golongan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('pangkat_golongan') is-invalid @enderror" id="pangkat_golongan" name="pangkat_golongan" value="{{ $edit_civitas->pangkat_golongan }}" placeholder="Contoh: Pembina / IVa" required>
                                @error('pangkat_golongan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ $edit_civitas->jabatan }}" placeholder="Contoh: Ketua Jurusan / Dosen" required>
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="kategori_id" class="form-label fw-medium text-secondary">Kategori Civitas <span class="text-danger">*</span></label>
                                
                                <input type="hidden" name="kategori_id" id="kategori_id" value="{{ old('kategori_id', $edit_civitas->kategori_id) }}" required>

                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary w-100 text-start dropdown-toggle rounded-3 py-2 d-flex align-items-center justify-content-between @error('kategori_id') is-invalid border-danger text-danger @enderror" 
                                            type="button" 
                                            id="dropdownKategoriBtn" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                        <span id="dropdownSelectedText">
                                            @php
                                                // Menentukan teks default berdasarkan old value atau data database saat ini
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

                                    <ul class="dropdown-menu w-100 shadow-sm rounded-3" aria-labelledby="dropdownKategoriBtn">
                                        @foreach ($data_kategori as $kategori)
                                            <li>
                                                <button class="dropdown-item py-2 {{ old('kategori_id', $edit_civitas->kategori_id) == $kategori->id_kategori ? 'active' : '' }}" 
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
                            <div class="col-md-6">
                                <label for="motto" class="form-label">Motto Hidup <span class="text-muted">(Opsional)</span></label>
                                <input type="text" class="form-control @error('motto') is-invalid @enderror" id="motto" name="motto" value="{{ $edit_civitas->motto }}" placeholder="Contoh: Mengabdi dengan prestasi">
                                @error('motto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label id="label_foto" for="foto" class="form-label">Foto Profil <span class="text-muted">(Kosongkan jika tidak ingin mengubah foto)</span></label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                                <div class="form-text">Format: JPG, PNG. Maksimal 2MB.</div>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-2">
                                <p class="mb-1 text-muted fs-7">Foto Saat Ini:</p>
                                <img src="{{ asset('uploads/civitas/' . $edit_civitas->foto) }}" alt="Foto {{ $edit_civitas->nama_lengkap }}" class="img-thumbnail" style="max-height: 120px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Riwayat Pendidikan: SMA / Sederajat <span class="fw-normal text-white-50 fs-6">(Kosongkan jika tidak ada)</span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="sma_nama" class="form-label">Nama Sekolah / Institusi</label>
                                <input type="text" class="form-control @error('sma_nama') is-invalid @enderror" id="sma_nama" name="sma_nama" value="{{ $edit_civitas->sma_nama }}" placeholder="Contoh: SMAN 1 Bandung">
                                @error('sma_nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="sma_tahun_lulus" class="form-label">Tahun Lulus</label>
                                <input type="number" class="form-control @error('sma_tahun_lulus') is-invalid @enderror" id="sma_tahun_lulus" name="sma_tahun_lulus" value="{{ $edit_civitas->sma_tahun_lulus }}" placeholder="Contoh: 2022" min="1900" max="2100">
                                @error('sma_tahun_lulus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Riwayat Pendidikan: D3 <span class="fw-normal text-white-50 fs-6">(Kosongkan jika tidak ada)</span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="d3_universitas" class="form-label">Nama Universitas / Politeknik</label>
                                <input type="text" class="form-control @error('d3_universitas') is-invalid @enderror" id="d3_universitas" name="d3_universitas" value="{{ $edit_civitas->d3_universitas }}" placeholder="Contoh: Poltekkes Kemenkes Bandung">
                                @error('d3_universitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="d3_tahun_lulus" class="form-label">Tahun Lulus</label>
                                <input type="number" class="form-control @error('d3_tahun_lulus') is-invalid @enderror" id="d3_tahun_lulus" name="d3_tahun_lulus" value="{{ $edit_civitas->d3_tahun_lulus }}" placeholder="Contoh: 2025" min="1900" max="2100">
                                @error('d3_tahun_lulus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Riwayat Pendidikan: S1 / D4 <span class="fw-normal text-white-50 fs-6">(Kosongkan jika tidak ada)</span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="s1_universitas" class="form-label">Nama Universitas/Perguruan Tinggi</label>
                                <input type="text" class="form-control @error('s1_universitas') is-invalid @enderror" id="s1_universitas" name="s1_universitas" value="{{ $edit_civitas->s1_universitas }}" placeholder="Contoh: Universitas Parahyangan">
                                @error('s1_universitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="s1_prodi" class="form-label">Program Studi</label>
                                <input type="text" class="form-control @error('s1_prodi') is-invalid @enderror" id="s1_prodi" name="s1_prodi" value="{{ $edit_civitas->s1_prodi }}" placeholder="Contoh: Teknologi Laboratorium Medis">
                                @error('s1_prodi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="s1_peminatan" class="form-label">Peminatan</label>
                                <input type="text" class="form-control @error('s1_peminatan') is-invalid @enderror" id="s1_peminatan" name="s1_peminatan" value="{{ $edit_civitas->s1_peminatan }}" placeholder="Masukkan peminatan jika ada">
                                @error('s1_peminatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="s1_tahun_lulus" class="form-label">Tahun Lulus</label>
                                <input type="number" class="form-control @error('s1_tahun_lulus') is-invalid @enderror" id="s1_tahun_lulus" name="s1_tahun_lulus" value="{{ $edit_civitas->s1_tahun_lulus }}" placeholder="Contoh: 2045" min="1900" max="2100">
                                @error('s1_tahun_lulus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-dark">
                        <h5 class="mb-0">Riwayat Pendidikan: S2 <span class="fw-normal text-muted fs-6">(Kosongkan jika tidak ada)</span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="s2_universitas" class="form-label">Nama Universitas</label>
                                <input type="text" class="form-control @error('s2_universitas') is-invalid @enderror" id="s2_universitas" name="s2_universitas" value="{{ $edit_civitas->s2_universitas }}" placeholder="Contoh: Universitas Diponegoro">
                                @error('s2_universitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="s2_prodi" class="form-label">Program Studi</label>
                                <input type="text" class="form-control @error('s2_prodi') is-invalid @enderror" id="s2_prodi" name="s2_prodi" value="{{ $edit_civitas->s2_prodi }}" placeholder="Contoh: Kesehatan Masyarakat">
                                @error('s2_prodi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="s2_peminatan" class="form-label">Peminatan</label>
                                <input type="text" class="form-control @error('s2_peminatan') is-invalid @enderror" id="s2_peminatan" name="s2_peminatan" value="{{ $edit_civitas->s2_peminatan }}" placeholder="Contoh: Sistem Kemasyarakatan">
                                @error('s2_peminatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="s2_tahun_lulus" class="form-label">Tahun Lulus</label>
                                <input type="number" class="form-control @error('s2_tahun_lulus') is-invalid @enderror" id="s2_tahun_lulus" name="s2_tahun_lulus" value="{{ $edit_civitas->s2_tahun_lulus }}" placeholder="Contoh: 2078" min="1900" max="2100">
                                @error('s2_tahun_lulus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Riwayat Pendidikan: S3 <span class="fw-normal text-muted fs-6">(Kosongkan jika tidak ada)</span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="s3_universitas" class="form-label">Nama Universitas</label>
                                <input type="text" class="form-control @error('s3_universitas') is-invalid @enderror" id="s3_universitas" name="s3_universitas" value="{{ $edit_civitas->s3_universitas }}" placeholder="Masukkan nama universitas">
                                @error('s3_universitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="s3_prodi" class="form-label">Program Studi</label>
                                <input type="text" class="form-control @error('s3_prodi') is-invalid @enderror" id="s3_prodi" name="s3_prodi" value="{{ $edit_civitas->s3_prodi }}" placeholder="Masukkan program studi">
                                @error('s3_prodi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="s3_peminatan" class="form-label">Peminatan</label>
                                <input type="text" class="form-control @error('s3_peminatan') is-invalid @enderror" id="s3_peminatan" name="s3_peminatan" value="{{ $edit_civitas->s3_peminatan }}" placeholder="Masukkan peminatan">
                                @error('s3_peminatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="s3_tahun_lulus" class="form-label">Tahun Lulus</label>
                                <input type="number" class="form-control @error('s3_tahun_lulus') is-invalid @enderror" id="s3_tahun_lulus" name="s3_tahun_lulus" value="{{ $edit_civitas->s3_tahun_lulus }}" placeholder="Contoh: 2082" min="1900" max="2100">
                                @error('s3_tahun_lulus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-5">
                    <a href="/civitas" class="btn btn-light me-md-2">Batal</a>
                    <button type="submit" class="btn btn-primary px-5">Perbarui Data Civitas</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    function selectKategori(element) {
        var value = element.getAttribute('data-value');
        var text = element.innerText;

        // Kirim ID terpilih ke hidden input
        document.getElementById('kategori_id').value = value;

        // Ubah teks UI pada dropdown utama
        document.getElementById('dropdownSelectedText').innerText = text;

        // Opsional: Kelola kelas active pada item dropdown
        document.querySelectorAll('.dropdown-item').forEach(item => item.classList.remove('active'));
        element.classList.add('active');
    }
</script>
@endsection