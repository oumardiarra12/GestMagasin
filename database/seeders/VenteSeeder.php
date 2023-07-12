<?php

namespace Database\Seeders;

use App\Models\Vente;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          Vente::create([
            "num_vente"=>$faker->numerify,
               'status_vente_paiement' => "non payer",
               'total_vente'=>$faker->numerify('#######'),
               'client_id'=>$i,
               "user_id"=>1,
               'description_vente'=>$faker->text,
           ]);
       }
    }
}
