<?php

declare(strict_types=1);

namespace Customer\Domain;

use Customer\Domain\ValueObject\ReviewDescription;
use Customer\Domain\ValueObject\ReviewId;
use Customer\Domain\ValueObject\ReviewRating;
use Customer\Domain\ValueObject\ReviewTitle;
use Shared\Domain\AggregateRoot;
use Shared\Domain\ValueObject\CustomerId;
use Shared\Domain\ValueObject\ProductId;

final class Review extends AggregateRoot
{
    public function __construct(
        private ReviewId $id,
        private CustomerId $customerId,
        private ProductId $productId,
        private ReviewTitle $title,
        private ReviewDescription $description,
        private ReviewRating $rating,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'customer_id' => $this->customerId->value(),
            'product_id' => $this->productId->value(),
            'title' => $this->title->value(),
            'description' => $this->description->value(),
            'rating' => $this->rating->value(),
        ];
    }

    public function reviewId(): ReviewId
    {
        return $this->id;
    }

    public function customerId(): CustomerId
    {
        return $this->customerId;
    }

    public function productId(): ProductId
    {
        return $this->productId;
    }

    public function title(): ReviewTitle
    {
        return $this->title;
    }

    public function description(): ReviewDescription
    {
        return $this->description;
    }

    public function rating(): ReviewRating
    {
        return $this->rating;
    }
}
