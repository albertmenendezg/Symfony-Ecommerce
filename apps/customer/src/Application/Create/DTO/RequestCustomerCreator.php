<?php

declare(strict_types=1);

namespace Customer\Application\Create\DTO;

final class RequestCustomerCreator
{
    public function __construct(
        private string $id,
        private string $userId,
        private string $name,
        private string $surname,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function surname(): string
    {
        return $this->surname;
    }
}
