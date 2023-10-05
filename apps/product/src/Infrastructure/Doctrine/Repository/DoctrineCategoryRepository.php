<?php

declare(strict_types=1);

namespace Product\Infrastructure\Doctrine\Repository;

use Product\Domain\ProductCategory;
use Product\Domain\Repository\ProductCategoryRepository;
use Product\Domain\ValueObject\ProductCategoryId;
use Shared\Infrastructure\Doctrine\DoctrineAbstractRepository;

final class DoctrineCategoryRepository extends DoctrineAbstractRepository implements ProductCategoryRepository
{

    public function entityRepositoryClass(): string
    {
        return ProductCategory::class;
    }

    public function save(ProductCategory $category): void
    {
        $this->em()->persist($category);
        $this->em()->flush();
    }

    public function remove(ProductCategory $category): void
    {
        $this->em()->remove($category);
        $this->em()->flush();
    }

    /**
     * @return ProductCategory[]
     */
    public function findAll(): iterable
    {
        return $this->repository()->findAll();
    }

    public function findById(ProductCategoryId $id): ?ProductCategory
    {
        return $this->repository()->findOneBy(['id' => $id]);
    }
}
