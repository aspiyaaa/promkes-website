<style>
/* Wadah kustom untuk slider */
.carousel-custom {
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

/* Mengatur tinggi gambar aslimu agar fleksibel dan tidak gepeng */
.carousel-custom .carousel-item img {
    width: 100%;
    /* Di laptop, kunci aspek rasio spanduk memanjang (misal 16:6) */
    aspect-ratio: 16 / 6; 
    object-fit: cover; /* Menjaga gambar proporsional meski layar melar */
    object-position: center;
}

/* 📱 OPTIMASI RESEPIF KHUSUS LAYAR ANDROID (MOBILE) */
@media (max-width: 767.98px) {
    .carousel-custom .carousel-item img {
        /* Di HP Android, ubah rasio aspeknya menjadi sedikit lebih tinggi (16:9 atau 16:10)
           supaya spanduk aslimu tidak menciut terlalu tipis seperti pita */
        aspect-ratio: 16 / 9; 
    }
    
    /* Sembunyikan panah navigasi di Android agar tidak mengganggu usapan jempol */
    .carousel-custom .carousel-control-prev,
    .carousel-custom .carousel-control-next {
        display: none;
    }
}
</style>

<div class="container-fluid py-0 px-0" style="background-color: #ff6600;">
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade carousel-custom" data-bs-ride="carousel">
        
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>
        
        <div class="carousel-inner">
            
            <div class="carousel-item active" data-bs-interval="4000">
                <img src="{{ asset('assets/slide1.png') }}" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            
            <div class="carousel-item" data-bs-interval="4000">
                <img src="{{ asset('assets/slide2.png') }}" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            
            <div class="carousel-item" data-bs-interval="4000">
                <img src="{{ asset('assets/slide3.png') }}" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>

            <div class="carousel-item" data-bs-interval="4000">
                <img src="{{ asset('assets/slide4.png') }}" class="d-block w-100" alt="Slide 4">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>

            <div class="carousel-item" data-bs-interval="4000">
                <img src="{{ asset('assets/slide5.png') }}" class="d-block w-100" alt="Slide 5">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        
    </div>
</div>