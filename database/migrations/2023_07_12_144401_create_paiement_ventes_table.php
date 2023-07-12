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
        Schema::create('paiement_ventes', function (Blueprint $table) {
            $table->id();
            $table->integer("total_vente");
            $table->integer("total_payer");
            $table->integer("total_reste");
            $table->string("user_id");
            $table->date("date_paiement_vente")->default(date('m/d/y'));
            $table->string("description_paiement")->nullable();
            $table->foreignId("vente_id")->constrained('ventes');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paiement_ventes', function (Blueprint $table) {
            $table->dropColumn(["vente_id"]);
        });
        Schema::dropIfExists('paiement_ventes');
    }
};
