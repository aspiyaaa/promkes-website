@extends('layouts.master')

@section('content')
<div class="py-4 py-md-5">
    <div class="container-fluid px-3 px-md-4">
        
        <div class="card border-light shadow-sm rounded-lg overflow-hidden" style="border: 1px solid #e3e6f0;">
            <div class="card-header bg-white py-3 border-bottom" style="border-bottom: 2px solid #f8f9fc !important;">
                <h5 class="m-0 font-weight-bold text-secondary" style="color: #4e73df !important; font-size: 1.1rem;">
                    Master Data Prestasi Mahasiswa
                </h5>
            </div>
            
            @if($data_prestasi->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle mb-0 seragam-table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">NO</th>
                                <th scope="col">NAMA MAHASISWA / TIM</th>
                                <th scope="col">DETAIL KOMPETISI & PENYELENGGARA</th>
                                <th scope="col" class="text-center">TINGKAT</th>
                                <th scope="col" class="text-center">TAHUN</th>
                                <th scope="col" class="text-center">PENCAPAIAN</th>
                                <th scope="col" class="text-center" style="width: 150px;">AKSI FOTO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_prestasi as $index => $item)
                                <tr>
                                    <td class="text-center text-muted align-middle" style="font-size: 0.95rem;">
                                        {{ $index + 1 }}
                                    </td>
                                    
                                    <td class="align-middle">
                                        <div class="font-weight-bold text-dark" style="font-size: 0.95rem; color: #2d3748 !important;">
                                            {{ $item->nama_mahasiswa }}
                                        </div>
                                        <div class="text-muted small">NIM. {{ $item->nim ?? '-' }}</div>
                                    </td>
                                    
                                    <td class="align-middle">
                                        <div class="font-weight-bold text-dark text-wrap-mobile" style="font-size: 0.95rem;">
                                            {{ $item->nama_kompetisi }}
                                        </div>
                                        <div class="text-muted small">Penyelenggara: {{ $item->penyelenggara }}</div>
                                    </td>
                                    
                                    <td class="text-center align-middle">
                                        @if($item->tingkat == 'Internasional')
                                            <span class="badge badge-danger px-2 py-1 text-uppercase" style="font-size: 70%; letter-spacing: 0.5px;">Internasional</span>
                                        @elseif($item->tingkat == 'Nasional')
                                            <span class="badge badge-primary px-2 py-1 text-uppercase" style="font-size: 70%; letter-spacing: 0.5px;">Nasional</span>
                                        @else
                                            <span class="badge badge-warning text-dark px-2 py-1 text-uppercase" style="font-size: 70%; letter-spacing: 0.5px;">Wilayah</span>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center align-middle font-weight-bold text-secondary" style="font-size: 0.95rem;">
                                        {{ $item->tahun_prestasi }}
                                    </td>
                                    
                                    <td class="text-center align-middle">
                                        <span class="font-weight-bold text-success" style="font-size: 0.95rem;">
                                            {{ $item->pencapaian }}
                                        </span>
                                    </td>
                                    
                                    <td class="text-center align-middle">
                                        @if($item->bukti_prestasi)
                                            <button type="button" class="btn btn-primary btn-sm px-3 py-1.5 btn-buka-foto-kustom" data-id="{{ $item->id }}" style="background-color: #4e73df; border-color: #4e73df; border-radius: 4px; font-size: 0.85rem; font-weight: 600;">
                                                Lihat Foto <i class="fas fa-external-link-alt ml-1" style="font-size: 10px;"></i>
                                            </button>

                                            <div id="popupFoto-{{ $item->id }}" class="custom-overlay-prestasi" style="display: none;">
                                                <div class="custom-popup-box">
                                                    <div class="popup-header d-flex justify-content-between align-items-center">
                                                        <h6 class="m-0 font-weight-bold text-dark text-left">Bukti: {{ $item->nama_kompetisi }}</h6>
                                                        <button type="button" class="close-popup-btn" data-id="{{ $item->id }}">&times;</button>
                                                    </div>
                                                    <div class="popup-body bg-dark">
                                                        <img src="{{ asset('uploads/' . $item->bukti_prestasi) }}" alt="Bukti">
                                                    </div>
                                                    <div class="popup-footer text-left small text-muted">
                                                        Oleh Mahasiswa: {{ $item->nama_mahasiswa }}
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted small font-italic">Tidak ada file</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-folder-open fa-2x mb-2 opacity-50"></i>
                    <p class="mb-0 small">Belum ada data prestasi yang terdaftar.</p>
                </div>
            @endif
        </div>

    </div>
</div>

<style>
    /* Styling Header & Baris Tabel */
    .seragam-table {
        width: 100%;
        border-collapse: collapse;
    }
    .seragam-table thead th {
        background-color: #f8f9fc !important;
        color: #5a5c69 !important;
        font-weight: 700 !important;
        font-size: 0.8rem !important;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e3e6f0 !important;
        border-top: none !important;
        padding: 12px 10px !important;
    }
    .seragam-table tbody td {
        border-bottom: 1px solid #e3e6f0 !important;
        padding: 14px 10px !important;
        font-size: 0.9rem;
    }
    .seragam-table tbody tr:hover {
        background-color: #f8f9fc;
    }
    .text-wrap-mobile {
        white-space: normal;
        word-break: break-word;
        max-width: 250px;
    }

    /* DESAIN POP-UP OVERLAY KUSTOM (Murni CSS & Lebih Responsif) */
    .custom-overlay-prestasi {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
    }
    .custom-popup-box {
        background: #fff;
        width: 100%;
        max-width: 550px;
        border-radius: 6px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        overflow: hidden;
        animation: popupShow 0.2s ease-out;
    }
    .popup-header {
        padding: 12px 15px;
        background: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }
    .close-popup-btn {
        background: none;
        border: none;
        font-size: 1.6rem;
        line-height: 1;
        color: #b7b9cc;
        cursor: pointer;
        padding: 0;
    }
    .close-popup-btn:hover {
        color: #3a3b45;
    }
    .popup-body {
        padding: 10px;
        text-align: center;
    }
    .popup-body img {
        max-width: 100%;
        max-height: 65vh;
        object-fit: contain;
        border-radius: 4px;
    }
    .popup-footer {
        padding: 10px 15px;
        background: #f8f9fc;
        border-top: 1px solid #e3e6f0;
    }

    @keyframes popupShow {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Klik Buka Foto
        $('.btn-buka-foto-kustom').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#popupFoto-' + id).css('display', 'flex');
            $('body').css('overflow', 'hidden'); // Kunci scroll halaman belakang
        });

        // Klik Tombol Tutup / Tanda Silang (X) -> Langsung Hilang Seketika
        $('.close-popup-btn').on('click', function() {
            var id = $(this).data('id');
            $('#popupFoto-' + id).css('display', 'none');
            $('body').css('overflow', 'auto'); // Aktifkan scroll kembali
        });

        // Klik di area hitam kosong luar gambar untuk menutup alternatif
        $('.custom-overlay-prestasi').on('click', function(e) {
            if ($(e.target).hasClass('custom-overlay-prestasi')) {
                $(this).css('display', 'none');
                $('body').css('overflow', 'auto');
            }
        });
    });
</script>
@endsection