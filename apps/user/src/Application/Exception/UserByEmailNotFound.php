<?php

declare(strict_types=1);

namespace User\Application\Exception;

use DomainException;
use User\Domain\ValueObject\UserEmail;

final class UserByEmailNotFound extends DomainException
{
    public function __construct(UserEmail $email)
    {
        parent::__construct(sprintf("Could not find user with email %s", $email->value()));
    }
}
