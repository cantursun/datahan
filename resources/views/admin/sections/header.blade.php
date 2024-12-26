<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a title="Menüyü Aç/Kapat" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a title="Tam Ekran" class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a title="Çıkış Yap" class="nav-link" href="{{ route('panel.logout') }}" role="button">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="d-flex justify-content-center align-items-center brand-box">
        <a href="{{ route('panel.dashboard') }}" class="brand-img">
            <h1>DATAHAN</h1>
        </a>
    </div>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('panel.dashboard') }}"
                       class="nav-link {{ request()->routeIs('panel.dashboard') ? 'active' : null }}">
                        <i class="fas fa-dashboard"></i>
                        <p>
                            Panel
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('panel.about.index')}}"
                       class="nav-link {{ request()->routeIs('panel.about.*') ? 'active' : null }}">
                        <i class="fas fa-book"></i>
                        <p>
                            Hakkımızda
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('panel.portfolio.index')}}"
                       class="nav-link {{ request()->routeIs('panel.portfolio.*') ? 'active' : null }}">
                        <i class="fas fa-user-circle"></i>
                        <p>
                            Portfolyo
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('panel.setting.index')}}"
                       class="nav-link {{ request()->routeIs('panel.setting.*') ? 'active' : null }}">
                        <i class="fas fa-gear"></i>
                        <p>
                            Ayarlar
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('panel.message.index')}}"
                       class="nav-link {{ request()->routeIs('panel.message.*') ? 'active' : null }}">
                        <i class="fas fa-envelope"></i>
                        <p>
                            Mesajlar
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>



