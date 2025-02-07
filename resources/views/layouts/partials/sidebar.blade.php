<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img src="{{ asset('assets/img/favicon/favicon.ico') }}" class="app-brand-logo rounded demo" width="50"
                alt="">
            <span class="app-brand-text demo menu-text fw-bolder ">sistem informasi</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Home -->
        <li class="menu-item {{ (Request::RouteIs('home')) ? 'active' : '' }} ">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Home</div>
            </a>
        </li>
        @if (Auth()->user()->hasRole('admin'))
        {{-- user admin --}}
        <li class="menu-item {{ (Request::RouteIs('admin.management.*')) ? 'active open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="User interface">Management User</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (Request::RouteIs('admin.management.anggota.*')) ? 'active' : '' }}">
                    <a href="{{ route('admin.management.anggota.index') }}" class="menu-link">
                        <div>Anggota</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div>Pengurus</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div>Masyarakat</div>
                    </a>
                </li>
            </ul>
        </li>
        @elseif (Auth()->user()->hasRole('pengurus'))
        @elseif (Auth()->user()->hasRole('anggota'))
        @elseif (Auth()->user()->hasRole('masyarakat'))
        @endif

    </ul>
</aside>