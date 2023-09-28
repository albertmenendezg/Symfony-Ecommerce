<?php

namespace Product\Domain\Repository;

use Product\Domain\Category;

interface CategoryRepository
{
    public function save(Category $category): void;
    public function remove(Category $category): void;

    /**
     * @return Category[]
     */
    public function findAll(): iterable;
    public function findById(Category $id): ?Category;
}