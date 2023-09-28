<?php

declare(strict_types=1);

namespace Product\Application\Create\DTO;

final class RequestProductCreator
{
    public function __construct(
        private string $id,
        private string $name,
        private string $description,
        private int $stock,
        private float $price,
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

    public function description(): string
    {
        return $this->description;
    }

    public function stock(): int
    {
        return $this->stock;
    }

    public function price(): float
    {
        return $this->price;
    }

}
