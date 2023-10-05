<?php

declare(strict_types=1);

namespace Customer\Infrastructure\Doctrine\Repository;

use Customer\Domain\CustomerReview;
use Customer\Domain\Repository\ReviewRepository;
use Shared\Domain\ValueObject\ProductId;
use Shared\Infrastructure\Doctrine\DoctrineAbstractRepository;

final class DoctrineReviewRepository extends DoctrineAbstractRepository implements ReviewRepository
{

    public function entityRepositoryClass(): string
    {
        return CustomerReview::class;
    }

    public function save(CustomerReview $review): void
    {
        $this->em()->persist($review);
        $this->em()->flush();
    }

    public function remove(CustomerReview $review): void
    {
        $this->em()->remove($review);
        $this->em()->flush();
    }

    /**
     * @return CustomerReview[]
     */
    public function findAll(): iterable
    {
        return $this->repository()->findAll();
    }

    /**
     * @return CustomerReview[]
     */
    public function findAllByProductId(ProductId $productId): iterable
    {
        return $this->repository()->findBy(['productId' => $productId]);
    }
}
