<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $showArchived = $request->input('archived');

        if ($showArchived) {
            $users = User::onlyTrashed()
                ->when($search, fn($q) => $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%"))
                ->orderBy('deleted_at', 'desc')
                ->paginate(15);
            $archived = $users;
        } else {
            $users = User::whereNull('deleted_at')
                ->when($search, fn($q) => $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%"))
                ->orderBy('created_at', 'desc')
                ->paginate(15);
            $archived = User::onlyTrashed()
                ->when($search, fn($q) => $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%"))
                ->paginate(15);
        }

        return view('admin.user-management', compact('users', 'archived'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // validation / create logic can be added later
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'username' => $request->username ?? null,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
        ]);

        $user->update($request->only(['full_name', 'email', 'username', 'role']));

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // prevent admin from deleting themselves
        if (Auth::id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User archived.');
    }

    /**
     * Restore archived user.
     */
    public function restore($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('users.index')->with('success', 'User restored.');
    }
}