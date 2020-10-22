<?php declare(strict_types=1);

namespace App\Entity;

class Docs
{
    private string  $passport;
    private ?string $INN;

    public function __construct(string $passport, ?string $INN = null)
    {
        $this->passport = $passport;
        $this->INN = $INN;
    }

    public function getPassport(): string
    {
        return $this->passport;
    }

    public function getINN(): ?string
    {
        return $this->INN;
    }
}
