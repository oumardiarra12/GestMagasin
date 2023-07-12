<?php

namespace Database\Seeders;

use App\Models\LigneDevis;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LigneDevisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          LigneDevis::create([
            "quantite_lignedevis"=>10,
               'prixvente_lignedevis' => $faker->numerify('#######'),
               'soustotal_lignedevis'=>$faker->numerify('#######'),
               'produit_id'=>$i,
               'devis_id'=>$i,
           ]);
       }
    }
}
