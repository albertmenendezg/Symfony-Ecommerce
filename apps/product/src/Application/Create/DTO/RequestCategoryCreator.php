<?php

declare(strict_types=1);

namespace Product\Application\Create\DTO;

final class RequestCategoryCreator
{
    public function __construct(
        private string $id,
        private string $name,
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

}
