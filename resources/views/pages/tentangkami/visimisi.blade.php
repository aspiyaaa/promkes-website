@extends('layouts.master')

@section('content')
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
@endsection