<?php

namespace App\Validator;

use DateTime;
use Exception;

class DateValidator
{
    /**
     * @param $date
     * @return bool|void
     */
    public function validateDate($date)
    {
        if (!$date) {
            return false;
        }
        try {
            new DateTime($date);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }

}