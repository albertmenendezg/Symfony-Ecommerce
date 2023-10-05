<?php

declare(strict_types=1);

namespace User\Domain\ValueObject;


final class UserPlainPassword extends UserCredentialValue
{
    public function __construct(string $value)
    {
        $password = password_hash($value, PASSWORD_BCRYPT, ['cost' => 12]);
        parent::__construct($password);
    }
}
