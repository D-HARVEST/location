<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['libelle' => 'Entrer Coucher'],
            ['libelle' => '1 chambre, 1 salon'],
            ['libelle' => '3 chambres, 1 salon'],
            ['libelle' => '3 chambres, 2 salons'],
            ['libelle' => '4 chambres, 1 salons'],
            ['libelle' => '4 chambres, 2 salons'],
            ['libelle' => '5 chambres, 1 salon'],
            ['libelle' => '5 chambres, 2 salons'],
        ];

        foreach ($categories as $categorie) {
            DB::table('categories')->insert([
                'libelle' => $categorie['libelle'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
