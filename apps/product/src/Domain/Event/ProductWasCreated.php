<?php

declare(strict_types=1);

namespace Product\Domain\Event;

use Shared\Domain\Event\DomainEvent;

final class ProductWasCreated extends DomainEvent
{
    public function eventName(): string
    {
        return 'product.was_created';
    }
}
