<?php

namespace Database\Seeders;

use App\Models\LigneVente;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LigneventeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          LigneVente::create([
            "quantite_lignevente"=>10,
               'prixvente_lignevente' => $faker->numerify('#######'),
               'soustotal_lignevente'=>$faker->numerify('#######'),
               'produit_id'=>$i,
               'vente_id'=>$i,
           ]);
       }
    }
}
