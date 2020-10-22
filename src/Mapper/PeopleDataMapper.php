<?php declare(strict_types=1);

namespace App\Mapper;

use App\DTO\DocsData;
use App\DTO\HumanData;
use App\Entity\People\Human;

class PeopleDataMapper
{
    /**
     * @var Human
     */
    private Human $human;

    public function __construct(Human $human)
    {
        $this->human = $human;
    }

    public function data(bool $withPair = false): HumanData
    {
        $data = new HumanData();

        $data->firstName = $this->human->getFirstName();
        $data->lastName = $this->human->getLastName();

        if (null !== $this->human->getDocs()) {
            $data->docs = new DocsData();
            $data->docs->passport = $this->human->getDocs()->getPassport();
            $data->docs->INN = $this->human->getDocs()->getINN();
        }

        if ($withPair && null !== $this->human->getPair()) {
            $pairMapper = new self($this->human->getPair());
            $data->pair = $pairMapper->data();
        }

        return $data;
    }
}
