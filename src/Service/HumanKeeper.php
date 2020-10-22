<?php declare(strict_types=1);

namespace App\Service;

use App\DTO\HumanData;
use App\DTO\PatchData;
use App\DTO\SentFields;
use App\Entity\Docs;
use App\Entity\People\Human;
use App\Exception\People\HumanException;

class HumanKeeper
{
    private HumanRepo $humans;

    public function __construct(HumanRepo $humanRepo)
    {
        $this->humans = $humanRepo;
    }

    public function newHuman(HumanData $data): Human
    {
        $docs = new Docs($data->docs->passport, $data->docs->INN);
        return new Human($data->firstName, $data->lastName, $docs); // +persist and flush
    }

    public function getById(int $id): Human
    {
        if (null === ($human = $this->humans->find($id))) {
            throw new HumanException('entity not found'); //entityNotFoundException
        }

        return $human;
    }

    public function patch(int $id, array $data, SentFields $sentFields): void
    {
        $partialData = new PatchData(Human::class, $data, $sentFields);
        $human = $this->getById($id);
        $human->patch($partialData->validate());
    }
}
