<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Messenger;

use Shared\Domain\Event\DomainEvent;
use Shared\Domain\Event\DomainEventPublisher;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerDomainEventPublisher implements DomainEventPublisher
{

    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->bus->dispatch($event);
        }
    }
}