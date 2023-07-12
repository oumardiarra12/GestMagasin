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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string("nom_fournisseur");
            $table->string("prenom_fournisseur")->nullable();
            $table->string("email_fournisseur");
            $table->string("tel_fournisseur");
            $table->string("adresse_fournisseur");
            $table->string("description_fournisseur")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
