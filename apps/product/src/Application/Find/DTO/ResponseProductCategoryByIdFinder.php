<?php

declare(strict_types=1);

namespace Product\Application\Find\DTO;

use Product\Domain\ProductCategory;

final class ResponseProductCategoryByIdFinder
{
    public function __construct(private ProductCategory $category)
    {
    }

    public function category(): ProductCategory
    {
        return $this->category;
    }
}
