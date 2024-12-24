<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array {
        return [
            new Middleware('permission:view-users', only: ['index']),
            new Middleware('permission:create-users', only: ['create']),
            new Middleware('permission:edit-users', only: ['edit']),
            // new Middleware('permission:delete-users', only: ['destroy']),
        ];
    }

    public function index()
    {
        $allUsers = User::all();
        return view('user.index', [
            'allUsers' => $allUsers
        ]);
    }

    
    public function create()
    {
        $allRoles = Role::all();
        return view('user.create', [
            'allRoles' => $allRoles,
        ]);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['min:8']
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        if (!empty($request->roles)) {
            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }
        }

        session()->flash('success', 'User Created Successfully');
        return redirect()->route('all-users');
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $hasRoles = $user->roles->pluck('name');
        $allRoles = Role::all();
        return view('user.edit', [
            'allRoles' => $allRoles,
            'hasRoles' => $hasRoles,
            'user' => $user,
        ]);
    }

    
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,'.$id.',id'],
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($request->roles)) {
            $user->syncRoles($request->roles);
        }
        else {
            $user->syncRoles([]);
        }
        
        session()->flash('success', 'User Updated!');
        return redirect()->route('all-users');
    }

    
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('success', 'User Deleted Successfully');
        return redirect()->route('all-users');
    }
}
