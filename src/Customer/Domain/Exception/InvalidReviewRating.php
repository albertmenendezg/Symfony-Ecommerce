<?php

declare(strict_types=1);

namespace Customer\Domain\Exception;

use DomainException;

final class InvalidReviewRating extends DomainException
{
    public function __construct(int $rating)
    {
        parent::__construct("The rating $rating should be greater than 0 and less than 10");
    }
}
