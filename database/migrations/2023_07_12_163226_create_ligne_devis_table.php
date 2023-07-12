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
        Schema::create('ligne_devis', function (Blueprint $table) {
            $table->id();
            $table->integer("quantite_lignedevis");
            $table->integer("prixvente_lignedevis");
            $table->integer("soustotal_lignedevis");
            $table->foreignId("produit_id")->constrained('produits');
            $table->foreignId("devis_id")->constrained('devis');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ligne_devis', function (Blueprint $table) {
            $table->dropColumn(["produit_id","devis_id"]);
        });
        Schema::dropIfExists('ligne_devis');
    }
};
