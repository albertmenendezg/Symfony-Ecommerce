<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Doctrine\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Shared\Domain\ValueObject\UuidValueObject;

class UuidType extends StringType
{

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'CHAR(36)';
    }

    public function getName(): string
    {
        return 'uuid';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UuidValueObject
    {
        return new UuidValueObject($value);
    }

    /**
     * @param UuidValueObject $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value?->value();
    }
}
