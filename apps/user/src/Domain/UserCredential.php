<?php

declare(strict_types=1);

namespace User\Domain;

use Shared\Domain\AggregateRoot;
use User\Domain\Event\UserCreatedWasCreated;
use User\Domain\ValueObject\UserCredentialCreatedAt;
use User\Domain\ValueObject\UserCredentialId;
use User\Domain\ValueObject\UserCredentialType;
use User\Domain\ValueObject\UserCredentialUpdatedAt;
use User\Domain\ValueObject\UserCredentialValue;
use User\Domain\ValueObject\UserPlainPassword;

final class UserCredential extends AggregateRoot
{

    public function __construct(
        private UserCredentialId        $id,
        private User                    $user,
        private UserCredentialValue     $value,
        private UserCredentialType      $type,
        private UserCredentialCreatedAt $createdAt,
        private UserCredentialUpdatedAt $updatedAt,
    ) {
    }

    public static function createPassword (
        UserCredentialId $id,
        User $user,
        UserPlainPassword $password,
    ): self {
        $credential = new self(
            $id,
            $user,
            $password,
            UserCredentialType::password(),
            new UserCredentialCreatedAt(),
            new UserCredentialUpdatedAt(),
        );

        $credential->record(
            new UserCreatedWasCreated(
                $id->value(),
                $credential->toArray()
            )
        );

        return $credential;
    }

    public function toArray(): array
    {
        return [

        ];
    }

    public function id(): UserCredentialId
    {
        return $this->id;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function value(): UserCredentialValue
    {
        return $this->value;
    }

    public function type(): UserCredentialType
    {
        return $this->type;
    }

    public function createdAt(): UserCredentialCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): UserCredentialUpdatedAt
    {
        return $this->updatedAt;
    }
}
