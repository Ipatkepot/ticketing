<x-guest-layout>
    <div class="card bg-secondary shadow border-0">
        {{-- Header Card make warna Biru Primary jiga di Navbar/Sidebar --}}
        <div class="card-header bg-primary py-4 text-center">
            <h3 class="text-white mb-0">{{ __('Daftar Akun Anyar') }}</h3>
        </div>
        
        <div class="card-body px-lg-5 py-lg-5">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative border-0 shadow-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-hat-3 text-primary"></i></span>
                        </div>
                        <input id="name" class="form-control" type="text" name="name" :value="old('name')" placeholder="Nama Lengkap" required autofocus autocomplete="name" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative border-0 shadow-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-email-83 text-primary"></i></span>
                        </div>
                        <input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Email Address" required autocomplete="username" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative border-0 shadow-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open text-primary"></i></span>
                        </div>
                        <input id="password" class="form-control" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative border-0 shadow-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open text-primary"></i></span>
                        </div>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="text-center">
                    {{-- Tombol Register warna Primary (Biru) --}}
                    <button type="submit" class="btn btn-primary w-100 my-4 shadow">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="flex items-center justify-center mt-2">
                    <a class="text-sm text-primary font-weight-bold" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
