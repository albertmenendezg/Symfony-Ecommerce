<?php

declare(strict_types=1);

namespace Customer\Application\Find\DTO;

use Customer\Domain\Customer;

final class CustomersFinderResponse
{
    private iterable $customers;
    public function __construct(
        Customer ... $customer
    ) {
        $this->customers = $customer;
    }

    public function toArray(): array
    {
        $resp = [];
        foreach ($this->customers as $customer) {
            $resp[] = $customer->toArray();
        }
        return $resp;
    }

    public function customers(): iterable
    {
        return $this->customers;
    }
}
