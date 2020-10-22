<?php declare(strict_types=1);

namespace App\Entity\People;

use App\DTO\HumanData;
use App\DTO\PatchData;
use App\Entity\Docs;
use App\Exception\People\HumanException;
use LogicException;

class Human
{
    protected string $firstName;
    protected string $lastName;
    private ?Docs    $docs;
    private ?Human   $pair = null;

    public function __construct(string $firstName, string $lastName, ?Docs $docs)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->docs = $docs;
    }

    public function gotMarried(Human $human): void
    {
        if ($human === $this) {
            throw new LogicException('cannot marry yourself');
        }

        $this->pair = $human;
        $human->gotMarried($this);
    }

    public function gotDivorce(): void
    {
        $this->pair = null;
    }

    public function isMarried(): bool
    {
        return null !== $this->pair;
    }

    public function update(HumanData $data): void
    {
        if (null === $data->firstName && null === $data->lastName) {
            throw new LogicException('something went wrong');
        }

        $this->firstName = $data->firstName;
        $this->lastName = $data->lastName;

        if (null === $data->docs) {
            return;
        }

        $this->docs = new Docs($data->docs->passport, $data->docs->INN);
    }

    public function patch(PatchData $partialData): void
    {
        if (!$partialData->isOk()) {
            throw new HumanException('sent data is not valid');
        }

        foreach ($partialData->getMap() as $property => $value) {
            $this->$property = $value;
        }
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getDocs(): ?Docs
    {
        return $this->docs;
    }

    public function getPair(): ?Human
    {
        return $this->pair;
    }
}
