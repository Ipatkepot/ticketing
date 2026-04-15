@php
    // Ambil nama rute yang sedang aktif (contoh: admin.dashboard)
    $currentRoute = Route::currentRouteName();

    // Jika route tidak dinamai, fallback ke segment URL
    $pageTitle = $currentRoute 
        ? ucwords(str_replace(['.', '_'], [' › ', ' '], $currentRoute)) 
        : ucwords(str_replace('-', ' ', request()->segment(1)));
@endphp
<div class="min-height-300 bg-dark position-absolute w-100"></div>

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      </ol>
      <h6 class="font-weight-bolder text-white mb-0">{{ $pageTitle }}</h6>
    </nav>

    <!-- <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group">
          <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
          <input type="text" class="form-control" placeholder="Cari...">
        </div>
      </div> -->

      <ul class="navbar-nav justify-content-end">
        {{-- User Info --}}
        <li class="nav-item d-flex align-items-center">
          <span class="nav-link text-white font-weight-bold px-2">
            <i class="fas fa-user me-sm-1"></i>
            @if(Auth::check())
                {{ Auth::user()->name }}
            @endif
          </span>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-danger ms-2">
              <i class="fas fa-sign-out-alt me-1"></i> Logout
            </button>
          </form>
        </li>

        {{-- Toggle Sidebar Mobile --}}
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="#" class="nav-link text-white p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="fas fa-bars"></i>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->