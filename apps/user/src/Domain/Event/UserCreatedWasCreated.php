<?php

declare(strict_types=1);

namespace User\Domain\Event;

use Shared\Domain\Event\DomainEvent;

final class UserCreatedWasCreated extends DomainEvent
{

    public function eventName(): string
    {
        return 'user.credential_was_created';
    }
}
