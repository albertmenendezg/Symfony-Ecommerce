<?php

declare(strict_types=1);

namespace Cart\Application\Find\DTO;

use Cart\Domain\Cart;

final class ResponseCartsFinder
{
    private iterable $carts;
    public function __construct(
        Cart ... $cart
    ) {
        $this->carts = $cart;
    }

    public function toArray(): array
    {
        $resp = [];
        foreach ($this->carts as $cart) {
            $resp[] = $cart->toArray();
        }
        return $resp;
    }
}
