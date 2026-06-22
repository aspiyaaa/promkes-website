@extends('layouts.master_admin')

@section('title', 'Tambah Berita')

@section('content_admin')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            
            <!-- Header Tampilan Form -->
            <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-gray-800">Tambah Data Konten Berita</h2>
                    <p class="text-muted small mb-0">Tulis dan terbitkan informasi, artikel, atau pengumuman terbaru</p>
                </div>
                <a href="/berita" class="btn btn-outline-secondary btn-sm rounded-pill px-3 text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <!-- Form Pengiriman Data -->
            <form action="/berita" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Card Bagian 1: Informasi Konten Utama -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 text-primary">
                            <i class="bi bi-file-earmark-text fs-4 me-2"></i>
                            <h5 class="mb-0 fw-bold">Metadata & Detail Artikel</h5>
                        </div>
                        
                        <div class="row g-3">
                            <!-- Judul Berita -->
                            <div class="col-md-12">
                                <label for="title" class="form-label fw-medium text-secondary small">Judul Berita / Artikel <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-3 @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Masukkan judul utama artikel berita" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Penulis / Author -->
                            <div class="col-md-6">
                                <label for="author" class="form-label fw-medium text-secondary small">Penulis / Author <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-3 @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author') }}" placeholder="Contoh: Humas / Nama Admin" required>
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Publikasi (Dropdown Custom Bergaya Civitas) -->
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-medium text-secondary small">Status Publikasi <span class="text-danger">*</span></label>
                                
                                <input type="hidden" name="status" id="status" value="{{ old('status') }}" required>

                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary w-100 text-start dropdown-toggle rounded-3 py-2 d-flex align-items-center justify-content-between @error('status') is-invalid border-danger text-danger @enderror" 
                                            type="button" 
                                            id="dropdownStatusBtn" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                        <span id="dropdownSelectedText">
                                            @if(old('status') == 'published')
                                                Published (Terbitkan Langsung)
                                            @elseif(old('status') == 'draft')
                                                Draft (Simpan sebagai Arsip)
                                            @else
                                                -- Pilih Status Konten --
                                            @endif
                                        </span>
                                    </button>

                                    <ul class="dropdown-menu w-100 shadow-sm rounded-3" aria-labelledby="dropdownStatusBtn">
                                        <li>
                                            <button class="dropdown-item py-2" type="button" data-value="published" onclick="selectStatus(this)">
                                                Published (Terbitkan Langsung)
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item py-2" type="button" data-value="draft" onclick="selectStatus(this)">
                                                Draft (Simpan sebagai Arsip)
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gambar Sampul / Thumbnail Berita -->
                            <div class="col-md-12">
                                <label for="thumbnail" class="form-label fw-medium text-secondary small">Gambar Sampul / Thumbnail Berita <span class="text-danger">*</span></label>
                                <input type="file" class="form-control rounded-3 @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*" required>
                                <div class="form-text text-muted small">Format berkas: JPG, JPEG, PNG. Ukuran maksimal file adalah 2MB.</div>
                                @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Bagian 2: Area Input Isi Berita -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3 text-secondary">
                            <i class="bi bi-body-text fs-4 me-2"></i>
                            <h5 class="mb-0 fw-bold">Isi Konten Artikel Berita</h5>
                        </div>
                        <p class="text-muted small mb-4">* Tuliskan seluruh paragraf informasi utama berita secara detail di bawah ini.</p>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="content" class="form-label fw-medium text-secondary small invisible h-0 m-0">Narasi Konten</label>
                                <textarea class="form-control rounded-4 p-3 bg-light @error('content') is-invalid @enderror" id="content" name="content" rows="10" placeholder="Ketikkan narasi dan isi berita lengkap di sini..." required style="resize: vertical;">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi Kontrol (Reset & Submit) -->
                <div class="d-flex justify-content-end gap-2 mb-5">
                    <button type="reset" class="btn btn-light rounded-3 px-4 border" onclick="resetDropdown()">Reset</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-5 fw-bold shadow-sm">Simpan Data Berita</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<!-- Skrip Integrasi Dropdown Penanganan Status Konten -->
<script>
    function selectStatus(element) {
        var value = element.getAttribute('data-value');
        var text = element.innerText;

        // Memasukkan value pilihan (draft / published) ke input hidden agar terbaca saat form disubmit
        document.getElementById('status').value = value;

        // Merubah teks utama tombol dropdown
        document.getElementById('dropdownSelectedText').innerText = text;
    }

    function resetDropdown() {
        // Mengembalikan teks tombol dropdown ke setelan pabrik saat form di-reset
        document.getElementById('dropdownSelectedText').innerText = '-- Pilih Status Konten --';
        document.getElementById('status').value = '';
    }
</script>
@endsection