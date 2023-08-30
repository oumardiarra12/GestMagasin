<?php

namespace Database\Seeders;

use App\Models\Produit;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          Produit::create([
            "ref_produit"=>$faker->numerify,
            "codebarre"=>$faker->numerify('##########'),
               'nom_produit' => $faker->name,
               'prixvente_produit'=>$faker->numerify('#######'),
               'prixachat_produit'=>$faker->numerify('#######'),
               'description_produit'=>$faker->text,
               "stockmin"=>20,
               "stockactuel"=>200,
               "famille_id"=>$i,
               "unite_id"=>1,
               "user_id"=>1
           ]);
       }
    }
}
