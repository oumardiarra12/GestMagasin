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
        Schema::create('retour_ventes', function (Blueprint $table) {
            $table->id();
            $table->string("num_retourvente")->nullable();
            $table->string("ref_retourvente")->nullable();
            $table->integer("total_retourvente");
            $table->date("date_retourvente")->default(date('m/d/y'));
            $table->string("description_retourvente")->nullable();
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
        Schema::table('retour_ventes', function (Blueprint $table) {
            $table->dropColumn(["client_id"]);
        });
        Schema::dropIfExists('retour_ventes');
    }
};
