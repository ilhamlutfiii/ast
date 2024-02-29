<ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
      <div class="sidebar-brand-icon">
        <img src="{{ asset('images/logo2.png')}}" alt="Logo" width="50" height="50">
      </div>
      <div class="sidebar-brand-text mx-3">MSI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route('admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Manajemen
        </div>

    <!-- Users -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usersCollapse" aria-expanded="true" aria-controls="usersCollapse">
          <i class="fas fa-sitemap"></i>
          <span>Users</span>
        </a>
        <div id="usersCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opsi User</h6>
            <a class="collapse-item" href="{{route('units.index')}}">Unit</a>
            <a class="collapse-item" href="{{route('jabatans.index')}}">Jabatan</a>
            <a class="collapse-item" href="{{route('bidangs.index')}}">Bidang</a>
            <a class="collapse-item" href="{{route('fungsis.index')}}">Fungsi</a>
            <a class="collapse-item" href="{{route('users.index')}}">User</a>
          </div>
        </div>
    </li>
        <!-- Categories -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryCollapse">
          <i class="fas fa-sitemap"></i>
          <span>Kategori Aset IT</span>
        </a>
        <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opsi Kategori:</h6>
            <a class="collapse-item" href="{{route('category.index')}}">Kategori</a>
            <a class="collapse-item" href="{{route('category.create')}}">Tambah Kategori</a>
          </div>
        </div>
    </li>
        <!-- Aset IT -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#asetCollapse" aria-expanded="true" aria-controls="asetCollapse">
          <i class="fas fa-cubes"></i>
          <span>Aset IT</span>
        </a>
        <div id="asetCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opsi Aset IT:</h6>
            <a class="collapse-item" href="{{route('aset.index')}}">Aset IT</a>
            <a class="collapse-item" href="{{route('aset.create')}}">Tambah Aset IT</a>
          </div>
        </div>
    </li>

    <!--Peminjaman -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('pinjam.index')}}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>Peminjaman</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('maintenance.index')}}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>Maintenance</span>
        </a>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('review.index')}}">
            <i class="fas fa-comments"></i>
            <span>Reviews</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
     <!-- Heading -->
    <div class="sidebar-heading">
        General Settings
    </div>

     <!-- General settings -->
     <li class="nav-item">
        <a class="nav-link" href="{{route('settings')}}">
            <i class="fas fa-cog"></i>
            <span>Settings</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>