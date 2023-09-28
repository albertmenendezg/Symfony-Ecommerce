<?php

declare(strict_types=1);

namespace Customer\Domain;

use Customer\Domain\Event\CustomerWasCreated;
use Customer\Domain\ValueObject\CustomerCreatedAt;
use Customer\Domain\ValueObject\CustomerEmail;
use Customer\Domain\ValueObject\CustomerName;
use Customer\Domain\ValueObject\CustomerStatus;
use Customer\Domain\ValueObject\CustomerSurname;
use Customer\Domain\ValueObject\CustomerUpdatedAt;
use Shared\Domain\AggregateRoot;
use Shared\Domain\ValueObject\CustomerId;

final class Customer extends AggregateRoot
{
    public function __construct(
        private CustomerId $id,
        private CustomerName $name,
        private CustomerSurname $surname,
        private CustomerEmail $email,
        private CustomerStatus $status,
        private CustomerCreatedAt $createdAt,
        private CustomerUpdatedAt $updatedAt,
    ) {
    }

    public static function create(
        CustomerId $id,
        CustomerName $name,
        CustomerSurname $surname,
        CustomerEmail $email,
    ): self {
        $customer = new Customer(
            $id,
            $name,
            $surname,
            $email,
            CustomerStatus::active(),
            new CustomerCreatedAt(),
            new CustomerUpdatedAt(),
        );

        $customer->record(
            new CustomerWasCreated(
                $customer->id->value(),
                $customer->toArray(),
            )
        );

        return $customer;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'surname' => $this->surname->value(),
            'email' => $this->email->value(),
            'created_at' => $this->createdAt->__toString(),
            'updated_at' => $this->updatedAt->__toString()
        ];
    }

    public function id(): CustomerId
    {
        return $this->id;
    }

    public function name(): CustomerName
    {
        return $this->name;
    }

    public function surname(): CustomerSurname
    {
        return $this->surname;
    }

    public function email(): CustomerEmail
    {
        return $this->email;
    }

    public function status(): CustomerStatus
    {
        return $this->status;
    }

    public function createdAt(): CustomerCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): CustomerUpdatedAt
    {
        return $this->updatedAt;
    }
}
