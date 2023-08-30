<?php

namespace Database\Seeders;

use App\Models\Depense;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
        Depense::create([
            "num_depense"=>$faker->numerify,
            "total_depense"=>$faker->numerify('#######'),
            "note_depense"=>$faker->text,
            "categorie_depense_id"=>$i,
            "user_id"=>1,
        ]);
    }
    }
}
