<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img  src="{{ asset('logoPOLSUB2-1.png') }}" alt="Brand Logo" class="img-fluid" width="25">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Helpdesk</span>
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
            <a href="{{route('master-chatbot.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bot"></i>
                <div data-i18n="Account Settings">Chatbot</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('master-tiket.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-band-aid"></i>
                <div data-i18n="Authentications">Tiket</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('master-faq.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-question-mark"></i>
                <div data-i18n="Authentications">FAQ</div>
            </a>
        </li>

        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="{{route('master-users.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Basic">Users</div>
            </a>
        </li>
    </ul>
</aside>
