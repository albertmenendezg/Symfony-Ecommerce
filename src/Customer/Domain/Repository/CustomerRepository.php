<?php

declare(strict_types=1);

namespace Customer\Domain\Repository;

use Customer\Domain\Customer;

interface CustomerRepository
{
    public function save(Customer $customer): void;

    public function remove(Customer $customer): void;

    /**
     * @return Customer[]
     */
    public function findAll(): iterable;
}
