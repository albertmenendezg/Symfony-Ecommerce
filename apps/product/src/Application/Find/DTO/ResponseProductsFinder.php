<?php

declare(strict_types=1);

namespace Product\Application\Find\DTO;

use Product\Domain\Product;

final class ResponseProductsFinder
{
    private iterable $products;
    public function __construct(
        Product ... $product
    ) {
        $this->products = $product;
    }

    public function products(): iterable
    {
        return $this->products;
    }

    public function toArray(): iterable
    {
        $resp = [];
        foreach ($this->products as $product) {
            $resp[] = $product->toArray();
        }
        return  $resp;
    }
}
