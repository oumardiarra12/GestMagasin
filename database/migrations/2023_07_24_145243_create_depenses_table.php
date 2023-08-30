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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->string("num_depense")->nullable();
            $table->date("date_depense")->default(date('Y-m-d'));
            $table->integer("total_depense");
            $table->string("note_depense")->nullable();
            $table->foreignId("categorie_depense_id")->constrained('categorie_depenses');
            $table->foreignId("user_id")->constrained('users');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('depenses', function (Blueprint $table) {
            $table->dropColumn(["categorie_depense_id","user_id"]);
        });
        Schema::dropIfExists('depenses');
    }
};
