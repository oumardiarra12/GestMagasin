<?php

namespace Database\Seeders;

use App\Models\PaiementVente;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaiementVenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
         PaiementVente::create([
            "total_vente"=>$faker->numerify('#######'),
            "total_payer"=>$faker->numerify('#######'),
               'total_reste' => $faker->numerify('#######'),
               'vente_id' => $i,
               "user_id"=>1,
               'description_paiement'=>$faker->text,
           ]);
       }
    }
}
