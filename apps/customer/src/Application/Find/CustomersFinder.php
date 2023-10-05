<?php

declare(strict_types=1);

namespace Customer\Application\Find;

use Customer\Application\Find\DTO\CustomersFinderResponse;
use Customer\Domain\Repository\CustomerRepository;

final class CustomersFinder
{
    public function __construct(
        private CustomerRepository $repository
    ) {
    }

    public function __invoke(): CustomersFinderResponse
    {
        $customers = $this->repository->findAll();
        return new CustomersFinderResponse(... $customers);
    }
}
