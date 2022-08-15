<?php

namespace App\Service;

use App\Adapter\GameClientInterface;
use App\api\RapidApiClient;
use App\InvalidCommandException;
use App\Repository\RapidApiProviderInterface;
use Exception;

class RapidApiService implements RapidApiProviderInterface
{
    /**
     * @var RapidApiClient
     */
    private RapidApiClient $client;

    /**
     * @var GameClientInterface
     */
    private GameClientInterface $gameClientInterface;

    /**
     * @param RapidApiClient $client
     * @param GameClientInterface $gameClientInterface
     */
    public function __construct(RapidApiClient $client, GameClientInterface $gameClientInterface)
    {
        $this->client = $client;
        $this->gameClientInterface = $gameClientInterface;
    }

    /**
     * @param string $date
     * @return array
     * @throws InvalidCommandException
     */
    public function getGames(string $date): array
    {
        $games = $this->client->getGamesByDate($date);
        $gamesPlayed = [];

        foreach ($games['data'] as $game) {
            $homePlayers = [];
            foreach ($this->getTeamPlayers($game['home_team']['name']) as $player) {
                $homePlayers[] = $player;
            }
            $visitorPlayers = [];
            foreach ($this->getTeamPlayers($game['visitor_team']['name']) as $player) {
                $visitorPlayers[] = $player;
            }

            $homeTeam = $this->gameClientInterface->Team(
                $game['home_team'],
                $homePlayers
            );

            $visitorTeam = $this->gameClientInterface->Team(
                $game['visitor_team'],
                $visitorPlayers
            );
            $gamesPlayed[] = $this->gameClientInterface->Game($game, $homeTeam, $visitorTeam);
        }
        return $gamesPlayed;
    }


    /**
     * @param string $teamName
     * @param int $startPage
     * @return array
     * @throws Exception
     */
    public function getTeamPlayers(string $teamName, int $startPage = 0): array
    {
        $allPlayers = $this->client->getPlayers($startPage);
        $players = [];
        foreach ($allPlayers['data'] as $player) {
            if ($player['team']['name'] !== $teamName) {
                continue;
            }
            $players[] = $this->gameClientInterface->Player($player);
        }
        return $players;
    }
}
