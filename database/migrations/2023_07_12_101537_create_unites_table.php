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
        Schema::create('unites', function (Blueprint $table) {
            $table->id();
           $table->string("code_unite");
           $table->string("nom_unite");
           $table->string("description_unite")->nullable();
           $table->foreignId("user_id")->constrained('users');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unites', function (Blueprint $table) {
            $table->dropColumn(["user_id"]);
        });
        Schema::dropIfExists('unites');
    }
};
