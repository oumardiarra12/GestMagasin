<?php

namespace Database\Seeders;

use App\Models\Devis;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DevisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          Devis::create([
            "num_devis"=>$faker->numerify,
               'status_devis' => "non accepter",
               'total_devis'=>$faker->numerify('#######'),
               'client_id'=>$i,
               "user_id"=>1,
               'description_devis'=>$faker->text,
           ]);
       }
    }
}
