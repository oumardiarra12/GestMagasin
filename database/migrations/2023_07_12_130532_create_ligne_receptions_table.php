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
        Schema::create('ligne_receptions', function (Blueprint $table) {
            $table->id();
            $table->integer("quantite_achat_ligne_reception");
            $table->integer("quantite_ligne_reception");
            $table->integer("prixachat_ligne_reception");
            $table->integer("soustotal_ligne_lignereception");
            $table->foreignId("produit_id")->constrained('produits');
            $table->foreignId("reception_id")->constrained('receptions');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ligne_receptions', function (Blueprint $table) {
            $table->dropColumn(["produit_id","reception_id"]);
        });
        Schema::dropIfExists('ligne_receptions');
    }
};
