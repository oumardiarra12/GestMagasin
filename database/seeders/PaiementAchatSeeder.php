<?php

namespace Database\Seeders;

use App\Models\PaiementAchat;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaiementAchatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
         PaiementAchat::create([
            "total_achat"=>$faker->numerify('#######'),
            "total_payer"=>$faker->numerify('#######'),
               'total_reste' => $faker->numerify('#######'),
               'reception_id' => $i,
               "user_id"=>1,
               'description_paiement'=>$faker->text,
           ]);
       }
    }
}
