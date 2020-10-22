<?php declare(strict_types=1);

namespace App\Entity\People;

class Man extends Human
{
    private bool $hasPassedCMS = false; // UMS = compulsory military service

    public function passTheCMS(): void
    {
        $this->hasPassedCMS = true;
    }
}
