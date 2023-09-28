<?php

declare(strict_types=1);

namespace Cart\Domain\Repository;

use Cart\Domain\Cart;

interface CartRepository
{
    public function save(Cart $cart): void;
    public function remove(Cart $cart): void;

    /**
     * @return Cart[]
     */
    public function findAll(): iterable;
}
