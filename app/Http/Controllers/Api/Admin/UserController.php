<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:publisher,attendee,admin',
            'status' => 'required|in:active,inactive,banned',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => UserRole::from($validated['role']),
            'status' => UserStatus::from($validated['status']),
        ]);

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'string|unique:users,username,' . $user->id,
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'string|min:8',
            'role' => 'in:publisher,attendee,admin',
            'status' => 'in:active,inactive,banned',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        
        if(isset($validated['role'])){
            $validated['role'] = UserRole::from($validated['role']);
        }

        if(isset($validated['status'])){
            $validated['status'] = UserStatus::from($validated['status']);
        }

        $user->update($validated);

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
