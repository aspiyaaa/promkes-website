@extends('layouts.master_admin')

@section('title', 'Update Galeri BKJ')

@section('content_admin')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="h3 mb-0 text-gray-800">Edit Dokumentasi Galeri BKJ</h2>
                <a href="/galeri_bkj" class="btn btn-secondary btn-sm">Kembali</a>
            </div>

            <form action="/galeri_bkj/{{ $edit_galeri->id_galeri_bkj }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Form Pembaruan Data Galeri</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            
                            <div class="col-md-6">
                                <label for="bkj_id" class="form-label fw-medium text-secondary">Badan Kelengkapan Jurusan (BKJ) <span class="text-danger">*</span></label>
                                
                                <input type="hidden" name="bkj_id" id="bkj_id" value="{{ old('bkj_id', $edit_galeri->bkj_id) }}" required>

                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary w-100 text-start dropdown-toggle rounded-3 py-2 d-flex align-items-center justify-content-between @error('bkj_id') is-invalid border-danger text-danger @enderror" 
                                            type="button" 
                                            id="dropdownBkjBtn" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                        <span id="dropdownSelectedText">
                                            @php
                                                $selectedId = old('bkj_id', $edit_galeri->bkj_id);
                                                $selectedText = '-- Pilih BKJ --';
                                                foreach($data_bkj as $bkj) {
                                                    if($bkj->id_bkj == $selectedId) {
                                                        $selectedText = $bkj->nama_bkj;
                                                    }
                                                }
                                            @endphp
                                            {{ $selectedText }}
                                        </span>
                                    </button>

                                    <ul class="dropdown-menu w-100 shadow-sm rounded-3" aria-labelledby="dropdownBkjBtn">
                                        @foreach ($data_bkj as $bkj)
                                            <li>
                                                <button class="dropdown-item py-2 {{ old('bkj_id', $edit_galeri->bkj_id) == $bkj->id_bkj ? 'active' : '' }}" 
                                                        type="button" 
                                                        data-value="{{ $bkj->id_bkj }}" 
                                                        onclick="selectBkj(this)">
                                                    {{ $bkj->nama_bkj }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                @error('bkj_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="foto_kegiatan" class="form-label">Foto Kegiatan <span class="text-muted">(Kosongkan jika tidak ingin mengubah foto)</span></label>
                                <input type="file" class="form-control @error('foto_kegiatan') is-invalid @enderror" id="foto_kegiatan" name="foto_kegiatan" accept="image/*">
                                <div class="form-text">Format: JPG, JPEG, PNG. Maksimal 10MB.</div>
                                @error('foto_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="keterangan_foto" class="form-label">Keterangan Foto <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('keterangan_foto') is-invalid @enderror" id="keterangan_foto" name="keterangan_foto" rows="3" placeholder="Tuliskan deskripsi singkat mengenai foto kegiatan ini..." required>{{ old('keterangan_foto', $edit_galeri->keterangan_foto) }}</textarea>
                                @error('keterangan_foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mt-3">
                                <p class="mb-1 text-muted small">Foto Kegiatan Saat Ini:</p>
                                @if($edit_galeri->foto_kegiatan && file_exists(public_path('uploads/galeri_bkj/' . $edit_galeri->foto_kegiatan)))
                                    <img src="{{ asset('uploads/galeri_bkj/' . $edit_galeri->foto_kegiatan) }}" alt="Foto Kegiatan" class="img-thumbnail rounded shadow-sm" style="max-height: 200px; object-fit: cover;">
                                @else
                                    <div class="alert alert-warning py-2 d-inline-block small mb-0">Foto tidak ditemukan di server atau terhapus.</div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-5">
                    <a href="/galeri_bkj" class="btn btn-light me-md-2">Batal</a>
                    <button type="submit" class="btn btn-primary px-5">Perbarui Data Galeri</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    function selectBkj(element) {
        var value = element.getAttribute('data-value');
        var text = element.innerText;

        // Masukkan ID terpilih ke hidden input bkj_id
        document.getElementById('bkj_id').value = value;

        // Ubah tampilan text tombol dropdown
        document.getElementById('dropdownSelectedText').innerText = text;

        // Reset dan atur ulang kelas active pada item dropdown
        document.querySelectorAll('.dropdown-item').forEach(item => item.classList.remove('active'));
        element.classList.add('active');
    }
</script>
@endsection