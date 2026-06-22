@extends('layouts.master_admin')

@section('title','Tambah Civitas')

@section('content_admin')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            
            <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-gray-800">Tambah Data Civitas Akademik</h2>
                    <p class="text-muted small mb-0">Kelola informasi biodata dan riwayat pendidikan dosen/staf</p>
                </div>
                <a href="/civitas" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="/civitas" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 text-primary">
                            <i class="bi bi-person-badge fs-4 me-2"></i>
                            <h5 class="mb-0 fw-bold">Biodata Utama</h5>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama_lengkap" class="form-label fw-medium text-secondary small">Nama Lengkap beserta Gelar <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-3 @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Contoh: Dr. Nama, M.KKK" required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nip" class="form-label fw-medium text-secondary small">NIP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-3 @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}" placeholder="Masukkan NIP" required>
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="pangkat_golongan" class="form-label fw-medium text-secondary small">Pangkat / Golongan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-3 @error('pangkat_golongan') is-invalid @enderror" id="pangkat_golongan" name="pangkat_golongan" value="{{ old('pangkat_golongan') }}" placeholder="Contoh: Pembina / IVa" required>
                                @error('pangkat_golongan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jabatan" class="form-label fw-medium text-secondary small">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-3 @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" placeholder="Contoh: Ketua Jurusan / Dosen" required>
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="kategori_id" class="form-label fw-medium text-secondary small">Kategori Civitas <span class="text-danger">*</span></label>
                                
                                <input type="hidden" name="kategori_id" id="kategori_id" value="{{ old('kategori_id') }}" required>

                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary w-100 text-start dropdown-toggle rounded-3 py-2 d-flex align-items-center justify-content-between @error('kategori_id') is-invalid border-danger text-danger @enderror" 
                                            type="button" 
                                            id="dropdownKategoriBtn" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                        <span id="dropdownSelectedText">
                                            @if(old('kategori_id'))
                                                @foreach($data_kategori as $kategori)
                                                    @if($kategori->id_kategori == old('kategori_id'))
                                                        {{ $kategori->nama_kategori }}
                                                    @endif
                                                @endforeach
                                            @else
                                                -- Pilih Kategori --
                                            @endif
                                        </span>
                                    </button>

                                    <ul class="dropdown-menu w-100 shadow-sm rounded-3" aria-labelledby="dropdownKategoriBtn">
                                        @foreach ($data_kategori as $kategori)
                                            <li>
                                                <button class="dropdown-item py-2" 
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
                                <label for="motto" class="form-label fw-medium text-secondary small">Motto Hidup <span class="text-muted">(Opsional)</span></label>
                                <input type="text" class="form-control rounded-3 @error('motto') is-invalid @enderror" id="motto" name="motto" value="{{ old('motto') }}" placeholder="Contoh: Mengabdi dengan prestasi">
                                @error('motto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="foto" class="form-label fw-medium text-secondary small">Foto Profil <span class="text-danger">*</span></label>
                                <input type="file" class="form-control rounded-3 @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*" required>
                                <div class="form-text text-muted small">Format: JPG, PNG. Maksimal 10MB.</div>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 text-secondary">
                            <i class="bi bi-mortarboard-fill fs-4 me-2"></i>
                            <h5 class="mb-0 fw-bold">Riwayat Jenjang Pendidikan</h5>
                        </div>
                        <p class="text-muted small mt-1 mb-4">* Silakan isi form di bawah ini. Bagian pendidikan bersifat opsional (bisa dikosongkan jika tidak ada).</p>

                        <div class="mb-4 p-3 bg-light rounded-3 border-start border-secondary border-3">
                            <h6 class="fw-bold mb-3 text-dark">Pendidikan Menengah: SMA / Sederajat</h6>
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label for="sma_nama" class="form-label small">Nama Sekolah / Institusi</label>
                                    <input type="text" class="form-control rounded-3 bg-white @error('sma_nama') is-invalid @enderror" id="sma_nama" name="sma_nama" value="{{ old('sma_nama') }}" placeholder="Contoh: SMAN 1 Bandung">
                                    @error('sma_nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="sma_tahun_lulus" class="form-label small">Tahun Lulus</label>
                                    <input type="number" class="form-control rounded-3 bg-white @error('sma_tahun_lulus') is-invalid @enderror" id="sma_tahun_lulus" name="sma_tahun_lulus" value="{{ old('sma_tahun_lulus') }}" placeholder="Contoh: 2022" min="1900" max="2100">
                                    @error('sma_tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 p-3 bg-light rounded-3 border-start border-dark border-3">
                            <h6 class="fw-bold mb-3 text-dark">Program Diploma (D3)</h6>
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label for="d3_universitas" class="form-label small">Nama Universitas / Politeknik</label>
                                    <input type="text" class="form-control rounded-3 bg-white @error('d3_universitas') is-invalid @enderror" id="d3_universitas" name="d3_universitas" value="{{ old('d3_universitas') }}" placeholder="Contoh: Poltekkes Kemenkes Bandung">
                                    @error('d3_universitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="d3_tahun_lulus" class="form-label small">Tahun Lulus</label>
                                    <input type="number" class="form-control rounded-3 bg-white @error('d3_tahun_lulus') is-invalid @enderror" id="d3_tahun_lulus" name="d3_tahun_lulus" value="{{ old('d3_tahun_lulus') }}" placeholder="Contoh: 2025" min="1900" max="2100">
                                    @error('d3_tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 p-3 bg-light rounded-3 border-start border-success border-3">
                            <h6 class="fw-bold mb-3 text-dark">Program Sarjana (S1 / D4)</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="s1_universitas" class="form-label small">Nama Universitas / Perguruan Tinggi</label>
                                    <input type="text" class="form-control rounded-3 bg-white @error('s1_universitas') is-invalid @enderror" id="s1_universitas" name="s1_universitas" value="{{ old('s1_universitas') }}" placeholder="Contoh: Universitas Indonesia">
                                    @error('s1_universitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="s1_prodi" class="form-label small">Program Studi</label>
                                    <input type="text" class="form-control rounded-3 bg-white @error('s1_prodi') is-invalid @enderror" id="s1_prodi" name="s1_prodi" value="{{ old('s1_prodi') }}" placeholder="Contoh: Kesehatan Masyarakat">
                                    @error('s1_prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-8">
                                    <label for="s1_peminatan" class="form-label small">Peminatan</label>
                                    <input type="text" class="form-control rounded-3 bg-white @error('s1_peminatan') is-invalid @enderror" id="s1_peminatan" name="s1_peminatan" value="{{ old('s1_peminatan') }}" placeholder="Masukkan peminatan jika ada">
                                    @error('s1_peminatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="s1_tahun_lulus" class="form-label small">Tahun Lulus</label>
                                    <input type="number" class="form-control rounded-3 bg-white @error('s1_tahun_lulus') is-invalid @enderror" id="s1_tahun_lulus" name="s1_tahun_lulus" value="{{ old('s1_tahun_lulus') }}" placeholder="Contoh: 2012" min="1900" max="2100">
                                    @error('s1_tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 p-3 bg-light rounded-3 border-start border-info border-3">
                            <h6 class="fw-bold mb-3 text-dark">Program Magister (S2)</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="s2_universitas" class="form-label small">Nama Universitas</label>
                                    <input type="text" class="form-control rounded-3 bg-white @error('s2_universitas') is-invalid @enderror" id="s2_universitas" name="s2_universitas" value="{{ old('s2_universitas') }}" placeholder="Contoh: Universitas Diponegoro">
                                    @error('s2_universitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="s2_prodi" class="form-label small">Program Studi</label>
                                    <input type="text" class="form-control rounded-3 bg-white @error('s2_prodi') is-invalid @enderror" id="s2_prodi" name="s2_prodi" value="{{ old('s2_prodi') }}" placeholder="Contoh: Promosi Kesehatan">
                                    @error('s2_prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-8">
                                    <label for="s2_peminatan" class="form-label small">Peminatan</label>
                                    <input type="text" class="form-control rounded-3 bg-white @error('s2_peminatan') is-invalid @enderror" id="s2_peminatan" name="s2_peminatan" value="{{ old('s2_peminatan') }}" placeholder="Contoh: Magister Kesehatan Masyarakat">
                                    @error('s2_peminatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="s2_tahun_lulus" class="form-label small">Tahun Lulus</label>
                                    <input type="number" class="form-control rounded-3 bg-white @error('s2_tahun_lulus') is-invalid @enderror" id="s2_tahun_lulus" name="s2_tahun_lulus" value="{{ old('s2_tahun_lulus') }}" placeholder="Contoh: 2016" min="1900" max="2100">
                                    @error('s2_tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 p-3 bg-light rounded-3 border-start border-warning border-3">
                            <h6 class="fw-bold mb-3 text-dark">Program Doktor (S3)</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="s3_universitas" class="form-label small">Nama Universitas</label>
                                    <input type="text" class="form-control rounded-3 bg-white @error('s3_universitas') is-invalid @enderror" id="s3_universitas" name="s3_universitas" value="{{ old('s3_universitas') }}" placeholder="Masukkan nama universitas">
                                    @error('s3_universitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label her="s3_prodi" class="form-label small">Program Studi</label>
                                    <input type="text" class="form-control rounded-3 bg-white @error('s3_prodi') is-invalid @enderror" id="s3_prodi" name="s3_prodi" value="{{ old('s3_prodi') }}" placeholder="Masukkan program studi">
                                    @error('s3_prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-8">
                                    <label for="s3_peminatan" class="form-label small">Peminatan</label>
                                    <input type="text" class="form-control rounded-3 bg-white @error('s3_peminatan') is-invalid @enderror" id="s3_peminatan" name="s3_peminatan" value="{{ old('s3_peminatan') }}" placeholder="Masukkan peminatan">
                                    @error('s3_peminatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="s3_tahun_lulus" class="form-label small">Tahun Lulus</label>
                                    <input type="number" class="form-control rounded-3 bg-white @error('s3_tahun_lulus') is-invalid @enderror" id="s3_tahun_lulus" name="s3_tahun_lulus" value="{{ old('s3_tahun_lulus') }}" placeholder="Contoh: 2021" min="1900" max="2100">
                                    @error('s3_tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mb-5">
                    <button type="reset" class="btn btn-light rounded-3 px-4 border">Reset</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-5 fw-bold shadow-sm">Simpan Data Civitas</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<script>
    function selectKategori(element) {
        var value = element.getAttribute('data-value');
        var text = element.innerText;

        // Set nilai ke hidden input agar terbaca di Controller saat submit
        document.getElementById('kategori_id').value = value;

        // Ubah teks tombol utama sesuai dengan yang dipilih
        document.getElementById('dropdownSelectedText').innerText = text;
    }
</script>
@endsection