<?php

declare(strict_types=1);

namespace Customer\Domain;

use Customer\Domain\Event\CustomerWasCreated;
use Customer\Domain\ValueObject\CustomerCreatedAt;
use Customer\Domain\ValueObject\CustomerName;
use Customer\Domain\ValueObject\CustomerStatus;
use Customer\Domain\ValueObject\CustomerSurname;
use Customer\Domain\ValueObject\CustomerUpdatedAt;
use Shared\Domain\AggregateRoot;
use Shared\Domain\ValueObject\CustomerId;
use Shared\Domain\ValueObject\UserId;

final class Customer extends AggregateRoot
{
    public function __construct(
        private CustomerId $id,
        private UserId $userId,
        private CustomerName $name,
        private CustomerSurname $surname,
        private CustomerStatus $status,
        private CustomerCreatedAt $createdAt,
        private CustomerUpdatedAt $updatedAt,
    ) {
    }

    public static function create(
        CustomerId $id,
        UserId $userId,
        CustomerName $name,
        CustomerSurname $surname,
    ): self {
        $customer = new Customer(
            $id,
            $userId,
            $name,
            $surname,
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
            'user_id' => $this->userId->value(),
            'name' => $this->name->value(),
            'surname' => $this->surname->value(),
            'created_at' => $this->createdAt->__toString(),
            'updated_at' => $this->updatedAt->__toString()
        ];
    }

    public function id(): CustomerId
    {
        return $this->id;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function name(): CustomerName
    {
        return $this->name;
    }

    public function surname(): CustomerSurname
    {
        return $this->surname;
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
