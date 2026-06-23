@extends('layouts.master_admin')

@section('title', 'Tambah Galeri BKJ')

@section('content_admin')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            
            <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-gray-800">Tambah Dokumentasi Galeri BKJ</h2>
                    <p class="text-muted small mb-0">Kelola foto kegiatan dan dokumentasi Badan Kelengkapan Jurusan</p>
                </div>
                <a href="/galeri_bkj" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="/galeri_bkj" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 text-primary">
                            <i class="bi bi-images fs-4 me-2"></i>
                            <h5 class="mb-0 fw-bold">Informasi Dokumentasi</h5>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label自动 for="bkj_id" class="form-label fw-medium text-secondary small">Badan Kelengkapan Jurusan <span class="text-danger">*</span></label>
                                
                                <input type="hidden" name="bkj_id" id="bkj_id" value="{{ old('bkj_id') }}" required>

                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary w-100 text-start dropdown-toggle rounded-3 py-2 d-flex align-items-center justify-content-between @error('bkj_id') is-invalid border-danger text-danger @enderror" 
                                            type="button" 
                                            id="dropdownBkjBtn" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                        <span id="dropdownSelectedText">
                                            @if(old('bkj_id'))
                                                @foreach($data_bkj as $bkj)
                                                    @if($bkj->id_bkj == old('bkj_id'))
                                                        {{ $bkj->nama_bkj }}
                                                    @endif
                                                @endforeach
                                            @else
                                                -- Pilih BKJ --
                                            @endif
                                        </span>
                                    </button>

                                    <ul class="dropdown-menu w-100 shadow-sm rounded-3" aria-labelledby="dropdownBkjBtn">
                                        @foreach ($data_bkj as $bkj)
                                            <li>
                                                <button class="dropdown-item py-2" 
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
                                <label for="foto_kegiatan" class="form-label fw-medium text-secondary small">Foto Kegiatan <span class="text-danger">*</span></label>
                                <input type="file" class="form-control rounded-3 @error('foto_kegiatan') is-invalid @enderror" id="foto_kegiatan" name="foto_kegiatan" accept="image/*" required>
                                <div class="form-text text-muted small">Format: JPG, JPEG, PNG. Maksimal 10MB.</div>
                                @error('foto_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="keterangan_foto" class="form-label fw-medium text-secondary small">Keterangan Foto / Deskripsi Kegiatan <span class="text-danger">*</span></label>
                                <textarea class="form-control rounded-3 @error('keterangan_foto') is-invalid @enderror" id="keterangan_foto" name="keterangan_foto" rows="4" placeholder="Jelaskan mengenai foto kegiatan yang diunggah..." required>{{ old('keterangan_foto') }}</textarea>
                                @error('keterangan_foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mb-5">
                    <button type="reset" class="btn btn-light rounded-3 px-4 border">Reset</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-5 fw-bold shadow-sm">Simpan Data Galeri</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<script>
    function selectBkj(element) {
        var value = element.getAttribute('data-value');
        var text = element.innerText;

        // Set nilai ke hidden input agar terbaca di Controller saat submit
        document.getElementById('bkj_id').value = value;

        // Ubah teks tombol utama sesuai dengan yang dipilih
        document.getElementById('dropdownSelectedText').innerText = text;
    }
</script>
@endsection