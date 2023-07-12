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
        Schema::create('ligne_retour_achats', function (Blueprint $table) {
            $table->id();
            $table->integer("quantite_retourligneAchat");
            $table->integer("prixachat_retourligneAchat");
            $table->integer("soustotal_retourligneAchat");
            $table->foreignId("produit_id")->constrained('produits');
            $table->foreignId("retour_achat_id")->constrained('retour_achats');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ligne_retour_achats', function (Blueprint $table) {
            $table->dropColumn(["produit_id","retour_achat_id"]);
        });
        Schema::dropIfExists('ligne_retour_achats');
    }
};
