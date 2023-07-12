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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->string("num_vente")->nullable();
            $table->enum("status_vente_paiement",["non payer","payer","payer partial"])->default("non payer");
            $table->integer("total_vente");
            $table->date("date_vente")->default(date('m/d/y'));
            $table->string("description_vente")->nullable();
            $table->string("user_id");
            $table->foreignId("client_id")->constrained('clients');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->dropColumn(["client_id"]);
        });
        Schema::dropIfExists('ventes');
    }
};
