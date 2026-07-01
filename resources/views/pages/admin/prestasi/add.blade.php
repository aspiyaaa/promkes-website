@extends('layouts.master_admin')

@section('title', 'Tambah Prestasi Mahasiswa Promkes')

@section('content_admin')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Prestasi</h1>
        <a href="/prestasi" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4 col-lg-8 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Input Prestasi Mahasiswa</h6>
        </div>
        <div class="card-body text-dark">
            <form action="/prestasi" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-md-8 mb-3">
                        <label for="nama_mahasiswa" class="font-weight-bold">Nama Mahasiswa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" 
                               id="nama_mahasiswa" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" placeholder="Masukkan nama lengkap mahasiswa" required>
                        @error('nama_mahasiswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 mb-3">
                        <label for="nim" class="font-weight-bold">NIM <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                               id="nim" name="nim" value="{{ old('nim') }}" placeholder="Masukkan NIM" required>
                        @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="nama_kompetisi" class="font-weight-bold">Nama Kompetisi / Perlombaan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_kompetisi') is-invalid @enderror" 
                           id="nama_kompetisi" name="nama_kompetisi" value="{{ old('nama_kompetisi') }}" placeholder="Contoh: Lomba Poster Kesehatan Nasional" required>
                    @error('nama_kompetisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        <label for="pencapaian" class="font-weight-bold">Pencapaian / Juara <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('pencapaian') is-invalid @enderror" 
                               id="pencapaian" name="pencapaian" value="{{ old('pencapaian') }}" placeholder="Contoh: Juara 1 / Finalis" required>
                        @error('pencapaian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 mb-3">
                        <label for="tingkat" class="font-weight-bold">Tingkat <span class="text-danger">*</span></label>
                        <select class="form-control @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat" required>
                            <option value="" disabled selected>-- Pilih Tingkat Lomba --</option>
                            <option value="Wilayah" {{ old('tingkat') == 'Wilayah' ? 'selected' : '' }}>Wilayah</option>
                            <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                            <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                        </select>
                        @error('tingkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 mb-3">
                        <label for="tahun_prestasi" class="font-weight-bold">Tahun <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('tahun_prestasi') is-invalid @enderror" 
                               id="tahun_prestasi" name="tahun_prestasi" value="{{ old('tahun_prestasi', date('Y')) }}" placeholder="Contoh: 2026" required>
                        @error('tahun_prestasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="penyelenggara" class="font-weight-bold">Penyelenggara Kegiatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" 
                           id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara') }}" placeholder="Contoh: Ikatan Mahasiswa Promosi Kesehatan Indonesia" required>
                    @error('penyelenggara')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="bukti_prestasi" class="font-weight-bold">Upload Bukti Prestasi <span class="text-muted font-weight-normal">(Sertifikat / Foto Piala - Opsional)</span></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('bukti_prestasi') is-invalid @enderror" id="bukti_prestasi" name="bukti_prestasi" accept="image/*" onchange="previewImage()">
                        <label class="custom-file-label" for="bukti_prestasi" id="file-label">Pilih file gambar...</label>
                    </div>
                    <small class="form-text text-muted">Format gambar (.jpg, .jpeg, .png) maksimal ukuran 2MB.</small>
                    @error('bukti_prestasi')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    
                    <div class="mt-3">
                        <img id="img-preview" class="img-fluid img-thumbnail d-none" style="max-height: 200px;">
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end" style="gap: 10px;">
                    <button type="reset" class="btn btn-light border">Reset</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save fa-sm text-white-50 mr-1"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function previewImage() {
        const fileInput = document.getElementById('bukti_prestasi');
        const fileLabel = document.getElementById('file-label');
        const imgPreview = document.getElementById('img-preview');

        // Mengubah label teks sesuai nama file yang dipilih
        if(fileInput.files && fileInput.files[0]) {
            fileLabel.textContent = fileInput.files[0].name;
            
            // Menampilkan preview gambar secara real-time
            const oFReader = new FileReader();
            oFReader.readAsDataURL(fileInput.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.classList.remove('d-none');
                imgPreview.src = oFREvent.target.result;
            };
        }
    }
</script>
@endsection