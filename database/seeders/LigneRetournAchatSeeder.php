<?php

namespace Database\Seeders;

use App\Models\LigneRetourAchat;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LigneRetournAchatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          LigneRetourAchat::create([
            "quantite_retourligneAchat"=>10,
               'prixachat_retourligneAchat' => $faker->numerify('#######'),
               'soustotal_retourligneAchat'=>$faker->numerify('#######'),
               'produit_id'=>$i,
               'retour_achat_id'=>$i,
           ]);
       }
    }
}
