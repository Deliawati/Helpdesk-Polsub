<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('welcome')}}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img  src="{{ asset('logoPOLSUB2-1.png') }}" alt="Brand Logo" class="img-fluid" width="25">
            </span>
            <h6 class="text-capitalize fs-4 mt-3 text-body fw-bolder">Helpdesk</h6>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="{{route('home')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Modul</span>
        </li>
        <li class="menu-item">
            <a href="{{route('modul-chatbot.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bot"></i>
                <div data-i18n="Account Settings">Chatbot</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('modul-tiket.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-band-aid"></i>
                <div data-i18n="Authentications">Tiket</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('modul-faq.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-question-mark"></i>
                <div data-i18n="Authentications">FAQ</div>
            </a>
        </li>

        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Master</span></li>
        <li class="menu-item">
            <a href="javasscript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-info-circle"></i>
                <div data-i18n="Basic">Info Akademik</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('master-layanan-akademik.index')}}" class="menu-link">
                    <div data-i18n="Without menu">Layanan</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{route('master-kalender-akademik.index')}}" class="menu-link">
                    <div data-i18n="Without navbar">Kalender</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{route('master-peraturan-akademik.index')}}" class="menu-link">
                    <div data-i18n="Container">Peraturan</div>
                  </a>
                </li>
            </ul>
        </li>
        @if(Auth::user()->role == 'superadmin')
            <li class="menu-item">
                <a href="{{route('master-users.index')}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-group"></i>
                    <div data-i18n="Basic">Data Admin</div>
                </a>
            </li>
        @endif
    </ul>
</aside>
