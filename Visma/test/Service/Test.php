<?php

namespace AppTest\Service;

use App\Adapter\GameAdapter;
use App\api\RapidApiClient;
use App\Model\Game;
use App\Service\RapidApiService;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{

    public function testGetGames()
    {
        $rapidService = new RapidApiService(
          new RapidApiClient(),
          new GameAdapter()
        );
        $date = "2021-12-31";

        $games = $rapidService->getGames($date);
        /** @var Game $game */
        foreach ($games as $game) {
            $this->assertIsInt($game->getHomeTeamScore());
            $this->assertIsInt($game->getVisitorTeamScore());
            $this->assertIsObject($game->getHomeTeam());
            $this->assertIsObject($game->getVisitorTeam());
        }
    }

    public function testGetPlayers()
    {
        $apiProvider = new RapidApiService(
            new RapidApiClient(),
            new GameAdapter()
        );
        $players = $apiProvider->getTeamPlayers('celtics', 0);

        $this->assertIsArray($players, "");
    }
}
