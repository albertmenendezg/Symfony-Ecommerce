<?php

declare(strict_types=1);

namespace User\Domain\Exception;

use DomainException;

final class InvalidUserRole extends DomainException
{
    public function __construct(string $role)
    {
        parent::__construct("The role $role is not valid as user role");
    }
}
