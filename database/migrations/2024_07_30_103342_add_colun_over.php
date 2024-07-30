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
        Schema::table('over_fixtures', function (Blueprint $table) {
            $table->string('home')->nullable();
            $table->string('away')->nullable();
            $table->string('draw')->nullable();

            $table->string('half_home')->nullable();
            $table->string('half_away')->nullable();
            $table->string('half_draw')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
