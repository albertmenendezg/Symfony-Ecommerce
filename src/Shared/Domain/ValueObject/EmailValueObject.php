<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

use Shared\Domain\Exception\InvalidEmail;

class EmailValueObject extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureValidEmail($value);
        parent::__construct($value);
    }

    private function ensureValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmail($email);
        }
    }
}
