<?php

namespace AppTest\api;

use App\api\RapidApiClient;
use App\Model\Game;
use App\Model\Team;
use App\Validator\GameValidator;
use AppTest\Mock\api\ApiMock;

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{

    public function testGetGamesByDate()
    {
    $rapidApi = new RapidApiClient();
    $rapidApiTest = new ApiMock();
    $date = "2021-12-31";

    $this->assertEquals($rapidApi->getGamesByDate($date), $rapidApiTest->getGamesByDate());

    }

}
