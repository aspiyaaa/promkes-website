@extends('layouts.master_admin')

@section('title', 'Ubah Unit Kegiatan Mahasiswa Jurusan')

@section('content_admin')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="mb-4 pb-2 border-bottom">
                <h2 class="h4 mb-1 fw-bold text-gray-800">Ubah Data UKMJ</h2>
                <p class="text-muted small mb-0">Perbarui profil, tautan eksternal, atau lambang dari unit kegiatan mahasiswa.</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    
                    <form action="/ukmj/{{ $edit_bkj->id_ukmj }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="nama_ukmj" class="form-label text-secondary fw-bold small">Nama Unit Kegiatan Mahasiswa Jurusan</label>
                            <input type="text" 
                                   class="form-control rounded-3 shadow-sm @error('nama_ukmj') is-invalid @enderror" 
                                   id="nama_ukmj" 
                                   name="nama_ukmj" 
                                   value="{{ old('nama_ukmj', $edit_bkj->nama_ukmj) }}" 
                                   placeholder="Contoh: UKMJ Olahraga">
                            @error('nama_ukmj')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label text-secondary fw-bold small">Deskripsi Singkat Kegiatan / Profil</label>
                            <textarea class="form-control rounded-3 shadow-sm @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="5" 
                                      placeholder="Tuliskan profil singkat UKMJ...">{{ old('deskripsi', $edit_bkj->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="medsos" class="form-label text-secondary fw-bold small">Link Media Sosial / Instagram Resmi</label>
                            <input type="text" 
                                   class="form-control rounded-3 shadow-sm @error('medsos') is-invalid @enderror" 
                                   id="medsos" 
                                   name="medsos" 
                                   value="{{ old('medsos', $edit_bkj->medsos) }}" 
                                   placeholder="Contoh: https://instagram.com/username_ukmj">
                            @error('medsos')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="logo" class="form-label text-secondary fw-bold small">Logo Resmi UKMJ</label>
                            
                            <div class="mb-3 p-2 border rounded-3 bg-light d-flex align-items-center gap-3" style="max-width: 100%;">
                                @if($edit_bkj->logo)
                                    <img src="{{ asset('uploads/ukmj/' . $edit_bkj->logo) }}" alt="Current Logo" class="img-thumbnail rounded-2" style="max-height: 60px; max-width: 60px; object-fit: cover;">
                                    <div>
                                        <div class="small fw-bold text-dark">Logo Aktif Saat Ini</div>
                                        <div class="text-muted" style="font-size: 0.75rem;">{{ $edit_bkj->logo }}</div>
                                    </div>
                                @else
                                    <div class="bg-white border rounded-2 d-flex align-items-center justify-content-center text-muted" style="height: 60px; width: 60px;">
                                        <i class="bi bi-image fs-4"></i>
                                    </div>
                                    <div class="small text-muted">Belum ada file logo yang terunggah.</div>
                                @endif
                            </div>

                            <input type="file" 
                                   class="form-control rounded-3 shadow-sm @error('logo') is-invalid @enderror" 
                                   id="logo" 
                                   name="logo" 
                                   accept="image/*">
                            <div class="form-text text-muted small mt-1">Kosongkan jika tidak ingin merubah logo (.png, .jpg, .jpeg, maks. 2MB).</div>
                            @error('logo')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                            <a href="/ukmj" class="btn btn-light rounded-3 border px-3 btn-sm text-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary rounded-3 px-4 btn-sm fw-bold shadow-sm">
                                <i class="bi bi-save me-1"></i> Perbarui Data UKMJ
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection