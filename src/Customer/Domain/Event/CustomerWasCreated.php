<?php

declare(strict_types=1);

namespace Customer\Domain\Event;

use Shared\Domain\Event\DomainEvent;

final class CustomerWasCreated extends DomainEvent
{

    public function eventName(): string
    {
        return 'customer.was_created';
    }
}
