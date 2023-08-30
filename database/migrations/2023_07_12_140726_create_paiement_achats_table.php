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
        Schema::create('paiement_achats', function (Blueprint $table) {
            $table->id();
            $table->string("num_paiement_achats")->nullable();
            $table->integer("total_achat");
            $table->integer("total_payer");
            $table->integer("total_reste");
            $table->string("user_id");
            $table->date("date_paiement_achat")->default(date('Y-m-d'));
            $table->string("description_paiement")->nullable();
            $table->foreignId("achat_id")->constrained('achats');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paiement_achats', function (Blueprint $table) {
            $table->dropColumn(["achat_id"]);
        });
        Schema::dropIfExists('paiement_achats');
    }
};
