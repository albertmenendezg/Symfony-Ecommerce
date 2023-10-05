<?php

namespace Product\Domain\Repository;

use Product\Domain\ProductCategory;
use Product\Domain\ValueObject\ProductCategoryId;

interface ProductCategoryRepository
{
    public function save(ProductCategory $category): void;
    public function remove(ProductCategory $category): void;

    /**
     * @return ProductCategory[]
     */
    public function findAll(): iterable;
    public function findById(ProductCategoryId $id): ?ProductCategory;
}