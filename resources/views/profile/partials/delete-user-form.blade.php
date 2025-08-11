<section>
    <header>
        <h2 class="text-lg font-medium text-danger">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-muted">
            {{ __('Setelah akun kamu dihapus, semua data akan terhapus permanen. Pastikan kamu sudah menyimpan informasi yang diperlukan.') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger mt-3"
        x-data
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Hapus Akun') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
            @csrf
            @method('delete')

            <h5 class="text-danger fw-bold mb-3">
                {{ __('Apakah kamu yakin ingin menghapus akun?') }}
            </h5>

            <p class="text-muted mb-3">
                {{ __('Setelah akun kamu dihapus, semua data akan hilang permanen. Masukkan password untuk konfirmasi.') }}
            </p>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                @if ($errors->userDeletion->has('password'))
                    <div class="text-danger mt-1">
                        {{ $errors->userDeletion->first('password') }}
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </button>
                <button type="submit" class="btn btn-danger ms-2">
                    {{ __('Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
