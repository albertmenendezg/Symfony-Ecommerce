<?php

declare(strict_types=1);

namespace Product\Infrastructure\Doctrine\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Product\Domain\ValueObject\ProductCategoryId;
use Shared\Infrastructure\Doctrine\Mapping\UuidType;

final class ProductCategoryIdType extends UuidType
{
    public function getName(): string
    {
        return 'product_category_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ProductCategoryId
    {
        return new ProductCategoryId($value);
    }
}
