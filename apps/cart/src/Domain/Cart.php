<?php

declare(strict_types=1);

namespace Cart\Domain;

use Cart\Domain\Event\CartWasCreated;
use Cart\Domain\ValueObject\CartCreatedAt;
use Cart\Domain\ValueObject\CartId;
use Cart\Domain\ValueObject\CartUpdatedAt;
use Shared\Domain\AggregateRoot;
use Shared\Domain\ValueObject\CustomerId;

final class Cart extends AggregateRoot
{
    public function __construct(
        private CartId $id,
        private CustomerId $customerId,
        /** @var $cartsItems CartItem[] */
        private iterable $cartItems,
        private CartCreatedAt $createdAt,
        private CartUpdatedAt $updatedAt
    ) {
    }

    public static function create(
        CartId $id,
        CustomerId $customerId,
    ): self {
        $cart = new self(
            $id,
            $customerId,
            [],
            new CartCreatedAt(),
            new CartUpdatedAt(),
        );

        $cart->record(
            new CartWasCreated (
                $cart->id->value(),
                $cart->toArray()
            )
        );

        return $cart;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'customer_id' => $this->customerId->value(),
            'createdAt' => $this->createdAt->__toString(),
            'updatedAt' => $this->updatedAt->__toString()
        ];
    }

    public function id(): CartId
    {
        return $this->id;
    }

    public function customerId(): CustomerId
    {
        return $this->customerId;
    }

    /**
     * @return CartItem[]
     */
    public function cartItems(): iterable
    {
        return $this->cartItems;
    }

    public function createdAt(): CartCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): CartUpdatedAt
    {
        return $this->updatedAt;
    }
}
