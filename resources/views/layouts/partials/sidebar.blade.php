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
        <li class="menu-item {{ (Request::RouteIs('pengurus.lpj.*')) ? 'active' : '' }}">
            <a href="{{ route('pengurus.lpj.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-report"></i>
                <div>LPJ kegiatan</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('pengurus.keuangan.*')) ? 'active' : '' }}">
            <a href="{{ route('pengurus.keuangan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dollar-circle"></i>
                <div>Management Keuangan</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('pengurus.pengumuman.*')) ? 'active' : '' }}">
            <a href="{{ route('pengurus.pengumuman.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bell"></i>
                <div>Management Pengumuman</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('pengurus.iuran.*')) ? 'active' : '' }} ">
            <a href="{{ route('pengurus.iuran.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div>Management Iuran Kas Anggota</div>
            </a>
        </li>
        @elseif (Auth()->user()->hasRole('anggota'))
        <li class="menu-item {{ (Request::RouteIs('anggota.kegiatan.*')) ? 'active' : '' }}">
            <a href="{{ route('anggota.kegiatan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                <div>Lihat Kegiatan</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('anggota.kas.*')) ? 'active' : '' }}">
            <a href="{{ route('anggota.kas.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dollar-circle"></i>
                <div>Lihat uang kas</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('anggota.bayarkas.*')) ? 'active' : '' }}">
            <a href="{{ route('anggota.bayarkas.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div>Bayar uang kas</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('anggota.pengumuman.*')) ? 'active' : '' }}">
            <a href="{{ route('anggota.pengumuman.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div>Lihat Pengumuman</div>
            </a>
        </li>
        @elseif (Auth()->user()->hasRole('masyarakat'))
        <li class="menu-item {{ (Request::RouteIs('masyarakat.kegiatan.*')) ? 'active' : '' }}">
            <a href="{{ route('masyarakat.kegiatan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                <div>Jadwal Kegiatan</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('masyarakat.pengumuman.*')) ? 'active' : '' }}">
            <a href="{{ route('masyarakat.pengumuman.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div>Lihat Pengumuman</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('masyarakat.kas.*')) ? 'active' : '' }}">
            <a href="{{ route('masyarakat.kas.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dollar"></i>
                <div>Lihat Keuangan</div>
            </a>
        </li>
        @endif

    </ul>
</aside>