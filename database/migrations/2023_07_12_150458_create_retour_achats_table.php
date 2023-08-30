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
            $table->integer("total_retour_achat");
            $table->date("date_retour_achat")->default(date('Y-m-d'));
            $table->string("description_retour_achat")->nullable();
            $table->foreignId("user_id")->constrained('users');
            $table->foreignId("achat_id")->constrained('achats');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('retour_achats', function (Blueprint $table) {
            $table->dropColumn(["achat_id","user_id"]);
        });
        Schema::dropIfExists('retour_achats');
    }
};
