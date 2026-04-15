<table class="table table-hover align-items-center mb-0 text-center">
    <thead class="bg-light">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Tipe User</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $index => $user)
            <tr>
                <td>{{ $users->firstItem() + $index }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->usertype) }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-muted">Tidak ada user.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-end mt-3 me-3">
    {!! $users->links('pagination::bootstrap-5') !!}
</div>
