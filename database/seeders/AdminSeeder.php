<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the admins table.
     */
    public function run(): void
    {
        Admin::insert([
                'email' => 'admin@test.com',
                'name' => 'Test Admin',
                'password' => Hash::make('password123'),
            ]);
    }
}
