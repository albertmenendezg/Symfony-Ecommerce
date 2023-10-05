<?php

declare(strict_types=1);

namespace User\Domain\Repository;

use Shared\Domain\ValueObject\UserId;
use User\Domain\User;
use User\Domain\ValueObject\UserEmail;

interface UserRepository
{
    public function save(User $user): void;
    public function findById(UserId $id): ?User;

    /**
     * @return User[]
     */
    public function findAll(): iterable;
    public function findByEmail(UserEmail $email): ?User;
}
