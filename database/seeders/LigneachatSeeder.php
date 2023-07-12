<?php

namespace Database\Seeders;

use App\Models\LigneAchat;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LigneachatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          LigneAchat::create([
            "quantite_ligneAchat"=>10,
            "quantite_recu_ligneAchat"=>5,
               'prixachat_ligneAchat' => $faker->numerify('#######'),
               'soustotal_ligneAchat'=>$faker->numerify('#######'),
               'produit_id'=>$i,
               'achat_id'=>$i,
           ]);
       }
    }
}
