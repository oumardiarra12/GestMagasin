<?php

namespace Database\Seeders;

use App\Models\RetourLigneVente;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LigneRetournVenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          RetourLigneVente::create([
            "quantite_ligneretourvente"=>10,
               'prixvente_ligneretourvente' => $faker->numerify('#######'),
               'soustotal_ligneretourvente'=>$faker->numerify('#######'),
               'produit_id'=>$i,
               'retour_vente_id'=>$i,
           ]);
       }
    }
}
