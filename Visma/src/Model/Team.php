<?php

namespace App\Model;

class Team
{
    private string $conference;
    private string $name;

    /**
     * @var Player[]
     */
    private array $players;

    public function __construct(
        string $conference,
        string $name,
        array $players
    ) {
        $this->conference = $conference;
        $this->name = $name;
        $this->players = $players;
    }

    /**
     * @return string
     */
    public function getConference(): string
    {
        return $this->conference;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array|Player[]
     */
    public function getPlayers(): array
    {
        return $this->players;
    }
}