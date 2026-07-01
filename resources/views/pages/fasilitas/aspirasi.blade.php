@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <!-- 1. JIKA FORM BERHASIL DIKIRIM (TAMPILKAN HANYA NOTIFIKASI SUKSES) -->
            @if(session('success'))
                <div class="card custom-card bg-white text-center p-5 mb-4 success-animation">
                    <div class="card-body">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success fa-5x"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-2">Berhasil Dikirim!</h2>
                        <p class="text-muted fs-5">
                            {{ session('success') }}
                        </p>
                        <p class="text-secondary small">Masukan Anda sangat berharga bagi perkembangan pelayanan akademik dan media informasi Jurusan Promosi Kesehatan.</p>
                        
                        <!-- Tombol ini akan merefresh halaman dan otomatis memunculkan form lagi -->
                        <a href="{{ url('/aspirasi_saran/create') }}" class="btn btn-outline-primary btn-sm px-4 mt-3 rounded-pill">
                            <i class="fas fa-pen me-2"></i>Kirim Masukan Lain
                        </a>
                    </div>
                </div>

            <!-- 2. JIKA KONDISI NORMAL / BELUM SUBMIT (TAMPILKAN FORM UTAMA) -->
            @else
                <div class="card custom-card bg-white p-4 p-md-5">
                    
                    <!-- BENTUK PENGANTAR (INFORMASI FITUR) -->
                    <div class="text-center mb-5">
                        <div class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3 fw-semibold text-uppercase tracking-wider">
                            <i class="fas fa-lightbulb me-2"></i>Kolaborasi & Evaluasi
                        </div>
                        <h2 class="fw-bold text-dark">Bantu Kami Berkembang ✨</h2>
                        <p class="text-muted mx-auto mt-3" style="max-width: 600px; line-height: 1.6;">
                            Selamat datang di ruang masukan informasi Jurusan Promosi Kesehatan! Wadah ini disediakan secara khusus untuk menampung ide kreatif, evaluasi teknis performa <strong>website jurusan</strong>, serta saran konstruktif demi meningkatkan kualitas pelayanan administrasi dan fasilitas di lingkungan Kampus Promkes. 
                        </p>
                        <hr class="w-25 mx-auto text-muted my-4">
                    </div>

                    <!-- FORM UTAMA -->
                    <form action="{{ url('/aspirasi_saran') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <!-- Nama Pengirim -->
                            <div class="col-md-6">
                                <label for="nama_pengirim" class="form-label fw-semibold text-secondary">Nama Pengirim <span class="text-muted font-monospace" style="font-size: 0.8rem;">(Opsional)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control bg-light border-start-0" id="nama_pengirim" name="nama_pengirim" placeholder="Kosongkan jika ingin anonim" value="{{ old('nama_pengirim') }}">
                                </div>
                            </div>

                            <!-- Status / Peran -->
                            <div class="col-md-6">
                                <label for="status_peran" class="form-label fw-semibold text-secondary">Status / Peran Anda <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-graduation-cap"></i></span>
                                    <select class="form-select border-start-0 @error('status_peran') is-invalid @enderror" id="status_peran" name="status_peran" required>
                                        <option value="" selected disabled>Pilih status...</option>
                                        <option value="mahasiswa_aktif" {{ old('status_peran') == 'mahasiswa_aktif' ? 'selected' : '' }}>Mahasiswa Aktif</option>
                                        <option value="dosen_staf" {{ old('status_peran') == 'dosen_staf' ? 'selected' : '' }}>Dosen / Staf</option>
                                        <option value="alumni" {{ old('status_peran') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                                        <option value="umum" {{ old('status_peran') == 'umum' ? 'selected' : '' }}>Masyarakat Umum</option>
                                    </select>
                                </div>
                                @error('status_peran') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- Kategori Masukan -->
                            <div class="col-12">
                                <label class="form-label fw-semibold text-secondary d-block mb-2">Kategori Masukan <span class="text-danger">*</span></label>
                                <div class="row g-2">
                                    <div class="col-md-6 col-lg-3">
                                        <input type="radio" class="btn-check" name="kategori_masukan" id="kat_web" value="teknis_website" {{ old('kategori_masukan') == 'teknis_website' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary w-100 py-3 rounded-3" for="kat_web">
                                            <i class="fas fa-code d-block mb-1 fa-lg"></i> Fitur Website
                                        </label>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <input type="radio" class="btn-check" name="kategori_masukan" id="kat_fasilitas" value="fasilitas_perkuliahan" {{ old('kategori_masukan') == 'fasilitas_perkuliahan' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-danger w-100 py-3 rounded-3" for="kat_fasilitas">
                                            <i class="fas fa-school d-block mb-1 fa-lg"></i> Fasilitas Kampus
                                        </label>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <input type="radio" class="btn-check" name="kategori_masukan" id="kat_organisasi" value="kinerja_organisasi" {{ old('kategori_masukan') == 'kinerja_organisasi' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-warning w-100 py-3 rounded-3" for="kat_organisasi">
                                            <i class="fas fa-users d-block mb-1 fa-lg"></i> Himpunan/Ormawa
                                        </label>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <input type="radio" class="btn-check" name="kategori_masukan" id="kat_lainnya" value="lainnya" {{ old('kategori_masukan') == 'lainnya' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-secondary w-100 py-3 rounded-3" for="kat_lainnya">
                                            <i class="fas fa-folder-plus d-block mb-1 fa-lg"></i> Hal Lainnya
                                        </label>
                                    </div>
                                </div>
                                @error('kategori_masukan') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- Subjek -->
                            <div class="col-12">
                                <label for="subjek" class="form-label fw-semibold text-secondary">Subjek / Inti Pembahasan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('subjek') is-invalid @enderror" id="subjek" name="subjek" placeholder="Contoh: Error pada halaman berita / Usulan tong sampah baru" value="{{ old('subjek') }}" required>
                                @error('subjek') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- Isi Pesan -->
                            <div class="col-12">
                                <label for="isi_pesan" class="form-label fw-semibold text-secondary">Detail Saran & Kritik <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('isi_pesan') is-invalid @enderror" id="isi_pesan" name="isi_pesan" rows="5" placeholder="Tuliskan argumen atau masukan Anda secara jelas di sini..." required>{{ old('isi_pesan') }}</textarea>
                                @error('isi_pesan') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- Lampiran File -->
                            <div class="col-12">
                                <label for="lampiran_file" class="form-label fw-semibold text-secondary">Dokumen Lampiran / Bukti Pendukung <span class="text-muted font-monospace" style="font-size: 0.8rem;">(Opsional, Max 2MB)</span></label>
                                <input type="file" class="form-control @error('lampiran_file') is-invalid @enderror" id="lampiran_file" name="lampiran_file" accept=".jpg,.jpeg,.png,.pdf">
                                <div class="form-text text-muted">Format yang didukung: JPG, PNG, atau PDF (Misal: Tangkapan layar web error).</div>
                                @error('lampiran_file') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- Tombol Submit -->
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-gradient w-100 text-white shadow-sm">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Masukan Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

        </div>
    </div>
</div>
<style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }
        .custom-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        .btn-gradient {
            background: linear-gradient(45deg, #0d6efd, #00c6ff);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }
        .success-animation {
            animation: bounceIn 0.6s ease;
        }
        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }
    </style>
@endsection