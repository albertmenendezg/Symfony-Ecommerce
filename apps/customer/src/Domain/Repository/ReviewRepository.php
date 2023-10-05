<?php

declare(strict_types=1);

namespace Customer\Domain\Repository;

use Customer\Domain\CustomerReview;
use Shared\Domain\ValueObject\ProductId;

interface ReviewRepository
{
    public function save(CustomerReview $review): void;

    public function remove(CustomerReview $review): void;

    /**
     * @return CustomerReview[]
     */
    public function findAll(): iterable;

    /**
     * @return CustomerReview[]
     */
    public function findAllByProductId(ProductId $productId): iterable;
}
