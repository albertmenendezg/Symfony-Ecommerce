<?php

declare(strict_types=1);

namespace User\Domain\ValueObject;

use Shared\Domain\ValueObject\StringValueObject;
use User\Domain\Exception\InvalidUserRole;

final class UserRole extends StringValueObject
{
    private const VALID_ROLES = [
        'user',
        'admin'
    ];
    public function __construct(string $value)
    {

        parent::__construct($value);
    }

    private function ensureValidRole(string $role): void
    {
        if (!in_array($role, self::VALID_ROLES)) {
            throw new InvalidUserRole($role);
        }
    }
}
