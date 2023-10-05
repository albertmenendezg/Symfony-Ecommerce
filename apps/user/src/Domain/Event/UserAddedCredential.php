<?php

declare(strict_types=1);

namespace User\Domain\Event;

use Shared\Domain\Event\DomainEvent;

final class UserAddedCredential extends DomainEvent
{

    public function eventName(): string
    {
        return 'user.credential_added';
    }
}
