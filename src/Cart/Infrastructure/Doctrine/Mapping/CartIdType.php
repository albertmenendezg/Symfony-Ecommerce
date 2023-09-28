<?php

declare(strict_types=1);

namespace Cart\Infrastructure\Doctrine\Mapping;

use Cart\Domain\ValueObject\CartId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Shared\Infrastructure\Doctrine\Mapping\UuidType;

final class CartIdType extends UuidType
{
    public function getName(): string
    {
        return 'cart_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): CartId
    {
        return new CartId($value);
    }
}
