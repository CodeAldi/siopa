<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img src="{{ asset('assets/img/favicon/favicon.ico') }}" class="app-brand-logo rounded demo" width="50"
                alt="">
            <span class="app-brand-text demo menu-text fw-bolder fs-5 ">sistem informasi <br>Organisasi Pemuda <br>Anak Air</span>
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
        <li class="menu-item open {{ (Request::RouteIs('admin.management.*')) ? 'active' : '' }}">
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
                <li class="menu-item {{ (Request::RouteIs('admin.management.pengurus.*')) ? 'active' : '' }}">
                    <a href="{{ route('admin.management.pengurus.index') }}" class="menu-link">
                        <div>Pengurus</div>
                    </a>
                </li>
                <li class="menu-item {{ (Request::RouteIs('admin.management.masyarakat.*')) ? 'active' : '' }}">
                    <a href="{{ route('admin.management.masyarakat.index') }}" class="menu-link">
                        <div>Masyarakat</div>
                    </a>
                </li>
            </ul>
        </li>
        @elseif (Auth()->user()->hasRole('pengurus'))
        <li class="menu-item {{ (Request::RouteIs('pengurus.programKerja.*')) ? 'active' : '' }}">
            <a href="{{ route('pengurus.programKerja.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-briefcase"></i>
                <div>Management Kegiatan Organisasi</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('pengurus.keuangan.*')) ? 'active' : '' }}">
            <a href="{{ route('pengurus.keuangan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dollar-circle"></i>
                <div>Management Keuangan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bell"></i>
                <div>Management Pengumuman</div>
            </a>
        </li>
        @elseif (Auth()->user()->hasRole('anggota'))
        @elseif (Auth()->user()->hasRole('masyarakat'))
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                <div>Jadwal Kegiatan</div>
            </a>
        </li>
        @endif

    </ul>
</aside>