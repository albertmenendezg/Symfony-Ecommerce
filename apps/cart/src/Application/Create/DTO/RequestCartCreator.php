<?php

declare(strict_types=1);

namespace Cart\Application\Create\DTO;

final class RequestCartCreator
{
    public function __construct(
        private string $id,
        private string $customerId,
        private array $requestsCartItem
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function customerId(): string
    {
        return $this->customerId;
    }

    public function requestsCartItem(): array
    {
        return $this->requestsCartItem;
    }

}
