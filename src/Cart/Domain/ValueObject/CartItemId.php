<?php

declare(strict_types=1);

namespace Cart\Domain\ValueObject;

use Shared\Domain\ValueObject\UuidValueObject;

final class CartItemId extends UuidValueObject
{
    public static function random(): self
    {
        return new self(parent::random()->value);
    }
}
