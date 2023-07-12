<?php

namespace Database\Seeders;

use App\Models\Societe;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocieteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        Societe::create([
            "nom_societe"=>"SADIOTECH",
            "activite_societe"=>"gestion",
            "tel_societe"=>$faker->phoneNumber,
            "logo_societe"=>$faker->imageUrl,
            "nif_societe"=>"123456789",
            "bp_societe"=>"Bamako 123",
            "adresse"=>$faker->address
        ]);
    }
}
