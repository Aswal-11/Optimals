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
        return view('role.index');
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'table_names' => 'required|array',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $input = $request->all();

        if (! isset($input['description'])) {
            $input['description'] = null;
        }

        $permissions = $input['permissions'];
        // Join all selected tables into one comma-separated string for every permission
        $tableNameValue = implode(',', $input['table_names'] ?? []);

        unset($input['permissions'], $input['table_names']);

        $role = Role::create($input);
        $pivotData = [];

        foreach ($permissions as $permissionId) {
            $pivotData[$permissionId] = [
                'table_name' => $tableNameValue ?: null,
            ];
        }

        $role->permissions()->sync($pivotData);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
