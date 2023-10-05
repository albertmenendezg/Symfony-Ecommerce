<?php

declare(strict_types=1);

namespace Payment\Domain;

use Payment\Domain\ValueObject\PaymentId;
use Shared\Domain\AggregateRoot;

class Payment extends AggregateRoot
{
    public function __construct(
        private PaymentId $id,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value()
        ];
    }
}
