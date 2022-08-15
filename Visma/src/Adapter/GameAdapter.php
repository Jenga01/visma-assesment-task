<?php

namespace App\Adapter;

use App\Model\Game;
use App\Model\Player;
use App\Model\Team;

class GameAdapter implements GameClientInterface
{
    /**
     * @param array $game
     * @param Team $homeTeam
     * @param Team $visitorTeam
     * @return Game
     */
    public function Game(array $game, Team $homeTeam, Team $visitorTeam): Game
    {
        return new Game(
            $homeTeam,
            $visitorTeam,
            (int)$game['home_team_score'],
            (int)$game['visitor_team_score']
        );
    }

    /**
     * @param array $team
     * @param array $players
     * @return Team
     */
    public function Team(array $team, array $players): Team
    {
        return new Team(
            (string)$team['conference'],
            (string)$team['name'],
            $players
        );
    }

    /**
     * @param array $player
     * @return Player
     */
    public function Player(array $player): Player
    {
        return new Player(
            (string)$player['first_name'],
            (string)$player['last_name'],
        );
    }
}