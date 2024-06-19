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
        Schema::create('exact_score_fixtures', function (Blueprint $table) {
            $table->id();
            $table->integer('fixture_id');
            $table->string('value_0_0')->nullable();
            $table->string('value_1_1')->nullable();
            $table->string('value_0_1')->nullable();
            $table->string('value_1_0')->nullable();
            $table->string('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exact_score_fixtures');
    }
};
