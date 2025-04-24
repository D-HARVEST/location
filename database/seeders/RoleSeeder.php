<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Super-admin', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            if (\Spatie\Permission\Models\Role::where('name', $role['name'])->exists()) {
                continue;
            }
            \Spatie\Permission\Models\Role::create($role);
        }

        $permissions = config('permissions');
        $adminRole = \Spatie\Permission\Models\Role::where('name', 'Super-admin')->first();
        $adminRole->syncPermissions($permissions);
    }
}
