<?php

namespace App\Validator;

use App\Model\Game;

class GameValidator implements GameValidatorInterface
{
    /**
     * @param Game $game
     * @return bool
     */
    public function validate(Game $game): bool
    {
        $homeWinner = $game->getHomeTeamScore() > $game->getVisitorTeamScore();
        $sameConf = $game->getHomeTeam()->getConference() == $game->getVisitorTeam()->getConference();

        return ($homeWinner && $sameConf);
    }
}