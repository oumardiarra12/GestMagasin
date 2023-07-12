<?php

namespace Database\Seeders;

use App\Models\Fournisseur;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FournisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
         Fournisseur::create([
            "nom_fournisseur"=>$faker->firstName,
            "prenom_fournisseur"=>$faker->lastName,
               'email_fournisseur' => $faker->email,
               'tel_fournisseur' => $faker->phoneNumber,
               'adresse_fournisseur'=>$faker->address,
               'description_fournisseur'=>$faker->text,
           ]);
       }
    }
}
