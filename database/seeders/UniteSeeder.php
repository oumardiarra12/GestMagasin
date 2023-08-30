<?php

namespace Database\Seeders;

use App\Models\Unite;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        Unite::create([
            "code_unite"=> "carton",
            'nom_unite' => "carton",
            "description_unite"=>$faker->text,
            "user_id"=>1
        ]);
        Unite::create([
            "code_unite"=> "L",
            'nom_unite' => "Littre",
            "description_unite"=>$faker->text,
            "user_id"=>1
        ]);
        Unite::create([
            "code_unite"=> "Boite",
            'nom_unite' => "Boite",
            "description_unite"=>$faker->text,
            "user_id"=>1
        ]);
    }
}
