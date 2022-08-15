<?php
declare(strict_types=1);

namespace App;

use App\api\RapidApiClient;
use App\api\RapidClientInterface;
use App\Model\Game;
use App\Service\RapidApiService;
use App\Validator\GameValidatorInterface;
use Exception;

class Command
{
    private Printer $printer;
    private RapidClientInterface $rapidApi;
    private GameValidatorInterface $validator;
    private RapidApiService $rapidApiProvider;

    /**
     * @param Printer $printer
     * @param RapidApiClient $rapidApi
     * @param GameValidatorInterface $validator
     * @param RapidApiService $rapidApiProvider
     */
    public function __construct(
        Printer $printer,
        RapidApiClient $rapidApi,
        GameValidatorInterface $validator,
        RapidApiService $rapidApiProvider
    ) {
        $this->printer = $printer;
        $this->rapidApi = $rapidApi;
        $this->validator = $validator;
        $this->rapidApiProvider = $rapidApiProvider;
    }

    /**
     * @return void
     */
    public function executeHelp(): void
    {
        $printer = $this->printer;
        $name = 'teams <team-keyword>';
        $description = 'List NBA teams';

        $printer->writeLn('Command: ' . $name);
        $printer->writeLn(str_pad(' ', 4) . $description);
        $printer->writeLn('');
    }

    /**
     * @param array $arguments
     * @return void
     * @throws Exception
     */
    public function teamsList(array $arguments): void
    {
        $printer = $this->printer;
        $rapidApi = $this->rapidApi;

        $teams = $rapidApi->getTeams();
        $filter = $arguments[0] ?? null;

        foreach ($teams['data'] as $team) {
            if ($filter !== null && (stristr($team['full_name'], $filter) || stristr($team['city'], $filter))) {
                $printer->writeLn('Team name: ' . $team['full_name'] . ' from ' . $team['city']);
            }
        }
    }

    /**
     * @param array $arguments
     * @return void
     * @throws InvalidCommandException
     */
    public function gamesList(array $arguments): void
    {
        $date = $arguments[0] ?? null;
        $games = $this->rapidApiProvider->getGames($date);

        /** @var Game $game */
        foreach ($games as $game) {
            if ($this->validator->validate($game)) {
                $this->printer->writeLn('--------------');
                $this->printer->writeLn('Home team is: ' . $game->getHomeTeam()->getName());
                $this->printer->writeLn('Visitor team is: ' . $game->getVisitorTeam()->getName());
                $this->printer->writeLn(
                    'Game score: ' . $game->getHomeTeamScore() . ' - ' . $game->getVisitorTeamScore()
                );
                $this->printer->writeLn('--------------');

                $this->printer->writeLn('Home team players:');
                foreach ($game->getHomeTeam()->getPlayers() as $player) {
                    $this->printer->writeLn("{$player->getFirstName()} {$player->getLastName()}");
                }

                $this->printer->writeLn('---------------');
                $this->printer->writeLn('Away team players:');
                foreach ($game->getVisitorTeam()->getPlayers() as $player) {
                    $this->printer->writeLn("{$player->getFirstName()} {$player->getLastName()}");
                }
                $this->printer->writeLn('');
            }
        }
    }
}
