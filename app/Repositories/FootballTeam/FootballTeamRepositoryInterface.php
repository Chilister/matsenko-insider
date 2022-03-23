<?php

namespace App\Repositories\FootballTeam;

use App\Models\FootballTeam;
use Illuminate\Database\Eloquent\Collection;

interface FootballTeamRepositoryInterface
{
    /**
     * @return int
     */
    public function getRoundLimit(): int;

    /**
     * @return Collection<FootballTeam>
     */
    public function getAllTeams(): Collection;
}
