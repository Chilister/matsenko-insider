<?php

use App\Models\FootballTeam;
use App\Models\MatchResult;
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
        Schema::create('team_predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MatchResult::class, 'match_id');
            $table->foreignIdFor(FootballTeam::class, 'team_id');
            $table->unsignedInteger('percent');
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
        Schema::dropIfExists('team_predictions');
    }
};
