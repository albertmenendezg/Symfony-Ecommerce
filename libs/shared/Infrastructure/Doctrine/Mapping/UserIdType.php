<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Doctrine\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Shared\Domain\ValueObject\UserId;

final class UserIdType extends UuidType
{
    public function getName(): string
    {
        return 'user_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UserId
    {
        return new UserId($value);
    }
}
