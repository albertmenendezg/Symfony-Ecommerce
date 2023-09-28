<?php

declare(strict_types=1);

namespace Shared\Domain\Exception;

use DomainException;

final class InvalidEmail extends DomainException
{
    public function __construct(string $email)
    {
        parent::__construct('The email $email is not valid');
    }
}
