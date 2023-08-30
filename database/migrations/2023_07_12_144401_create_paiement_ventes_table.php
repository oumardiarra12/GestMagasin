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
            $table->string("num_paiement_ventes")->nullable();
            $table->integer("total_vente");
            $table->integer("total_payer");
            $table->integer("total_reste");
            $table->date("date_paiement_vente")->default(date('Y-m-d'));
            $table->string("description_paiement")->nullable();
            $table->foreignId("vente_id")->constrained('ventes');
            $table->foreignId("user_id")->constrained('users');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paiement_ventes', function (Blueprint $table) {
            $table->dropColumn(["vente_id","user_id"]);
        });
        Schema::dropIfExists('paiement_ventes');
    }
};
