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
        Schema::create('retour_achats', function (Blueprint $table) {
            $table->id();
            $table->string("num_retour_achat")->nullable();
            $table->string("refreception_retour_achat")->nullable();
            $table->integer("total_retour_achat");
            $table->date("date_retour_achat")->default(date('m/d/y'));
            $table->string("description_retour_achat")->nullable();
            $table->string("user_id");
            $table->foreignId("fournisseur_id")->constrained('fournisseurs');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('retour_achats', function (Blueprint $table) {
            $table->dropColumn(["fournisseur_id"]);
        });
        Schema::dropIfExists('retour_achats');
    }
};
