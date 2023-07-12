<?php

namespace Database\Seeders;

use App\Models\LigneReception;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LignereceptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          LigneReception::create([
            "quantite_achat_ligne_reception"=>10,
            "quantite_ligne_reception"=>5,
               'prixachat_ligne_reception' => $faker->numerify('#######'),
               'soustotal_ligne_lignereception'=>$faker->numerify('#######'),
               'produit_id'=>$i,
               'reception_id'=>$i,
           ]);
       }
    }
}
