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
        Schema::create('retour_ligne_ventes', function (Blueprint $table) {
            $table->id();
            $table->integer("quantite_ligneretourvente");
            $table->integer("prixvente_ligneretourvente");
            $table->integer("soustotal_ligneretourvente");
            $table->foreignId("produit_id")->constrained('produits');
            $table->foreignId("retour_vente_id")->constrained('retour_ventes');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('retour_ligne_ventes', function (Blueprint $table) {
            $table->dropColumn(["produit_id","retour_vente_id"]);
        });
        Schema::dropIfExists('retour_ligne_ventes');
    }
};
