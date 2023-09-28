<?php

declare(strict_types=1);

namespace Customer\Infrastructure\Doctrine\Mapping;

use Customer\Domain\ValueObject\ReviewId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Shared\Infrastructure\Doctrine\Mapping\UuidType;

final class ReviewIdType extends UuidType
{
    public function getName(): string
    {
        return 'review_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ReviewId
    {
        return new ReviewId($value);
    }
}
