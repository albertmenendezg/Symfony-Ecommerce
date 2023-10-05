<?php

declare(strict_types=1);

namespace Shared\Domain\Event;

interface DomainEventPublisher
{
    public function publish(DomainEvent ...$event): void;
}