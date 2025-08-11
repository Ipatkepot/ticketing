<div class="min-height-300 bg-dark position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="#">
      <img src="{{ asset('argon/assets/img/logo-ct-dark.png')}}" width="26px" height="26px" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold">Ticketing Support Help</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
 
    @auth
    @php
        $usertype = auth()->user()->usertype;

        $dashboardRoute = match ($usertype) {
            'admin' => route('admin.dashboard'),
            'mahasiswa' => route('mahasiswa.dashboard'),
            'staff' => route('staff.dashboard'),
            'ketuap3ti' => route('ketuap3ti.dashboard'),
            'pimpinan' => route('pimpinan.dashboard'),
            default => '#',
        };
    @endphp

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs($usertype . '.dashboard') ? 'active' : '' }}" href="{{ $dashboardRoute }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-tv text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
            <a class="nav-link" href="{{ route('tickets.index') }}">
                <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-ticket-alt text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tiket Saya</span>
            </a>
        </li>

    {{-- ADMIN --}}
    @if ($usertype === 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('ticket_categories.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-tags text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Kategori Tiket</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('ticket_priorities.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-layer-group text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Prioritas Tiket</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-users text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Manajemen User</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.users.import.form') }}" class="nav-link">
            <i class="fas fa-file-import me-2"></i> Import User
            </a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="{{ route('user_types.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-user-cog text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Manajemen Usertype</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}" href="{{ route('admin.tickets.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list-alt text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tiket Masuk</span>
            </a>
        </li>
    @endif

    {{-- MAHASISWA --}}
    @if ($usertype === 'ketuap3ti')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.tickets.index') }}">
                <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-tasks text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tiket Masuk</span>
            </a>
        </li>

        
    @endif

    @if (auth()->user()->usertype === 'staff')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.tickets.index') }}">
                <i class="fas fa-inbox"></i>
                <span class="nav-link-text ms-1">Tiket Masuk</span>
            </a>
        </li>
    @endif

    {{-- PIMPINAN --}}
    @if (auth()->user()->usertype === 'pimpinan')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pimpinan.laporan') }}">
        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-chart-bar text-dark text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Laporan Tiket</span>
        </a>
    </li>

    <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}" href="{{ route('admin.tickets.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list-alt text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tiket Masuk</span>
            </a>
        </li>
    @endif



    {{-- Akun --}}
    <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-user text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
        </a>
    </li>
    @endauth


    </ul>
  </div>
</aside>
