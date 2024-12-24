<?php

namespace App\Http\Controllers;

use App\Models\PermissionType;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class RolesController extends Controller implements HasMiddleware
{

    public static function middleware(): array {
        return [
            new Middleware('permission:view-roles', only: ['index']),
            new Middleware('permission:create-roles', only: ['create']),
            new Middleware('permission:edit-roles', only: ['edit']),
            new Middleware('permission:delete-roles', only: ['destroy']),
        ];
    }

    public function debug() {
    //     $allPermissions = \Spatie\Permission\Models\Permission::all();
    //     return view('demofile', [
    //         'allPermissions' => $allPermissions,
    //     ]);
        return view('debug.debug-accordian');
    }
    public function index()
    {
        $roles = Role::all();
        $allPermissions = Permission::all();
        $permissionTypes = PermissionType::all();

        $permissionData = PermissionType::with('permissions')
        ->get()
        ->mapWithKeys(function ($type) {
            return [
                $type->name => $type->permissions->toArray()
            ];
        });

        // foreach loop representation of the above lambda function would be as follows:
        // $permissionTypes = PermissionType::with('permissions')->get();

        // $permissionData = [];
        // foreach ($permissionTypes as $type) {
        //     $permissionData[$type->name] = $type->permissions->toArray();
        // }

        // dd($permissionData);

        return view('allRoles', [
            'roles' => $roles,
            'allPermissions' => $allPermissions,
            'permissionTypes' => $permissionTypes,
            'permissionData' => $permissionData,
        ]);
    }

    public function create() {
        $allPermissions = Permission::all();
        $permissionTypes = PermissionType::all();
        return view('createRole', [
            'allPermissions' => $allPermissions,
            'permissionTypes' => $permissionTypes,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->permissions);
        $validated = $request->validate([
            'role' => ['required', 'unique:roles,name'],
        ]);

        $role = Role::create([
            'name' => $validated['role'],
        ]);

        if(!empty($request->permissions)) {
            foreach ($request->permissions as $permission) {
                $role->givePermissionTo($permission);
            }
        }

        session()->flash('success', 'Role Created Successfully!');
        return redirect()->route('all-roles');
    }

    public function edit($id) {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $allPermissions = Permission::all();
        $permissionTypes = PermissionType::all();

        return view('editRole', [
            'allPermissions' => $allPermissions,
            'hasPermissions' => $hasPermissions,
            'permissionTypes' => $permissionTypes,
            'role' => $role,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'role' => ['required', 'unique:roles,name,'.$id.',id'], // 'unique:table,column,except,id'
        ]);

        $role = Role::find($request->id);

        $role->update([
            'name' => $validated['role'],
        ]);

        if(!empty($request->permissions)) {
            $role->syncPermissions($request->permissions);
        }
        else {
            $role->syncPermissions([]);
        }

        session()->flash('success', 'Role Updated Successfully!');
        return redirect()->route('all-roles');

    }



    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        session()->flash('success', 'Role Deleted Successfully!');
        return redirect()->route('all-roles');
    }
}
