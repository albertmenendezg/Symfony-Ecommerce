<?php

declare(strict_types=1);

namespace Customer\Application\Create\DTO;

final class RequestCustomerCreator
{
    public function __construct(
        private string $id,
        private string $name,
        private string $surname,
        private string $email,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function surname(): string
    {
        return $this->surname;
    }

    public function email(): string
    {
        return $this->email;
    }
}
