<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::with('permissions')->get();

        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        $permissions = Permission::select('id', 'name', 'slug')->orderBy('name')->get();
        $tableNames = config('table_access.tables');

        return view('role.create', compact('permissions', 'tableNames'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string',
            'permissions' => 'required|array',
            'permissions.*' => 'array',
            'permissions.*.*' => 'exists:permissions,id',
        ]);

        $role = Role::create($request->only(['name', 'description']));

        $this->syncRolePermissions($role, $request->input('permissions', []));

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        $permissions = Permission::select('id', 'name', 'slug')->orderBy('name')->get();
        $tableNames = config('table_access.tables');

        $selectedPermissions = [];
        foreach ($role->permissions as $permission) {
            $tables = explode(',', $permission->pivot->table_name);
            foreach ($tables as $table) {
                $table = trim($table);
                if (! $table) {
                    continue;
                }

                $selectedPermissions[$table][] = $permission->id;
            }
        }

        return view('role.edit', compact('role', 'permissions', 'tableNames', 'selectedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$role->id,
            'description' => 'nullable|string',
            'permissions' => 'required|array',
            'permissions.*' => 'array',
            'permissions.*.*' => 'exists:permissions,id',
        ]);

        $role->update($request->only(['name', 'description']));

        $this->syncRolePermissions($role, $request->input('permissions', []));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }

    private function syncRolePermissions(Role $role, array $permissions): void
    {
        $insertData = $this->preparePermissionData($permissions, $role->id);

        DB::transaction(function () use ($role, $insertData) {
            DB::table('role_permission')
                ->where('role_id', $role->id)
                ->delete();

            if (! empty($insertData)) {
                DB::table('role_permission')->insert($insertData);
            }
        });
    }

    private function preparePermissionData(array $permissions, int $roleId): array
    {
        $now = now();
        $rows = [];

        foreach ($permissions as $table => $permissionIds) {
            if (! is_array($permissionIds)) {
                continue;
            }

            foreach (array_unique($permissionIds) as $permissionId) {
                $permissionId = (int) $permissionId;

                if ($permissionId <= 0) {
                    continue;
                }

                $rows[] = [
                    'role_id' => $roleId,
                    'permission_id' => $permissionId,
                    'table_name' => $table,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        return array_values(array_unique($rows, SORT_REGULAR));
    }
}
