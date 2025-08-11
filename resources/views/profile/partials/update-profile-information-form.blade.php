{{-- Form untuk kirim ulang verifikasi email --}}
<form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-none">
    @csrf
</form>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi nama dan email akun kamu.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="form-group mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control"
                value="{{ old('name', $user->name) }}" required autocomplete="name">
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-muted">
                        {{ __('Email kamu belum diverifikasi.') }}
                        <button type="submit" form="send-verification" class="btn btn-link p-0 align-baseline">
                            {{ __('Klik di sini untuk kirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-sm text-success">
                            {{ __('Link verifikasi baru telah dikirim ke email kamu.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>

        @if (session('status') === 'profile-updated')
            <p class="text-sm text-success mt-2">
                {{ __('Profil berhasil diperbarui.') }}
            </p>
        @endif
    </form>
</section>
