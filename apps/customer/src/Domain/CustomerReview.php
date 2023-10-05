<?php

declare(strict_types=1);

namespace Customer\Domain;

use Customer\Domain\Event\CustomerReviewWasCreated;
use Customer\Domain\ValueObject\CustomerReviewDescription;
use Customer\Domain\ValueObject\CustomerReviewId;
use Customer\Domain\ValueObject\CustomerReviewRating;
use Customer\Domain\ValueObject\CustomerReviewTitle;
use Shared\Domain\AggregateRoot;
use Shared\Domain\ValueObject\ProductId;

final class CustomerReview extends AggregateRoot
{
    public function __construct(
        private CustomerReviewId          $id,
        private Customer                  $customer,
        private ProductId                 $productId,
        private CustomerReviewTitle       $title,
        private CustomerReviewDescription $description,
        private CustomerReviewRating      $rating,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'customer_id' => $this->customer->id()->value(),
            'product_id' => $this->productId->value(),
            'title' => $this->title->value(),
            'description' => $this->description->value(),
            'rating' => $this->rating->value(),
        ];
    }

    public static function create(
        CustomerReviewId          $id,
        Customer                  $customer,
        ProductId                 $productId,
        CustomerReviewTitle       $title,
        CustomerReviewDescription $description,
        CustomerReviewRating      $rating,
    ): self {
        $review = new self(
            $id,
            $customer,
            $productId,
            $title,
            $description,
            $rating
        );

        $review->record(
            new CustomerReviewWasCreated (
                $review->id->value(),
                $review->toArray()
            )
        );

        return $review;
    }

    public function reviewId(): CustomerReviewId
    {
        return $this->id;
    }

    public function customer(): Customer
    {
        return $this->customer;
    }

    public function productId(): ProductId
    {
        return $this->productId;
    }

    public function title(): CustomerReviewTitle
    {
        return $this->title;
    }

    public function description(): CustomerReviewDescription
    {
        return $this->description;
    }

    public function rating(): CustomerReviewRating
    {
        return $this->rating;
    }
}
