<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:staff,vendor,kepala_sekolah',
        ]);

        User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password),
            'role' => $r->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User baru berhasil ditambahkan.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
