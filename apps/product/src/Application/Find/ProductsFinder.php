<?php

declare(strict_types=1);

namespace Product\Application\Find;

use Product\Application\Find\DTO\ResponseProductsFinder;
use Product\Domain\Repository\ProductRepository;

final class ProductsFinder
{
    public function __construct(
        private ProductRepository $repository
    ) {
    }

    public function __invoke(): ResponseProductsFinder
    {
        $products = $this->repository->findAll();
        return new ResponseProductsFinder(... $products);
    }
}
