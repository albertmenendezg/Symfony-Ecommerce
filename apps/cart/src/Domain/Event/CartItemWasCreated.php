<?php

declare(strict_types=1);

namespace Cart\Domain\Event;

use Shared\Domain\Event\DomainEvent;

final class CartItemWasCreated extends DomainEvent
{

    public function eventName(): string
    {
        return 'cart.was_created';
    }
}
