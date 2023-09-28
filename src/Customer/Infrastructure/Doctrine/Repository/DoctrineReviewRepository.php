<?php

declare(strict_types=1);

namespace Customer\Infrastructure\Doctrine\Repository;

use Customer\Domain\Repository\ReviewRepository;
use Customer\Domain\Review;
use Shared\Domain\ValueObject\ProductId;
use Shared\Infrastructure\Doctrine\DoctrineAbstractRepository;

final class DoctrineReviewRepository extends DoctrineAbstractRepository implements ReviewRepository
{

    public function entityRepositoryClass(): string
    {
        return Review::class;
    }

    public function entityManagerName(): string
    {
        return 'customers_em';
    }

    public function save(Review $review): void
    {
        $this->em()->persist($review);
        $this->em()->flush();
    }

    public function remove(Review $review): void
    {
        $this->em()->remove($review);
        $this->em()->flush();
    }

    /**
     * @return Review[]
     */
    public function findAll(): iterable
    {
        return $this->repository()->findAll();
    }

    /**
     * @return Review[]
     */
    public function findAllByProductId(ProductId $productId): iterable
    {
        return $this->repository()->findBy(['productId' => $productId]);
    }
}
