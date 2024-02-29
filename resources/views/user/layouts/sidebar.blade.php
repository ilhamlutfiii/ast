<ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('user')}}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/logo2.png')}}" alt="Logo" width="50" height="50">
        </div>
        <div class="sidebar-brand-text mx-3">MSI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('user')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pinjaman
    </div>
    <!--Pinjams -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.pinjam.index')}}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>Pinjamanku</span>
        </a>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.asetreview.index')}}">
            <i class="fas fa-comments"></i>
            <span>Reviews</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>