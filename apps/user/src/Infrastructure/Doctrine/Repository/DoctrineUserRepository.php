<?php

declare(strict_types=1);

namespace User\Infrastructure\Doctrine\Repository;

use Shared\Domain\ValueObject\UserId;
use Shared\Infrastructure\Doctrine\DoctrineAbstractRepository;
use User\Domain\Repository\UserRepository;
use User\Domain\User;
use User\Domain\ValueObject\UserEmail;

final class DoctrineUserRepository extends DoctrineAbstractRepository implements UserRepository
{

    public function entityRepositoryClass(): string
    {
        return User::class;
    }

    public function save(User $user): void
    {
        $this->em()->persist($user);
        $this->em()->flush();
    }

    public function findById(UserId $id): ?User
    {
        return $this->repository()->find($id);
    }

    public function findAll(): iterable
    {
        return $this->repository()->findAll();
    }

    public function findByEmail(UserEmail $email): ?User
    {
        return $this->repository()->findOneBy(['email.value' => $email->value()]);
    }
}
