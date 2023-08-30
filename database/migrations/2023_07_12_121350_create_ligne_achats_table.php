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
        Schema::create('ligne_achats', function (Blueprint $table) {
            $table->id();
            $table->integer("quantite_ligneAchat");
            $table->integer("quantite_recu_ligneAchat")->nullable();
            $table->integer("quantiterecu_ligneAchat")->nullable();
            $table->integer("prixachat_ligneAchat");
            $table->integer("soustotal_ligneAchat");
            $table->foreignId("produit_id")->constrained('produits');
            $table->foreignId("achat_id")->constrained('achats');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ligne_achats', function (Blueprint $table) {
            $table->dropColumn(["produit_id","achat_id"]);
        });
        Schema::dropIfExists('ligne_achats');
    }
};
