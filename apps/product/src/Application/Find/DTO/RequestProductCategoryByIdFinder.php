<?php

declare(strict_types=1);

namespace Product\Application\Find\DTO;

final class RequestProductCategoryByIdFinder
{
    public function __construct(
        private string $categoryId
    ) {
    }

    public function categoryId(): string
    {
        return $this->categoryId;
    }
}
