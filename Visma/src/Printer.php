<?php
declare(strict_types=1);

namespace App;

class Printer
{
    /**
     * @param string $string
     * @return void
     */
    public function write(string $string): void
    {
        echo $string;
    }

    /**
     * @param string $string
     * @return void
     */
    public function writeLn(string $string): void
    {
        echo $this->write($string) . "\n";
    }
}
