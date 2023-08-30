<?php

namespace Database\Seeders;

use App\Models\CategorieDepense;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieDepenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
        CategorieDepense::create([
            "nom_categorie_depense"=>$faker->name,
            "description_categorie_depense"=>$faker->text,
        ]);
    }
    }
}
