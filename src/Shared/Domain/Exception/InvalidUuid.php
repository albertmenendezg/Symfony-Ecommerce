<?php

declare(strict_types=1);

namespace Shared\Domain\Exception;

use DomainException;

final class InvalidUuid extends DomainException
{
    public function __construct(string $value)
    {
        parent::__construct(sprintf("The value %s is not valid for an uuid", $value));
    }
}