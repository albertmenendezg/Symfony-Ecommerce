<?php

declare(strict_types=1);

namespace Product\Infrastructure\Doctrine\Repository;

use Product\Domain\Category;
use Product\Domain\Repository\CategoryRepository;
use Shared\Infrastructure\Doctrine\DoctrineAbstractRepository;

final class DoctrineCategoryRepository extends DoctrineAbstractRepository implements CategoryRepository
{

    public function entityRepositoryClass(): string
    {
        return Category::class;
    }

    public function entityManagerName(): string
    {
        return 'products_em';
    }

    public function save(Category $category): void
    {
        $this->em()->persist($category);
        $this->em()->flush();
    }

    public function remove(Category $category): void
    {
        $this->em()->remove($category);
        $this->em()->flush();
    }

    /**
     * @return Category[]
     */
    public function findAll(): iterable
    {
        return $this->repository()->findAll();
    }

    public function findById(Category $id): ?Category
    {
        return $this->repository()->findOneBy(['id' => $id]);
    }
}
