<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="text-center mb-4">
                <h1 class="text-white font-weight-bold" style="letter-spacing: 2px; text-transform: uppercase;">
                    Buat Akun Baru
                </h1>
                <p class="text-white opacity-8">Daftar untuk mengakses Ticketing System</p>
            </div>

            <div class="card glass-card shadow-lg border-0" style="border-radius: 1rem !important;">
                <div class="card-body px-lg-5 py-lg-5">
                    <form method="POST" action="{{ route('register') }}" class="text-start">
                        @csrf

                        {{-- Input Nama --}}
                        <label class="form-control-label text-muted small ms-1">Nama Lengkap</label>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative shadow-none border-0" 
                                 style="background-color: #f4f5f7; border-radius: 0.75rem;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-0">
                                        <i class="ni ni-hat-3 text-primary"></i>
                                    </span>
                                </div>
                                <input class="form-control border-0 ps-0 bg-transparent" placeholder="Jhon Doe" 
                                       type="text" name="name" value="{{ old('name') }}" required autofocus 
                                       style="height: 48px; font-weight: 600;">
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-1 ms-2" />
                        </div>

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
                                       type="email" name="email" value="{{ old('email') }}" required 
                                       style="height: 48px; font-weight: 600;">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1 ms-2" />
                        </div>

                        {{-- Input Password --}}
                        <label class="form-control-label text-muted small ms-1">Kata Sandi</label>
                        <div class="form-group mb-3">
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

                        {{-- Konfirmasi Password --}}
                        <label class="form-control-label text-muted small ms-1">Konfirmasi Kata Sandi</label>
                        <div class="form-group mb-4">
                            <div class="input-group input-group-merge input-group-alternative shadow-none border-0" 
                                 style="background-color: #f4f5f7; border-radius: 0.75rem;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-0">
                                        <i class="ni ni-lock-circle-open text-primary"></i>
                                    </span>
                                </div>
                                <input class="form-control border-0 ps-0 bg-transparent" placeholder="••••••••" 
                                       type="password" name="password_confirmation" required 
                                       style="height: 48px; font-weight: 600;">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100 shadow-none border-0 py-3" 
                                style="border-radius: 0.75rem; background: linear-gradient(310deg, #5e72e4 0%, #825ee4 100%); font-weight: 700; font-size: 0.875rem; letter-spacing: 0.5px;">
                                DAFTAR SEKARANG
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4 position-relative" style="z-index: 10;">
                <p class="text-white mb-0 small opacity-8">Sudah punya akun?</p>
                <a href="{{ route('login') }}" 
                   class="text-white font-weight-bold" 
                   style="text-decoration: none; border-bottom: 1px solid rgba(255,255,255,0.5); padding-bottom: 2px;">
                    Masuk ke Sistem
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>