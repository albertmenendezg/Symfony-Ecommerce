<?php

declare(strict_types=1);

namespace Shared\Domain\Exception;

use DomainException;

final class InvalidDateTime extends DomainException
{
        public function __construct(string $value, string $format = DATE_ATOM)
        {
            parent::__construct("The time $value is not valid for format $format");
        }
}
