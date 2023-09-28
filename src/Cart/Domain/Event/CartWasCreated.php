<?php

declare(strict_types=1);

namespace Cart\Domain\Event;

use Shared\Domain\Event\DomainEvent;

final class CartWasCreated extends DomainEvent
{

    public function eventName(): string
    {
        return 'cart.was_created';
    }
}
