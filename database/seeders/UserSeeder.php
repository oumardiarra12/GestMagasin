<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        User::create([
            'nom_user' => $faker->firstName,
            'prenom_user' => $faker->lastName,
            'telephone_user' => $faker->phoneNumber,
            'email' => 'admin@test.ml',
            'photo_user' => 'userdefault.jpg',
            'adresse_user'=>$faker->text,
            'password' => Hash::make('Bamako123'),
            'categorie_id'=>1
        ]);
        User::create([
            'nom_user' => $faker->firstName,
            'prenom_user' => $faker->lastName,
            'telephone_user' => $faker->phoneNumber,
            'email' => 'manage@test.ml',
            'photo_user' => 'userdefault.jpg',
            'adresse_user'=>$faker->text,
            'password' => Hash::make('Bamako123'),
            'categorie_id'=>2
        ]);
        for ($i=3; $i <= 5 ; $i++) {
            User::create([
                'nom_user' => $faker->firstName,
                'prenom_user' => $faker->lastName,
                'telephone_user' => $faker->phoneNumber,
                'email' => 'agent@test'.$i.'.ml',
                'photo_user' => 'userdefault.jpg',
                'adresse_user'=>$faker->text,
                'password' => Hash::make('Bamako123'),
                'categorie_id'=>3
            ]);
        }
    }
}
