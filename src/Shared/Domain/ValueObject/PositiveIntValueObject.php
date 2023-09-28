<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

use Shared\Domain\Exception\InvalidPositiveNumber;

class PositiveIntValueObject
{
    protected int $value;
    public function __construct(int $value)
    {
        $this->ensureIsPositive($value);
        $this->value = $value;
    }

    private function ensureIsPositive(int $value): void
    {
        if ($value < 0) {
            throw new InvalidPositiveNumber($value);
        }
    }

    public function value(): int
    {
        return $this->value;
    }
}
