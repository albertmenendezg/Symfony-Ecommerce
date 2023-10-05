<?php

declare(strict_types=1);

namespace User\Infrastructure\Doctrine\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Shared\Infrastructure\Doctrine\Mapping\UuidType;
use User\Domain\ValueObject\UserCredentialId;

final class UserCredentialIdType extends UuidType
{
    public function getName(): string
    {
        return 'user_credential_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UserCredentialId
    {
        return new UserCredentialId($value);
    }
}
