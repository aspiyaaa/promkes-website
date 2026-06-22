@extends('layouts.master_admin')

@section('title', 'Edit Berita')

@section('content_admin')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <!-- Header Tampilan Form Edit -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="h3 mb-0 text-gray-800">Edit Data Konten Berita</h2>
                <a href="/berita" class="btn btn-secondary btn-sm">Kembali</a>
            </div>

            <!-- Form Pengiriman Data Perbaruan (Update) -->
            <form action="/berita/{{ $edit_berita->id_berita }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Card Bagian 1: Informasi Konten Utama -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Metadata & Detail Artikel</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Judul Berita -->
                            <div class="col-md-12">
                                <label for="title" class="form-label">Judul Berita / Artikel <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $edit_berita->title) }}" placeholder="Masukkan judul utama artikel berita" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Penulis / Author -->
                            <div class="col-md-6">
                                <label for="author" class="form-label">Penulis / Author <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', $edit_berita->author) }}" placeholder="Contoh: Humas / Nama Admin" required>
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Publikasi (Dropdown Custom Bergaya Civitas) -->
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-medium text-secondary">Status Publikasi <span class="text-danger">*</span></label>
                                
                                <input type="hidden" name="status" id="status" value="{{ old('status', $edit_berita->status) }}" required>

                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary w-100 text-start dropdown-toggle rounded-3 py-2 d-flex align-items-center justify-content-between @error('status') is-invalid border-danger text-danger @enderror" 
                                            type="button" 
                                            id="dropdownStatusBtn" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                        <span id="dropdownSelectedText">
                                            @php
                                                $selectedStatus = old('status', $edit_berita->status);
                                                if($selectedStatus == 'published') {
                                                    $statusText = 'Published (Terbitkan Langsung)';
                                                } elseif($selectedStatus == 'draft') {
                                                    $statusText = 'Draft (Simpan sebagai Arsip)';
                                                } else {
                                                    $statusText = '-- Pilih Status Konten --';
                                                }
                                            @endphp
                                            {{ $statusText }}
                                        </span>
                                    </button>

                                    <ul class="dropdown-menu w-100 shadow-sm rounded-3" aria-labelledby="dropdownStatusBtn">
                                        <li>
                                            <button class="dropdown-item py-2 {{ old('status', $edit_berita->status) == 'published' ? 'active' : '' }}" type="button" data-value="published" onclick="selectStatus(this)">
                                                Published (Terbitkan Langsung)
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item py-2 {{ old('status', $edit_berita->status) == 'draft' ? 'active' : '' }}" type="button" data-value="draft" onclick="selectStatus(this)">
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
                                <label for="thumbnail" class="form-label">Gambar Sampul / Thumbnail Berita <span class="text-muted">(Kosongkan jika tidak ingin mengubah gambar)</span></label>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                                <div class="form-text">Format berkas: JPG, JPEG, PNG. Ukuran maksimal file adalah 2MB.</div>
                                @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tampilan Gambar Thumbnail Saat Ini -->
                            <div class="col-12 mt-2">
                                <p class="mb-1 text-muted fs-7">Gambar Thumbnail Saat Ini:</p>
                                <img src="{{ asset('uploads/berita/' . $edit_berita->thumbnail) }}" alt="Thumbnail {{ $edit_berita->title }}" class="img-thumbnail" style="max-height: 150px; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Bagian 2: Area Input Isi Berita -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Isi Konten Artikel Berita</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="content" class="form-label invisible h-0 m-0">Narasi Konten</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="12" placeholder="Ketikkan narasi dan isi berita lengkap di sini..." required style="resize: vertical;">{{ old('content', $edit_berita->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi Kontrol (Batal & Update) -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-5">
                    <a href="/berita" class="btn btn-light me-md-2">Batal</a>
                    <button type="submit" class="btn btn-primary px-5">Perbarui Data Berita</button>
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

        // Kelola kelas active pada item dropdown status
        document.querySelectorAll('.dropdown-item').forEach(item => item.classList.remove('active'));
        element.classList.add('active');
    }
</script>
@endsection