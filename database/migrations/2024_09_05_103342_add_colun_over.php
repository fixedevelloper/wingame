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
            $table->string('old_home')->nullable();
            $table->string('old_away')->nullable();
            $table->string('old_draw')->nullable();

            $table->string('variation_home')->nullable();
            $table->string('variation_away')->nullable();
            $table->string('variation_draw')->nullable();
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
