<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

use App\Shared\Domain\ValueObject\Uuid;
use DateTimeImmutable;

abstract class DomainEvent
{
    private string $aggregateId;
    private array $data;
    private string $eventId;
    private DateTimeImmutable $occurredOn;

    final public function __construct(
        string $aggregateId,
        array $data,
        ?string $eventId = null,
        ?DateTimeImmutable $occurredOn = null
    ) {
        $this->aggregateId = $aggregateId;
        $this->data = $data;
        $this->eventId = $eventId ?? Uuid::random()->__toString();
        $this->occurredOn = $occurredOn ?? new DateTimeImmutable();
    }

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function occurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }

    abstract public function eventName(): string;
}