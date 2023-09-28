<?php

declare(strict_types=1);

namespace Product\Domain\Event;

use Shared\Domain\Event\DomainEvent;

final class CategoryWasCreated extends DomainEvent
{

    public function eventName(): string
    {
        return 'category.was_created';
    }
}
