<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Super-admin', 'guard_name' => 'web'],
            ['name' => 'locataire', 'guard_name' => 'web'],
            ['name' => 'gerant', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            if (!Role::where('name', $role['name'])->exists()) {
                Role::create($role);
            }
        }

        // Optionnel : attribuer toutes les permissions à Super-admin
        $permissions = config('permissions'); 
        $adminRole = Role::where('name', 'Super-admin')->first();
        if ($adminRole && is_array($permissions)) {
            $adminRole->syncPermissions($permissions);
        }
    }
}
