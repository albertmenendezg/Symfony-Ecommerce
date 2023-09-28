<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

use Shared\Domain\Exception\InvalidUuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

class UuidValueObject extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureValidUuid($value);
        parent::__construct($value);
    }

    private function ensureValidUuid(string $value): void
    {
        if (!RamseyUuid::isValid($value)) {
            throw new InvalidUuid($value);
        }
    }

    public static function random(): self
    {
        return new UuidValueObject(RamseyUuid::uuid4()->toString());
    }
}