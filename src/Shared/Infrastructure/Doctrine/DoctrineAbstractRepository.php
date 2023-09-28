<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

abstract class DoctrineAbstractRepository
{

    private EntityManagerInterface $em;
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->em = $managerRegistry->getManager($this->entityManagerName());
    }

    public function em(): EntityManagerInterface
    {
        return $this->em;
    }

    public function repository(): EntityRepository
    {
        return $this->em->getRepository($this->entityRepositoryClass());
    }

    public abstract function entityRepositoryClass(): string;
    public abstract function entityManagerName(): string;
}