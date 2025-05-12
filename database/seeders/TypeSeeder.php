<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['libelle' => 'Ordinaire'],
            ['libelle' => 'Sanitaire'],
            ['libelle' => 'Duplex'],
            ['libelle' => 'Studio'],
            ['libelle' => 'Appartement'],
            ['libelle' => 'Villa'],
            ['libelle' => 'Chambre'],
            ['libelle' => 'Magasin'],
            ['libelle' => 'Bureau'],
            ['libelle' => 'Entrepôt'],
        ];

        foreach ($types as $type) {
            DB::table('types')->insert([
                'libelle' => $type['libelle'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
