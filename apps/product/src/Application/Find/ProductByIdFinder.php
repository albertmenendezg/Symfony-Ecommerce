<?php

declare(strict_types=1);

namespace Product\Application\Find;

use Product\Application\Exception\ProductByIdNotFound;
use Product\Application\Find\DTO\RequestProductByIdFinder;
use Product\Application\Find\DTO\ResponseProductByIdFinder;
use Product\Domain\Repository\ProductRepository;
use Shared\Domain\ValueObject\ProductId;

final class ProductByIdFinder
{
    public function __construct(
        private ProductRepository $repository
    ) {
    }

    /**
     * @throws ProductByIdNotFound
     */
    public function __invoke(
        RequestProductByIdFinder $request
    ): ResponseProductByIdFinder {
        $id = new ProductId($request->id());
        $product = $this->repository->findById($id);

        if (!$product) {
            throw new ProductByIdNotFound($request->id());
        }

        return new ResponseProductByIdFinder($product);
    }
}
