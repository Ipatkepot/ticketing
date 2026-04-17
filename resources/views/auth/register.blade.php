<x-guest-layout>
    <div class="card bg-secondary shadow border-0">
        {{-- Header Card Warna Biru sarua jiga Dashboard --}}
        <div class="card-header bg-primary pb-5">
            <div class="text-white text-center mt-2 mb-3">
                <h2 class="text-white">Daptar Akun</h2>
                <small>Eusian data diri di handap</small>
            </div>
        </div>
        
        <div class="card-body px-lg-5 py-lg-5 mt--6">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative border-0 shadow-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-hat-3 text-primary"></i></span>
                        </div>
                        <input id="name" class="form-control" placeholder="Nama Lengkap" type="text" name="name" :value="old('name')" required autofocus />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
                </div>

                <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative border-0 shadow-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-email-83 text-primary"></i></span>
                        </div>
                        <input id="email" class="form-control" placeholder="Email" type="email" name="email" :value="old('email')" required />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                </div>

                <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative border-0 shadow-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open text-primary"></i></span>
                        </div>
                        <input id="password" class="form-control" placeholder="Password" type="password" name="password" required />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                </div>

                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative border-0 shadow-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open text-primary"></i></span>
                        </div>
                        <input id="password_confirmation" class="form-control" placeholder="Konfirmasi Password" type="password" name="password_confirmation" required />
                    </div>
                </div>

                <div class="text-center">
                    {{-- Tombol warna Primary sarua jiga Navbar/Sidebar --}}
                    <button type="submit" class="btn btn-primary w-100 my-4 shadow-lg">
                        {{ __('Register Sekarang') }}
                    </button>
                </div>

                <div class="text-center">
                    <a class="text-sm text-primary font-weight-bold" href="{{ route('login') }}">
                        {{ __('Geus boga akun? Login didiyeu') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
