<?php

namespace Database\Seeders;

use App\Models\RetourAchat;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RetournAchatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          RetourAchat::create([
            "num_retour_achat"=>$faker->numerify,
            "refreception_retour_achat"=>$faker->numerify,
               'total_retour_achat'=>$faker->numerify('#######'),
               'fournisseur_id'=>$i,
               "user_id"=>1,
               'description_retour_achat'=>$faker->text,
           ]);
       }
    }
}
