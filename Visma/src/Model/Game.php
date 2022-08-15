<?php

namespace App\Model;

class Game
{
    private Team $homeTeam;
    private Team $visitorTeam;
    private int $homeTeamScore;
    private int $visitorTeamScore;

    /**
     * @param Team $homeTeam
     * @param Team $visitorTeam
     * @param int $homeTeamScore
     * @param int $visitorTeamScore
     */
    public function __construct(
        Team $homeTeam,
        Team $visitorTeam,
        int $homeTeamScore,
        int $visitorTeamScore,
    ) {
        $this->homeTeam = $homeTeam;
        $this->visitorTeam = $visitorTeam;
        $this->homeTeamScore = $homeTeamScore;
        $this->visitorTeamScore = $visitorTeamScore;
    }

    /**
     * @return Team
     */
    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    /**
     * @return Team
     */
    public function getVisitorTeam(): Team
    {
        return $this->visitorTeam;
    }

    /**
     * @return int
     */
    public function getHomeTeamScore(): int
    {
        return $this->homeTeamScore;
    }

    /**
     * @return int
     */
    public function getVisitorTeamScore(): int
    {
        return $this->visitorTeamScore;
    }

}