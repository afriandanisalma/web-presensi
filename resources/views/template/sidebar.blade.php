<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Absensi</span>
      </a>
    </div>
    
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">

        @if(auth()->user()->role == 'admin')
                <li class="sidebar-header">
                    <strong>Menu Admin</strong>
                </li>
            @endif

            @if(auth()->user()->role == 'user')
            <li class="sidebar-header">
              <strong>Menu User</strong>
          </li>
          @endif

        <li class="nav-item">
          @if (Auth::user()->role === 'admin')
          <a class="nav-link text-dark @yield('Dashboard') " href="Dashboard">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
            @endif
          </a>
        </li>

        <li class="nav-item">
          @if (Auth::user()->role === 'admin')
          <a class="nav-link text-dark @yield('absensi') " href="absensi">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Kehadiran</span>
            @endif
          </a>
        </li>

        <li class="nav-item">
          @if (Auth::user()->role === 'admin')
          <a class="nav-link text-dark @yield('izin_admin') " href="{{ route('admin.izin.index') }}">
            <i class="material-symbols-rounded opacity-5">date_range</i>
            <span class="nav-link-text ms-1">Izin Peserta</span>
            @endif
          </a>
        </li>

        <li class="nav-item">
          @if (Auth::user()->role === 'admin')
          <a class="nav-link text-dark @yield('peserta') " href="peserta">
            <i class="material-symbols-rounded opacity-5">person</i>
              <span class="nav-link-text ms-1">Data Peserta</span>
            @endif  
          </a>

        <li class="nav-item">
          @if (Auth::user()->role === 'admin')
          <a class="nav-link text-dark @yield('users') " href="users">
            <i class="material-symbols-rounded opacity-5">group</i>
              <span class="nav-link-text ms-1">Akun User</span>
            @endif  
          </a> 

        <li class="nav-item">
          @if(auth()->user()->role == 'user')
          <a class="nav-link text-dark @yield('izin') " href="izin">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Izin</span>
            @endif
          </a>
        </li>
        
        <li class="nav-item">
          @if(auth()->user()->role == 'user')
          <a class="nav-link text-dark @yield('profile') " href="profile">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">profile</span>
            @endif
          </a>
        </li>
        
    
    </div>
  </aside>