<?php

use App\Models\MatchResult;
use App\Models\MatchSchedule;
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
        Schema::create('match_results', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MatchResult::class, 'schedule_id');
            $table->unsignedInteger('first_team_result');
            $table->unsignedInteger('second_team_result');
            $table->foreignIdFor(MatchSchedule::class, 'week');
            $table->unsignedInteger('match_id')->index();
            $table->unsignedInteger('league_id')->index();
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
        Schema::dropIfExists('match_results');
    }
};
