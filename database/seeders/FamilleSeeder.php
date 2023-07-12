<?php

namespace Database\Seeders;

use App\Models\Famille;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           Famille::create([
               'nom_famille' => $faker->name,
               'description_famille' => $faker->text,
           ]);
       }
    }
}
