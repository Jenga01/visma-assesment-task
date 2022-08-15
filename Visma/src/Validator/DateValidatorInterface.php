<?php

namespace App\Validator;

interface DateValidatorInterface
{
    /**
     * @param $date
     * @return bool|null
     */
    public function validateDate($date): ?bool;
}