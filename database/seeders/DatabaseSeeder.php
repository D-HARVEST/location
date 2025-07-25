<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Administrateur',
            'email' => 'admin@admin',
            'password' => bcrypt('p@ssw0rd'),
        ]);

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CategorieSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(SettingsTableSeeder::class);
        try {
            $admin->assignRole('Super-admin');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
