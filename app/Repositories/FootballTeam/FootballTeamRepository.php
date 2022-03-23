<?php

namespace App\Repositories\FootballTeam;

use App\Models\FootballTeam;
use Illuminate\Database\Eloquent\Collection;

class FootballTeamRepository implements FootballTeamRepositoryInterface
{
    protected FootballTeam $footballTeam;

    /**
     * FootballTeamRepository constructor.
     * @param FootballTeam $footballTeam
     */
    public function __construct(FootballTeam $footballTeam) {
        $this->footballTeam = $footballTeam;
    }

    public function getRoundLimit(): int
    {
        return FootballTeam::count() / 2;
    }

    /**
     * @return Collection<FootballTeam>
     */
    public function getAllTeams(): Collection
    {
        return FootballTeam::all();
    }
}
