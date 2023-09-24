<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\InvalidUuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

final class Uuid
{
    private string $value;

    public function __construct(string $value)
    {
        $this->ensureValidUuid($value);
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function ensureValidUuid(string $value): void
    {
        if (RamseyUuid::isValid($value)) {
            throw new InvalidUuid($value);
        }
    }

    public static function random(): self
    {
        return new Uuid(RamseyUuid::uuid4()->toString());
    }
}