<?php

declare(strict_types=1);

namespace User\Application\Create\DTO;

final class RequestUserCredentialPasswordCreator
{
    public function __construct(
        private string $id,
        private string $email,
        private string $password,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
