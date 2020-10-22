<?php declare(strict_types=1);

namespace App\Entity\People;

use LogicException;

class HumanPair
{
    private array $partners;
    private array $children = [];
    private bool  $isActual = true;

    public function __construct(Human ...$partners)
    {
        if (count($partners) !== 2) {
            throw new LogicException('impossible to add more or less than 2 partners');
        }
        $this->partners = $partners;
    }

    public function wedding(bool $changeSurname = false): void
    {
        $firstP = array_pop($this->partners);
        $secondP = array_pop($this->partners);

        if ($firstP instanceof Women) {
            $firstP->gotMarried($secondP, $changeSurname);
        }

        if ($secondP instanceof Women) {
            $secondP->gotMarried($firstP, $changeSurname);
        }
    }

    public function addChild(Human $child): void
    {
        $this->children[] = $child;
    }

    public function divorce(): void
    {
        foreach ($this->partners as $partner) {
            $partner->gotDivorce();
        }
        $this->isActual = false;
    }
}
