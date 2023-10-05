<?php

declare(strict_types=1);

namespace Product\Application\Find;

use Product\Application\Exception\ProductCategoryNotFound;
use Product\Application\Find\DTO\RequestProductCategoryByIdFinder;
use Product\Application\Find\DTO\ResponseProductCategoryByIdFinder;
use Product\Domain\Repository\ProductCategoryRepository;
use Product\Domain\ValueObject\ProductCategoryId;

final class ProductCategoryByIdFinder
{
    public function __construct(
        private ProductCategoryRepository $repository
    ) {
    }

    public function __invoke(RequestProductCategoryByIdFinder $request): ResponseProductCategoryByIdFinder
    {
        $categoryId = new ProductCategoryId($request->categoryId());
        $category = $this->repository->findById($categoryId);
        if (!$category) {
            throw new ProductCategoryNotFound($categoryId);
        }

        return new ResponseProductCategoryByIdFinder($category);
    }
}
