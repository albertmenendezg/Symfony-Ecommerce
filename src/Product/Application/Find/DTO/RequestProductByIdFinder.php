<?php

declare(strict_types=1);

namespace Product\Application\Find\DTO;

final class RequestProductByIdFinder
{
    public function __construct(
        private string $id
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }
}
