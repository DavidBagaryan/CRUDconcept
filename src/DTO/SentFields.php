<?php declare(strict_types=1);

namespace App\DTO;

class SentFields
{
    public array $fields = [];

    public function hasField(string $fieldName): bool
    {
        return in_array($fieldName, $this->fields, true);
    }

    public function unsetField(string $fieldName): void
    {
        $key = array_search($fieldName, $this->fields, true);
        if (false !== $key && null !== $key) {
            unset($this->fields[$key]);
        }
    }
}
