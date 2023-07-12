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
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->string("num_reception")->nullable();
            $table->string("num_piece")->nullable();
            $table->enum("status_achat_paiement",["non payer","payer","payer partial"])->default("non payer");
            $table->date("date_reception")->default(date("m/d/y"));
            $table->integer("total_reception");
            $table->string("description_reception")->nullable();
            $table->string("user_id");
            $table->foreignId("achat_id")->constrained('achats');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('receptions', function (Blueprint $table) {
            $table->dropColumn(["achat_id"]);
        });
        Schema::dropIfExists('receptions');
    }
};
