<?php

namespace AppTest\Validator;

use App\Model\Game;
use App\Model\Team;
use App\Validator\GameValidator;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{

    public function testValidation(): void
    {
        $validator = new GameValidator();

        $homeTeamSCore = 100;
        $awayTeamScore = 99;

        $game = new Game(new Team("west", "Lakers", array("Kobe Bryant, Shaq")),
                         new Team("west", "Spurs", array("Tim Duncan, Tony Parker")),
                         $homeTeamSCore, $awayTeamScore);

        $this->assertTrue($validator->validate($game), true);
    }

    public function testValidationTeamsNotFromSameConference(): void
    {
        $validator = new GameValidator();

        $homeTeamSCore = 100;
        $awayTeamScore = 99;

        $game = new Game(new Team("west", "Lakers", array("Kobe Bryant, Shaq")),
                         new Team("east", "Spurs", array("Tim Duncan, Tony Parker")),
                         $homeTeamSCore, $awayTeamScore);

        $this->assertNotTrue($validator->validate($game), true);
    }

    public function testValidationHomeTeamLost(): void
    {
        $validator = new GameValidator();

        $homeTeamSCore = 100;
        $awayTeamScore = 120;

        $game = new Game(new Team("west", "Lakers", array("Kobe Bryant, Shaq")),
                         new Team("west", "Spurs", array("Tim Duncan, Tony Parker")),
                         $homeTeamSCore, $awayTeamScore);

        $this->assertNotTrue($validator->validate($game), true);
    }
}
