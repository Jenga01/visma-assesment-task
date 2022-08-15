<?php
declare(strict_types=1);

namespace App\api;

use App\InvalidCommandException;
use App\Validator\DateValidator;
use Exception;

class RapidApiClient implements RapidClientInterface
{
    // Readme in https://rapidapi.com/theapiguy/api/free-nba/details
    private string $baseUrl = 'https://free-nba.p.rapidapi.com/';
    private string $key = '4fdb2c4532msh98db9d8739bd30ap17c82cjsn4e79f97aab5a';

    /**
     * @return array
     * @throws Exception
     */
    public function getTeams(): array
    {
        $url = 'teams?page=0';

        return $this->getCurl($url);
    }


    /**
     * @param string $dates
     * @return array
     * @throws Exception
     */
    public function getStats(string $dates): array
    {
        $url = 'stats?' . $dates;

        return $this->getCurl($url);
    }

    /**
     * @param string $date
     * @return array|null
     * @throws InvalidCommandException
     * @throws Exception
     */
    public function getGamesByDate(string $date): ?array
    {
        $dateValidator = new DateValidator();
        $url = 'games?' . $date;
        if (!$dateValidator->validateDate($date)) {
            throw new InvalidCommandException("Type error", "Invalid date or format");
        }
        return $this->getCurl($url);
    }

    /**
     * @param string $url
     * @return array
     * @throws Exception
     */
    public function getCurl(string $url): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->baseUrl . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: free-nba.p.rapidapi.com",
                "x-rapidapi-key: " . $this->key
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception("cURL Error #:" . $err);
        }

        return json_decode($response, true);
    }

    /**
     * @param int $page
     * @param int $perPage
     * @param array $search
     * @return array
     * @throws Exception
     */
    public function getPlayers(int $page = 0, int $perPage = 25, array $search = []): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        $url = 'players?' . http_build_query($params);

        return $this->getCurl($url);
    }

}
