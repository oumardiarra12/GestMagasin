<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LigneDevis;
use App\Models\LigneRetourAchat;
use App\Models\RetourVente;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            SocieteSeeder::class,
            CategorieSeeder::class,
            UserSeeder::class,
            FamilleSeeder::class,
            UniteSeeder::class,
            ProduitSeeder::class,
            ClientSeeder::class,
            FournisseurSeeder::class,
            AchatSeeder::class,
            LigneachatSeeder::class,
            ReceptionSeeder::class,
            LignereceptionSeeder::class,
            VenteSeeder::class,
            LigneventeSeeder::class,
            RetournAchatSeeder::class,
            LigneRetournAchatSeeder::class,
            RetournVenteSeeder::class,
            LigneRetournVenteSeeder::class,
            DevisSeeder::class,
            LigneDevisSeeder::class,
        ]);

    }
}
