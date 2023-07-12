<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        Categorie::create([
            "nom_categorie"=>"Admin",
            "description_categorie"=>$faker->text,
        ]);
        Categorie::create([
            "nom_categorie"=>"Manager",
            "description_categorie"=>$faker->text,
        ]);
        Categorie::create([
            "nom_categorie"=>"Agent",
            "description_categorie"=>$faker->text,
        ]);
    }
}
