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
        Schema::create('achats', function (Blueprint $table) {
            $table->id();
            $table->string("num_achat")->nullable();
            $table->enum("status_achat_reception",["encours","reception","reception partial","annuler"])->default("encours");
            $table->integer("total_achat");
            $table->date("date_achat")->default(date('m/d/y'));
            $table->string("description_achat")->nullable();
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
        Schema::table('achats', function (Blueprint $table) {
            $table->dropColumn(["fournisseur_id"]);
        });
        Schema::dropIfExists('achats');
    }
};
