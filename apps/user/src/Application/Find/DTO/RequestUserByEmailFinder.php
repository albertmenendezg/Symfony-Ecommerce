<?php

declare(strict_types=1);

namespace User\Application\Find\DTO;

final class RequestUserByEmailFinder
{
    public function __construct(
        private string $email
    ) {
    }

    public function email(): string
    {
        return $this->email;
    }
}
