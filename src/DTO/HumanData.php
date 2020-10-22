<?php declare(strict_types=1);

namespace App\DTO;

class HumanData
{
    public ?string    $firstName = null;
    public ?string    $lastName  = null;
    public ?string    $gender    = null;
    public ?DocsData  $docs      = null;
    public ?HumanData $pair      = null;

    public function toArray(): array
    {
        return (array)$this;
    }
}
