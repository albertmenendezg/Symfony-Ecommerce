<?php

declare(strict_types=1);

namespace Customer\Domain\ValueObject;

use Customer\Domain\Exception\InvalidReviewRating;
use Shared\Domain\ValueObject\PositiveIntValueObject;

final class CustomerReviewRating extends PositiveIntValueObject
{
    public function __construct(int $value)
    {
        $this->ensureValidRatingNumber($value);
        parent::__construct($value);
    }

    private function ensureValidRatingNumber(int $rating): void
    {
        if ($rating > 10 || $rating < 0) {
            throw new InvalidReviewRating($rating);
        }
    }
}
