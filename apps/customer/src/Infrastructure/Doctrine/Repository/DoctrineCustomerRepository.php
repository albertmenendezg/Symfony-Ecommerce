<?php

declare(strict_types=1);

namespace Customer\Infrastructure\Doctrine\Repository;

use Customer\Domain\Customer;
use Customer\Domain\Repository\CustomerRepository;
use Shared\Infrastructure\Doctrine\DoctrineAbstractRepository;

final class DoctrineCustomerRepository extends DoctrineAbstractRepository implements CustomerRepository
{
    public function entityRepositoryClass(): string
    {
        return Customer::class;
    }

    public function save(Customer $customer): void
    {
        $this->em()->persist($customer);
        $this->em()->flush();
    }

    public function remove(Customer $customer): void
    {
        $this->em()->remove($customer);
        $this->em()->flush();
    }

    /**
     * @return Customer[]
     */
    public function findAll(): iterable
    {
        return $this->repository()->findAll();
    }
}
