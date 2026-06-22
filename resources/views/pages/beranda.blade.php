@extends('layouts.master')

@section('content')

<div class="container py-3 text-center">
    <div class="mb-4">
        <h2 class="fw-bold tracking-wide mb-1" style="color: #ff6200;">AKREDITASI</h2>
        <h5 class="fw-semibold text-muted" style="letter-spacing: 1px;">TAHUN 2024-2029</h5>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-11 col-lg-10 rounded">
            <div class="card border border-secondary-subtle shadow rounded-4 overflow-hidden bg-white p-2 p-sm-3">
                <img src="{{ asset('assets/akreditasi.png') }}" class="img-fluid rounded-3 w-100" alt="Sertifikat Akreditasi">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5 my-4 rounded-3" style="background-color: #2e636e;">
    <div class="container">
        <div class="row align-items-stretch g-4">
            
            <div class="col-12 col-lg-6 d-flex flex-column">
                <div class="rounded-4 overflow-hidden shadow h-100 border border-4 border-white bg-white p-1">
                    <img src="{{ asset('assets/lab.png') }}" 
                         class="img-fluid w-100 h-100 object-fit-cover rounded-3" 
                         alt="laboratorium" 
                         style="min-height: 300px;">
                </div>
            </div>
            
            <div class="col-12 col-lg-6 text-white ps-lg-5 d-flex flex-column justify-content-center">
                <h2 class="fw-bold mb-3 h3" style="letter-spacing: 0.5px; line-height: 1.4;">PRODI PROMOSI KESEHATAN PROGRAM SARJANA TERAPAN</h2>
                <div class="border-start border-3 border-warning ps-3 my-3 py-1 opacity-75">
                    <span class="badge bg-warning text-dark fw-bold px-2 py-1.5 rounded-2">Status: UNGGUL (2024)</span>
                </div>
                <p class="text-white-50" style="text-align: justify; font-size: 1rem; line-height: 1.6;">
                    Promosi Kesehatan merupakan istilah dalam ilmu kesehatan yang diartikan sebagai proses untuk memampukan masyarakat dalam memelihara dan meningkatkan kesehatannya. Promosi Kesehatan (PromKes) adalah salah satu dari kedelapan jurusan yang terdapat di Politeknik Kesehatan Kemenkes Bandung. 
                </p>
                <p class="text-white-50" style="text-align: justify; font-size: 1rem; line-height: 1.6;">
                    Promosi Kesehatan merupakan jurusan pertama di Indonesia yang berdiri pada tahun 2016 sesuai Surat Keputusan Menteri Riset, pada tanggal 19 Januari 2016 yang menyatakan bahwa Program Studi Promosi Kesehatan, Program sarjana Terapan Promosi Kesehatan Politeknik Kesehatan Kemenkes bandung resmi dibuka.
                </p>
                <p class="text-white-50 mb-0" style="text-align: justify; font-size: 1rem; line-height: 1.6;">
                    Program Studi Sarjana Terapan Promosi Kesehatan, yang pada tahun 2019 terakreditasi B, telah meningkatkan status akreditasinya menjadi Unggul pada tahun 2024.
                </p>
            </div>

        </div>
    </div>
</div>

<div class="container py-4">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark mb-2">VISI & MISI</h2>
        <p class="text-muted small px-3">Komitmen kami untuk mencetak Tenaga Promosi Kesehatan Profesional</p>
        <div class="mx-auto" style="width: 60px; height: 3px; background-color: #ff6200; border-radius: 2px;"></div>
    </div>
    
    <div class="row g-4 justify-content-center">
        <div class="col-12 col-md-6 d-flex">
            <div class="card border border-secondary-subtle shadow-sm rounded-4 p-4 w-100 bg-white" style="border-top: 4px solid #ff6200 !important;">
                <div class="d-flex align-items-center mb-3 text-dark">
                    <i class="bi bi-eye-fill fs-3 me-2" style="color: #ff6200;"></i>
                    <h3 class="h4 fw-bold mb-0" style="color: #ff6200;">VISI</h3>
                </div>
                <p class="text-secondary mb-0" style="text-align: justify; line-height: 1.6; font-size: 1.05rem;">
                    Menjadi Program Studi Promosi Kesehatan Program Sarjana Terapan yang menghasilkan lulusan unggul, berkarakter, dan berdaya saing global dalam teknologi pengembangan media Pomosi Kesehatan tahun 2029.
                </p>
            </div>
        </div>

        <div class="col-12 col-md-6 d-flex">
            <div class="card border border-secondary-subtle shadow-sm rounded-4 p-4 w-100 bg-white" style="border-top: 4px solid #ff6200 !important;">
                <div class="d-flex align-items-center mb-3 text-dark">
                    <i class="bi bi-bullseye fs-3 me-2" style="color: #ff6200;"></i>
                    <h3 class="h4 fw-bold mb-0" style="color: #ff6200;">MISI</h3>
                </div>
                <ol class="text-secondary ps-3 mb-0" style="text-align: justify; line-height: 1.6;">
                    <li class="mb-2">Menyelenggarakan pendidikan yang bermutu dan adaptif terhadap perkembangan media berbasis teknologi.</li>
                    <li class="mb-2">Melaksanakan penelitian inovatif dalam pengembangan media promosi kesehatan.</li>
                    <li class="mb-2">Melaksanakan pengabdian masyarakat berbasis hasil penelitian dalam promosi kesehatan.</li>
                    <li class="mb-0">Melaksanakan kemitraan dengan lintas sektor secara nasional maupun global.</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        
        <div class="col-12 col-lg-6 d-flex">
            <div class="card border border-secondary-subtle shadow-sm rounded-4 p-4 w-100 bg-white" style="border-top: 4px solid #2e636e !important;">
                <div class="d-flex align-items-center mb-3" style="color: #2e636e;">
                    <i class="bi bi-trophy-fill fs-3 me-2"></i>
                    <h3 class="h4 fw-bold mb-0">TUJUAN</h3>
                </div>
                <hr class="text-muted my-2">
                <ol class="text-secondary ps-3 mt-3" style="text-align: justify; line-height: 1.6;">
                    <li class="mb-3">Menghasilkan lulusan yang unggul dan kreatif dalam merancang serta memproduksi media promosi kesehatan melalui pemberdayaan masyarakat.</li>
                    <li class="mb-3">Mewujudkan penelitian yang aplikatif dibidang promosi kesehatan untuk perubahan perilaku masyarakat berbasis media teknologi.</li>
                    <li class="mb-3">Menyelenggarakan pengebdian masyarakat berbasis hasil penelitian dalam bidang promosi kesehatan untuk perubahan perilaku berbesis media tekologi dengan pendekatan pemberdayaan masyarakat.</li>
                    <li class="mb-0">Meningkatkan kualitas dan profesionalisme dosen serta tenaga kependidikan serta kemitraan dalam mendukung pengembangan media promosi kesehatan.</li>
                </ol>
            </div>
        </div>

        <div class="col-12 col-lg-6 d-flex">
            <div class="card border border-secondary-subtle shadow-sm rounded-4 p-4 w-100 bg-white" style="border-top: 4px solid #2e636e !important;">
                <div class="d-flex align-items-center mb-3" style="color: #2e636e;">
                    <i class="bi bi-diagram-3-fill fs-3 me-2"></i>
                    <h3 class="h4 fw-bold mb-0">STRATEGI</h3>
                </div>
                <hr class="text-muted my-2">
                <ol class="text-secondary ps-3 mt-3" style="text-align: justify; line-height: 1.5; font-size: 0.95rem;">
                    <li class="mb-2">Menyelenggarakan pembelajaran berbasis project-based learning dalam pengembangan media promosi kesehatan berbasis teknologi melalui pemberdayaan masyarakat.</li>
                    <li class="mb-2">Meninjau dan mengembangkan kurikulum setiap tahun sesuai tren teknologi dan kebutuhan dunia kerja.</li>
                    <li class="mb-2">Mengikutsertakan pelatihan untuk dosen dan tenaga kependidikan yang mendukung kompetensi.</li>
                    <li class="mb-2">Melaksanakan penelitian dosen sesuai dengan skema dalam pengembangan media promosi kesehatan melalui pemberdayaan masyarakat secara nasional dan global.</li>
                    <li class="mb-2">Melaksanakan pengabdian masyarakat berdasarkan hasil penelitian secara nasional dan global.</li>
                    <li class="mb-2">Meningkatkan publikasi ilmiah dan Hak Kekayaan Intelektual (HKI).</li>
                    <li class="mb-2">Mengintegrasikan hasil penelitian dan pengabdian masyarakat kedalam pembelajaran.</li>
                    <li class="mb-0">Melaksanakan kemitraan dalam melaksanakan tridharma perguruan tinggi secara naional dan global.</li>
                </ol>
            </div>
        </div>

    </div>
</div>

@endsection