<?php

declare(strict_types=1);

namespace Customer\Infrastructure\Doctrine\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Shared\Domain\ValueObject\CustomerId;
use Shared\Infrastructure\Doctrine\Mapping\UuidType;

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
