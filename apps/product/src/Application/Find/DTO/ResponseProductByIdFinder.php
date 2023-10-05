<?php

declare(strict_types=1);

namespace Product\Application\Find\DTO;

use Product\Domain\Product;

final class ResponseProductByIdFinder
{
    public function __construct(
        private Product $product
    ) {
    }

    public function product(): Product
    {
        return $this->product;
    }
}
