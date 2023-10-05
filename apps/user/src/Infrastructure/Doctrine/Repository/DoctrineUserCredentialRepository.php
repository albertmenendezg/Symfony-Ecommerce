<?php

declare(strict_types=1);

namespace User\Infrastructure\Doctrine\Repository;

use Shared\Infrastructure\Doctrine\DoctrineAbstractRepository;
use User\Domain\Repository\UserCredentialRepository;
use User\Domain\UserCredential;

final class DoctrineUserCredentialRepository extends DoctrineAbstractRepository implements UserCredentialRepository
{

    public function entityRepositoryClass(): string
    {
        return UserCredential::class;
    }

    public function save(UserCredential $credential): void
    {
        $this->em()->persist($credential);
        $this->em()->flush();
    }
}
