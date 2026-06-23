<style>
    .collapse-inner .collapse-item.active {
        background-color: #f8f9fc !important;
        color: #4e73df !important;
        font-weight: bold;
    }
    .collapse-inner .collapse-item.active i {
        color: #4e73df !important;
    }
    .collapse-inner .collapse-item:hover {
        background-color: #eaecf4;
    }
</style>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <div class="p-2 bg-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="fas fa-heartbeat text-primary" style="font-size: 1.2rem;"></i>
            </div>
        </div>
        <div class="sidebar-brand-text mx-3 fw-bold tracking-wider">PROMKES</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading opacity-75 small text-uppercase tracking-wide">
        Menu Utama
    </div>

    <li class="nav-item {{ Request::is('civitas*') || Request::is('kategori*') || Request::is('badan_kelengkapan_jurusan*') || Request::is('ukmj*') || Request::is('berita*') ? 'active' : '' }}">
        <a class="nav-link {{ Request::is('civitas*') || Request::is('kategori*') || Request::is('badan_kelengkapan_jurusan*') || Request::is('ukmj*') || Request::is('berita*') ? '' : 'collapsed' }}" 
           href="#" data-toggle="collapse" data-target="#collapseDataMaster"
           aria-expanded="true" aria-controls="collapseDataMaster">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Manajemen Data</span>
        </a>
        <div id="collapseDataMaster" class="collapse {{ Request::is('civitas*') || Request::is('kategori*') || Request::is('badan_kelengkapan_jurusan*') || Request::is('ukmj*') || Request::is('berita*') ? 'show' : '' }}" 
             aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded shadow-sm">
                <h6 class="collapse-header text-gray-500 font-weight-bold">Daftar Data:</h6>
                
                <a class="collapse-item d-flex align-items-center gap-2 {{ Request::is('civitas*') ? 'active' : '' }}" href="/civitas">
                    <i class="fas fa-users fa-sm text-gray-400 mr-1"></i> Data Civitas
                </a>
                
                <a class="collapse-item d-flex align-items-center gap-2 {{ Request::is('kategori*') ? 'active' : '' }}" href="/kategori">
                    <i class="fas fa-tags fa-sm text-gray-400 mr-1"></i> Data Kategori
                </a>
                
                <a class="collapse-item d-flex align-items-center gap-2 {{ Request::is('badan_kelengkapan_jurusan*') ? 'active' : '' }}" href="/badan_kelengkapan_jurusan">
                    <i class="fas fa-sitemap fa-sm text-gray-400 mr-1"></i> Data BKJ
                </a>
                
                <a class="collapse-item d-flex align-items-center gap-2 {{ Request::is('ukmj*') ? 'active' : '' }}" href="/ukmj">
                    <i class="fas fa-running fa-sm text-gray-400 mr-1"></i> Data UKMJ
                </a>

                <a class="collapse-item d-flex align-items-center gap-2 {{ Request::is('berita*') ? 'active' : '' }}" href="/berita">
                    <i class="fas fa-newspaper fa-sm text-gray-400 mr-1"></i> Data Berita
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ Request::is('galeri_bkj*') || Request::is('galeri_ukmj*') ? 'active' : '' }}">
        <a class="nav-link {{ Request::is('galeri_bkj*') || Request::is('galeri_ukmj*') ? '' : 'collapsed' }}" 
           href="#" data-toggle="collapse" data-target="#collapseGaleri"
           aria-expanded="true" aria-controls="collapseGaleri">
            <i class="fas fa-fw fa-images"></i>
            <span>Galeri</span>
        </a>
        <div id="collapseGaleri" class="collapse {{ Request::is('galeri_bkj*') || Request::is('galeri_ukmj*') ? 'show' : '' }}" 
             aria-labelledby="headingGaleri" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded shadow-sm">
                <h6 class="collapse-header text-gray-500 font-weight-bold">Kategori Galeri:</h6>
                
                <a class="collapse-item d-flex align-items-center gap-2 {{ Request::is('galeri_bkj*') ? 'active' : '' }}" href="/galeri_bkj">
                    <i class="fas fa-folder fa-sm text-gray-400 mr-1"></i> Galeri BKJ
                </a>
                
                <a class="collapse-item d-flex align-items-center gap-2 {{ Request::is('galeri_ukmj*') ? 'active' : '' }}" href="/galeri_ukmj">
                    <i class="fas fa-folder fa-sm text-gray-400 mr-1"></i> Galeri UKMJ
                </a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>