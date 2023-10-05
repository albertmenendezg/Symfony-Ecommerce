<?php

declare(strict_types=1);

namespace Customer\Domain\Event;

use Shared\Domain\Event\DomainEvent;

final class CustomerReviewWasCreated extends DomainEvent
{

    public function eventName(): string
    {
        return 'customer.review_was_created';
    }
}
