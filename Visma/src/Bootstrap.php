<?php
declare(strict_types=1);

namespace App;

use App\Adapter\GameAdapter;
use App\api\RapidApiClient;
use App\Service\RapidApiService;
use App\Validator\GameValidator;


class Bootstrap
{
    /**
     * @param array $arguments
     * @return void
     * @throws InvalidCommandException
     */
    public function __invoke(array $arguments): void
    {
        array_shift($arguments);

        if (!isset($arguments[0])) {
            throw new InvalidCommandException("Command", 'No command specified');
        }

        $command = $arguments[0];
        $commandArguments = array_slice($arguments, 1);

        $this->runCommand($command, $commandArguments);
    }

    /**
     * @param mixed $commandName
     * @param array $commandArguments
     * @return void
     * @throws InvalidCommandException
     */
    private function runCommand(mixed $commandName, array $commandArguments): void
    {
        $command = new Command(
            new Printer(), new RapidApiClient(), new GameValidator(), new RapidApiService(
            new RapidApiClient(), new GameAdapter()
        )
        );

        switch ($commandName) {
            case 'teams':
                $command->teamsList($commandArguments);
                break;
            case 'games':
                $command->gamesList($commandArguments);
                break;
            case 'help':
                $command->executeHelp();
                break;

            default:
                throw new InvalidCommandException($commandName, 'Such command does not exist');
        }
    }
}
