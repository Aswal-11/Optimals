<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name' => 'create'],
            ['name' => 'read'],
            ['name' => 'update'],
            ['name' => 'delete'],
        ]);
    }
}
