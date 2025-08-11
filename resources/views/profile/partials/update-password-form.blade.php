<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="form-group mb-3">
        <label for="current_password" class="form-label">Password Saat Ini</label>
        <input type="password" name="current_password" id="current_password" class="form-control" required autocomplete="current-password">
        @error('current_password')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="password" class="form-label">Password Baru</label>
        <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
        @error('password')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

</section>
