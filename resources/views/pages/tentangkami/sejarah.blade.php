@extends('layouts.master')

@section('content')
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
@endsection