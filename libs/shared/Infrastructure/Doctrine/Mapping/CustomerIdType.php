<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Doctrine\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Shared\Domain\ValueObject\CustomerId;

final class CustomerIdType extends UuidType
{
    public function getName(): string
    {
        return 'customer_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): CustomerId
    {
        return new CustomerId($value);
    }
}
