<?php

declare(strict_types=1);

namespace Shared\Domain\Exception;

use DomainException;

final class InvalidPositiveNumber extends DomainException
{
    public function __construct(int|float $value)
    {
        parent::__construct("The number $value is not positive");
    }
}
