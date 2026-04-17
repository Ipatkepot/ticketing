<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="text-center mb-4">
                <h1 class="text-white font-weight-bold" style="letter-spacing: 2px; text-transform: uppercase;">
                    Ticketing System
                </h1>
                <p class="text-white opacity-8">Support Help Desk</p>
            </div>

            <div class="card glass-card shadow-lg">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center mb-4">
                        <h2 class="text-primary font-weight-bold">Selamat Datang</h2>
                        <p class="text-muted small">Silakan masuk untuk melanjutkan</p>
                    </div>
                    
                  <form role="form" method="POST" action="{{ route('login') }}" class="text-start">
    @csrf
    
    {{-- Input Email --}}
    <label class="form-control-label text-muted small ms-1">Alamat Email</label>
    <div class="form-group mb-3">
        <div class="input-group input-group-merge input-group-alternative shadow-none border-0" 
             style="background-color: #f4f5f7; border-radius: 0.75rem;">
            <div class="input-group-prepend">
                <span class="input-group-text bg-transparent border-0">
                    <i class="ni ni-email-83 text-primary"></i>
                </span>
            </div>
            <input class="form-control border-0 ps-0 bg-transparent" placeholder="name@example.com" 
                   type="email" name="email" value="{{ old('email') }}" required autofocus 
                   style="height: 48px; font-weight: 600;">
        </div>
        <x-input-error :messages="$errors->get('email')" class="mt-1 ms-2" />
    </div>

    {{-- Input Password --}}
    <label class="form-control-label text-muted small ms-1">Kata Sandi</label>
    <div class="form-group mb-4">
        <div class="input-group input-group-merge input-group-alternative shadow-none border-0" 
             style="background-color: #f4f5f7; border-radius: 0.75rem;">
            <div class="input-group-prepend">
                <span class="input-group-text bg-transparent border-0">
                    <i class="ni ni-lock-circle-open text-primary"></i>
                </span>
            </div>
            <input class="form-control border-0 ps-0 bg-transparent" placeholder="••••••••" 
                   type="password" name="password" required 
                   style="height: 48px; font-weight: 600;">
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-1 ms-2" />
    </div>

    {{-- Remember Me & Forgot Row --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" id="remember_me" type="checkbox" name="remember">
            <label class="custom-control-label" for="remember_me">
                <span class="text-muted small">Ingat saya</span>
            </label>
        </div>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-primary small font-weight-bold">Lupa Sandi?</a>
        @endif
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary w-100 shadow-none border-0 py-3" 
            style="border-radius: 0.75rem; background: linear-gradient(310deg, #5e72e4 0%, #825ee4 100%); font-weight: 700; font-size: 0.875rem; letter-spacing: 0.5px;">
            MASUK KE DASHBOARD
        </button>
    </div>
</form>
                </div>
            </div>
            
           @if (Route::has('register'))
            <div class="text-center mt-4 position-relative" style="z-index: 10;">
                <p class="text-white mb-0 small opacity-8">Belum punya akun?</p>
                <a href="{{ route('register') }}" 
                   class="text-white font-weight-bold" 
                   style="text-decoration: none; border-bottom: 1px solid rgba(255,255,255,0.5); padding-bottom: 2px; transition: all 0.3s;">
                    Buat Akun Baru
                </a>
            </div>
            @endif
        </div>
    </div>
</x-guest-layout>