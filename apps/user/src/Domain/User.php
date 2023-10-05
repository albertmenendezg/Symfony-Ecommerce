<?php

declare(strict_types=1);

namespace User\Domain;

use Shared\Domain\AggregateRoot;
use Shared\Domain\ValueObject\UserId;
use User\Domain\Event\UserAddedCredential;
use User\Domain\Event\UserWasCreated;
use User\Domain\ValueObject\UserAdmin;
use User\Domain\ValueObject\UserEmail;
use User\Domain\ValueObject\UserRole;

final class User extends AggregateRoot
{
    /** @var $credentials UserCredential[] */
    private iterable $credentials;
    public function __construct(
        private UserId $id,
        private UserEmail $email,
        private UserAdmin $admin,
    ) {
        $this->credentials = [];
    }

    public static function create(
        UserId $id,
        UserEmail $email,
    ): self {

        $user = new self (
            $id,
            $email,
            UserAdmin::notAdmin()
        );

        $user->record(
            new UserWasCreated (
                $user->id->value(),
                $user->toArray()
            )
        );

        return $user;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'email' => $this->email->value(),
            'admin' => $this->admin->value(),
        ];
    }

    public function addCredential(UserCredential $credential): void
    {
        $this->credentials[] = $credential;
        $this->record(
            new UserAddedCredential (
                $this->id->value(),
                $this->toArray()
            )
        );
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function credentials(): iterable
    {
        return $this->credentials;
    }

    public function admin(): UserAdmin
    {
        return $this->admin;
    }

    /**
     * @return UserRole[]
     */
    public function roles(): array
    {
        $roles = [new UserRole('user')];
        if ($this->admin->value()) {
            $roles[] = new UserRole('admin');
        }
        return $roles;
    }
}
