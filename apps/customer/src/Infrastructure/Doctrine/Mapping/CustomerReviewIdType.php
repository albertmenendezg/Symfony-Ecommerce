<?php

declare(strict_types=1);

namespace Customer\Infrastructure\Doctrine\Mapping;

use Customer\Domain\ValueObject\CustomerReviewId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Shared\Infrastructure\Doctrine\Mapping\UuidType;

final class CustomerReviewIdType extends UuidType
{
    public function getName(): string
    {
        return 'customer_review_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): CustomerReviewId
    {
        return new CustomerReviewId($value);
    }
}
