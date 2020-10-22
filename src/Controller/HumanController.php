<?php declare(strict_types=1);

namespace App\Controller;

use App\DTO\HumanData;
use App\DTO\SentFields;
use App\Mapper\PeopleDataMapper;
use App\Service\HumanKeeper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/human")
 */
class HumanController
{
    private HumanKeeper $humans;

    public function __construct(HumanKeeper $humans)
    {
        $this->humans = $humans;
    }

    /**
     * @Route("/", methods={POST})
     */
    public function create(HumanData $data): Response
    {
        // todo data validation

        $human = $this->humans->newHuman($data);
        return new JsonResponse((new PeopleDataMapper($human))->data());
    }

    /**
     * @Route("/{id}", methods={PUT})
     */
    public function update(int $id, HumanData $data): Response
    {
        // todo data validation

        $human = $this->humans->getById($id);
        $human->update($data);

        return new JsonResponse(new PeopleDataMapper($human));
    }

    /**
     * @Route("/{id}", methods={PUT})
     */
    public function patch(int $id, HumanData $data, SentFields $sentFields): Response
    {
        // todo data validation

        $this->humans->patch($id, $data->toArray(), $sentFields);
        $human = $this->humans->getById($id);

        return new JsonResponse(new PeopleDataMapper($human));
    }
}
