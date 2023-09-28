<?php

declare(strict_types=1);

namespace Cart\Domain;

use Cart\Domain\Event\CartItemWasCreated;
use Cart\Domain\ValueObject\CartItemId;
use Cart\Domain\ValueObject\CartItemQuantity;
use Shared\Domain\AggregateRoot;
use Shared\Domain\ValueObject\ProductId;

final class CartItem extends AggregateRoot
{
    public function __construct(
        private CartItemId $id,
        private Cart $cart,
        private ProductId $productId,
        private CartItemQuantity $quantity
    ) {
    }

    public static function create(
        CartItemId $id,
        Cart $cart,
        ProductId $productId,
        CartItemQuantity $quantity
    ): self {
        $item = new CartItem(
            $id,
            $cart,
            $productId,
            $quantity
        );

        $item->record(
            new CartItemWasCreated (
                $item->id->value(),
                $item->toArray()
            )
        );

        return $item;
    }
    public function toArray(): array
    {
        return [];
    }

    public function id(): CartItemId
    {
        return $this->id;
    }

    public function cart(): Cart
    {
        return $this->cart;
    }

    public function productId(): ProductId
    {
        return $this->productId;
    }

    public function quantity(): CartItemQuantity
    {
        return $this->quantity;
    }
}
