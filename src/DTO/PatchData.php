<?php declare(strict_types=1);

namespace App\DTO;

use LogicException;

class PatchData
{
    private string     $entityClass;
    private array      $data;
    private SentFields $sentFields;
    private bool       $isOk = false;
    private array      $map  = [];

    public function __construct(string $entityClass, array $data, SentFields $sentFields)
    {
        $this->entityClass = $entityClass;
        $this->data = $data;
        $this->sentFields = $sentFields;
    }

    public function validate(): self
    {
        foreach ($this->sentFields->fields as $field) {
            if (property_exists($this->entityClass, $field) &&
                in_array($field, $this->data, true)
            ) {
                continue;
            }
            throw new LogicException("undefined property {$field}");
        }
        $this->isOk = true;
        return $this;
    }

    public function isOk(): bool
    {
        return $this->isOk;
    }

    public function getMap(): array
    {
        return $this->map;
    }
}
