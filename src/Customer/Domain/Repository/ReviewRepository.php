<?php

declare(strict_types=1);

namespace Customer\Domain\Repository;

use Customer\Domain\Review;
use Shared\Domain\ValueObject\ProductId;

interface ReviewRepository
{
    public function save(Review $review): void;

    public function remove(Review $review): void;

    /**
     * @return Review[]
     */
    public function findAll(): iterable;

    /**
     * @return Review[]
     */
    public function findAllByProductId(ProductId $productId): iterable;
}
