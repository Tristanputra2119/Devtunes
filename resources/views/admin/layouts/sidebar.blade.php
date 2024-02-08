<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="sidebar-brand-text mx-3">DevTune</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li
        class="nav-item @yield('dashboard') {{ strpos(request()->path(), 'dashboard') !== false ? 'active' : '' }}
        ">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Music Management
    </div>

    <!-- Nav Item - Charts -->
    <li
        class="nav-item @yield('playlist') {{ strpos(request()->path(), 'playlist') !== false ? 'active' : '' }}
        ">
        <a class="nav-link" href="{{ route('playlist.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Playlist</span></a>
    </li>
    <li class="nav-item @yield('music') {{ strpos(request()->path(), 'music') !== false ? 'active' : '' }}
        ">
        <a class="nav-link" href="{{ route('music.index') }}">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Music</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
