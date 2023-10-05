<?php

declare(strict_types=1);

namespace User\Domain\ValueObject;

use Shared\Domain\ValueObject\UuidValueObject;

final class UserCredentialId extends UuidValueObject
{
    public static function random(): self
    {
        return new self(parent::random()->value);
    }
}
