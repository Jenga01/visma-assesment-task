<?php

namespace App\Validator;

use App\Model\Game;

interface GameValidatorInterface
{
    /**
     * @param Game $game
     * @return bool
     */
    public function validate(Game $game): bool;
}