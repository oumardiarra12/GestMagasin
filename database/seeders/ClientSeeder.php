<?php

namespace Database\Seeders;

use App\Models\Client;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
         Client::create([
            "nom_client"=>$faker->firstName,
            "prenom_client"=>$faker->lastName,
               'email_client' => $faker->email,
               'tel_client' => $faker->phoneNumber,
               'adresse_client'=>$faker->address,
               'description_client'=>$faker->text,
           ]);
       }
    }
}
