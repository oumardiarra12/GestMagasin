<?php

namespace Database\Seeders;

use App\Models\RetourVente;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RetournVenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          RetourVente::create([
            "num_retourvente"=>$faker->numerify,
            "ref_retourvente"=>$faker->numerify,
               'total_retourvente'=>$faker->numerify('#######'),
               'client_id'=>$i,
               "user_id"=>1,
               'description_retourvente'=>$faker->text,
           ]);
       }
    }
}
