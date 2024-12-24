<?php

namespace App\Http\Controllers;

use App\Models\PermissionType;
use Illuminate\Http\Request;

class PermissionTypeController extends Controller
{
    
    public function index()
    {
        $permissionTypes = PermissionType::all();
        return view('permissionCategory.index', ['permissionTypes' => $permissionTypes]);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => ['required', 'unique:permission_types,name', 'min:3'],
        ]);

        PermissionType::create([
            'name' => $validated['category']
        ]);
        session()->flash('success', 'Category Created!');
        return redirect()->route('all-permission-categories');
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request)
    {
        $category = PermissionType::find($request->id);
        $validated = $request->validate([
            'category' => ['required','unique:permission_types,name,'.$request->id.',id', 'min:3'],
        ]);

        $category->update([
            'name' => $validated['category']
        ]);
        session()->flash('success', 'Category Updated!');
        return redirect()->route('all-permission-categories');
    }

    
    public function destroy(string $id)
    {
        PermissionType::destroy($id);
        session()->flash('success', 'Category Deleted!');
        return redirect()->route('all-permission-categories');
    }
}
