<?php

declare(strict_types=1);

namespace Cart\Application\Create\DTO;

final class RequestCartItemCreator
{
    public function __construct(
        private string $productId,
        private int $quantity
    ) {
    }

    public function productId(): string
    {
        return $this->productId;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }
}
