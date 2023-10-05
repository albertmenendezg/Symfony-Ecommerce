<?php

declare(strict_types=1);

namespace Cart\Domain\Repository;

use Cart\Domain\CartItem;

interface CartItemRepository
{
    public function save(CartItem $item): void;
    public function remove(CartItem $item): void;

    /**
     * @return CartItem[]
     */
    public function findAll(): iterable;
}
