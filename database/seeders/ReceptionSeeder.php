<?php

namespace Database\Seeders;

use App\Models\Reception;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          Reception::create([
            "num_reception"=>$faker->numerify,
            "num_piece"=>$faker->numerify('##########'),
               'status_achat_paiement' => "non payer",
               'total_reception'=>$faker->numerify('#######'),
               'description_reception'=>$faker->text,
               "achat_id"=>1,
               "user_id"=>1,
           ]);
       }
    }
}
