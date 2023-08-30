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
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->string("num_devis")->nullable();
            $table->enum("status_devis",["non accepter","accepter"])->default("non accepter");
            $table->integer("total_devis");
            $table->date("date_devis")->default(date('Y-m-d'));
            $table->string("description_devis")->nullable();
            $table->foreignId("client_id")->constrained('clients');
            $table->foreignId("user_id")->constrained('users');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devis', function (Blueprint $table) {
            $table->dropColumn(["client_id","user_id"]);
        });
        Schema::dropIfExists('devis');
    }
};
