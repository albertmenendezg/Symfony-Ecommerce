<?php

declare(strict_types=1);

namespace Cart\Infrastructure\Doctrine\Mapping;

use Cart\Domain\ValueObject\CartItemId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Shared\Infrastructure\Doctrine\Mapping\UuidType;

final class CartItemIdType extends UuidType
{
    public function getName(): string
    {
        return 'cart_item_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): CartItemId
    {
        return new CartItemId($value);
    }
}
