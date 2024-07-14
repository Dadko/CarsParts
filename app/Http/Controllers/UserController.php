<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->ajax()) {
            return response()->json(['message' => 'User added successfully']);
        }

        return redirect()->route('users.index');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'User updated successfully']);
        }

        return redirect()->route('users.index');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'User deleted successfully']);
        }

        return redirect()->route('users.index');
    }
}
