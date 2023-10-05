<?php

declare(strict_types=1);

namespace Product\Infrastructure\Doctrine\Repository;

use Product\Domain\Product;
use Product\Domain\Repository\ProductRepository;
use Shared\Domain\ValueObject\ProductId;
use Shared\Infrastructure\Doctrine\DoctrineAbstractRepository;

final class DoctrineProductRepository extends DoctrineAbstractRepository implements ProductRepository
{

    public function entityRepositoryClass(): string
    {
        return Product::class;
    }

    public function save(Product $product): void
    {
        $this->em()->persist($product);
        $this->em()->flush();
    }

    public function remove(Product $product): void
    {
        $this->em()->remove($product);
        $this->em()->flush();
    }

    /**
     * @return Product[]
     */
    public function findAll(): iterable
    {
        return $this->repository()->findAll();
    }

    public function findById(ProductId $id): ?Product
    {
        return $this->repository()->find($id);
    }
}
