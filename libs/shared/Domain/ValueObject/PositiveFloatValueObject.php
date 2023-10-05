<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

use Shared\Domain\Exception\InvalidPositiveNumber;

class PositiveFloatValueObject
{
    protected float $value;
    public function __construct(float $value)
    {
        $this->ensureIsPositive($value);
        $this->value = $value;
    }

    private function ensureIsPositive(float $value): void
    {
        if ($value < 0) {
            throw new InvalidPositiveNumber($value);
        }
    }

    public function value(): float
    {
        return $this->value;
    }
}
