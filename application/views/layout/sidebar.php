<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url() ?>" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="url(#paint0_linear)" fill-opacity="0.2"/>
                    <path d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18Z" fill="#7367F0"/>
                    <path d="M12 4V2M12 22V20M4 12H2M22 12H20M6.34 6.34L4.93 4.93M19.07 19.07L17.66 17.66M6.34 17.66L4.93 19.07M19.07 4.93L17.66 6.34" stroke="#7367F0" stroke-width="2" stroke-linecap="round"/>
                    <defs>
                        <linearGradient id="paint0_linear" x1="12" y1="2" x2="12" y2="22" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#7367F0"/>
                            <stop offset="1" stop-color="#7367F0" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">SunSmart SPK</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        
        <li class="menu-item <?= ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') ? 'active' : '' ?>">
            <a href="<?= base_url('dashboard') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Master</span>
        </li>
        
        <li class="menu-item <?= ($this->uri->segment(1) == 'kriteria') ? 'active' : '' ?>">
            <a href="<?= base_url('kriteria') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
                <div data-i18n="Data Kriteria">Data Kriteria</div>
            </a>
        </li>
        
        <li class="menu-item <?= ($this->uri->segment(1) == 'alternatif') ? 'active' : '' ?>">
            <a href="<?= base_url('alternatif') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-flask"></i>
                <div data-i18n="Data Alternatif">Data Sunscreen</div>
                <div class="badge bg-label-primary rounded-pill ms-auto">Produk</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Proses SPK</span>
        </li>

        <li class="menu-item <?= ($this->uri->segment(1) == 'penilaian') ? 'active' : '' ?>">
            <a href="<?= base_url('penilaian') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-edit"></i>
                <div data-i18n="Input Penilaian">Input Penilaian</div>
            </a>
        </li>

        <li class="menu-item <?= ($this->uri->segment(1) == 'edas') ? 'active' : '' ?>">
            <a href="<?= base_url('edas') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-trophy"></i>
                <div data-i18n="Hasil Perhitungan">Hasil Perhitungan</div>
                <div class="badge bg-label-success rounded-pill ms-auto">Final</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengaturan</span>
        </li>

        <li class="menu-item <?= ($this->uri->segment(1) == 'user') ? 'active' : '' ?>">
            <a href="<?= base_url('user') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users-group"></i>
                <div data-i18n="Manajemen User">Manajemen User</div>
            </a>
        </li>
    </ul>
</aside>