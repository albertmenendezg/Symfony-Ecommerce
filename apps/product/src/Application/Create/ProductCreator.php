<?php

declare(strict_types=1);

namespace Product\Application\Create;

use Product\Application\Create\DTO\RequestProductCreator;
use Product\Application\Find\DTO\RequestProductCategoryByIdFinder;
use Product\Application\Find\ProductCategoryByIdFinder;
use Product\Domain\Product;
use Product\Domain\Repository\ProductRepository;
use Product\Domain\ValueObject\ProductDescription;
use Product\Domain\ValueObject\ProductName;
use Product\Domain\ValueObject\ProductPrice;
use Product\Domain\ValueObject\ProductStock;
use Shared\Domain\Event\DomainEventPublisher;
use Shared\Domain\ValueObject\ProductId;

final class ProductCreator
{
    public function __construct(
        private ProductRepository $repository,
        private ProductCategoryByIdFinder $productCategoryByIdFinder,
        private DomainEventPublisher $publisher,
    ) {
    }

    public function __invoke(RequestProductCreator $request): void
    {
        $category = $this->productCategoryByIdFinder->__invoke(
            new RequestProductCategoryByIdFinder(
                $request->categoryId()
            )
        )->category();

        $product = Product::create(
            new ProductId($request->id()),
            new ProductName($request->name()),
            new ProductDescription($request->description()),
            new ProductStock($request->stock()),
            new ProductPrice($request->price()),
            $category,
        );

        $this->repository->save($product);
        $this->publisher->publish(... $product->pullDomainEvents());
    }
}
