<?php

namespace Database\Seeders;

use App\Models\Achat;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          Achat::create([
            "num_achat"=>$faker->numerify,
            "status_achat_reception"=>"encours",
               //'status_achat_paiement' => "non payer",
               'total_achat'=>$faker->numerify('#######'),
               'fournisseur_id'=>$i,
               "user_id"=>1,
               'description_achat'=>$faker->text,
           ]);
       }
    }
}
