<?php

declare(strict_types=1);

namespace User\Domain\Exception;

use DomainException;

final class InvalidUserCredentialType extends DomainException
{
    public function __construct(string $type)
    {
        parent::__construct("The type $type is not valid as user credential type");
    }
}
