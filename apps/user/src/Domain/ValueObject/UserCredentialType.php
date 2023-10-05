<?php

declare(strict_types=1);

namespace User\Domain\ValueObject;

use Shared\Domain\ValueObject\StringValueObject;
use User\Domain\Exception\InvalidUserCredentialType;

final class UserCredentialType extends StringValueObject
{
    private const VALID_TYPES = ['password'];
    public function __construct(string $value)
    {
        $this->validateValidType($value);
        parent::__construct($value);
    }

    private function validateValidType(string $type): void
    {
        if (!in_array($type, self::VALID_TYPES)) {
            throw new InvalidUserCredentialType($type);
        }
    }

    public static function password(): self {
        return new self('password');
    }
}
