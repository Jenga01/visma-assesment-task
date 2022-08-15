<?php

namespace App\Adapter;

use App\Model\Game;
use App\Model\Player;
use App\Model\Team;

interface GameClientInterface
{
    /**
     * @param array $game
     * @param Team $homeTeam
     * @param Team $visitorTeam
     * @return Game
     */
    public function Game(array $game, Team $homeTeam, Team $visitorTeam): Game;

    /**
     * @param array $team
     * @param array $players
     * @return Team
     */
    public function Team(array $team, array $players): Team;

    /**
     * @param array $player
     * @return Player
     */
    public function Player(array $player): Player;
}