<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ligne_ventes', function (Blueprint $table) {
            $table->id();
            $table->integer("quantite_lignevente");
            $table->integer("prixvente_lignevente");
            $table->integer("soustotal_lignevente");
            $table->foreignId("produit_id")->constrained('produits');
            $table->foreignId("vente_id")->constrained('ventes');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ligne_ventes', function (Blueprint $table) {
            $table->dropColumn(["produit_id","vente_id"]);
        });
        Schema::dropIfExists('ligne_ventes');
    }
};
