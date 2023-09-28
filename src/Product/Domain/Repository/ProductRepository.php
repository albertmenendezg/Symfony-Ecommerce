<?php

namespace Product\Domain\Repository;

use Product\Domain\Product;
use Shared\Domain\ValueObject\ProductId;

interface ProductRepository
{
    public function save(Product $product): void;
    public function remove(Product $product): void;

    /**
     * @return Product[]
     */
    public function findAll(): iterable;
    public function findById(ProductId $id): ?Product;
}