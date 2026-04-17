<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="text-center mb-4">
                <h1 class="text-white font-weight-bold" style="letter-spacing: 2px; text-transform: uppercase;">
                    Reset Password
                </h1>
                <p class="text-white opacity-8">Ticketing System Support</p>
            </div>

            <div class="card glass-card shadow-lg border-0" style="border-radius: 1rem !important;">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center mb-4">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md mb-3 mx-auto">
                            <i class="ni ni-key-25 text-white opacity-10" aria-hidden="true"></i>
                        </div>
                        <h2 class="text-primary font-weight-bold">Lupa Kata Sandi?</h2>
                        <p class="text-muted small">
                            {{ __('Masukkan email Anda dan kami akan kirimkan link reset password.') }}
                        </p>
                    </div>

                    <x-auth-session-status class="mb-4 text-success font-weight-bold small text-center" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group mb-4">
                            <label class="form-control-label text-muted small ms-1">Alamat Email</label>
                            <div class="input-group input-group-merge input-group-alternative shadow-none border-0" 
                                 style="background-color: #f4f5f7; border-radius: 0.75rem;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-0">
                                        <i class="ni ni-email-83 text-primary"></i>
                                    </span>
                                </div>
                                <input id="email" class="form-control border-0 ps-0 bg-transparent" 
                                       placeholder="name@example.com" type="email" name="email" 
                                       value="{{ old('email') }}" required autofocus 
                                       style="height: 48px; font-weight: 600;">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1 ms-2" />
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100 shadow-none border-0 py-3" 
                                style="border-radius: 0.75rem; background: linear-gradient(310deg, #5e72e4 0%, #825ee4 100%); font-weight: 700; font-size: 0.875rem; letter-spacing: 0.5px;">
                                {{ __('KIRIM LINK RESET') }}
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-primary small font-weight-bold">
                            <i class="ni ni-bold-left small me-1"></i> Kembali ke Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>