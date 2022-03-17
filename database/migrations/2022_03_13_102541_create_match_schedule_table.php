<?php

use App\Models\FootballTeam;
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
        Schema::create('match_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FootballTeam::class, 'first_team_id');
            $table->foreignIdFor(FootballTeam::class, 'second_team_id');
            $table->unsignedInteger('week')->index();
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
        Schema::dropIfExists('match_schedule');
    }
};
