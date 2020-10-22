<?php declare(strict_types=1);

namespace App\Entity\People;

class Women extends Human
{
    private bool $hasGaveBirth = false;

    public function gotMarried(Human $human, bool $changeSurname = false): void
    {
        parent::gotMarried($human);
        if ($changeSurname) {
            $this->lastName = $human->lastName;
        }
    }

    public function gaveBirth(): void
    {
        $this->hasGaveBirth = true;
    }
}
