<?php

declare(strict_types=1);

namespace Customer\Application\Create;

use Customer\Application\Create\DTO\RequestCustomerCreator;
use Customer\Domain\Customer;
use Customer\Domain\Repository\CustomerRepository;
use Customer\Domain\ValueObject\CustomerName;
use Customer\Domain\ValueObject\CustomerSurname;
use Shared\Domain\Event\DomainEventPublisher;
use Shared\Domain\ValueObject\CustomerId;
use Shared\Domain\ValueObject\UserId;

final class CustomerCreator
{

    public function __construct(
        private CustomerRepository $repository,
        private DomainEventPublisher $publisher
    ) {
    }

    public function __invoke(RequestCustomerCreator $request): void
    {
        $customer = Customer::create(
            new CustomerId($request->id()),
            new UserId($request->userId()),
            new CustomerName($request->name()),
            new CustomerSurname($request->surname()),
        );

        $this->repository->save($customer);
        $this->publisher->publish(... $customer->pullDomainEvents());
    }
}
