<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    // optionally add constructor for middleware/permissions
    public function __construct()
    {
        // $this->middleware('can:manage-users'); // uncomment if you use gates/policies
    }

    /**
     * Display a listing of users (search + pagination).
     */
    public function index(Request $request)
    {
        $q = $request->query('q');
        $status = $request->query('status'); // active / inactive / all
        $perPage = 15;

        $users = User::query()
            ->when($q, fn($query) => $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
            }))
            ->when(in_array($status, ['active', 'inactive']), fn($query) => $query->where('status', $status === 'active' ? 1 : 0))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('Admin.users.index', compact('users', 'q', 'status'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('Admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|confirmed|min:6',
            'role' => ['required', Rule::in(['customer', 'seller', 'admin'])],
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = $request->has('status') ? 1 : 0; // ✅ use is_active instead of status

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('Admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('Admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|confirmed|min:6',
'role' => ['required', Rule::in(['customer', 'seller', 'admin'])],
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['is_active'] = $request->has('status') ? 1 : 0; // ✅ fixed

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // If you use soft deletes: $user->delete();
        // Otherwise:
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Toggle user status (active/inactive).
     */
    public function toggleStatus(User $user)
    {
        // ✅ Toggle user status between 1 (active) and 0 (inactive)
        $user->is_active = $user->is_active == 1 ? 0 : 1;
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

}
