<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Doctrine\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Shared\Domain\ValueObject\ProductId;

final class ProductIdType extends UuidType
{
    public function getName(): string
    {
        return 'product_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ProductId
    {
        return new ProductId($value);
    }
}
