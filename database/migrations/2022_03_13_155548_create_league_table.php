<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\FootballTeam::class, 'team_id');
            $table->unsignedInteger('points');
            $table->unsignedInteger('plays');
            $table->unsignedInteger('won');
            $table->unsignedInteger('drawn');
            $table->unsignedInteger('lost');
            $table->integer('goal_difference');
            $table->foreignIdFor(\App\Models\MatchResult::class, 'match_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('league');
    }
};
