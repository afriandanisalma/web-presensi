<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">@yield('breadcrumb_parent', 'Pages')</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('breadcrumb_current', 'Dashboard')</li>
        </ol>
      </nav>
      
        <ul class="navbar-nav d-flex align-items-center  justify-content-end">
          <li class="nav-item dropdown">
            {{-- <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> --}}
              <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile Photo" class="rounded-circle" width="40" height="40">
                {{-- {{ Auth::user()->name }} --}}
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('profile.index') }}">Profil</a>
                
            </div>
        </li>
        
          
          
        </ul>

        

      </div>
    </div>
  </nav>