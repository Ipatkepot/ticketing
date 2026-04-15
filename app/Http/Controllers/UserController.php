<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserType;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('usertype', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        // Supaya pagination ikut bawa parameter search
        $users->appends(['search' => $search]);

        return view('users.index', compact('users', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userTypes = UserType::all();
        return view('users.create', compact('userTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'usertype' => 'required|exists:user_types,name',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->usertype,
        ]);

        return redirect()->route('users-management.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function search(Request $request)
{
    $search = $request->get('query', '');

    $users = User::where('name', 'like', "%{$search}%")
        ->orWhere('email', 'like', "%{$search}%")
        ->orWhere('usertype', 'like', "%{$search}%")
        ->orderBy('name', 'asc')
        ->paginate(10);

    // Untuk AJAX, kembalikan hanya partial table
    if ($request->ajax()) {
        return view('users.partials.table', compact('users'))->render();
    }

    return view('users.index', compact('users'));
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $userTypes = UserType::all();
        return view('users.edit', compact('user', 'userTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'usertype' => 'required|string|exists:user_types,name'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'usertype' => $request->usertype
        ]);

        return redirect()->route('users.index')->with('success', 'Tipe user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
        ->with('success', 'User berhasil dihapus.');
    }
}
