<style>
/* Kustomisasi gaya footer agar senada dengan navbar premium */
.footer-custom {
    background-color: #1f444c; /* Warna toska tua yang solid dan elegan */
    color: #e9ecef;
}

.footer-custom a {
    color: #ced4da;
    text-decoration: none;
    transition: all 0.2s ease;
}

/* Efek hover warna oranye khas Promkes pada link footer */
.footer-custom a:hover {
    color: #ff8533;
    padding-left: 4px; /* Efek bergeser sedikit yang manis saat disorot */
}

.footer-custom .footer-title {
    color: #ffffff;
    font-weight: 600;
    position: relative;
    padding-bottom: 10px;
}

/* Garis bawah oranye kecil di bawah judul kolom */
.footer-custom .footer-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 2px;
    background-color: #ff8533;
    border-radius: 2px;
}

.footer-custom .social-icon {
    width: 36px;
    height: 36px;
    background-color: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.footer-custom .social-icon:hover {
    background-color: #ff8533;
    transform: translateY(-3px);
}
</style>

<div class="mt-5" style="background: #ff8533; height:5px;"></div>
<footer class="footer-custom pt-5 pb-3">
    <div class="container">
        <div class="row g-4 justify-content-between">
            
            <div class="col-12 col-md-6 col-lg-4">
                <div class="mb-3">
                    <img src="/assets/logo-polkesban.png" alt="Logo Poltekkes Bandung" height="45" class="bg-white p-1 rounded-2 mb-3">
                    <h5 class="fw-bold mb-0 text-white small tracking-wide">PRODI PROMOSI KESEHATAN</h5>
                    <p class="text-muted small mb-0">Poltekkes Kemenkes Bandung</p>
                </div>
                <p class="small text-secondary-subtle" style="text-align: justify; line-height: 1.6;">
                    Menghasilkan lulusan unggul, berkarakter, dan berdaya saing global dalam teknologi pengembangan media Promosi Kesehatan.
                </p>
            </div>

            <div class="col-12 col-sm-6 col-lg-2 ps-lg-4">
                <h6 class="footer-title text-uppercase mb-3 small tracking-wider">Navigasi</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="/beranda"><i class="bi bi-chevron-right small me-1"></i> Beranda</a></li>
                    <li><a href="/akreditasi"><i class="bi bi-chevron-right small me-1"></i> Akreditasi</a></li>
                    <li><a href="/visimisi"><i class="bi bi-chevron-right small me-1"></i> Visi & Misi</a></li>
                    <li><a href="/struktur"><i class="bi bi-chevron-right small me-1"></i> Struktur</a></li>
                    <li><a href="/berita"><i class="bi bi-chevron-right small me-1"></i> Berita</a></li>
                </ul>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <h6 class="footer-title text-uppercase mb-3 small tracking-wider">Fasilitas</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="/ruangkelas"><i class="bi bi-chevron-right small me-1"></i> Ruang Kelas</a></li>
                    <li><a href="/lab"><i class="bi bi-chevron-right small me-1"></i> Laboratorium</a></li>
                    <li><a href="/peminjaman"><i class="bi bi-chevron-right small me-1"></i> Peminjaman Lab</a></li>
                    <li><a href="/layanan"><i class="bi bi-chevron-right small me-1"></i> Layanan Mahasiswa</a></li>
                </ul>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <h6 class="footer-title text-uppercase mb-3 small tracking-wider">Kontak Kami</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small text-secondary-subtle">
                    <li class="d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill text-warning mt-1"></i>
                        <span>Jl. Babakan Loa, Pasirkaliki, Kec. Cimahi Utara, Kota Cimahi, Jawa Barat 40514</span>
                    </li>
                    <!-- <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill text-warning"></i>
                        <span>(022) 4201042</span>
                    </li> -->
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill text-warning"></i>
                        <span>promkes@potekkesbandung.ac.id</span>
                    </li>
                </ul>
                <div class="d-flex gap-2 mt-3">
                    <a href="https://instagram.com/promkes.poltekkesbandung" class="social-icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="https://youtube.com/@mediapromkes_polkesban?si=VnFV9XCvTrTbRwFq" class="social-icon" aria-label="Youtube"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="social-icon" aria-label="Website"><i class="bi bi-globe"></i></a>
                </div>
            </div>
        </div>

        <hr class="opacity-10 my-4 bg-white">

        <div class="row align-items-center small text-secondary-subtle">
            <div class="col-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
                &copy; {{ date('Y') }} Prodi Promosi Kesehatan Poltekkes Kemenkes Bandung. All Rights Reserved.
            </div>
            <div class="col-12 col-md-6 text-center text-md-end">
                <span class="small">Developed</span>
            </div>
        </div>
    </div>
</footer>