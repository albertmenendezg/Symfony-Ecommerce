<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

class BooleanValueObject
{
    protected bool $value;
    public function __construct(?bool $value = false)
    {
        $this->value = $value;
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function isEqualTo(self $object): bool
    {
        return $this->value === $object->value;
    }

    public function isNotEqualTo(self $object): bool
    {
        return !$this->isEqualTo($object);
    }
}
