<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class PermissionService
{
    public function check(string $action, string $table): bool
    {
        // 1. Main User (Full Access)
        if (Auth::guard('web')->check()) {
            return true;
        }

        // 2. Subuser (Role-based access)
        if (Auth::guard('subuser')->check()) {

            $subUser = Auth::guard('subuser')->user();

            if (!$subUser->role) {
                return false;
            }

            $permissions = $subUser->role->permissions()
                ->where('slug', $action)
                ->get();

            foreach ($permissions as $permission) {
                $tables = explode(',', $permission->pivot->table_name);
                if (in_array($table, $tables)) {
                    return true;
                }
            }

            return false;
        }

        // 3. Not logged in
        return false;
    }
}
