<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTypeController extends Controller
{
    public function __construct()
    {
        if (Auth::check() && Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized access.');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_types = \App\Models\UserType::all();
        return view('user_types.index', compact('user_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_types = UserType::all();
        return view('user_types.create', compact('user_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        UserType::create([
            'name' => $request->name,
        ]);

        return redirect()->route('user_types.index')->with('success', 'Usertype berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserType $userType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserType $userType)
    {
        return view('user_types.edit', compact('userType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserType $userType)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $userType->update([
            'name' => $request->name,
        ]);

        return redirect()->route('user_types.index')->with('success', 'Usertype berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserType $userType)
    {
        $userType->delete();
        return redirect()->route('user_types.index')->with('success', 'Usertype berhasil dihapus.');
    }
}
