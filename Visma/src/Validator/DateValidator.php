<?php

namespace App\Validator;

use DateTime;
use Exception;

class DateValidator implements DateValidatorInterface
{
    /**
     * @param $date
     * @return bool|null
     */
    public function validateDate($date): ?bool
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
        return null;
    }

}