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
        Schema::create('team_events', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id');
            $table->integer('fixture_id');
            $table->boolean('last5_no_lost')->default(false);
            $table->boolean('last5_lost_more')->default(false);
            $table->boolean('last5_win_all')->default(false);
            $table->boolean('last5_lost_all')->default(false);
            $table->string('day_timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_events');
    }
};
