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
        Schema::create('standings', function (Blueprint $table) {
            $table->id();
            $table->integer('league_id');
            $table->integer('team_id');
            $table->string('season');
            $table->string('group');
            $table->integer('rank');
            $table->integer('points');
            $table->integer('goal_diff');
            $table->string('form');
            $table->string('status');
            $table->integer('home_played');
            $table->integer('home_win');
            $table->integer('home_lost');
            $table->integer('home_draw');
            $table->integer('home_goal_for');
            $table->integer('home_goal_against');
            $table->date('update_round');
            $table->integer('away_played');
            $table->integer('away_win');
            $table->integer('away_lost');
            $table->integer('away_draw');
            $table->integer('away_goal_for');
            $table->integer('away_goal_against');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standings');
    }
};
