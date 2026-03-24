<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::select('id', 'name', 'slug')->orderBy('name')->get();
        $tableNames = config('table_access.tables');

        return view('role.create', compact('permissions', 'tableNames'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string',
            'table_names' => 'required|array',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $input = $request->only(['name', 'description']);

        $permissions = $request->permissions;
        $tableNameValue = implode(',', $request->table_names ?? []);

        $role = Role::create($input);
        $pivotData = [];

        foreach ($permissions as $permissionId) {
            $pivotData[$permissionId] = [
                'table_name' => $tableNameValue ?: null,
            ];
        }

        $role->permissions()->sync($pivotData);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::select('id', 'name', 'slug')->orderBy('name')->get();
        $tableNames = config('table_access.tables');
        
        // Get already selected tables from first permission (they are all same in store logic)
        $selectedTables = [];
        if ($role->permissions()->exists()) {
            $selectedTables = explode(',', $role->permissions()->first()->pivot->table_name);
        }

        return view('role.edit', compact('role', 'permissions', 'tableNames', 'selectedTables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string',
            'table_names' => 'required|array',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update($request->only(['name', 'description']));

        $permissions = $request->permissions;
        $tableNameValue = implode(',', $request->table_names ?? []);

        $pivotData = [];
        foreach ($permissions as $permissionId) {
            $pivotData[$permissionId] = [
                'table_name' => $tableNameValue ?: null,
            ];
        }

        $role->permissions()->sync($pivotData);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
