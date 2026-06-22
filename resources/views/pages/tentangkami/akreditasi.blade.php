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
@endsection