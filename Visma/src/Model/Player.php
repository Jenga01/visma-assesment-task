<?php

namespace App\Model;

class Player
{
    private string $firstname;
    private string $lastname;

    /**
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(
        string $firstName,
        string $lastName,
    ) {
        $this->firstname = $firstName;
        $this->lastname = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastname;
    }

}

