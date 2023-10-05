<?php

declare(strict_types=1);

namespace User\Domain\ValueObject;

use Shared\Domain\ValueObject\BooleanValueObject;

final class UserAdmin extends BooleanValueObject
{
    public static function notAdmin(): self
    {
        return new self(false);
    }

    public static function admin(): self
    {
        return new self(true);
    }
}
