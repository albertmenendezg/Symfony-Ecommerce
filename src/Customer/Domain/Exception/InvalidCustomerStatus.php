<?php

declare(strict_types=1);

namespace Customer\Domain\Exception;

use DomainException;

final class InvalidCustomerStatus extends DomainException
{
    public function __construct(string $status)
    {
        parent::__construct("The status $status is not valid");
    }
}
