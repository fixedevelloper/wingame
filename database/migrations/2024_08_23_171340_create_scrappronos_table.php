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
        Schema::create('scrappronos', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('team_home')->nullable();
            $table->string('team_away')->nullable();
            $table->string('logique')->nullable();
            $table->string('suprise')->nullable();
            $table->string('null')->nullable();
            $table->string('domicile')->nullable();
            $table->string('exterieur')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scrappronos');
    }
};
