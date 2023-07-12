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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string("ref_produit")->nullable();
            $table->string("codebarre")->nullable();
            $table->string("nom_produit");
            $table->integer("stockmin")->default(10);
            $table->integer("stockactuel")->nullable();
            $table->integer("prixvente_produit");
            $table->integer("prixachat_produit");
            $table->string("description_produit");
           $table->foreignId("famille_id")->constrained('familles');
            $table->foreignId("unite_id")->constrained('unites');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropColumn(["famille_id","unite_id"]);
        });
        Schema::dropIfExists('produits');
    }
};
