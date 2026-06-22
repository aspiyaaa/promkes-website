<style>
/* Modifikasi navbar-custom agar lebih cantik dan rapi */
.navbar-custom {
    background: #ffffffd2 !important; /* Warna dasar putih transparan */
    backdrop-filter: blur(10px); /* Efek blur kaca di belakang navbar */
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05); /* Bayangan halus di bawah navbar */
    transition: all 0.3s ease;
}

/* Mempercantik tampilan link menu */
.navbar-custom .nav-link {
    color: #495057 !important;
    font-weight: 500;
    padding: 0.5rem 1rem !important;
    transition: color 0.2s ease;
}

/* Efek hover warna oranye khas Promkes saat kursor diarahkan ke menu */
.navbar-custom .nav-link:hover, 
.navbar-custom .nav-link:focus,
.navbar-custom .show > .nav-link {
    color: #ff6200 !important; 
}

/* Merapikan tampilan kotak dropdown di laptop maupun mobile */
.navbar-custom .dropdown-menu {
    border: 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border-radius: 12px;
    padding: 0.5rem;
}

.navbar-custom .dropdown-item {
    border-radius: 8px;
    padding: 0.5rem 1rem;
    color: #495057;
    font-weight: 500;
}

.navbar-custom .dropdown-item:hover {
    background-color: rgba(255, 98, 0, 0.08);
    color: #ff6200;
}

/* Mengatur jarak logo agar tidak menempel di Android */
@media (max-width: 991.98px) {
    .navbar-brand img {
        height: 35px !important; /* Menyeimbangkan ukuran logo di handphone */
    }
    .navbar-collapse {
        margin-top: 1rem;
        padding-bottom: 0.5rem;
    }
    .navbar-nav .nav-item {
        padding-left: 0.5rem;
    }
}
</style>

<nav class="navbar navbar-expand-lg navbar-light sticky-top navbar-custom py-2">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/beranda">
            <img src="/assets/logo-polkesban.png" alt="Logo Polkesban" height="38" class="d-inline-block align-top">
            <!-- <div class="vr bg-secondary opacity-25 my-1" style="height: 25px; width: 1.5px;"></div>
            <img src="/assets/logo-promkes.png" alt="Logo Promkes" height="48" class="d-inline-block align-top"> -->
        </a>
        
        <button class="navbar-toggler border-0 rounded-3 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color: rgba(0,0,0,0.03);">
            <span class="navbar-toggler-icon" style="font-size: 1.15rem;"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-1 mb-2 mb-lg-0" style="font-size: 0.95rem;">
                
                <li class="nav-item">
                    <a class="nav-link" href="/beranda">Beranda</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTentang" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tentang Kami
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0" aria-labelledby="navbarDropdownTentang">
                        <li><a class="dropdown-item" href="/akreditasi">Akreditasi</a></li>
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li><a class="dropdown-item" href="/sejarah">Sejarah Promkes</a></li>
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li><a class="dropdown-item" href="/visimisi">Visi & Misi</a></li>
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li><a class="dropdown-item" href="/tujuanstrategi">Tujuan & Strategi</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/struktur">Struktur Organisasi</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMhs" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kemahasiswaan
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0" aria-labelledby="navbarDropdownMhs">
                        <li><a class="dropdown-item" href="/BKJ">Badan Kelengkapan Jurusan</a></li>
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li><a class="dropdown-item" href="/UKMJ">Unit Kegiatan Mahasiswa</a></li>
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li><a class="dropdown-item" href="/layanan">Layanan Kemahasiswaan</a></li>
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li><a class="dropdown-item" href="/tracer">Tracer Study</a></li>
                    </ul>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownFasilitas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Fasilitas
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0" aria-labelledby="navbarDropdownFasilitas">
                        <li><a class="dropdown-item" href="/ruangkelas">Ruang Kelas</a></li>
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li><a class="dropdown-item" href="/lab">Laboratorium</a></li>
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li><a class="dropdown-item" href="/fasilitaslain">Fasilitas Lain</a></li>
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li><a class="dropdown-item" href="/peminjaman">Peminjaman Lab</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/news">Berita</a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>