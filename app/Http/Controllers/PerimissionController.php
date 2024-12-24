<?php

namespace App\Http\Controllers;
use App\Models\PermissionType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;

class PerimissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array {
        return [
            new Middleware('permission:view-permissions', only: ['index']),
            new Middleware('permission:create-permissions', only: ['store']),
            new Middleware('permission:edit-permissions', only: ['update']),
            new Middleware('permission:delete-permissions', only: ['destroy']),
        ];
    }

    public function index()
    {
        $permissions = Permission::all();
        $permissionTypes = PermissionType::all();
        return view('allPermissions', [
            'permissions' => $permissions,
            'permissionTypes' => $permissionTypes,
        ]);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'permissionType' => ['required'],
            'permission' => ['required', 'unique:permissions,name'],
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name' => $validated['permission'],
            'permission_type' => $validated['permissionType']
        ]);

        session()->flash('success', 'Permission Created Successfully!');
        return redirect()->route('all-permissions');
    }

    
    public function show( $permission)
    {
        //
    }

    
    public function edit( $permission)
    {
        //
    }

    
    public function update(Request $request)
    {
        $id = $request->id;
        $validated = $request->validate([
            'permission' => ['required', 'unique:permissions,name,'.$id.',id'], // => ignores the permission with id=$id.
        ]);

        $permission = \Spatie\Permission\Models\Permission::find($id);

        $permission->update([
            'name' => $validated['permission'],
        ]);

        session()->flash('success', 'Permission Updated Successfully!');
        return redirect()->route('all-permissions');

    }

    
    public function destroy($id)
    {
        $permission = \Spatie\Permission\Models\Permission::find($id);
        $permission->delete();
        session()->flash('success', 'Permission Deleted Successfully!');
        return redirect()->route('all-permissions');
    }
}
