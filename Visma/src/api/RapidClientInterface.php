<?php

namespace App\api;

interface RapidClientInterface
{
    /**
     * @return array
     */
    public function getTeams(): array;

    /**
     * @param string $date
     * @return array|null
     */
    public function getGamesByDate(string $date): ?array;

    /**
     * @param string $dates
     * @return array
     */
    public function getStats(string $dates): array;

    /**
     * @param int $page
     * @param int $perPage
     * @param array $search
     * @return array
     */
    public function getPlayers(int $page = 0, int $perPage = 25, array $search = []): array;
}